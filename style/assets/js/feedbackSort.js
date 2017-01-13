/**
 * Created by Giovanni on 14/12/2016.
 */
/**
 * IMPORTANT:
 * dominio is a  global variable , you can see this variable
 * in each views that needs to show a list of feedback or
 * perform some action on it.
 */
    $(document).ready(function () {
       $("#option-1,#option-2,#option-3").click(function () {
           var optionValue = $(event.target).attr("name");
           var id = $("#user-feedback-id").attr("value");
           $.ajax({
               url: dominio+"/SortFeedback",
               type: "POST",
               data: {'optionValue': optionValue,'id':id},
               dataType: 'json',
               async: true,
               success:function (data) {

                   var destination = $("#feedback-list-destination");
                   destination.empty();
                   generateFeedbackList(data,"user",destination)
               },
               error:function (data,textStatus, xhr) {

                   toastr.error("Errore inaspettato durante l'ordinamento");
               }
           });
       })
    });