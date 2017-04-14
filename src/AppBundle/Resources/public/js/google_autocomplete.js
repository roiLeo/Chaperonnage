var placeSearch, autocompleteStart, autocompleteFinish;
/*var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};*/

function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocompleteStart = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('startAddress')),
        {types: ['geocode']});
    autocompleteFinish = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('finishAddress')),
        {types: ['geocode']});


    // When the user selects an address from the dropdown, event
    autocompleteStart.addListener('place_changed', fillInAddress);
    //autocompleteFinish.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
    // Get the place details from the autocomplete object.

    var place = autocompleteStart.getPlace();
    alert(place.address_components.toString());/*
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        var val = place.address_components[i]];

    }*/

     /*
    for (var component in componentForm) {
        document.getElementById(component).value = '';
        document.getElementById(component).disabled = false;
    }

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
        }
    }*/
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