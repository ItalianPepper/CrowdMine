<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once CONTROL_DIR . "Controller.php";
include_once MODEL_DIR . "Annuncio.php";

function getAnnunci($tipologia, $da, $a, $luogo) {
    $query = sprintf("SELECT * FROM `annuncio` WHERE `tipologia`=$tipologia AND `luogo`=$luogo AND `data`>'$da' AND `data`<'$a'");
    $res = Controller::getDB()->query($query);
    $annunci = array();
    if ($res) {
        while ($obj = $res->fetch_assoc()) {
            $annuncio = new Annuncio($obj['id'], $obj['titolo'], $obj['data'], $obj['descrizione'], $obj['luogo'], $obj['data_pubblicazione'], $obj['tipologia'], $obj['email_utente']);
            $annuncio->setId($obj['id']);
            $annunci[] = $annuncio;
        }
    }
    return $annunci;
}

function getUtenteByEmail($email) {
    $GET_UTENTE_EMAIL = "SELECT * FROM `utente` WHERE `e-mail` = '%s'";
    $query = sprintf($GET_UTENTE_EMAIL, $email);

    $res = Controller::getDB()->query($query);
    return parseUtente($res);
}

function parseUtente($res) {
    if ($obj = $res->fetch_assoc()) {
        return new Utente($obj['nome'], $obj['cognome'], $obj['telefono'], $obj['e-mail'], $obj['citta'], $obj['password'], $obj['descrizione'], $obj['immagine'], $obj['tipologia'], $obj['data'], $obj['id'], $obj['professione']);
    } else {
        throw new ApplicationException(ErrorUtils::$UTENTE_NON_TROVATO);
    }
}

$tipologia = $_GET['tipologia'];
$periodo = explode(" - ", $_GET['periodo']);
$da = str_replace('/', '-', $periodo[0]);
$at = explode("'", $da);
$da = $at[1];
$da = date("Y-m-d H:i:s", strtotime($da));

$a = str_replace('/', '-', $periodo[1]);
$to = explode("'", $a);
$a = $to[0];
$a = date("Y-m-d H:i:s", strtotime($a));
$luogo = $_GET['luogo'];
?>
<div class="box-body">
    <?php
    $allAnnunci = getAnnunci($tipologia, $da, $a, $luogo);
    if (count($allAnnunci) > 0) {
        foreach ($allAnnunci as $annuncio) {
            $utenteAnnuncio = getUtenteByEmail($annuncio->getEmail());
            $id = $utenteAnnuncio->getId();
            ?>
            <div class="box box-widget" style="border: 1px solid; border-radius: 10px; border-color: #1e9bd7;">
                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle" src="<?php echo $utenteAnnuncio->getImmagine(); ?>" alt="User Image">
                        <span class="username"><a href="<?php echo DOMINIO_SITO; ?>/profilo/<?php echo $id ?>"><?php echo $utenteAnnuncio->getNome(); ?> <?php echo $utenteAnnuncio->getCognome(); ?></a> <p><?php echo strtoupper($annuncio->getTitolo()); ?></p></span>
                        <span class="description">Data pubblicazione: <?php echo date("d/m/Y", strtotime($annuncio->getDataPubblicazione())); ?> - Data servizio: <?php echo date("d/m/Y", strtotime($annuncio->getData())); ?> - Luogo servizio: <?php echo $annuncio->getLuogo(); ?></span>
                    </div>
                </div>
                <div class="box-body">
                    <p><?php echo $annuncio->getDescrizione(); ?></p>
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <a href="<?php echo DOMINIO_SITO; ?>/profilo/<?php echo $id; ?>"><button type="button" class="btn btn-block btn-primary btn-sm">Sono interessato</button></a>
                    </div>
                    <span class="pull-left text-muted">Annuncio <?php echo $annuncio->getTipologia(); ?></span>
                </div>
            </div>
        <?php }
    }
    else echo "Nessun annuncio trovato";
    ?>
</div>