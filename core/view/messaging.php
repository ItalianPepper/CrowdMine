<!DOCTYPE html>

<!DOCTYPE html>
<html>
<head>
    <?php include_once VIEW_DIR."ViewUtils.php";?>
    <?php include_once VIEW_DIR."headerStart.php";?>

    <style>
      
         .app-messaging .chat-group ul.group > li.message a .message .content .title:hover {
                cursor: pointer;
                font-size: 14px;
                font-weight: bold;
                text-decoration: underline;
            }
        
    </style>

    <?php
        if(isset($user))
        $fullname = $user->getNome()." ".$user->getCognome();
    ?>

</head>
<body>
<div class="app app-default">
    <div class="app-container app-full no-sidebar">
        <?php include_once VIEW_DIR."headerNavBar.php";?>
        <div class="app-head"></div>

<?php
include_once MODEL_DIR . "Utente.php";
include_once MODEL_DIR . "Messaggio.php";
include_once MANAGER_DIR . "Manager.php";
include_once MANAGER_DIR . "NotificaManager.php";
include_once MANAGER_DIR . "MessaggioManager.php";

#RECUPERO INFORMAZIONI DALL'UTENTE
$id_utente_connesso = $user->getId();
$manager_msg = new MessaggioManager();
$lista_destinatari = $manager_msg->listaDestinatari($id_utente_connesso); //array di utenti

//RECUPERO L'ID DEL DESTINATARIO
    if (isset($_GET["idcand"])) {
        if ($_GET["idcand"] == "") {
            $id_get = -2;
        } else
            $id_get = $_GET["idcand"];
    } else
        $id_get = -3;
    
   
?>

<!-- MESSAGGI --> 
<!-- Trigger the modal with a button -->

<div class="app-messaging-container">

    <div class="app-messaging <?php
    
    if(isset($_SESSION['destinatario'])){
            echo "";
    }else echo "collapse in";
    
    ?>" id="collapseMessaging">
        <div class="chat-group">
            <div class="heading">Conversazioni: </div>
            <ul class="group full-height">

                <!-- LISTA DESTINATARI -->
                <?php
                foreach ($lista_destinatari as $indice => $elemento) {
                    $id = $lista_destinatari[$indice]->getId();
                    $num_messaggi_non_letti = $manager_msg->messaggiNonLetti($id, $id_utente_connesso);
                    echo '<li class="message">' . "\n";
                    echo '<a data-toggle="collapse" href="#collapseMessaging" aria-expanded="false" aria-controls="collapseMessaging">' . "\n";
                    if(count($num_messaggi_non_letti)>0)
                        echo '<span id="numero_conversazione" class="badge badge-warning pull-right">'.count($num_messaggi_non_letti).'</span>' . "\n";
                    echo '<div class="message">' . "\n";
                    echo '<img class="profile" src="https://placehold.it/100x100">' . "\n";
                    echo '<div class="content">' . "\n";
                    echo '<div class="title"' . ' id="' . $id . '"' . ' onclick="stampa(event)">' . $lista_destinatari[$indice]->getNome() . " " . $lista_destinatari[$indice]->getCognome() . '</div>' . "\n";
                    echo '</div>' . "\n";
                    echo '</div>' . "\n";
                    echo '</a>' . "\n";
                    echo '</li>' . "\n";
                }
                ?> 

            </ul>
        </div>
        <div class="messaging" id="ris" style="height: 100%">
               

        </div> <!--class messaging -->
        
    </div>
</div> <!-- messaging container -->
</div> <!-- app container -->
</div> <!-- app app default -->

 
   

    
</body>
</html>

<script type="text/javascript">
    
    // ##2## Quando viene caricato il documento stampo la conversazione con l'id presente nel Get
    document.addEventListener("DOMContentLoaded", function (event) {
       
       
       id = <?php if(isset($_SESSION['destinatario'])){
                    echo $_SESSION['destinatario'];
                    }else echo -1;
                 ?>;
       stampa_id(id);
     
    });
    
    // ##1## se clicco un destintario parte questa funzione. Viene ricaricato il documento
    function redirect(event) {

        var id = event.target.id;
        window.location.href = '<?php echo DOMINIO_SITO; ?>/messaging?idcand=' + id;
        //alert("REDIRECT: " + window.location.href);
    
    }

    //STAMPA LA CONVERSAZIONE A DESTRA DELLA VIEW
    function stampa(event)
    {

        var httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function ()
        {
            if ((httpRequest.readyState === XMLHttpRequest.DONE) && (httpRequest.status === 200))
            {
                document.getElementById('ris').innerHTML = httpRequest.responseText;
                 $('#messaggi_inviati').animate({scrollTop: $('#messaggi_inviati').prop("scrollHeight")}, 0);
                 resetNumeri();
            }
        };

        var params;
        if (event != null) { //IL GET NON CI STA. 
            var id = event.target.id;
            params = "id=" + id;
        }
        <?php
            //if ($id_get > -1) { //Il GET CI STA
            //    echo 'params = "id=' . $id_get . '"';
            //}
        ?>;
        //alert("Id: " + params);
        //alert("stampo la conversazione: " + params);
        httpRequest.open("POST", "<?php echo DOMINIO_SITO . "/stampaConversazione"; ?>", true);
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send(params);
        
        
    }
    
    function resetNumeri(){
        
        divNumber = $("#numero_conversazione");
        numero = divNumber.html();
        divNumber.remove();
        header = $("#num_messaggi");
        headerNumber = header.html();
        if((headerNumber-numero) == 0){
            header.hide();
        }
        else{
            header.show();
            header.html(headerNumber-numero);
        }
    }
    
    
     //STAMPA LA CONVERSAZIONE A DESTRA DELLA VIEW
    function stampa_id(destinatario)
    {
        if (destinatario<0) return;
        var httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function ()
        {
            if ((httpRequest.readyState === XMLHttpRequest.DONE) && (httpRequest.status === 200))
            {
                document.getElementById('ris').innerHTML = httpRequest.responseText;
                 $('#messaggi_inviati').animate({scrollTop: $('#messaggi_inviati').prop("scrollHeight")}, 0);
                 resetNumeri();
            }
        };

        var params;
        if (event != null) { //IL GET NON CI STA. 
            var id = destinatario;
            params = "id=" + id;
        }
        
        //alert("stampo la conversazione: " + params);
        httpRequest.open("POST", "<?php echo DOMINIO_SITO . "/stampaConversazione"; ?>", true);
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send(params);
        
    }
    
    
    //INVIA UN MESSAGGIO 
    function inviamessaggio(event)
    {
        textbox = document.getElementById('area');
        if(textbox.value!="") {
            var httpRequest = new XMLHttpRequest();
            httpRequest.onreadystatechange = function () {
                if ((httpRequest.readyState === XMLHttpRequest.DONE) && (httpRequest.status === 200)) {
                    document.getElementById('messaggi_inviati').innerHTML = httpRequest.responseText;
                    $('#messaggi_inviati').animate({scrollTop: $('#messaggi_inviati').prop("scrollHeight")}, 0);
                }//else  alert("error: " + httpRequest.readyState + "STATUS: " + httpRequest.status);
            };


            //var modulo = new FormData(document.getElementById('myForm'));
            var id = event.target.id;
            var params = "id=" + id;

            var testo = document.getElementById("area").value;
            var params = params + "&testo=" + testo;
            //alert(params);
            httpRequest.open("POST", "<?php echo DOMINIO_SITO . "/inviaMessaggio"; ?>", true);
            httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            httpRequest.send(params);
            textbox.value = "";
        }
    }



    function inviaCollaborazione(event)
    {

        var httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function ()
        {
            if ((httpRequest.readyState === XMLHttpRequest.DONE) && (httpRequest.status === 200))
            {
                document.getElementById('ciao').innerHTML = httpRequest.responseText;
            }//else  alert("error: " + httpRequest.readyState + "STATUS: " + httpRequest.status);  
        };
        
        //var modulo = new FormData(document.getElementById('myForm'));
        var id = event.target.id;
        var params = "id=" + id; //id candidatura

        httpRequest.open("POST", "<?php echo DOMINIO_SITO . "/inviaCollaborazione"; ?>" , true);
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send(params);
 
    }





    function rifiutaCandidato(event)
    {

        var httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function ()
        {
            if ((httpRequest.readyState === XMLHttpRequest.DONE) && (httpRequest.status === 200))
            {
                document.getElementById('ciao').innerHTML = httpRequest.responseText;
            }//else  alert("error: " + httpRequest.readyState + "STATUS: " + httpRequest.status);  
        };
        

        //var modulo = new FormData(document.getElementById('myForm'));
        var id = event.target.id;
        var params = "id=" + id; //id candidatura
   
        httpRequest.open("POST", "<?php echo DOMINIO_SITO . "/rifiutaCandidato"; ?>" , true);
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send(params);
    }
    
    
    
    
    
    
    function accettaCollaborazione(event)
    {

        var httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function ()
        {
            if ((httpRequest.readyState === XMLHttpRequest.DONE) && (httpRequest.status === 200))
            {
                document.getElementById('ciao').innerHTML = httpRequest.responseText;
            }//else  alert("error: " + httpRequest.readyState + "STATUS: " + httpRequest.status);  
        };

        //var modulo = new FormData(document.getElementById('myForm'));
        var id = event.target.id;
        var params = "id=" + id; //id candidatura
        httpRequest.open("POST", "<?php echo DOMINIO_SITO . "/accettaCollaborazione?id="; ?>" + id, true);
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send(params);
    }
   
   
   
    
    function rifiutaCollaborazione(event)
    {

        var httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function ()
        {
            if ((httpRequest.readyState === XMLHttpRequest.DONE) && (httpRequest.status === 200))
            {
                document.getElementById('ciao').innerHTML = httpRequest.responseText;
            }//else  alert("error: " + httpRequest.readyState + "STATUS: " + httpRequest.status);  
        };


        //var modulo = new FormData(document.getElementById('myForm'));
        var id = event.target.id;
        var params = "id=" + id; //id candidatura
        httpRequest.open("POST", "<?php echo DOMINIO_SITO . "/rifiutaCollaborazione?id="; ?>" + id, true);
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send(params);
    }
   
    
    
    
    
    function stampaCandidature(event)
    {

        var httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function ()
        {
            if ((httpRequest.readyState === XMLHttpRequest.DONE) && (httpRequest.status === 200))
            {
                document.getElementById('info').innerHTML = httpRequest.responseText;
            }//else  alert("error: " + httpRequest.readyState + "STATUS: " + httpRequest.status);  
        };

        //var modulo = new FormData(document.getElementById('myForm'));
        var id = event.target.id;
        var params = "id=" + id; //id candidatura
        httpRequest.open("POST", "<?php echo DOMINIO_SITO . "/stampaCandidature"; ?>" , true);
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send(params);
    }
   
   
   
   
</script>





<script type="text/javascript" src="<?php echo STYLE_DIR ?>assets/js/vendor.js"></script>
<script type="text/javascript" src="<?php echo STYLE_DIR ?>assets/js/app.js"></script>
<script type="text/javascript" src="<?php echo STYLE_DIR ?>assets/js/headerUtils.js"></script>
<script type="text/javascript" src="<?php echo STYLE_DIR ?>assets/js/messagingUpdate.js"></script>
