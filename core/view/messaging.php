<!DOCTYPE html>
<?php
   
    include_once VIEW_DIR . "headerOld2.php";
    include_once MODEL_DIR . "Utente.php";
    include_once MODEL_DIR . "Messaggio.php";
    include_once MANAGER_DIR . "MessaggioManagerStub.php";
   
    //include_once("MessaggioManager.php");
    //include_once("control_Messaggi.php");
   
    //session_start();
    //$utente = $_SESSION['utente'];
    
    // if ($utente == null)
    //     header("location:./index.php");

    //$destinatari = new MessaggioManager();
    //$lista_destinatari = $ga->lista_destinatari(); //array di utenti
    $lista_destinatari[0] = new Utente(1, 'Simone', 'Giak', "38093", "Sal", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
    $lista_destinatari[1] = new Utente(2, 'Giancarlo', 'Mannara', "38093", "Rom", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
    $lista_destinatari[2] = new Utente(3, 'Luca', 'PM', "38093", "Rom", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
    $lista_destinatari[3] = new Utente(4, 'Fabiano', 'Pecorelli', "38093", "Rom", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
      
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
        var params = "id=" +id;
       
        httpRequest.open("POST", "<?php echo DOMINIO_SITO."/stampaConversazione?id="; ?>"  + id,true);  
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
        httpRequest.send(params);
    }
    
    function inviamessaggio(event)
    {  
       
        var httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange=function()
          {
            if((httpRequest.readyState === XMLHttpRequest.DONE) && (httpRequest.status === 200))
            {   
                document.getElementById('info').innerHTML = httpRequest.responseText;
            }//else  alert("error: " + httpRequest.readyState + "STATUS: " + httpRequest.status);  
          };
        
       
        //var modulo = new FormData(document.getElementById('myForm'));
        var id = event.target.id;
        var params = "id="+id;
        httpRequest.open("POST", "<?php echo DOMINIO_SITO."/inviaMessaggio?id="; ?>"  + id,true);  
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
        httpRequest.send(params);
    }
    
    function inviaCollaborazione(event)
    {  
       
        var httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange=function()
          {
            if((httpRequest.readyState === XMLHttpRequest.DONE) && (httpRequest.status === 200))
            {   
                document.getElementById('info').innerHTML = httpRequest.responseText;
            }//else  alert("error: " + httpRequest.readyState + "STATUS: " + httpRequest.status);  
          };
        
       
        //var modulo = new FormData(document.getElementById('myForm'));
        var id = event.target.id;
        var params = "id="+id; //id candidatura
        httpRequest.open("POST", "<?php echo DOMINIO_SITO."/inviaCollaborazione?id="; ?>"  + id,true);  
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
        httpRequest.send(params);
    }
    
     
    function rifiutaCandidato(event)
    {  
       
        var httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange=function()
          {
            if((httpRequest.readyState === XMLHttpRequest.DONE) && (httpRequest.status === 200))
            {   
                document.getElementById('info').innerHTML = httpRequest.responseText;
            }//else  alert("error: " + httpRequest.readyState + "STATUS: " + httpRequest.status);  
          };
        
       
        //var modulo = new FormData(document.getElementById('myForm'));
        var id = event.target.id;
        var params = "id="+id; //id candidatura
        httpRequest.open("POST", "<?php echo DOMINIO_SITO."/rifiutaCandidato?id="; ?>"  + id,true);  
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
        httpRequest.send(params);
    }
    
    function rifiutaCollaborazione(event)
    {  
       
        var httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange=function()
          {
            if((httpRequest.readyState === XMLHttpRequest.DONE) && (httpRequest.status === 200))
            {   
                document.getElementById('info').innerHTML = httpRequest.responseText;
            }//else  alert("error: " + httpRequest.readyState + "STATUS: " + httpRequest.status);  
          };
        
       
        //var modulo = new FormData(document.getElementById('myForm'));
        var id = event.target.id;
        var params = "id="+id; //id candidatura
        httpRequest.open("POST", "<?php echo DOMINIO_SITO."/accettaCollaborazione?id="; ?>"  + id,true);  
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
        httpRequest.send(params);
    }
    
    
</script>

<!-- MESSAGGI --> 
  <div class="app-messaging-container">
    <div class="app-messaging" id="collapseMessaging">
      <div class="chat-group">
        <div class="heading">Converstion</div>
        <ul class="group full-height">
          
          <li class="section">unread</li>
                   
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
          
            
        
        </ul>
      </div>
      <div class="messaging" id="ris">
       
       
      </div>
       
    </div>
  </div>
</div>
</div>
 
  <script type="text/javascript" src="<?php echo STYLE_DIR ?>/assets/js/vendor.js"></script>
  <script type="text/javascript" src="<?php echo STYLE_DIR ?>/assets/js/app.js"></script>

 
</body>
</html>