/**
 * Created by LongSky on 13/12/2016.
 */
/**
 * IMPORTANT:
 * dominio is a  global variable then you can see this variable
 * in each views that needs to show a list of feedback or
 * perform some action on it.
 */
function deleteFeedback(id) {
   clearjQueryCache();
    $.ajax({
        url: dominio+"/feedbackValutation",
        type: "POST",
        data: {'id': id, 'stato': "eliminato"},
        dataType: 'json',
        async: true,
        success: function (data) {
            toastr[data["toastType"]](data["toastMessage"]);
            divToDelete = $("#" + id + "");
            destination = $("#feedback-list-destination");
            divToDelete.fadeOut();
        },
        error: function (data) {
            toastr[data["toastType"]](data["toastMessage"]);
        }
    });
}

function confirmFeedback(id) {
   clearjQueryCache();
    $.ajax({
        url: dominio+"/feedbackValutation",
        type: "POST",
        data: {'id': id ,'stato':"attivato"},
        dataType: 'json',
        async: true,
        success: function (data) {
            toastr[data["toastType"]](data["toastMessage"]);
            divToDelete = $("#" + id + "");
            destination = $("#feedback-list-destination");
            divToDelete.fadeOut();

        },
        error: function (data) {
            toastr[data["toastType"]](data["toastMessage"]);
        }
    });
}

function sendFeedbackToAdmin(id) {
    clearjQueryCache();
    $.ajax({
        url: dominio+"/feedbackValutation",
        type: "POST",
        data: {'id': id, 'stato': "amministratore"},
        dataType: 'json',
        async: true,
        success: function (data) {
            toastr[data["toastType"]](data["toastMessage"]);
            divToDelete = $("#" + id + "");
            destination = $("#feedback-list-destination");
            divToDelete.fadeOut();

        },
        error: function (data) {
            toastr[data["toastType"]](data["toastMessage"]);
        }
    });
}

function segnalaFeedback(feedbackID) {
        clearjQueryCache();
        $.ajax({
            url: dominio+'/feedbackValutation',
            type: 'POST',
            data: {'id': feedbackID, 'stato': "segnalato"},
            dataType: 'json',
            async: true,
            success: function (data) {
                toastr[data["toastType"]](data["toastMessage"]);
                divToDelete = $("#" + feedbackID + "");
                destination = $("#feedback-list-destination");
                divToDelete.fadeOut();

            },
            error: function (data) {
                toastr[data["toastType"]](data["toastMessage"]);
            }

        })
}

function clearjQueryCache() {
    for (var x in jQuery.cache) {
        delete jQuery.cache[x];
    }
}



