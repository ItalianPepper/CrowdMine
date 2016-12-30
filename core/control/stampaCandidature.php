<?php


include_once MODEL_DIR . "Utente.php";
include_once MODEL_DIR . "Messaggio.php";
include_once MODEL_DIR . "Candidatura.php";

include_once MANAGER_DIR . "MessaggioManager.php";
include_once MANAGER_DIR . "UtenteManagerStub.php";

$id_destinatario = $_SESSION['destinatario'];

## RECUPERO INFORMAZIONI SULL'UTENTE CONNESSO ##
// session_start();
// $utente = $_SESSION['utente'];
//$_SESSION['lista']= serialize($lista-utenti);
$utente_connesso = new Utente(2, 'Alfredo', 'Fiorillo', "38093", "Sal", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine");
// if ($utente == null)
//     header("location:./index.php");
## MANAGER ##
$manager_msg = new MessaggioManager();
$manager_utente = new UtenteManagerStub();


if (isset($_GET['idcand'])) {
    if ($_GET["idcand"] == "") {
        $id_get = -2;
    } else
        $id_get = $_GET["idcand"];
} else
    $id_get = -3;


## CANDIDATURE ###
//L'utente destinatario Simone si è candidato ad due annunci di Alfredo; Alfredo quindi può Inviare la Collaborazione o Rifiutare il candidato [tutto relativo a quell'annuncio]
$lista_candidature = $manager_msg->isCandidato($utente_connesso->getId(), $id_destinatario);

if ($lista_candidature != null) {

    //SE ESISTE UNA CANDIDATURA CREALA: 
    foreach ($lista_candidature as $indice => $value) {
        $idcandidatura = $lista_candidature[$indice]->getId();
        $id_annuncio = $lista_candidature[$indice]->getIdAnnuncio();
        ?>
        <div class="media social-post">
            <div class="media-left">
                <div>-</div>
            </div>
            <div class="media-body">
                <div class="media-heading">
                    <h4 class="title">CANDIDATURA #<?php echo $idcandidatura; ?> <?php echo $id_get . "    "; ?>  si e' candidato all'annuncio <b><?php echo $id_annuncio; ?></h4>
                    <h5 class="timeing">20 mins ago</h5>
                </div>       
                <div class="media-content"> <?php echo $lista_candidature[$indice]->getCorpo(); ?>   </div>

                <div class="media-action">
                    <button class="btn btn-link" ><i class="fa fa-comments-o" id="<?php echo $idcandidatura; ?>" onclick="inviaCollaborazione(event)"></i>Invia Collaborazione</button>
                    <button class="btn btn-link" id="<?php echo $idcandidatura; ?>" onclick="rifiutaCandidato(event)" ><i class="fa fa-thumbs-o-up" id="<?php echo $idcandidatura; ?>" onclick="rifiutaCandidato(event)"></i>Rifiuta Candidato</button>
                    <button class="btn btn-link"><i class="fa fa-comments-o" id="<?php echo $idcandidatura; ?>" onclick=""></i>Vai all'annuncio</button>

                </div>
                <!--<li class="divider"></li> -->
            </div>
        </div>
        <hr style="border-top: 5px solid #eee;">

        <?php
    } //fine della prima candidatura

} //FINE DI TUTTE LE CANDIDATURE


?>      
