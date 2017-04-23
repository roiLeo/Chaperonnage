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
            var url = 'http://127.0.0.1:8080/ride/new';
            return $http.get(url).then(function(response){
                return response.data;
            }, function(){
                console.warn('Arg, ride non viable');
                return [];
            });
        };

        return service;
    });