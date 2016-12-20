/**
 * Created by Lino on 20/12/2016.
 */

$(document).ready(function () {
    "use strict";
    $("#save-new-micro").click(function () {

        var macroSelected = $("#id-macro-selected").val();

        if (macroSelected.length == 0) {


            var htmlLengthError = '<button type="button" class="close" data-dismiss="alert"' +
                '                                                            aria-label="Close">' +
                '                                                        <span aria-hidden="true"></button>' +
                '                                                    <strong>Attenzione!</strong> Non è stata selezionata alcuna Macrocategoria';


            $("#micro-errors").html(htmlLengthError).fadeIn();
            $("#micro-errors").css("display", "block");
            $("#save-new-micro").prop("disabled", true);
        }
    })
});

$(document).ready(function () {
    "use strict";
    $("#id-macro-selected").change(function () {

        var macroSelected = $("#id-macro-selected").val();

        if (macroSelected.length != 0) {
            $("#micro-errors").fadeOut().css("display", "none");
            $("#save-new-micro").prop("disabled", false);
            ;
        }
    })
});

$(document).ready(function () {
    "use strict";
    $("#save-new-micro1").click(function () {

        var macroSelected = $("#macro").val();
        var microSelected = $("#micro").val();

        if (macroSelected.length == 0) {
            var htmlLengthError = '<button type="button" class="close" data-dismiss="alert"' +
                '                                                            aria-label="Close">' +
                '                                                        <span aria-hidden="true"></button>' +
                '                                                    <strong>Attenzione!</strong> Non è stata selezionata alcuna Macrocategoria';


            $("#micro-errors1").html(htmlLengthError).fadeIn();
            $("#micro-errors1").css("display", "block");
            $("#save-new-micro1").prop("disabled", true);
        }
        else if (microSelected.length == 0) {
            var htmlLengthError = '<button type="button" class="close" data-dismiss="alert"' +
                '                                                            aria-label="Close">' +
                '                                                        <span aria-hidden="true"></button>' +
                '                                                    <strong>Attenzione!</strong> Non è stata selezionata alcuna Microcategoria';


            $("#micro-errors1").html(htmlLengthError).fadeIn();
            $("#micro-errors1").css("display", "block");
            $("#save-new-micro1").prop("disabled", true);
        }
    })
});

$(document).ready(function () {
    "use strict";
    $("#macro").change(function () {

        var macroSelected = $("#macro").val();

        if (macroSelected.length != 0) {
            $("#micro-errors1").fadeOut().css("display", "none");
            $("#save-new-micro1").prop("disabled", false);
            ;
        }
    })
});

$(document).ready(function () {
    "use strict";
    $("#micro").change(function () {

        var macroSelected = $("#micro").val();

        if (macroSelected.length != 0) {
            $("#micro-errors1").fadeOut().css("display", "none");
            $("#save-new-micro1").prop("disabled", false);
            ;
        }
    })
});