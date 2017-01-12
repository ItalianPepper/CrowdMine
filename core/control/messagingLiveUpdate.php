<?php
/**
 * Created by PhpStorm.
 * User: LongSky
 * Date: 12/01/2017
 * Time: 17:06
 */

include_once MANAGER_DIR . "MessaggioManager.php";
include_once MANAGER_DIR . "UtenteManager.php";

$manager_msg = new MessaggioManager();
$manager_utente = new UtenteManager();

$id_utente_destinatario = $_SESSION['destinatario'];
$utente_destinatario = $manager_utente->findUtenteById($id_utente_destinatario);


    if(count($manager_msg->messaggiNonLetti($id_utente_destinatario,$user->getId()))!=0) {


        $lista_messaggio = $manager_msg->loadConversation($user->getId(), $id_utente_destinatario);
        $manager_msg->setMessaggiNonLetti($id_utente_destinatario, $user->getId());

//echo count($lista_messaggio);
        $conversationString = "";

        foreach ($lista_messaggio as $indice => $value) {

            if ($lista_messaggio[$indice]->getIdUtenteDestinatario() == $user->getId()) {

                echo '<li class="right">';
            } else
                echo '<li>';

            echo '<div class="message">' . $lista_messaggio[$indice]->getCorpo() . '</div>';
            echo '<div class="info">';
            echo '<div class="datetime">' . $lista_messaggio[$indice]->getData() . '</div>';
            //echo '<div class="status"><i class="fa fa-check" aria-hidden="true"></i> Read</div>';
            echo '</div>';
            echo '</li>';
        }
    }
    else
        echo "";

