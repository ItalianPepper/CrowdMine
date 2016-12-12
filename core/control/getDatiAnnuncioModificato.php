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

    $titolo = null;
    $descrizione = null;
    $luogo = null;
    $retribuzione = null;
    $tipologia = null;
    $listaMicrocategorie = null;
    $stato = "revisione";

    //$utente = unserialize($_SESSION['utente']);
    //$idUtente = $utente->getId();
    $idUtente = "1";
    if(isset($_POST['titolo'])){
        $titolo = $_POST['titolo'];
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo titolo annuncio non settato";
        header("Location:" . DOMINIO_SITO . "/modificaAnnuncio");
        throw new IllegalArgumentException("Campo titolo annuncio non settato");
    }

    if (empty($titolo) || !preg_match(Patterns::$NAME_GENERIC, $titolo)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo titolo annuncio contiene caratteri speciali o è vuoto";
        header("Location:" . DOMINIO_SITO . "/modificaAnnuncio");
        throw new IllegalArgumentException("Campo titolo non corretto");
    }

    if(isset($_POST['descrizione'])){
        $descrizione = $_POST['descrizione'];
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo descrizione annuncio non settato";
        header("Location:" . DOMINIO_SITO . "/modificaAnnuncio");
        throw new IllegalArgumentException("Campo descrizione annuncio non settato");
    }

    if (empty($descrizione) || !preg_match(Patterns::$NAME_GENERIC, $descrizione)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo descrizione annuncio contiene caratteri speciali o è vuoto";
        header("Location:" . DOMINIO_SITO . "/modificaAnnuncio");
        throw new IllegalArgumentException("Campo descrizione non corretto");
    }

    if(isset($_POST['luogo'])){
        $luogo = $_POST['luogo'];
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo luogo annuncio non settato";
        header("Location:" . DOMINIO_SITO . "/modificaAnnuncio");
        throw new IllegalArgumentException("Campo luogo annuncio non settato");
    }

    if (empty($luogo) || !preg_match(Patterns::$NAME_GENERIC, $luogo)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo luogo annuncio contiene caratteri speciali o è vuoto";
        header("Location:" . DOMINIO_SITO . "/modificaAnnuncio");
        throw new IllegalArgumentException("Campo luogo non corretto");
    }

    if(isset($_POST['retribuzione'])){
        $retribuzione = $_POST['retribuzione'];
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo retribuzione annuncio non settato";
        header("Location:" . DOMINIO_SITO . "/modificaAnnuncio");
        throw new IllegalArgumentException("Campo retribuzione annuncio non settato");
    }

    if (empty($retribuzione) || !preg_match(Patterns::$REMUNERATION, $retribuzione)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo retribuzione annuncio contiene caratteri di testo o è vuoto";
        header("Location:" . DOMINIO_SITO . "/modificaAnnuncio");
        throw new IllegalArgumentException("Campo retribuzione non corretto");
    }

    if(isset($_POST['tipologia'])){
        $tipologia = $_POST['tipologia'];
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo tipologia annuncio non settato";
        header("Location:" . DOMINIO_SITO . "/modificaAnnuncio");
        throw new IllegalArgumentException("Campo tipologia annuncio non settato");
    }

    if (empty($tipologia) || !preg_match(Patterns::$NAME_GENERIC, $tipologia)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo tipologia annuncio contiene caratteri speciali o è vuoto";
        header("Location:" . DOMINIO_SITO . "/modificaAnnuncio");
        throw new IllegalArgumentException("Campo tipologia non corretto");
    }

    if(isset($_POST['microcategorie'])){
        //$listaMicrocategorie = $_POST['microcategorie']; //correggere con gli id delle microcategorie
        $listaMicrocategorie = ["1"];
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo microcategorie annuncio non settato";
        header("Location:" . DOMINIO_SITO . "/modificaAnnuncio");
        throw new IllegalArgumentException("Campo microcategorie annuncio non settato");
    }

    if (empty($listaMicrocategorie)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo listaMicrocategorie annuncio è vuoto";
        header("Location:" . DOMINIO_SITO . "/modificaAnnuncio");
        throw new IllegalArgumentException("Campo listaMicrocategorie non corretto");
    }

    $dataPubblicazione = new DateTime();
    $data = $dataPubblicazione->format("Y-m-d H:i:s");
    $managerAnnuncio = new AnnuncioManager();

    try{
        $managerAnnuncio->updateAnnuncio(15,$idUtente, $data, $titolo, $luogo, $listaMicrocategorie, $retribuzione, $tipologia, $descrizione);
        $_SESSION['toast-type'] = "success";
        $_SESSION['toast-message'] = "L'annuncio è in fase di lavorazione";
        header("Location:" . DOMINIO_SITO . "/annunciProprietari");
    } catch(ApplicationException $a){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Problemi con l'inserimento dell'annuncio";
    }

?>
