'use strict';

angular
    .module('results')
    .controller('ResultsCtrl', [
        '$scope',
        '$http',
        '$location',
        'RechercheService',
        'ResultsService',
        function($scope, $http, $location, RechercheService, ResultsService){

            if(!(RechercheService.getStartPoint()&&RechercheService.getFinishPoint()&&RechercheService.getDate())){
                $location.path('/recherche');
            }

            $scope.agents = [];
            $scope.agentUrl = '#';
            $scope.idRide = '0';
            var start = null;
            var finish = null;
            var startMarker = null;
            var finishMarker = null;
            var agentsMarkers = [];
            var bounds  = new google.maps.LatLngBounds();
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: start
            });
            directionsDisplay.setMap(map);

            start = {lat: RechercheService.getStartPoint().lat,
                         lng: RechercheService.getStartPoint().lng};
            finish = {lat: RechercheService.getFinishPoint().lat,
                          lng: RechercheService.getFinishPoint().lng};
            bounds.extend(start);
            bounds.extend(finish);


            startMarker = new google.maps.Marker({
                position: start,
                map: map,
                title: 'départ',
            });

            finishMarker = new google.maps.Marker({
                position: finish,
                map: map,
                title: 'arrivé',
            });

            if(start&&finish){
                //Displaying the direction on the map
                console.log(start);
                console.log('direction');
                directionsService.route({
                    origin: start,
                    destination: finish,
                    travelMode: 'WALKING'
                }, function (response, status) {
                    if (status === 'OK') {
                        finishMarker.setMap(null);
                        startMarker.setMap(null);
                        directionsDisplay.setDirections(response);
                    } else{
                        startMarker.setMap(map);
                        finishMarker.setMap(map);
                    }
                });
            }

            RechercheService.newRide()
                .then(function(response){
                    $scope.idRide = response.data.id;
                    ResultsService.searchAgents(start, finish).then(function(data){
                        $scope.searching = false;
                        $scope.agents = data;

                        for(var agent in $scope.agents){
                            agentsMarkers[$scope.agents[agent].id] = new google.maps.Marker({
                                position: $scope.agents[agent].position,
                                map: map,
                                title: $scope.agents[agent].name,

                            });
                            bounds.extend($scope.agents[agent].position);
                        }

                        map.fitBounds(bounds);
                        map.panToBounds(bounds);
                    });
                },
                function(){
                    $location.path('/recherche');
                });
        }]);
