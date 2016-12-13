/**
 * Created by LongSky on 13/12/2016.
 */

function deleteFeedback(id){
    $.ajax({
        url: "feedbackValutation",
        type: "POST",
        data: {'id': id, 'stato':"eliminato"},
        dataType: 'json',
        async: true,
        success: function (data) {
            toastr[data["toastType"]](data["toastMessage"]);
            divToDelete = $("#id");
            destination = $("#feedback-list-destination");
            destination.removeChild(divToDelete);
        }
    });
}

function confirmFeedback(id){
    $.ajax({
        url: "feedbackValutation",
        type: "POST",
        data: {'id': id, 'stato':"attivo"},
        dataType: 'json',
        async: true,
        success: function (data) {
            toastr[data["toastType"]](data["toastMessage"]);
            divToDelete = $("#id");
            destination = $("#feedback-list-destination");
            destination.removeChild(divToDelete);
        }
    });
}

function sendFeedbackToAdmin(id){
    $.ajax({
        url: "feedbackValutation",
        type: "POST",
        data: {'id': id, 'stato':"admin"},
        dataType: 'json',
        async: true,
        success: function (data) {
            toastr[data["toastType"]](data["toastMessage"]);
            divToDelete = $("#id");
            destination = $("#feedback-list-destination");
            destination.removeChild(divToDelete);
        }
    });
}


