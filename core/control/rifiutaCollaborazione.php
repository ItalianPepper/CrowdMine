<?php
    
    include_once MODEL_DIR . "Utente.php";
    include_once MODEL_DIR . "Messaggio.php";
    include_once MODEL_DIR . "Candidatura.php";
    include_once MANAGER_DIR . "MessaggioManager.php";
    
    
    ## RECUPERO INFORMAZIONI SULL'UTENTE CONNESSO ##
    // session_start();
    // $utente = $_SESSION['utente'];
    //$_SESSION['lista']= serialize($lista-utenti);
    $utente_connesso = new Utente(0, 'Alfredo', 'Fiorillo', "38093", "Sal", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
    // if ($utente == null)
    //     header("location:./index.php");
    
    $id_candidatura = $_POST["id"];
    $idDestinatario = $_SESSION['destinatario'];
    ## MANAGER ##
    $manager_msg = new MessaggioManager();
    
    ## RECUPERO IL  DELLA CONVERSAZIONE ###
    $invio_candidatura = $manager_msg->setRifiutaCollaborazione($id_candidatura);  //[STUB getUtentebyID]
    $manager_msg->sendMessaggio(null, "[COLLABORAZIONE RIFIUTATA]", '', '', $utente_connesso->getId(), $idDestinatario);
   
    if($invio_candidatura){
       include_once CONTROL_DIR . "stampaCandidature.php";
    }