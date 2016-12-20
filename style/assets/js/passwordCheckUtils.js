/**
 * Created by Lino on 07/12/2016.
 */

$(document).ready(function () {
    "use strict";
    $("#nuova-password").keyup(function () {

        var regExp = /^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9!@#$%]{8,}$/;
        var newPass = $("#nuova-password").val();

        if (newPass.length < 8) {


            var htmlLengthError = '<button type="button" class="close" data-dismiss="alert"' +
                '                                                            aria-label="Close">' +
                '                                                        <span aria-hidden="true"></button>' +
                '                                                    <strong>Attenzione!</strong> La password deve essere almeno di 8 caratteri';


            $("#password-errors").html(htmlLengthError).fadeIn();
            $("#password-errors").css("display", "block");
            $("#save-pass-button").prop("disabled", true);
        }
        else if (!regExp.test(newPass)) {

            var htmlRegexError= '<button type="button" class="close" data-dismiss="alert"' +
                '                                                            aria-label="Close">' +
                '                                                        <span aria-hidden="true"></button>' +
                '                                                    <strong>Attenzione!</strong> La password non rispetta lo standard previsto!';
            $("#password-errors").html(htmlRegexError).fadeIn();
            $("#password-errors").css("display", "block");
            $("#save-pass-button").prop("disabled", true);
        }
        else if (regExp.test(newPass)) {
            $("#password-errors").fadeOut().css("display", "none");
            $("#save-pass-button").prop("disabled", false);
        }
    })
});

$(document).ready(function () {
    "use strict";
    $("#conferma-nuova-password").keyup(function () {

        var regExp = /^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9!@#$%]{8,}$/;
        var confermaPassword = $("#conferma-nuova-password").val();
        var newPassword = $("#nuova-password").val();

        if (confermaPassword.length < 8) {


            var htmlLengthError = '<button type="button" class="close" data-dismiss="alert"' +
                '                                                            aria-label="Close">' +
                '                                                        <span aria-hidden="true"></button>' +
                '                                                    <strong>Attenzione!</strong> La password deve essere almeno di 8 caratteri';


            $("#password-errors").html(htmlLengthError).fadeIn();
            $("#password-errors").css("display", "block");
            $("#save-pass-button").prop("disabled", true);
        }
        else if (!regExp.test(confermaPassword)) {

            var htmlRegexError = '<button type="button" class="close" data-dismiss="alert"' +
                '                                                            aria-label="Close">' +
                '                                                        <span aria-hidden="true"></button>' +
                '                                                    <strong>Attenzione!</strong> La password non rispetta lo standard previsto!';
            $("#password-errors").html(htmlRegexError).fadeIn();
            $("#password-errors").css("display", "block");
            $("#save-pass-button").prop("disabled", true);
        }
        else if (regExp.test(confermaPassword)) {
            $("#password-errors").fadeOut().css("display", "none");
            $("#save-pass-button").prop("disabled", false);
        }

        if (confermaPassword!=newPassword){
            var htmlMatchError = '<button type="button" class="close" data-dismiss="alert"' +
                '                                                            aria-label="Close">' +
                '                                                        <span aria-hidden="true"></button>' +
                '                                                    <strong>Attenzione!</strong> La password di conferma non coincide con la prima inserita';
            $("#password-errors").html(htmlMatchError).fadeIn();
            $("#password-errors").css("display", "block");
            $("#save-pass-button").prop("disabled", true);
        }
    })
});