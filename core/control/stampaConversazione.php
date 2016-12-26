<?php
include_once MODEL_DIR . "Utente.php";
include_once MODEL_DIR . "Messaggio.php";
include_once MANAGER_DIR . "MessaggioManagerStub.php";
include_once MANAGER_DIR . "UtenteManagerStub.php";
//include_once("control_Messaggi.php");
## RECUPERO INFORMAZIONI SULL'UTENTE CONNESSO ##
// session_start();
// $utente = $_SESSION['utente'];
//$_SESSION['lista']= serialize($lista-utenti);
$utente_connesso = new Utente(0, 'Alfredo', 'Fiorillo', "38093", "Sal", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine");
// if ($utente == null)
//     header("location:./index.php");
## MANAGER ##
$manager_msg = new MessaggioManagerStub();
$manager_utente = new UtenteManagerStub();

## RECUPERO IL DESTINATARIO DELLA CONVERSAZIONE ###
$id_utente_destinatario = $_POST["id"];
$utente_destinatario = $manager_utente->getUtenteByID($id_utente_destinatario);  //[STUB getUtentebyID]
## RECUPERA LA CONVERSAZIONE CON IL DESTINATARIO ##
$lista_messaggio = $manager_msg->getConversazione($utente_connesso->getId(), $id_utente_destinatario);
?>    
<!-- INTESTAZIONE DEL MESSAGGIO -->
<div class="heading">
    <div class="title">
        <a class="btn-back" data-toggle="collapse" href="#collapseMessaging" aria-expanded="false" aria-controls="collapseMessaging">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </a>

        <?php echo $utente_destinatario->getNome() . "    "; ?>  



    </div>
    
    <div class="btn-group" style="padding-left: 10px">
        
        <?php  
            //L'utente destinatario Simone si è candidato ad due annunci di Alfredo; Alfredo quindi può Inviare la Collaborazione o Rifiutare il candidato [tutto relativo a quell'annuncio]
            $lista_candidature = $manager_msg->isCandidato($utente_connesso->getId(), $id_utente_destinatario);
            if ($lista_candidature != null){
        ?>        
            <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                <?php echo count($lista_candidature);  ?> candidature:  <span class="caret"></span>
            </button>

            <ul class="dropdown-menu" role="menu">
        <?php    
        
            foreach ($lista_candidature as $indice => $value) {
            $id_candidatura = $lista_candidature[$indice]->getId();
            $id_annuncio = $lista_candidature[$indice]->getIdAnnuncio();

        ?>
            
            <li><a> Candidatura id: <b><?php echo $id_candidatura; ?> | </b> <?php echo $utente_destinatario->getNome() . "    "; ?>  si e' candidato all'annuncio <b><?php echo $id_annuncio; ?></b></a>  <div style="padding-left: 20px"><button type="button" class="btn btn-info btn-xs">Vai all'annuncio</button> <button type="button" class="btn btn-success btn-xs">Invia Collaborazione</button> <button type="button" class="btn btn-danger btn-xs">Rifiuta Candidato</button> </div> </li>
            <!--<li class="divider"></li> -->
            
            <hr style="border-top: 5px solid #eee;">
            
        <?php  
                }
                echo '</ul>';
            }
        ?>
    </div>
    
    
   
    <div class="action"></div>
</div>
<ul class="chat">


    <?php
    foreach ($lista_messaggio as $indice => $value) {

        if ($lista_messaggio[$indice]->getIdUtenteDestinatario() == $utente_connesso->getId()) {

            echo '<li class="right">';
        } else
            echo '<li>';

        echo '<div class="message">' . $lista_messaggio[$indice]->getCorpo() . '</div>';
        echo '<div class="info">';
        echo '<div class="datetime">11.45pm</div>';
        echo '<div class="status"><i class="fa fa-check" aria-hidden="true"></i> Read</div>';
        echo '</div>';
        echo '</li>';
    }
    ?>


</ul>        
<div class="footer">
    <div class="message-box">
        <textarea placeholder="type something..." id="messaggio" class="form-control"></textarea>
        <button class="btn btn-default" id="<?php echo $id_utente_destinatario; ?>" onclick="inviamessaggio(event)"><i class="fa fa-paper-plane" aria-hidden="true"></i><span>Send</span></button>
    </div>
    <div id="info">

    </div>
</div>