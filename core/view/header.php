<?php

   
    //session_start();
    //$utente = $_SESSION['utente'];
    
    //Per ora sto simulando un utente loggato
    $utente = new Utente(1, 'Simone', 'Giak', "38093", "Sal", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
    //$utente = null;
    if ($utente == null)
        include_once VIEW_DIR . 'headerNoLog.php';
    else include_once VIEW_DIR . 'headerLog.php';