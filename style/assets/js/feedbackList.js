/**
 * Created by Giovanni Leo on 06/12/2016.
 */


$(document).ready(function () {
    "use strict";
     var username = "ciao";
    $("#feedback-tab-3").click(function () {
        $.ajax({
            url: "feedbackListRetrive",
            type: "POST",
            data: {'username': username},
            dataType: "JSON",
            async: true,
            success: function (data) {
                console.log(JSON.stringify(data));
               /* var feedbackListArray = JSON.parse(data);
                var i=0;
                for(i=0;i< feedbackListArray.size(); i++)
                {
                    var feedbackID = feedbackListArray[i].id;
                    var feedbackTitle = feedbackListArray[i].title;
                    var feedbackDesc= feedbackListArray[i].description;
                    var userFirstName = feedbackListArray[i].userFirstName;
                    var userLastName = feedbackListArray[i].userFirstName;
                    var userProfileImage= feedbackListArray[i].userProfileName;
                    var feedbackRating = feedbackListArray[i].rating;
                    feedbackRowToString(feedbackID,feedbackTitle,feedbackDesc,userFirstName,userLastName,userProfileImage);
                    setRatingStar(feedbackID,feedbackRating);
                }*/
            }


        })
    });
});


function feedbackRowToString(feedbackID, feedbackTitle, feedbackDesc, userFirstName, userLastName, userProfileImage) {
    "use strict";

    var html = '<div class="row" style="margin-top: 3%">' +
        '                                                        <div class="col-lg-12 col-md-12 col-xs-12">' +
        '                                                            <div class="section">' +
        '                                                                <div class="media social-post">' +
        '                                                                    <div class="media-left">' +
        '                                                                        <a href="#">' +
        '                                                                            <img' +
        '                                                                                src="<?php echo STYLE_DIR; ?>assets\images\profile.png"/>' +//ad user profile image
        '                                                                        </a>' +
        '                                                                    </div>' +
        '                                                                    <div class="section">' +
        '                                                                        <div class="section-body">' +
        '                                                                            <div class="media-body">' +
        '                                                                                <div class="media-heading">' +
        '                                                                                    <h4 class="title">' + userFirstName + ' ' + userLastName + '</h4>' +
        '                                                                                </div>' +
        '                                                                                <div class="rating-content"' +
        '                                                                                     onclick="return false;">' +
        '                                                                                    <div class="rating">' +
        '                                                                                        <input type="radio" id="star5-' + feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackID + '"' +
        '                                                                                               value="5"/><label' +
        '                                                                                            class="full" for="star5"' +
        '                                                                                            title="Awesome - 5 stars"></label>' +
        '                                                                                        <input type="radio"' +
        '                                                                                               id="star4half-' + feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackID + '"' +
        '                                                                                               value="4.5"/><label' +
        '                                                                                            class="half" for="star4half"' +
        '                                                                                            title="Pretty good - 4.5 stars"></label>' +
        '                                                                                        <input type="radio" id="star4-' + feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackID + '"' +
        '                                                                                               value="4"/><label' +
        '                                                                                            class="full" for="star4"' +
        '                                                                                            title="Pretty good - 4 stars"></label>' +
        '                                                                                        <input type="radio"' +
        '                                                                                               id="star3half-' + feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackID + '"' +
        '                                                                                               value="3.5"' +
        '                                                                                               checked/><label' +
        '                                                                                            class="half" for="star3half"' +
        '                                                                                            title="Meh - 3.5 stars"></label>' +
        '                                                                                        <input type="radio" id="star3-' + feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackID + '"' +
        '                                                                                               value="3"/><label' +
        '                                                                                            class="full" for="star3"' +
        '                                                                                            title="Meh - 3 stars"></label>' +
        '                                                                                        <input type="radio"' +
        '                                                                                              id="star2half-' + feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackID + '"' +
        '                                                                                               value="2.5"/><label' +
        '                                                                                            class="half" for="star2half"' +
        '                                                                                            title="Kinda bad - 2.5 stars"></label>' +
        '                                                                                        <input type="radio" id="star2-' + feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackID + '"' +
        '                                                                                               value="2"/><label' +
        '                                                                                            class="full" for="star2"' +
        '                                                                                            title="Kinda bad - 2 stars"></label>' +
        '                                                                                        <input type="radio"' +
        '                                                                                               id="star1half-' + feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackID + '"' +
        '                                                                                               value="1.5"/><label' +
        '                                                                                            class="half" for="star1half"' +
        '                                                                                            title="Meh - 1.5 stars"></label>' +
        '                                                                                        <input type="radio"  id="star1-' + feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackID + '"' +
        '                                                                                               value="1"/><label' +
        '                                                                                            class="full" for="star1"' +
        '                                                                                            title="Sucks big time - 1 star"></label>' +
        '                                                                                        <input type="radio"' +
        '                                                                                                id="starhalf-' + feedbackID + '"' +
        '                                                                                               name="rating-' + feedbackID + '"' +
        '                                                                                               value="0.5"/><label' +
        '                                                                                            class="half" for="starhalf"' +
        '                                                                                            title="Sucks big time - 0.5 stars"></label>' +
        '                                                                                    </div>' +
        '                                                                                </div>' +
        '                                                                                <h5 style="margin-top: 0px"><b>' + feedbackTitle + '</b></h5>' +
        '                                                                                <div class="media-content">' + feedbackDesc +
        '                                                                                </div>' +
        '                                                                                <div class="media-action">' +
        '                                                                                    <button class="btn btn-link"><i' +//add here a on click function
        '                                                                                            class="fa fa-exclamation-circle"></i>' +
        '                                                                                        Segnala' +
        '                                                                                    </button>' +
        '                                                                                </div>' +
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