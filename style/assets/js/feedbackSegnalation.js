/**
 * Created by Utente on 12/12/2016.
 */

function segnalaFeedback(feedbackID) {
    $(document).ready(function () {
        clearjQueryCache();
        $.ajax({
            url: 'feedbackSegnalation',
            type: 'POST',
            data: {'feedbackID': feedbackID},
            dataType: 'json',
            async: true,
            success: function (data) {

                toastr[data["toastType"]](data["toastMessage"]);

            },
            error: function () {
                toastr[data["toastType"]](data["toastMessage"]);
            }

        })
    })

}

function clearjQueryCache(){
    for (var x in jQuery.cache){
        delete jQuery.cache[x];
    }
}