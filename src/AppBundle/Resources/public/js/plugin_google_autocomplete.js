(function($) {
    $.fn.googleAutoComplete = function(options) {
        var settings = $.extend({
            selectorPostalCode: '.address-postal-code',
            selectorCity: '.address-city',
            selectorCountry: '.address-country',
            selectorLatitude: '.address-lattitude',
            selectorLongitude: '.address-longitude',
            selectorStreet: '.address-street',
            componentRestrictions: null,
            types: [],
            language: 'fr'
        }, options);

        var self = $(this);
        var parent = $(this).parent().parent();
        var formType = $(this).parent().parent().attr('data-form-type');
        var options = {
            types: settings.types,
            componentRestrictions: settings.componentRestrictions,
            language: settings.language
        };
        var autocomplete = new google.maps.places.Autocomplete(self[0], options);

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = this.getPlace();
            var route;
            var streetNumber;
            var concat;
            if (!place.place_id) {
                clear();
                self.trigger('google-place-changed');
                return;
            }

            /*
            $(settings.selectorPostalCode).val('');
            $(settings.selectorCity).val('');
            $(settings.selectorCountry).val('');
            $(settings.selectorStreet).val('');
            $(settings.selectorLatitude).val('');
            $(settings.selectorLongitude).val('');
            */

            if (settings.selectorLatitude && settings.selectorLongitude && typeof place.geometry !== 'undefined') {
                $(parent).find(settings.selectorLatitude).val(place.geometry.location.lat());
                $(parent).find(settings.selectorLongitude).val(place.geometry.location.lng());
            }

            for (var i in place.address_components) {
                var component = place.address_components[i];

                switch (component.types[0]) {
                    case 'postal_code':
                        $(parent).find(settings.selectorPostalCode).val(component.long_name);
                        $(parent).find(settings.selectorPostalCode).next().addClass('active');
                        break;

                    case 'locality':
                        $(parent).find(settings.selectorCity).val(component.long_name);
                        $(parent).find(settings.selectorCity).next().addClass('active');

                        break;

                    case 'country':
                        $(parent).find(settings.selectorCountry).val(component.long_name);
                        $(parent).find(settings.selectorCountry).next().addClass('active');
                        break;

                    case 'street_number':
                        streetNumber = component.long_name;
                        break;

                    case 'route':
                        route = component.long_name;

                        break;
                }
            }
            if(streetNumber){
                concat = streetNumber;
            }
            if (route) {
                concat += " " + route;
            }
            $(parent).find(settings.selectorStreet).val(concat);
            $(parent).find(settings.selectorStreet).next().addClass('active');
            self.trigger('google-place-changed');

        });

        $(self).keypress(function(event) {
            if (event.keyCode == 13 || event.which == 13) {
                event.preventDefault();
                if (!$('.pac-item-selected').length && $('.pac-container').length) {
                    $(this).simulate('keydown', {
                        keyCode: 40,
                        which: 40
                    });
                }

                return false;
            }

            if (event.keyCode == 9 || event.which == 9) {
                if (!$('.pac-item-selected').length && $('.pac-container').length) {
                    $(this).simulate('keydown', {
                        keyCode: 40,
                        which: 40
                    });
                }
                $(this).simulate('keydown', {
                    keyCode: 13,
                    which: 13
                });
            }
        });

        var clear = function() {
            $(parent).find(settings.selectorPostalCode).val('');
            $(parent).find(settings.selectorPostalCode).next().removeClass('active');
            $(parent).find(settings.selectorCity).val('');
            $(parent).find(settings.selectorCity).next().removeClass('active');
            $(parent).find(settings.selectorCountry).val('');
            $(parent).find(settings.selectorCountry).next().removeClass('active');
            $(parent).find(settings.selectorLongitude).val('');
            $(parent).find(settings.selectorLongitude).next().removeClass('active');
            $(parent).find(settings.selectorLatitude).val('');
            $(parent).find(settings.selectorLatitude).next().removeClass('active');
            $(parent).find(settings.selectorStreet).val('');
            $(parent).find(settings.selectorStreet).next().removeClass('active');
        };
        /*
        var savePreviousValues = function(){
            var previousPostalCode = $(parent).find(settings.selectorPostalCode).val();
            var previousCity = $(parent).find(settings.selectorCity).val();
            var previousCountry = $(parent).find(settings.selectorCountry).val();
            var previousLatitude = $(parent).find(settings.selectorLatitude).val();
            var previousLongitude = $(parent).find(settings.selectorLongitude).val();
            var previousStreet = $(parent).find(settings.selectorStreet).val();
            previousValues['street'] = previousStreet;
            previousValues['postal'] = previousPostalCode;
            previousValues['country'] = previousCountry;
            previousValues['latitude'] = previousLatitude;
            previousValues['longitude'] = previousLongitude;
            previousValues['city'] = previousCity;
            return previousValues;
        };
        */

        return this;
    };
}(jQuery));