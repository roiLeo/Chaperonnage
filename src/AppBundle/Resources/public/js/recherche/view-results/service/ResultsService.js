angular
    .module('results')
    .factory('ResultsService', function($http){
        var service = {};

        service.searchAgents = function(start, finish){
            var url = 'http://localhost:8000/api/agents?' +
                'startlat='+start.lat
                +'&startlng='+start.lng
                +'&finishlat='+finish.lat
                +'&finishlng='+finish.lng;

            return $http.get(url).then(function(response){
                return response.data;
            }, function(){
                console.warn('Arg, impossible de charger la liste d\'agents');
                return [];
            });
        };

        return service;
    });