<?php
    
    include_once MODEL_DIR . "Utente.php";
    include_once MODEL_DIR . "Messaggio.php";
    include_once MODEL_DIR . "Candidatura.php";
   
    include_once MANAGER_DIR . "MessaggioManagerStub.php";
    include_once MANAGER_DIR . "UtenteManagerStub.php";
    
    ## RECUPERO INFORMAZIONI SULL'UTENTE CONNESSO ##
    // session_start();
    // $utente = $_SESSION['utente'];
    //$_SESSION['lista']= serialize($lista-utenti);
    $utente_connesso = new Utente(0, 'Alfredo', 'Fiorillo', "38093", "Sal", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
    // if ($utente == null)
    //     header("location:./index.php");
    
    $id_candidatura = $_POST["id"];
    
    ## MANAGER ##
    $manager_msg = new MessaggioManagerStub();
    $manager_utente = new UtenteManagerStub();
    
    ## RECUPERO IL  DELLA CONVERSAZIONE ###
    $invio_candidatura = $manager_msg->rifiutaCandidato($id_candidatura);  //[STUB getUtentebyID]
    if($invio_candidatura){
        echo '<div class="alert alert-success">'."\n";
        echo '<strong>Candidato rifiutato!</strong>. Candidatura#'.$id_candidatura;
        echo '</div>';
    }