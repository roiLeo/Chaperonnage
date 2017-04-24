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
            var url = 'http://127.0.0.1:8000/ride/new?' +
                'appbundle_ride%5Bdate%5D%5Bdate%5D%5Bday%5D=' +
                '1&appbundle_ride%5Bdate%5D%5Bdate%5D%5Bmonth%5D=' +
                '1&appbundle_ride%5Bdate%5D%5Bdate%5D%5Byear%5D=' +
                '2012&appbundle_ride%5Bdate%5D%5Btime%5D%5Bhour%5D=' +
                '0&appbundle_ride%5Bdate%5D%5Btime%5D%5Bminute%5D=' +
                '0&appbundle_ride%5Bhour%5D%5Bhour%5D=' +
                '0&appbundle_ride%5Bhour%5D%5Bminute%5D=' +
                '0&appbundle_ride%5Bstatus%5D=waiting' +
                '&appbundle_ride%5BstartAddress%5D%5BpostalCode%5D=' + service.getStartPoint().postalCode +
                '&appbundle_ride%5BstartAddress%5D%5Bcity%5D=' + service.getStartPoint().city +
                '&appbundle_ride%5BstartAddress%5D%5Blongitude%5D=' + service.getStartPoint().lng +
                '&appbundle_ride%5BstartAddress%5D%5Blattitude%5D=' + service.getStartPoint().lat +
                '&appbundle_ride%5BfinishAddress%5D%5BpostalCode%5D=' +  service.getFinishPoint().postalCode +
                '&appbundle_ride%5BfinishAddress%5D%5Bcity%5D=' +  service.getFinishPoint().city +
                '&appbundle_ride%5BfinishAddress%5D%5Blongitude%5D=' +  service.getFinishPoint().lng +
                '&appbundle_ride%5BfinishAddress%5D%5Blattitude%5D=' +  service.getFinishPoint().lat;
            return $http.get(url).then(function(response){
                return response.data;
            }, function(){
                console.warn('Arg, ride non viable');
                return [];
            });
        };

        return service;
    });