/**
 * Created by darkv on 22/12/2016.
 */

function poll(){
    setTimeout(function(){
        console.log("ciao");
        $.ajax({
            type: "POST",
            url: "pannelloNotifiche",
            dataType: "json",
            success: function(data){
                var parsed = JSON.parse(data);
                var lista = [];
                for(var x in parsed){
                    lista.push(x);
                }
                var listaNotifiche = document.getElementById('lista-notifiche');
                $.each(lista, function(value, key){
                listaNotifiche.append(
                '<li>'+
                '<a href="'+ value +'">'+
                    '<div class="message">'+
                    '<div class="content">'+
                    '<div class="title">'+ key +'</div>'+
                '</div>'+
                '</div>'+
                '</a>'+
                '</li>')
                });
                poll();
            }
        });
    }, 30000);
};

poll();