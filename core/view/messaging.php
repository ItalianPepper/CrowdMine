<!DOCTYPE html>
<?php
include_once VIEW_DIR . "header.php";
include_once MODEL_DIR . "Utente.php";
include_once MODEL_DIR . "Messaggio.php";
include_once MANAGER_DIR . "MessaggioManagerStub.php";
include_once MANAGER_DIR . "MessaggioManager.php";

//$utente = $_SESSION['utente'];
// if ($utente == null)
//     header("location:./index.php");
$id_utente_connesso = 2;
$manager_msg = new MessaggioManager();
$lista_destinatari = $manager_msg->listaDestinatari(2); //array di utenti
//
//$lista_destinatari[0] = new Utente(1, 'Simone', 'Giak', "38093", "Sal", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine");
//$lista_destinatari[1] = new Utente(2, 'Giancarlo', 'Mannara', "38093", "Rom", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine");
//$lista_destinatari[2] = new Utente(3, 'Luca', 'PM', "38093", "Rom", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine");
//$lista_destinatari[3] = new Utente(4, 'Fabiano', 'Pecorelli', "38093", "Rom", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine");

if (isset($_GET["idcand"])) {
    if ($_GET["idcand"] == "") {
        $id_get = -2;
    } else
        $id_get = $_GET["idcand"];
} else
    $id_get = -3;

$_SESSION['destinatario'] = $id_get;
?>

<!-- MESSAGGI --> 
<!-- Trigger the modal with a button -->

<div class="app-messaging-container">



    <div class="app-messaging <?php
    if (isset($_GET["idcand"])) {
        $id_get = $_GET["idcand"];
        echo "collapse in";
    }
    ?>" id="collapseMessaging">
        <div class="chat-group">
            <div class="heading">Converstion</div>
            <ul class="group full-height">

                <li class="section">unread</li>

                <!-- LISTA DESTINATARI -->
                <?php
                foreach ($lista_destinatari as $indice => $elemento) {
                    $id = $lista_destinatari[$indice]->getId();
                    echo '<li class="message">' . "\n";
                    echo '<a data-toggle="collapse"  aria-expanded="false" aria-controls="collapseMessaging">' . "\n";
                    echo '<span class="badge badge-warning pull-right">1</span>' . "\n";
                    echo '<div class="message">' . "\n";
                    echo '<img class="profile" src="https://placehold.it/100x100">' . "\n";
                    echo '<div class="content">' . "\n";
                    echo '<div class="title"' . ' id="' . $id . '"' . ' onclick="redirect(event)">' . $lista_destinatari[$indice]->getNome() . " " . $lista_destinatari[$indice]->getCognome() . '</div>' . "\n";
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

<div id="candidature">


</div>

<script type="text/javascript" src="<?php echo STYLE_DIR ?>/assets/js/vendor.js"></script>
<script type="text/javascript" src="<?php echo STYLE_DIR ?>/assets/js/app.js"></script>


</body>
</html>

<script type="text/javascript">
    
    
    // ##1## se clicco un destintario parte questa funzione. Viene ricaricato il documento
    function redirect(event) {

        var id = event.target.id;
        window.location.href = 'http://localhost/CrowdMine/messaging?idcand=' + id;
        //alert("REDIRECT: " + window.location.href);
    }


    // ##2## Quando viene caricato il documento...
    document.addEventListener("DOMContentLoaded", function (event) {

        <?php
        if ($id_get >= 0) { //Il GET CI STA
            echo 'stampa(null)';
        } else {
            echo 'window.location.href = \'http.://localhost/CrowdMine/messaging\'';
        }
        ?>
    });


    function stampa(event)
    {

        var httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function ()
        {
            if ((httpRequest.readyState === XMLHttpRequest.DONE) && (httpRequest.status === 200))
            {
                document.getElementById('ris').innerHTML = httpRequest.responseText;
            }//else  alert("error: " + httpRequest.readyState + "STATUS: " + httpRequest.status);  
        };

        //var modulo = new FormData(document.getElementById('myForm'));
        var params;
        if (event != null) { //IL GET NON CI STA. 
            var id = event.target.id;
            params = "id=" + id;
        }
        <?php
        if ($id_get > -1) { //Il GET CI STA
            echo 'params = "id=' . $id_get . '"';
        }
        ?>;
        
        //alert("stampo la conversazione: " + params);
        httpRequest.open("POST", "<?php echo DOMINIO_SITO . "/stampaConversazione"; ?>", true);
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send(params);


    }

    function inviamessaggio(event)
    {

        var httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function ()
        {
            if ((httpRequest.readyState === XMLHttpRequest.DONE) && (httpRequest.status === 200))
            {
                document.getElementById('messaggi_inviati').innerHTML = httpRequest.responseText;
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
    }




    function inviaCollaborazione(event)
    {
        alert("Ciao");
        var httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function ()
        {
            if ((httpRequest.readyState === XMLHttpRequest.DONE) && (httpRequest.status === 200))
            {
                document.getElementById('ciao').innerHTML = httpRequest.responseText;
            }//else  alert("error: " + httpRequest.readyState + "STATUS: " + httpRequest.status);  
        };
        
        alert("Ciao");
        //var modulo = new FormData(document.getElementById('myForm'));
        var id = event.target.id;
        var params = "id=" + id; //id candidatura
        alert("Ciao");
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
        alert("Rifiuta Candiato");
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

        alert("ciao");
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




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">CANDIDATURE: </h4>
            </div>
            <div class="modal-body">
                
                <div class="card-body" id="ciao">
                    
                      <?php
                         include_once CONTROL_DIR . "stampaCandidature.php";
                       ?>
                                    
                </div> <!-- fine body modal -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

