/**
 * Created by Giovanni Leo on 17/12/2016.
 */

function retriveAdminFeedback() {
    $.ajax({
            url: "/CrowdMine/adminFedbackListRetrive",
            type: "POST",
            dataType: 'json',
            async: true,
            success: function (data) {
                var destination = $("#feedback-list-reported");
                destination.empty();
                generateFeedbackList(data, "admin", destination,"/CrowdMine")
            },
            error: function (data) {
                console.log("erroe");
                toastr[data["toastType"]](data["toastMessage"]);
            }
        }
    )
}

function retriveModeratorFeedback() {
    $.ajax({
            url: "/CrowdMine/reportedFedbackListRetrive",
            type: "POST",
            dataType: 'json',
            async: true,
            success: function (data) {
                console.log(data);
                var destination = $("#feedback-list-reported");
                destination.empty();
                generateFeedbackList(data, "moderator", destination,"/CrowdMine")
            },
            error: function (data) {
                console.log("erroe");
                toastr[data["toastType"]](data["toastMessage"]);
            }
        }
    )
}