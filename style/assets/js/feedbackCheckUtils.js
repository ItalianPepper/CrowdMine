/**
 * Created by Giovanni Leo on 04/12/2016.
 */
/**
 * This function is used to block the select of the rating star on the feedback
 */
$(document).ready(function () {
    $(".rating-content").click(function () {
        return false;
    })
});
/**
 * This function check if the length of feedback description is more than 300 character and if there are special character
 */
$(document).ready(function () {
    "use strict";
    $("#feedback-textarea").keyup(function () {

        var regExp = /^[a-zA-Z0-9_ èàòù]+$/g;
        var textAreaInput = $("#feedback-textarea").val();

        if (textAreaInput.length >= 300) {


            var htmlLengthError = '<button type="button" class="close" data-dismiss="alert"' +
                '                                                            aria-label="Close">' +
                '                                                        <span aria-hidden="true"></button>' +
                '                                                    <strong>Errore!</strong> Il testo deve essere massimo 300 caratteri!';


            $("#feedback-erros").html(htmlLengthError).fadeIn();
            $("#feedback-erros").css("display", "block");
            $("#button-add-feedback").prop("disabled", true); // I use this for disable button if lenght ismore than 300 characters
        }
        else if (!regExp.test(textAreaInput)) {

            var htmlSpecialCharError = '<button type="button" class="close" data-dismiss="alert"' +
                '                                                            aria-label="Close">' +
                '                                                        <span aria-hidden="true"></button>' +
                '                                                    <strong>Errore!</strong> Il testo contiene caratteri speciali!';
            $("#feedback-erros").html(htmlSpecialCharError).fadeIn();
            $("#feedback-erros").css("display", "block");
            $("#button-add-feedback").prop("disabled", true); // I use this for disable button if lenght ismore than 300 characters
        }
        else if (regExp.test(textAreaInput) || textAreaInput.length  <= 300 ) {
            $("#feedback-erros").fadeOut().css("display", "none");
            $("#button-add-feedback").prop("disabled", false);
        }
    })
});
/**
 * This function check special character in feedback input title
 */
$(document).ready(function () {
    "use strict";
    $("#feedback-title").keyup(function () {
        var regExp = /^[a-zA-Z0-9_ èàòù]+$/g;
        var inputTitle = $("#feedback-title").val();


        if (regExp.test(inputTitle)) {

            $("#feedback-erros").fadeOut().css("display", "none");
            $("#button-add-feedback").prop("disabled", false);
        }
        else if (!regExp.test(inputTitle)) {
            var html = '<button type="button" class="close" data-dismiss="alert"' +
                '                                                            aria-label="Close">' +
                '                                                        <span aria-hidden="true"></button>' +
                '                                                    <strong>Errore!</strong> Il testo contiene caratteri speciali!';


            $("#feedback-erros").html(html).fadeIn();
            $("#feedback-erros").css("display", "block");
            $("#button-add-feedback").prop("disabled", true);
        }

    })


});


