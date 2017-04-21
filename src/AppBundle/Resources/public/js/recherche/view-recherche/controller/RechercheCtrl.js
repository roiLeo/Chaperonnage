'use strict'

angular
    .module('recherche')
    .controller('RechercheCtrl', ['$scope', 'RechercheService', function($scope, RechercheService){
        var autocompleteStart, autocompleteFinish;
        var markers = { start : null,
            finish : null};
        var map;

        function initAutocomplete() {
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;

            var France = {lat: 46.7366065, lng: 1.402915};
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: France
            });
            directionsDisplay.setMap(map);

            navigator.geolocation.getCurrentPosition(function(position) {
                map.setCenter({lat: position.coords.latitude,
                    lng: position.coords.longitude});
            });


            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocompleteStart = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('startAddress')),
                {types: ['geocode']});
            autocompleteFinish = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('finishAddress')),
                {types: ['geocode']});

            // When the user selects an address from the dropdown, event
            autocompleteStart.addListener('place_changed', function(){fillInAddress('start', autocompleteStart, directionsService, directionsDisplay)});
            autocompleteFinish.addListener('place_changed', function(){fillInAddress('finish', autocompleteFinish, directionsService, directionsDisplay)});
        }

        function fillInAddress(addr, autocomplete, directionsService, directionsDisplay) {
            // Get the place details from the autocomplete object.
            var place = autocomplete.getPlace();
            var coord = {lat: place.geometry.location.lat(),
                lng: place.geometry.location.lng()};

            // Get each component of the address from the place details
            // and fill the corresponding field on the form.
            var lat = coord.lat;
            var lng = coord.lng;
            var city = '';
            var postalCode = 0;

            for (var i = 0; i < place.address_components.length; i++) {
                if(place.address_components[i].types[0]=="locality"){
                    city = place.address_components[i].long_name;
                }
                if(place.address_components[i].types[0]=="postal_code"){
                    postalCode = place.address_components[i].long_name;
                }
            }

            if(addr=='start') {
                RechercheService.setStartPoint(lat, lng, city, postalCode);
                console.log(addr);
            }else{
                console.log(addr);
                RechercheService.setFinishPoint(lat, lng, city, postalCode);
            }
            console.log(RechercheService.getStartPoint());
            console.log(RechercheService.getFinishPoint());
            //Showing the position on the map
            if(markers[addr]){
                markers[addr].setMap(null);
            }

            markers[addr] = new google.maps.Marker({
                position: coord,
                map: map,
                title: addr,
            });

            map.setCenter(coord);

            if(markers['start']&&markers['finish']){
                //Displaying the direction on the map
                directionsService.route({
                    origin: markers['start'].position,
                    destination: markers['finish'].position,
                    travelMode: 'WALKING'
                }, function (response, status) {
                    if (status === 'OK') {
                        directionsDisplay.setDirections(response);
                        markers['start'].setMap(null);
                        markers['finish'].setMap(null);
                    } else{
                        markers['start'].setMap(map);
                        markers['finish'].setMap(map);
                    }
                });
            }
        }

        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
        $scope.geolocate = function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                    });
                    autocompleteStart.setBounds(circle.getBounds());
                    autocompleteFinish.setBounds(circle.getBounds());
                });
            }
        };



        //------------------------------------------------------------------------
        initAutocomplete();
        $scope.myDate = new Date();
        $scope.isOpen = false;

        $scope.startPoint = function(){
            return RechercheService.getStartPoint();
        };

        $scope.createRide =  function(){
            RechercheService.newRide();
        };


    }]);