function request_call_local() {

    var phone = document.getElementById("npa").value.concat(document.getElementById("nnx").value).concat(document.getElementById("line").value);
    if (validate_phone(phone)) {
        alert("Connecting....");
        jQuery.post(
            ajaxurl,
            {
                'action': 'ibp_c2c_action',
                'data':   escape(phone)
            },
            function(response){

                alert(response);
            }
        );

    }

}

function validate_phone(phone) {
    if (phone.length !== 10) {
        alert("Sorry, the phone number you entered does not have 10 digits! ");
        return 0;
    }
    return 1;
}

function autofocus(field, limit, next, evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
    if (charCode > 31 && field.value.length === limit) {
        field.form.elements[next].focus();
    }
}
