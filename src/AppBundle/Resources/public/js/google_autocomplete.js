var autocompleteStart, autocompleteFinish;
var markers = { start : null,
                finish : null};
var map;

function initAutocomplete() {

    var France = {lat: 46.7366065, lng: 1.402915};

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: France
    });
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
    autocompleteStart.addListener('place_changed', function(){fillInAddress('start', autocompleteStart)});
    autocompleteFinish.addListener('place_changed', function(){fillInAddress('finish', autocompleteFinish)});
}

function fillInAddress(addr, autocomplete) {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();
    coord = {lat: place.geometry.location.lat(),
                lng: place.geometry.location.lng()};

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    document.getElementById(addr+"Latitude").value = coord.lat;
    document.getElementById(addr+"Longitude").value = coord.lng;

    for (var i = 0; i < place.address_components.length; i++) {
        if(place.address_components[i].types[0]=="locality"){
            document.getElementById(addr+"City").value = place.address_components[i].long_name;
        }
        if(place.address_components[i].types[0]=="postal_code"){
            document.getElementById(addr+"PostalCode").value = place.address_components[i].long_name;
        }
    }

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
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
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
}