/**
 * Created by LongSky on 13/12/2016.
 */

function deleteFeedback(id, deleteBtn){
    $.ajax({
        url: "feedbackValutation",
        type: "POST",
        data: {'id': id, 'stato':"eliminato"},
        dataType: 'json',
        async: true,
        success: function (data) {

        }
    });
}

function confirmFeedback(id, confirmBtn){
    $.ajax({
        url: "feedbackValutation",
        type: "POST",
        data: {'id': id, 'stato':"attivo"},
        dataType: 'json',
        async: true,
        success: function (data) {

        }
    });
}

function sendFeedbackToAdmin(id, adminBtn){
    $.ajax({
        url: "feedbackValutation",
        type: "POST",
        data: {'id': id, 'stato':"admin"},
        dataType: 'json',
        async: true,
        success: function (data) {

        }
    });
}


