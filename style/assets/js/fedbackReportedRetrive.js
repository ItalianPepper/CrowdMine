/**
 * Created by Giovanni Leo on 17/12/2016.
 */

$(document).ready(function () {
    $.ajax({
            url: "reportedFedbackListRetrive",
            type: "POST",
            dataType: 'json',
            async: true,
            success: function (data) {
                var destination = $("#feedback-list-reported");
                destination.empty();
                generateFeedbackList(data, "moderator", destination)
            },
            error: function (data) {
                console.log("erroe");
               toastr[data["toastType"]](data["toastMessage"]);
            }
        }
    )
});