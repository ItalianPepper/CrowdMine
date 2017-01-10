<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 12/12/2016
 * Time: 16:51
 */
include_once MANAGER_DIR . 'AnnuncioManager.php';
include_once CONTROL_DIR . "ControlUtils.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";
if(isset($_POST["annuncio"])) {

    $idAnnuncio = testInput($_POST["annuncio"]);
    $titolo = null;
    $descrizione = null;
    $luogo = null;
    $retribuzione = null;
    $tipologia = null;
    $listaMicrocategorie = null;
    $arrayMicro = array();

    $idUtente = $user->getId();

    if (isset($_POST['titolo-annuncio'])) {
        $titolo = testInput($_POST['titolo-annuncio']);
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo titolo annuncio non settato";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo titolo annuncio non settato");
    }

    if (empty($titolo) || !preg_match(Patterns::$NAME_GENERIC, $titolo)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo titolo annuncio contiene caratteri speciali o è vuoto";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo titolo non corretto");
    }

    if (isset($_POST['descrizione'])) {
        $descrizione = testInput($_POST['descrizione']);
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo descrizione annuncio non settato";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo descrizione annuncio non settato");
    }

    if (empty($descrizione)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo descrizione annuncio contiene caratteri speciali o è vuoto";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo descrizione non corretto");
    }

    if (isset($_POST['luogo-annuncio'])) {
        $luogo = testInput($_POST['luogo-annuncio']);
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo luogo annuncio non settato";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo luogo annuncio non settato");
    }

    if (empty($luogo) || !preg_match(Patterns::$NAME_GENERIC, $luogo)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo luogo annuncio contiene caratteri speciali o è vuoto";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo luogo non corretto");
    }

    if (isset($_POST['retribuzione-euro'])) {
        $retribuzione = testInput($_POST['retribuzione-euro']);
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo retribuzione annuncio non settato";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo retribuzione annuncio non settato");
    }

    if (empty($retribuzione) && intval($retribuzione) != 0 && $retribuzione < 0) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo retribuzione non corretto deve essere un numero maggiore o uguale a zero";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo retribuzione non corretto");
    }

    if (isset($_POST['radio2'])) {
        $tipologia = testInput($_POST['radio2']);
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo tipologia annuncio non settato";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo tipologia annuncio non settato");
    }

    if (empty($tipologia) || !preg_match(Patterns::$NAME_GENERIC, $tipologia)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo tipologia annuncio contiene caratteri speciali o è vuoto";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo tipologia non corretto");
    }

    if (isset($_POST['lista-Micro'])) {
        $listaMicrocategorie = json_decode($_POST["lista-Micro"], true);
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo microcategorie annuncio non settato";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo microcategorie annuncio non settato");
    }

    if (empty($listaMicrocategorie) || count($listaMicrocategorie) <= 0) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "L' annuncio deve contenere minimo una microcategoria ";
        header("Location:"  . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo lista micro non settato");
    }

    for ($i = 0; $i < count($listaMicrocategorie); $i++) {
        array_push($arrayMicro, $listaMicrocategorie[$i]["idMicro"]);
    }

    $dataPubblicazione = new DateTime();
    $data = $dataPubblicazione->format("Y-m-d H:i:s");
    $managerAnnuncio = new AnnuncioManager();

    try {
        $managerAnnuncio->updateAnnuncio($idAnnuncio, $idUtente, $data, $titolo, $luogo, $retribuzione, $tipologia, $descrizione, $arrayMicro);
        $_SESSION['toast-type'] = "success";
        $_SESSION['toast-message'] = "L'annuncio è in fase di lavorazione";
        header("Location:" . DOMINIO_SITO."/ProfiloPersonale#tab3");
        exit();
    } catch (ApplicationException $a) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Problemi con l'inserimento dell'annuncio";
    }
}

$_SESSION['toast-type'] = "error";
$_SESSION['toast-message'] = "Problemi con l'inserimento dell'annuncio";
header("Location:" . DOMINIO_SITO . "/ProfiloPersonale#tab3");

?>
