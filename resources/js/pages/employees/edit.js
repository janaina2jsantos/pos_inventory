$(document).ready(function() {
    // input mask
    $("#phone").inputmask("mask", {
        "mask": "(99) 99999-9999"
    });
    $("#zip").inputmask({
        "mask": "99999-999",
        placeholder: "" 
    });
    $("#salary").inputmask('€ 999.999.999,99', {
        numericInput: true
    });
});

$("#zip").blur(function() {
    var zip = $(this).val().replace(/\D/g, '');
    if (zip != "") {
        var validacep = /^[0-9]{8}$/;
        if(validacep.test(zip)) {
            $("#street").val("...").prop("disabled", true);
            $("#neighborhood").val("...").prop("disabled", true);
            $("#city").val("...").prop("disabled", true);
            $("#state").val("...").prop("disabled", true);
            // viacep API
            $.getJSON("https://viacep.com.br/ws/"+ zip +"/json/?callback=?", function(dados) {
                if (!("erro" in dados)) {
                    $("#street").val(dados.logradouro).prop("disabled", false);
                    $("#complement").prop("disabled", false);
                    $("#neighborhood").val(dados.bairro).prop("disabled", false);
                    $("#city").val(dados.localidade).prop("disabled", false);
                    $("#state").val(dados.uf).prop("disabled", false);
                } 
                else {
                    // ZIP Code not found
                    alert("ZIP Code not found.");
                    $("#zip").addClass("is-invalid");
                    $(window).scrollTop(0);
                }
            });
        } 
        else {
            // Invalid ZIP Code
            alert("Invalid ZIP Code.");
            $("#zip").addClass("is-invalid");
            $(window).scrollTop(0);
        }
    } 
    else {
        cleanFormFields();
    }
});

// only number for inputs
function validate(element, event) {
    var theEvent = event || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
    if (theEvent.code == 'Period') {
        theEvent.returnValue = false;
    }
    var regex = /[0-9]|\./;
    if(!regex.test(key)) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
    if ($(element).val().length > 8) {
        theEvent.returnValue = false;
    }
}
