<?php
    

    include_once MODEL_DIR . "Utente.php";
    include_once MODEL_DIR . "Messaggio.php";
    //include_once("MessaggioManager.php");
    //include_once("control_Messaggi.php");
   
   // session_start();
   
   // $utente = $_SESSION['utente'];
    //$_SESSION['lista']= serialize($lista-utenti);
   $utente_connesso = new Utente(0, 'Alfredo', 'Fiorillo', "38093", "Sal", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
    
   // if ($utente == null)
   //     header("location:./index.php");

    //$destinatari = new MessaggioManager();
    //$lista_destinatari = $ga->lista_destinatari(); //array di utenti
    
    ####### RECUPERA IL DESTINTARIO ###########
    $id_utente_destinatario = $_GET['id'];
    //ricerca utente con ID id_utente usando il manager dell'utente
    $utente_destintario = null;
    if($id_utente_destinatario==1)
        $utente_destintario = new Utente(1, 'Simone', 'Giak', "38093", "Sal", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
    else if($id_utente_destinatario==2)
        $utente_destintario = new Utente(2, 'Giancarlo', 'Mannara', "38093", "Rom", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
    else if($id_utente_destinatario==3)
        $utente_destintario = new Utente(3, 'Luca', 'PM', "38093", "Rom", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
    else if($id_utente_destinatario==4)
        $utente_destintario = new Utente(4, 'Fabiano', 'Pecorelli', "38093", "Rom", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
    
    ####### RECUPERA LA CONVERSAZIONE CON QUEL DESTINATARIO ###########
    //recupera conversazione usando il manager di messaggi [ARRAY di MESSAGGI]
    if($id_utente_destinatario==1){
        $lista_messaggio[0] = new Messaggio(0, $utente_connesso->getId(), $utente_destintario->getId(), "Ciao Simone", "16/04/2007", false );
        $lista_messaggio[1] = new Messaggio(0, $utente_destintario->getId(), $utente_connesso->getId(), "Ciao Alfredo", "16/04/2007", false );
        $lista_messaggio[2] = new Messaggio(0, $utente_connesso->getId(), $utente_destintario->getId(), "Voglio lavorare per te", "16/04/2007", false );
    
        
    }else if($id_utente_destinatario==2){
        $lista_messaggio[0] = new Messaggio(0, $utente_destintario->getId(), $utente_connesso->getId(), "Ciao Alfredo", "16/04/2007", false );
        $lista_messaggio[1] = new Messaggio(0, $utente_destintario->getId(), $utente_connesso->getId(), "Io e te non abbiamo niente da dirci", "16/04/2007", false );
         
    }else if($id_utente_destinatario==3){
        $lista_messaggio[0] = new Messaggio(0, $utente_connesso->getId(), $utente_destintario->getId(), "Ciao Luca", "16/04/2007", false );
        $lista_messaggio[1] = new Messaggio(0, $utente_destintario->getId(), $utente_connesso->getId(), "Ciao Alfredo", "16/04/2007", false );
        $lista_messaggio[2] = new Messaggio(0, $utente_connesso->getId(), $utente_destintario->getId(), "Voglio dirti una cosa:", "16/04/2007", false );
        $lista_messaggio[3] = new Messaggio(0, $utente_connesso->getId(), $utente_destintario->getId(), "Non vedo l'ora di chiamarti Dottore.", "16/04/2007", false );
        $lista_messaggio[4] = new Messaggio(0, $utente_connesso->getId(), $utente_destintario->getId(), "Ok?", "16/04/2007", false );
        $lista_messaggio[5] = new Messaggio(0, $utente_destintario->getId(), $utente_connesso->getId(), "Sei Idiota?", "16/04/2007", false );
    
    }else if($id_utente_destinatario==4){
        $lista_messaggio[0] = new Messaggio(0, $utente_destintario->getId(), $utente_connesso->getId(), "Ciao Alfredo", "16/04/2007", false );
        $lista_messaggio[1] = new Messaggio(0, $utente_connesso->getId(), $utente_destintario->getId(), "Ciao Fabiano", "16/04/2007", false );
        $lista_messaggio[2] = new Messaggio(0, $utente_destintario->getId(), $utente_connesso->getId(), "Come hai detto scusa?", "16/04/2007", false );
        $lista_messaggio[3] = new Messaggio(0, $utente_connesso->getId(), $utente_destintario->getId(),  "Cosa?", "16/04/2007", false );
        $lista_messaggio[4] = new Messaggio(0, $utente_destintario->getId(), $utente_connesso->getId(), "Vaffanculo, scriverò sulla minuta che mi hai insultato.", "16/04/2007", false );   
    }
    
    foreach ($lista_messaggio as $indice => $value) {
        
        if($lista_messaggio[$indice]->getIdUtenteMittente() == $utente_connesso->getId()){
            echo '<li class="right">';
        }else echo '<li>';
        
        echo '<div class="message">'.$lista_messaggio[$indice]->getCorpo().'</div>';
        echo '<div class="info">';
        echo '<div class="datetime">11.45pm</div>';
        echo '<div class="status"><i class="fa fa-check" aria-hidden="true"></i> Read</div>';
        echo '</div>';
        echo '</li>';

    }
    
?>


