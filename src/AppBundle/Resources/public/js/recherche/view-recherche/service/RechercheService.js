angular
    .module('recherche')
    .factory('RechercheService', function($http){
        var service = {};

        service.startPoint=null;

        service.finishPoint=null;

        service.date=null;

        service.getStartPoint = function(){
            return service.startPoint;
        };

        service.getFinishPoint = function(){
            return service.finishPoint;
        };

        service.getDate = function(){
            return service.date;
        };

        service.setStartPoint = function(lat, lng, city, postalCode){
            service.startPoint = {
                lat: lat,
                lng: lng,
                city: city,
                postalCode: postalCode
            };
        };

        service.setFinishPoint = function(lat, lng, city, postalCode){
            service.finishPoint = {
                lat: lat,
                lng: lng,
                city: city,
                postalCode: postalCode
            };
        };

        service.setDate = function(_date){
            service.date = _date;
        };

        service.newRide = function(){

            //On ajoute d'abbord les addresses

            var url = 'http://127.0.0.1:8000//address/new ?' +
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