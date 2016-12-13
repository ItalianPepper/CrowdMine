/**
 * Created by Giovanni Leo on 06/12/2016.
 */


$(document).ready(function () {
    "use strict";
    var id = 1;
    $("#feedback-tab-3").click(function () {
        $.ajax({
            url: "feedbackListRetrive",
            type: "POST",
            data: {'id': id},
            dataType: 'json',
            async: true,
            success: function (data) {
                var destination = $("#feedback-list-destination")
                console.log(destination);

                console.log(data);
                for (var i in data) {
                    var feedbackListObj = [];
                    feedbackListObj.feedbackID = data[i].feedbackID;
                    feedbackListObj.feedbackTitle = data[i].feedbackTitle;
                    feedbackListObj.feedbackDesc = data[i].feedbackDesc;
                    feedbackListObj.userFirstName = data[i].userFirstName;
                    feedbackListObj.userLastName = data[i].userLastName;
                    feedbackListObj.userProfileImage = data[i].userProfileImage;
                    feedbackListObj.feedbackRating = data[i].feedbackRating;

                    destination.append(feedbackRowToString(feedbackListObj, "moderator"));
                    setRatingStar(feedbackListObj.feedbackID, feedbackListObj.feedbackRating);


                }

            }


        })
    });
});


function feedbackRowToString(feedbackListObj, role) {
    "use strict";
    var buttonGroup = "";
    console.log(role);
    if (role == "user") {


        buttonGroup = '<div class="media-action">' +
            '   <button onclick="segnalaFeedback(' + feedbackListObj.feedbackID + ')" class="btn btn-link"><i' +
            '   class="fa fa-exclamation-circle"></i>' +
            '   Segnala' +
            '   </button>' +
            '  </div>';
    }
    else if (role == "moderator") {
        buttonGroup = '<div class="media-action">' +
            '<button onclick="confirmFeedback('+feedbackListObj.feedbackID+')"  class="btn btn-link"><i class="fa fa-check"></i> Conferma</button>' +
            '<button onclick="deleteFeedback('+feedbackListObj.feedbackID+')" class="btn btn-link"><i class="fa fa-close"></i> Elimina</button>' +
            '<button onclick="sendFeedbackToAdmin('+feedbackListObj.feedbackID+')" class="btn btn-link"><i class="fa fa-exclamation"></i> Invia all\' Amministratore</button>' +
            '                                                                                </div>';
    }
    else if (role == "admin") {
        buttonGroup = '<div class="media-action">' +
            '<button onclick="confirmFeedback('+feedbackListObj.feedbackID,this+')"  class="btn btn-link"><i class="fa fa-check"></i> Conferma</button>' +
            '<button onclick="deleteFeedback('+feedbackListObj.feedbackID,this+')" class="btn btn-link"><i class="fa fa-close"></i> Elimina</button>' +
            '                                                                                </div>';

    }
    var html = '<div class="row" style="margin-top: 3%" id="' + feedbackListObj.feedbackID + '">' +
        '                                                        <div class="col-lg-12 col-md-12 col-xs-12">' +
        '                                                            <div class="section">' +
        '                                                                <div class="media social-post">' +
        '                                                                    <div class="media-left">' +
        '                                                                        <a href="#">' +
        '                                                                         <img src="style&sol;assets&sol;images&sol;'+ feedbackListObj.userProfileImage + '"> ' +
        '                                                                        </a>' +
        '                                                                    </div>' +
        '                                                                    <div class="section">' +
        '                                                                        <div class="section-body">' +
        '                                                                            <div class="media-body">' +
        '                                                                                <div class="media-heading">' +
        '                                                                                    <h4 class="title">' + feedbackListObj.userFirstName + ' ' + feedbackListObj.userLastName + '</h4>' +
        '                                                                                </div>' +
        '                                                                                <div class="rating-content"' +
        '                                                                                     onclick="return false;">' +
        '                                                                                    <div class="rating">' +
        '                                                                                        <input type="radio" id="star5-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               value="5"/><label' +
        '                                                                                            class="full" for="star5"' +
        '                                                                                            title="Awesome - 5 stars"></label>' +
        '                                                                                        <input type="radio"' +
        '                                                                                               id="star4half-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               value="4.5"/><label' +
        '                                                                                            class="half" for="star4half"' +
        '                                                                                            title="Pretty good - 4.5 stars"></label>' +
        '                                                                                        <input type="radio" id="star4-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               value="4"/><label' +
        '                                                                                            class="full" for="star4"' +
        '                                                                                            title="Pretty good - 4 stars"></label>' +
        '                                                                                        <input type="radio"' +
        '                                                                                               id="star3half-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               value="3.5"' +
        '                                                                                               checked/><label' +
        '                                                                                            class="half" for="star3half"' +
        '                                                                                            title="Meh - 3.5 stars"></label>' +
        '                                                                                        <input type="radio" id="star3-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               value="3"/><label' +
        '                                                                                            class="full" for="star3"' +
        '                                                                                            title="Meh - 3 stars"></label>' +
        '                                                                                        <input type="radio"' +
        '                                                                                              id="star2half-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               value="2.5"/><label' +
        '                                                                                            class="half" for="star2half"' +
        '                                                                                            title="Kinda bad - 2.5 stars"></label>' +
        '                                                                                        <input type="radio" id="star2-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               value="2"/><label' +
        '                                                                                            class="full" for="star2"' +
        '                                                                                            title="Kinda bad - 2 stars"></label>' +
        '                                                                                        <input type="radio"' +
        '                                                                                               id="star1half-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               value="1.5"/><label' +
        '                                                                                            class="half" for="star1half"' +
        '                                                                                            title="Meh - 1.5 stars"></label>' +
        '                                                                                        <input type="radio"  id="star1-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               value="1"/><label' +
        '                                                                                            class="full" for="star1"' +
        '                                                                                            title="Sucks big time - 1 star"></label>' +
        '                                                                                        <input type="radio"' +
        '                                                                                                id="starhalf-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackListObj.feedbackID + '"' +
        '                                                                                               value="0.5"/><label' +
        '                                                                                            class="half" for="starhalf"' +
        '                                                                                            title="Sucks big time - 0.5 stars"></label>' +
        '                                                                                    </div>' +
        '                                                                                </div>' +
        '                                                                                <h5 style="margin-top: 0px"><b>' + feedbackListObj.feedbackTitle + '</b></h5>' +
        '                                                                                <div class="media-content">' + feedbackListObj.feedbackDesc +
        '                                                                                </div>' + buttonGroup +
        '                                                                            </div>' +
        '                                                                        </div>' +
        '                                                                    </div>' +
        '                                                                </div>' +
        '                                                            </div>' +
        '                                                        </div>' +
        '                                                    </div>';

    return html;
}

function setRatingStar(feedbackID, feedbackRatingValue) {
    "use strict";

    for (var i = 0; i < 5; i++) {
        if (feedbackRatingValue == i)
            $("#star" + i + "-" + feedbackID).attr("checked", "checked");
        if (feedbackRatingValue == i + 0.5)
            $("#star" + i + "half-" + feedbackID).attr("checked", "checked");
    }
}