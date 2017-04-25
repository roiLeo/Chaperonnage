function initAutocomplete() {

    $('.google-autocomplete').each(function() {
        $(this).googleAutoComplete({

        });
    })
}

function clearModalAddressForm(address_form)
{
    $(address_form).find('.google-autocomplete').val('');

    $(address_form).find('.address-name').val('');
    $(address_form).find('.address-name').next().removeClass('active');

    $(address_form).find('.address-street').val('');
    $(address_form).find('.address-street').next().removeClass('active');

    $(address_form).find('.address-postal-code').val('');
    $(address_form).find('.address-postal-code').next().removeClass('active');

    $(address_form).find('.address-city').val('');
    $(address_form).find('.address-city').next().removeClass('active');

    $(address_form).find('.address-country').val('');
    $(address_form).find('.address-country').next().removeClass('active');

    $(address_form).find('.address-longitude').val('');
    $(address_form).find('.address-lattitude').val('');

}
$(document).ready(function() {

    $(".btnDeleteAddress").click(function(){
        var deleteForm = $('form[name="app_delete_type"]');
        var id = $(this).parent().attr('data-id');
        $(deleteForm).attr('action',"/address/remove/"+ id);
        $('#remove_address_name').text($(this).parent().attr('data-address-name'));
    });

    $('#address_form').on('hidden.bs.modal', function (e) {
        clearModalAddressForm($(this)[0]);
    });
});