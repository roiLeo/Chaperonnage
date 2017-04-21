'use strict';

angular
    .module('results')
    .controller('ResultsCtrl', [
        '$scope',
        '$http',
        'RechercheService',
        'ResultsService',
        function($scope, $http, RechercheService, ResultsService){

            $scope.agents = [];
            $scope.selectedAgent = {};

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

            ResultsService.searchAgents(start, finish).then(function(data){
                $scope.searching = false;
                $scope.agents = data;
            });

            $scope.showAgent = function(agent){
                marker.setPosition(agent.position);
                map.setCenter(agent.position);
            };
        }]);
