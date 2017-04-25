angular
    .module('recherche')
    .factory('RechercheService', function($http){
        var service = {};

        service.startPoint=null;

        service.finishPoint=null;

        service.date="";

        service.getStartPoint = function(){
            return service.startPoint;
        };

        service.getFinishPoint = function(){
            return service.finishPoint;
        };

        service.getDate = function(){
            return service.date;
        };

        service.setStartPoint = function(lat, lng, city, postalCode, country){
            service.startPoint = {
                lat: lat,
                lng: lng,
                city: city,
                postalCode: postalCode,
                country: country
            };
        };

        service.setFinishPoint = function(lat, lng, city, postalCode, country){
            service.finishPoint = {
                lat: lat,
                lng: lng,
                city: city,
                postalCode: postalCode,
                country: country
            };
        };

        service.setDate = function(_date){
            service.date = _date;
        };

        service.newRide = function(){
            var url = 'http://127.0.0.1:8000/ride/new?' +
                'appbundle_ride%5Bdate%5D%5Bdate%5D%5Bday%5D='          + parseInt(service.getDate().toString().substr(8, 2))   +
                '&appbundle_ride%5Bdate%5D%5Bdate%5D%5Bmonth%5D='       + parseInt(service.getDate().toString().substr(5, 2))   +
                '&appbundle_ride%5Bdate%5D%5Bdate%5D%5Byear%5D='        + parseInt(service.getDate().toString().substr(0, 4))   +
                '&appbundle_ride%5Bdate%5D%5Btime%5D%5Bhour%5D='        + parseInt(service.getDate().toString().substr(11, 2))  +
                '&appbundle_ride%5Bdate%5D%5Btime%5D%5Bminute%5D='      + parseInt(service.getDate().toString().substr(14, 2))  +
                '&appbundle_ride%5Bhour%5D%5Bhour%5D='                  + parseInt(service.getDate().toString().substr(11, 2))  +
                '&appbundle_ride%5Bhour%5D%5Bminute%5D='                + parseInt(service.getDate().toString().substr(14, 2))  +
                '&appbundle_ride%5BprotectedUser%5D='                   + CURRENT_USER.id   +
                '&appbundle_ride%5Bstatus%5D=waiting'                   +
                '&appbundle_ride%5BstartAddress%5D%5Bname%5D='          + "address_start"                       +
                '&appbundle_ride%5BstartAddress%5D%5Bcountry%5D='       + service.getStartPoint().country       +
                '&appbundle_ride%5BstartAddress%5D%5BpostalCode%5D='    + service.getStartPoint().postalCode    +
                '&appbundle_ride%5BstartAddress%5D%5Bcity%5D='          + service.getStartPoint().city          +
                '&appbundle_ride%5BstartAddress%5D%5Blongitude%5D='     + service.getStartPoint().lng           +
                '&appbundle_ride%5BstartAddress%5D%5Blattitude%5D='     + service.getStartPoint().lat           +
                '&appbundle_ride%5BfinishAddress%5D%5Bname%5D='         + "address_finish"                      +
                '&appbundle_ride%5BfinishAddress%5D%5Bcountry%5D='      + service.getFinishPoint().country      +
                '&appbundle_ride%5BfinishAddress%5D%5BpostalCode%5D='   + service.getFinishPoint().postalCode   +
                '&appbundle_ride%5BfinishAddress%5D%5Bcity%5D='         + service.getFinishPoint().city         +
                '&appbundle_ride%5BfinishAddress%5D%5Blongitude%5D='    + service.getFinishPoint().lng          +
                '&appbundle_ride%5BfinishAddress%5D%5Blattitude%5D='    + service.getFinishPoint().lat;
            return $http.get(url);
        };

        return service;
    });