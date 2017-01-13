<!DOCTYPE html>
<?php
   
    include_once VIEW_DIR . 'header.php';
    include_once MODEL_DIR . "Utente.php";
    
    //include_once("Messaggio.php");
    //include_once("MessaggioManager.php");
    //include_once("control_Messaggi.php");
   
    // session_start();
   
    // $utente = $_SESSION['utente'];
    
    // if ($utente == null)
    //     header("location:./index.php");

    // $destinatari = new MessaggioManager();
    //$lista_destinatari = $ga->lista_destinatari(); //array di utenti
      
?>

<script type="text/javascript">
    
    function stampa(event)
    {
        var httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange=function()
          {
            if((httpRequest.readyState === XMLHttpRequest.DONE) && (httpRequest.status === 200))
            {
                document.getElementById('ris').innerHTML = httpRequest.responseText;
            }//else  alert("error: " + httpRequest.readyState + "STATUS: " + httpRequest.status);  
          };
        
        //var modulo = new FormData(document.getElementById('myForm'));
        var id = event.target.id;
        httpRequest.open("GET", "<?php echo DOMINIO_SITO."/stampaConversazione?id="; ?>"  + id,true);
        
        alert("<?php echo DOMINIO_SITO."/stampaConversazione?id="; ?>"  + id);  
        httpRequest.send(null);
    }
    
</script>

  <div class="app-messaging-container">
    <div class="app-messaging" id="collapseMessaging">
      <div class="chat-group">
        
        <div class="heading">Converstion</div>
        
        <ul class="group full-height">
        
            
        <!-- LISTA DESTINATARI -->
        <?php
            foreach($lista_destinatari as $indice => $elemento  ){
                $id = $lista_destinatari[$indice]->getId();
                echo '<li class="message">'."\n";
                echo  '<a data-toggle="collapse" href="#collapseMessaging" aria-expanded="false" aria-controls="collapseMessaging">'."\n";
                echo  '<span class="badge badge-warning pull-right">1</span>'."\n";
                echo  '<div class="message">'."\n";
                echo  '<img class="profile" src="https://placehold.it/100x100">'."\n";
                echo  '<div class="content">'."\n";
                echo  '<div class="title"'.' id="'.$id.'"'.' onclick="stampa(event)">'.$lista_destinatari[$indice]->getNome()." ".$lista_destinatari[$indice]->getCognome().'</div>'."\n";
                echo  '</div>'."\n";
                echo  '</div>'."\n";
                echo  '</a>'."\n";
                echo  '</li>'."\n";
            }  
        ?> 
     
      </div>
      
      <!-- CONVERSAZIONE -->  
      <div class="messaging">
        <div class="heading">
          <div class="title">
            <a class="btn-back" data-toggle="collapse" href="#collapseMessaging" aria-expanded="false" aria-controls="collapseMessaging">
              <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
              
              <!-- NOME DESTINATARIO -->
              <!--Lucia  Marshall <span class="badge badge-success badge-icon"><i class="fa fa-circle" aria-hidden="true"></i><span>Online</span></span> -->
          
          </div>
          <div class="action"></div>
        </div>
        
        <!-- INIZIO CHAT -->   
        <ul class="chat" id="ris">
            
        </ul>
        <div class="footer">
          <div class="message-box">
            <textarea placeholder="type something..." class="form-control"></textarea>
            <button class="btn btn-default"><i class="fa fa-paper-plane" aria-hidden="true"></i><span>Send</span></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript" src="<?php echo DOMINIO_SITO;?>/assets/js/vendor.js"></script>
<script type="text/javascript" src="<?php echo DOMINIO_SITO;?>/assets/js/app.js"></script>

  
  


