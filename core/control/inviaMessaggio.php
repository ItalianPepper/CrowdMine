<?php
    
    include_once MODEL_DIR . "Utente.php";
    include_once MODEL_DIR . "Messaggio.php";
    include_once MANAGER_DIR . "MessaggioManager.php";
    include_once MANAGER_DIR . "UtenteManagerStub.php";
    
    ## RECUPERO INFORMAZIONI SULL'UTENTE CONNESSO ##
    // session_start();
    // $utente = $_SESSION['utente'];
    //$_SESSION['lista']= serialize($lista-utenti);
    $utente_connesso = new Utente(0, 'Alfredo', 'Fiorillo', "38093", "Sal", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
    // if ($utente == null)
    //     header("location:./index.php");
    
    $id_destinatario = $_POST["id"];
    
    ## MANAGER ##
    $manager_msg = new MessaggioManager();
    $manager_utente = new UtenteManagerStub();
    
    ## RECUPERO IL DESTINATARIO DELLA CONVERSAZIONE ###
    $id_utente_destinatario = $_POST["id"];
    $utente_destinatario = $manager_utente->getUtenteByID($id_utente_destinatario);  //[STUB getUtentebyID]
    
    //echo $utente_destinatario->getNome()."    ";
    //$risultato = $manager_msg->inviaMessaggio($utente_connesso->getId(), $id_destinatario);
    $risultato = $manager_msg->sendMessaggio(null, "ciao", false, null, 1, 1);
    
    if($risultato){
        echo '<div class="alert alert-success">'."\n";
        echo '<strong>Invio con successo!</strong> Hai inviato un messaggio a '.$utente_destinatario->getNome() ;
        echo '</div>';
    }  else if($risultato==false){
        echo '<div class="alert alert-danger">'."\n";
        echo '<strong>Invio fallito!</strong> Non è stato possibile inviare il messaggio';
        echo '</div>';
    }
