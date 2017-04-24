var placeSearch, autocomplete;
var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    country: 'long_name',
    postal_code: 'short_name'
};
var inputsAddressForm = {
    street : 'app_address_type_street',
    postal_code: 'app_address_type_postalCode',
    city: 'app_address_type_city',
    country: 'app_address_type_country',
    longitude: 'app_address_type_longitude',
    lattitude: 'app_address_type_lattitude'
};
function initAutocomplete() {

    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
        {types: ['geocode']});

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    resetAddressForm();
    fillInInputs(place);
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
            autocomplete.setBounds(circle.getBounds());
        });
    }
}
function resetAddressForm(){
    for(var current in inputsAddressForm)
    {
        document.getElementById(inputsAddressForm[current]).value = '';
    }
    setInactiveLabels();
}
function fillInInputs(place)
{
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
            switch(addressType)
            {
                case 'street_number':
                    document.getElementById(inputsAddressForm['street']).value +=
                        place.address_components[i][componentForm['street_number']] + " ";
                    setActiveLabel(inputsAddressForm['street']);
                    break;
                case 'route':
                    document.getElementById(inputsAddressForm['street']).value +=
                        place.address_components[i][componentForm['route']];
                    setActiveLabel(inputsAddressForm['street']);
                    break;
                case 'locality':
                    document.getElementById(inputsAddressForm['city']).value =
                        place.address_components[i][componentForm['locality']];
                    setActiveLabel(inputsAddressForm['city']);
                    break;
                case 'country':
                    document.getElementById(inputsAddressForm['country']).value =
                        place.address_components[i][componentForm['country']];
                    setActiveLabel(inputsAddressForm['country']);
                    break;
                case 'postal_code':
                    document.getElementById(inputsAddressForm['postal_code']).value =
                        place.address_components[i][componentForm['postal_code']];
                    setActiveLabel(inputsAddressForm['postal_code']);
                    break;
            }
        }
    }
    document.getElementById(inputsAddressForm['lattitude']).value = place.geometry.location.lat();
    document.getElementById(inputsAddressForm['longitude']).value = place.geometry.location.lng();
}
function setActiveLabel(id){
    if(('app_address_longitude' != id) && (('app_address_lattitude' != id))){
        $("label[for='"+id+"']").addClass('active');
    }
}
function setInactiveLabels(){
    for(var current in inputsAddressForm){
        if(('app_address_longitude' != inputsAddressForm[current]) && (('app_address_lattitude' != inputsAddressForm[current]))){
            $("label[for='"+inputsAddressForm[current]+"']").removeClass('active');
        }
    }
}
function clearModalAddressForm()
{
    resetAddressForm();
    $("#autocomplete").val('');
    $("#app_address_type_name").val('');
    $("label[for='app_address_type_name']").removeClass('active');
}
$(document).ready(function() {
    $(".btnDeleteAddress").click(function(){
        var deleteForm = $('form[name="app_delete_type"]');
        var id = $(this).parent().attr('data-id');
        $(deleteForm).attr('action',"/address/remove/"+ id);
        $('#remove_address_name').text($(this).parent().attr('data-address-name'));
    });
    $('#address_form').on('hidden.bs.modal', function (e) {
        clearModalAddressForm();
    })
});