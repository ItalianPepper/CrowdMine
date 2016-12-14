/**
 * Created by Giovanni on 14/12/2016.
 */

    $(document).ready(function () {
       $("#option-1,#option-2,#option-3").click(function () {
            //take the id of valutated user
               var optionValue = $(event.target).attr("name");
           var id = $("#user-feedback-id").attr("value");
           console.log(optionValue,id);
           $.ajax({
               url: "",
               type: "POST",
               data: {'optionValue': optionValue},
               dataType: 'json',
               async: true,
               success:function () {

               },
               error:function () {

               }
           });
       })
    })