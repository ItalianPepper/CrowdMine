<?php


include_once MODEL_DIR . "Utente.php";
include_once MODEL_DIR . "Messaggio.php";
include_once MODEL_DIR . "Candidatura.php";
include_once MANAGER_DIR . "MessaggioManager.php";
include_once MANAGER_DIR . "UtenteManager.php";

$id_destinatario = $_SESSION['destinatario'];

function getCand($arg_1)
{   
    
    //if($arg_1 == "Candidato rifiutato") return 3;
    switch ($arg_1) {
        
        case 0:
            return "Candidatura inviata";
            break;
        
        case 1:
            return "Inviata Collaborazione";
            break;
        
        case 2:
            return "Candidatura rifiutata";
            break;
        
        case 3:
            return "Collaborazione accettata";
            break;
        
        case 4:
            return "Collaborazione rifiutata";
            break;
        
        default:
            break;
    }
    
    return 0;
}


function getColor($arg_1)
{   
    
    //if($arg_1 == "Candidato rifiutato") return 3;
    switch ($arg_1) {
        
        case 0:
            return "#000000"; //NERO per la candidatura inviata
            break;
        
        case 1:
            return "#d6c811"; //ARANCIONE per l'invio della collaborazione
            break;
        
        case 2:
            return "#f32323"; //ROSSO per candidatura rifiutata
            break;
        
        case 3:
            return "#49ce42"; //VERDE collaborazione accettata
            break;
        
        case 4:
            return "#ff3d3d"; //ROSSO collaborazione rifiutata
            break;
        
        default:
            break;
    }
    
    return 0;
}

## RECUPERO INFORMAZIONI SULL'UTENTE CONNESSO ##
// session_start();
// $utente = $_SESSION['utente'];
//$_SESSION['lista']= serialize($lista-utenti);
$utente_connesso = new Utente(2, 'Alfredo', 'Fiorillo', "38093", "Sal", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine");
// if ($utente == null)
//     header("location:./index.php");
## MANAGER ##
$manager_msg = new MessaggioManager();
$manager_utente = new UtenteManager();


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
$utente = $manager_utente->findUtenteById($id_destinatario);

        
        
if ($lista_candidature != null) {

    //SE ESISTE UNA CANDIDATURA CREALA: 
    foreach ($lista_candidature as $indice => $value) {
        $idcandidatura = $lista_candidature[$indice]->getId();
        $id_annuncio = $lista_candidature[$indice]->getIdAnnuncio();
        $stato = $manager_msg->getStatoCandidatura($idcandidatura);
        ?>
        <div class="media social-post">
            <div class="media-left">
                <div>-</div>
            </div>
            <div class="media-body">
                <div class="media-heading">
                    <h4 class="title"> <?php echo $utente->getNome() . "    "; ?>  si e' candidato al tuo annuncio <b><?php echo $id_annuncio; ?></h4>
                    <h5 class="timeing" style="color: <?php echo getColor($stato); ?>;font-size: small; opacity: 100"><?php echo "Stato: ".getCand($stato); ?> </h5>
                </div>       
                <div class="media-content" style="font-size: small;  font-weight: 100"> <?php echo $lista_candidature[$indice]->getCorpo(); ?>   </div>

                <div class="media-action">
                    <button class="btn btn-link" id="<?php echo $idcandidatura; ?>" onclick="inviaCollaborazione(event)" ><i class="fa fa-thumbs-o-up" id="<?php echo $idcandidatura; ?>" onclick="rifiutaCandidato(event)"></i>Invia Collaborazione</button>
                    <button class="btn btn-link" id="<?php echo $idcandidatura; ?>" onclick="rifiutaCandidato(event)" <?php echo $idcandidatura; ?>   <?php if($stato==3) echo ""; ?> ></i>Rifiuta Candidato</button>
                    <button class="btn btn-link"><i class="fa fa-comments-o" id="<?php echo $idcandidatura; ?>" onclick=""></i>Vai all'annuncio</button>

                </div>
                <!--<li class="divider"></li> -->
            </div>
        </div>
        <hr style="border-top: 5px solid #eee;">

        <?php
    } //fine della prima candidatura

} //FINE DI TUTTE LE CANDIDATURE



#CANDIDATURE DI CUI TI HANNO INVIATO LA COLLABORAZIONE
$lista_candidature = $manager_msg->isCandidato($id_destinatario, $utente_connesso->getId());

if ($lista_candidature != null) {

    //SE ESISTE UNA CANDIDATURA CREALA: 
    foreach ($lista_candidature as $indice => $value) {
        $idcandidatura = $lista_candidature[$indice]->getId();
        $id_annuncio = $lista_candidature[$indice]->getIdAnnuncio();
        $stato = $manager_msg->getStatoCandidatura($idcandidatura);
        ?>
        <div class="media social-post">
            <div class="media-left">
                <div>-</div>
            </div>
            <div class="media-body">
                <div class="media-heading">
                    <h4 class="title">Ti sei candidato all'annuncio di <?php echo $utente->getNome() . "    "; ?> <b><?php echo $id_annuncio; ?></h4>
                    <h5 class="timeing" style="color: <?php echo getColor($stato); ?>;font-size: small; opacity: 100"><?php echo "Stato: ".getCand($stato); ?></h5>
                </div>       
                <div class="media-content" style="font-size: small;  font-weight: 100"> <?php echo $lista_candidature[$indice]->getCorpo(); ?>   </div>

                <div class="media-action">
                    <!-- #CANDIDATURE DI CUI TI HANNO INVIATO LA COLLABORAZIONE -->
                    <button class="btn btn-link" id="<?php echo $idcandidatura; ?>" onclick="accettaCollaborazione(event)" ><i class="fa fa-thumbs-o-up" id="<?php echo $idcandidatura; ?>" onclick="rifiutaCandidato(event)"></i>Accetta Collaborazione</button>
                    <button class="btn btn-link" id="<?php echo $idcandidatura; ?>" onclick="rifiutaCollaborazione(event)" <?php echo $idcandidatura; ?>   <?php if($stato==3) echo ""; ?> ></i>Rifiuta Collaborazione</button>
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