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
   $utente_connesso = new Utente(0, 'Alfredo', 'Fiorillo', "38093", "Sal", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
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
             
             <?php echo $utente_destinatario->getNome()."    "; ?>  
            
              
            
          </div>
          <div class="action"></div>
        </div>
        <ul class="chat">
     
            
 <?php  
 
    foreach ($lista_messaggio as $indice => $value) {
           
        if($lista_messaggio[$indice]->getIdUtenteDestinatario() == $utente_connesso->getId()){
            
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
  
            
   </ul>        
    <div class="footer">
          <div class="message-box">
            <textarea placeholder="type something..." id="messaggio" class="form-control"></textarea>
            <button class="btn btn-default" id="<?php echo $id_utente_destinatario; ?>" onclick="inviamessaggio(event)"><i class="fa fa-paper-plane" aria-hidden="true"></i><span>Send</span></button>
          </div>
            <div id="info">

            </div>
        
        <?php  
          
            //l'utente destinatario si candida ad un annuncio di Alfredo_ Alfredo quindi può Inviare la Collaborazione, Rifiutare il candidato
            $lista_candidature = $manager_msg->isCandidato($utente_connesso->getId(), $id_utente_destinatario);
            
         
   
        ?>
            <button type="button" class="btn btn-primary btn-xs" id="<?php echo $id_utente_destinatario; ?>">Invia collaborazione</button>
            <button type="button" class="btn btn-primary btn-xs" id="<?php echo $id_utente_destinatario; ?>">Accetta collaborazione</button>
            <button type="button" class="btn btn-primary btn-xs" id="<?php echo $id_utente_destinatario; ?>">Rifiuta collaborazione</button>
            <button type="button" class="btn btn-primary btn-xs" id="<?php echo $id_utente_destinatario; ?>">Elimina candidato</button>
    </div>
    
   