<?php
    
    include_once MODEL_DIR . "Utente.php";
    include_once MODEL_DIR . "Messaggio.php";
    include_once MANAGER_DIR . "MessaggioManager.php";
    include_once MANAGER_DIR . "UtenteManager.php";
    
    ## RECUPERO INFORMAZIONI SULL'UTENTE CONNESSO ##
    // session_start();
    // $utente = $_SESSION['utente'];
    //$_SESSION['lista']= serialize($lista-utenti);
    $utente_connesso = new Utente(2, 'Alfredo', 'Fiorillo', "38093", "Sal", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
    // if ($utente == null)
    //     header("location:./index.php");
    
    //$id_destinatario = $_POST["id"];
    $id_destinatario = $_SESSION['destinatario'];
    $testo_messaggio = $_POST["testo"];
    
    ## MANAGER ##
    
    $manager_msg = new MessaggioManager();
    $manager_utente = new UtenteManager();
    
    ## RECUPERO IL DESTINATARIO DELLA CONVERSAZIONE ###
    $id_utente_destinatario = $_POST["id"];
    $utente_destinatario = $manager_utente->findUtenteById($id_utente_destinatario);  //[STUB getUtentebyID]
    //
    //echo $utente_destinatario->getNome()."    ";
    //$risultato = $manager_msg->inviaMessaggio($utente_connesso->getId(), $id_destinatario);
    //$date = date("d/m/Y" - G:i);
    //echo ($id_destinatario);
    $risultato = $manager_msg->sendMessaggio(null, $testo_messaggio, 0, 0, $utente_connesso->getId(), $id_destinatario); //id, corpo, data, letto
    
    if($risultato){
        //echo '<meta http-equiv="refresh" content="0;URL=http://localhost/CrowdMine/messaging?id='.$id_destinatario.'">';
        $lista_messaggio = $manager_msg->loadConversation($utente_connesso->getId(), $id_destinatario);
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

       // header('Location: http://localhost/CrowdMine/messaging?id='.$id_utente_destinatario); 
        //header( "refresh:5;url={$_SERVER['PHP_SELF']}" ); 
    }  else if($risultato==false){
        echo '<div class="alert alert-danger">'."\n";
        echo '<strong>Invio fallito!</strong> Non è stato possibile inviare il messaggio';
        echo '</div>';
    }

?>
     

