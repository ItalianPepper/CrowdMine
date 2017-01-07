<?php
    include_once MODEL_DIR . "Utente.php";
    include_once MODEL_DIR . "Messaggio.php";
    include_once MANAGER_DIR . "MessaggioManager.php";
    include_once MANAGER_DIR . "UtenteManager.php";


    ## MANAGER ##
    $manager_msg = new MessaggioManager();
    $manager_msg_stub = new MessaggioManager();

    $manager_utente = new UtenteManager();

    ## RECUPERO IL DESTINATARIO DELLA CONVERSAZIONE ###
    $id_utente_destinatario = $_POST["id"];
    $_SESSION['destinatario'] = $id_utente_destinatario;
   
    $utente_destinatario = $manager_utente->findUtenteById($id_utente_destinatario);  //[STUB getUtentebyID]
    ## RECUPERA LA CONVERSAZIONE CON IL DESTINATARIO ##
    $lista_messaggio = $manager_msg->loadConversation($user->getId(), $id_utente_destinatario);

    $manager_msg->setMessaggiNonLetti($id_utente_destinatario, $user->getId());    
?>    

<!-- INTESTAZIONE DEL MESSAGGIO -->
<div class="heading">
    <div class="title">
        <a class="btn-back" data-toggle="collapse" href="#collapseMessaging" aria-expanded="false" aria-controls="collapseMessaging">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </a>

        <?php echo $utente_destinatario->getNome() . "    "; ?>  
        
         <?php
        ## CANDIDATURE ###
        //L'utente destinatario Simone si è candidato ad due annunci di Alfredo; Alfredo quindi può Inviare la Collaborazione o Rifiutare il candidato [tutto relativo a quell'annuncio]
        $lista_candidature = $manager_msg->isCandidato($user->getId(), $id_utente_destinatario);
        if ($lista_candidature != null) {
            ?>        
                 <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal" style="margin-left: 20px">Gestione candidature</button>
            <?php
        }
        ?>


    </div>
     
    <div class="action"></div>
    </div>
    <ul class="chat" id="messaggi_inviati">


        <?php
            foreach ($lista_messaggio as $indice => $value) {

                if ($lista_messaggio[$indice]->getIdUtenteDestinatario() == $user->getId()) {

                    echo '<li class="right">';
                } else
                    echo '<li>';

                echo '<div class="message">' . $lista_messaggio[$indice]->getCorpo() . '</div>';
                echo '<div class="info">';
                echo '<div class="datetime">' . $lista_messaggio[$indice]->getData(). '</div>';
                //echo '<div class="status"><i class="fa fa-check" aria-hidden="true"></i> Read</div>';
                echo '</div>';
                echo '</li>';
            }
        ?>
        

    </ul>        
    <div class="footer">
        <div class="message-box">
            <textarea placeholder="Scrivi un messaggio..." id="area" class="form-control"></textarea>
            <button class="btn btn-default" id="<?php echo $id_utente_destinatario; ?>" onclick="inviamessaggio(event)"><i class="fa fa-paper-plane" aria-hidden="true"></i><span>INVIA</span></button>
        </div>
        <div id="info">

        </div>
    </div>

    <!-- MODAL PER LA GESTIONE CANDIDATURE -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding: 10px">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">CANDIDATURE: </h4>
                    </div>
                    <div class="modal-body">

                        <div class="card-body" id="ciao">

                              <?php
                                 include_once CONTROL_DIR . "stampaCandidature.php";
                               ?>

                        </div> <!-- fine body modal -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                    </div>
                </div>

            </div>
        </div>   