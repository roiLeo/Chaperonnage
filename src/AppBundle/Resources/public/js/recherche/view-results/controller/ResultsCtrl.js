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
            $scope.selectedAgent = {};
            $scope.agentUrl = '#';
            $scope.idRide = '0';

            var start = {lat: RechercheService.getStartPoint().lat,
                         lng: RechercheService.getStartPoint().lng};
            var finish = {lat: RechercheService.getFinishPoint().lat,
                          lng: RechercheService.getFinishPoint().lng};

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: start
            });

            var m2 = new google.maps.Marker({
                position: start,
                map: map,
                title: 'départ',
            });

            var marker = new google.maps.Marker({
                position: start,
                map: map,
                title: 'agent',
            });

            RechercheService.newRide()
                .then(function(response){
                    $scope.idRide = response.data.id;
                    ResultsService.searchAgents(start, finish).then(function(data){
                        $scope.searching = false;
                        $scope.agents = data;
                    });
                },
                function(){
                    $location.path('/recherche');
                });

            $scope.showAgent = function(agent){
                $scope.agentUrl= "http://127.0.0.1:8000/ride/edit/" + $scope.idRide +
                    "?appbundle_ride%5Bstatus%5D=in+progress" +
                    "&appbundle_ride%5BguardUser%5D=" + agent.id;
                marker.setPosition(agent.position);
                map.setCenter(agent.position);
            };
        }]);
