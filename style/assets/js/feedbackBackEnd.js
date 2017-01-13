/**
 * Created by Giovanni Leo on 17/12/2016.
 */
/**
 * IMPORTANT:
 * dominio is a  global variable then you can see this variable
 * in each views that needs to show a list of feedback or
 * perform some action on it.
 */
function retriveAdminFeedback() {
    $.ajax({
            url: dominio+"/adminFedbackListRetrive",
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
            url: dominio+"/reportedFedbackListRetrive",
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