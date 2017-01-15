/**
 * This function check if the length of feedback description is more than 300 character and if there are special character
 */
$(document).ready(function () {
    "use strict";
    $("#annuncio-textarea").keyup(function () {
        console.log("Posso di qua");

        var regExp = /^[a-zA-Z0-9_ èàòù.]+$/g;
        var textAreaInput = $("#annuncio-textarea").val();
        console.log(textAreaInput);

        if (regExp.test(textAreaInput)) {
            console.log("OK");
            $("#annuncio-erros").fadeOut();
            $("#button-add-annuncio").prop("disabled", false);
        }
        else if (!regExp.test(textAreaInput) && textAreaInput != "") {

            var htmlSpecialCharError = '<button type="button" class="close" data-dismiss="alert"' +
                '                                                            aria-label="Close">' +
                '                                                        <span aria-hidden="true"></button>' +
                '                                                    <strong>Errore!</strong> Il testo contiene caratteri speciali!';
            $("#annuncio-erros").html(htmlSpecialCharError).fadeIn();
            $("#annuncio-erros").css("display", "block");
            $("#button-add-annuncio").prop("disabled", true); // I use this for disable button if lenght ismore than 300 characters
        }

    });
});
/**
 * This function check special character in feedback input title
 */
$(document).ready(function () {
    "use strict";
    $("#annuncio-title").keyup(function () {
        var regExp = /^[a-zA-Z0-9_ èàòù]+$/g;
        var inputTitle = $("#annuncio-title").val();


        if (regExp.test(inputTitle)) {

            $("#annuncio-erros").fadeOut();
            $("#button-add-annuncio").prop("disabled", false);
        }
        else if (!regExp.test(inputTitle)) {
            var html = '<button type="button" class="close" data-dismiss="alert"' +
                '                                                            aria-label="Close">' +
                '                                                        <span aria-hidden="true"></button>' +
                '                                                    <strong>Errore!</strong> Il testo contiene caratteri speciali!';


            $("#annuncio-erros").html(html).fadeIn();
            $("#annuncio-erros").css("display", "block");
            $("#button-add-annuncio").prop("disabled", true);
        }

    })


});
