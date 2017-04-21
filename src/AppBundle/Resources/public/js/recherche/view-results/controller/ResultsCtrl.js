'use strict';

angular
    .module('results')
    .controller('ResultsCtrl', [
        '$scope',
        '$http',
        '$routeParams',
        //'$rootScope',
        'ResultsService',
        function($scope, $http, $routeParams, /*$rootScope,*/ ResultsService){

            //$rootScope.titre = 'CATALOGUE';
            $scope.agents = [];
            var start = {lat: $routeParams.startLat,
                         lng: $routeParams.startLng};
            var finish = {lat: $routeParams.finishLat,
                          lng: $routeParams.finishLng};

            ResultsService.searchAgents(start, finish).then(function(data){
                $scope.searching = false;
                $scope.agents = data;
            });


        }]);
