/**
 * Created by LongSky on 13/12/2016.
 */
function deleteFeedback(id){
    clearjQueryCache();
    $.ajax({
        url: "feedbackValutation",
        type: "POST",
        data: {'id': id, 'stato':"eliminato"},
        dataType: 'json',
        async: true,
        success: function (data) {
            toastr[data["toastType"]](data["toastMessage"]);
            divToDelete = $("#"+id+"");
            destination = $("#feedback-list-destination");
            divToDelete.remove();
        },
        error: function(data){
            toastr[data["toastType"]](data["toastMessage"]);
        }
    });
}

function confirmFeedback(id){
    clearjQueryCache();
    console.log("evento catturato");
    $.ajax({
        url: "feedbackValutation",
        type: "POST",
        data: {'id': id ,'stato':"attivo"},
        dataType: 'json',
        async: true,
        success: function (data) {
            toastr[data["toastType"]](data["toastMessage"]);
            divToDelete = $("#"+id+"");
            destination = $("#feedback-list-destination");
            divToDelete.remove();
        },
        error: function(data){
            toastr[data["toastType"]](data["toastMessage"]);
        }
    });
}

function sendFeedbackToAdmin(id){
    clearjQueryCache();
    $.ajax({
        url: "feedbackValutation",
        type: "POST",
        data: {'id': id, 'stato':"amministratore"},
        dataType: 'json',
        async: true,
        success: function (data) {
            toastr[data["toastType"]](data["toastMessage"]);
            divToDelete = $("#"+id+"");
            destination = $("#feedback-list-destination");
            divToDelete.remove();
        },
        error: function(data){
            toastr[data["toastType"]](data["toastMessage"]);
        }
    });
}


