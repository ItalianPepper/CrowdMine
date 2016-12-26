/**
 * Created by darkv on 22/12/2016.
 */

$.ajax({
        type: "POST",
        url: "listaNotifiche",
        success: function(data){
            loadNotifica(data.list);
        }
    });

function loadNotifica(result){
    $.each(result, function(value, key){

    });
}