<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 12/12/2016
 * Time: 09:45
 */

include_once MANAGER_DIR . 'AnnuncioManager.php';
include_once CONTROL_DIR . "ControlUtils.php";
include_once MODEL_DIR . "Utente.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";

    $annuncioManager = new AnnuncioManager();
    $userID = $user->getId();
    $titolo = null;
    $descrizione = null;
    $luogo = null;
    $retribuzione = null;
    $tipologia = null;
    $listaMicrocategorie = null;
    $arrayMicro = array();

    if (isset($_POST['titolo-annuncio'])) {
        $titolo = $_POST["titolo-annuncio"];
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo Titolo Annuncio non settato";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo Titolo Annuncio non settato");
    }
    if (isset($_POST['retribuzione-euro'])) {
        $retribuzione = $_POST["retribuzione-euro"];
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo retribuzione in euro non settato";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo retribuzione in euro non settato");
    }
    if (isset($_POST['descrizione'])) {
        $descrizione = $_POST["descrizione"];
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo descrizione  non settato";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo descrizione  non settato");
    }
    if (isset($_POST['luogo-annuncio'])) {
        $luogo = $_POST["luogo-annuncio"];
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo luogo annuncio non settato";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo luogo annuncio non settato");
    }
    if (isset($_POST['radio2'])) {
        $tipologia = $_POST["radio2"];
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo tipo di annuncio non settato";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo tipo di annuncio non settato");
    }
    if (isset($_POST['lista-Micro'])) {
        $listaMicrocategorie = json_decode($_POST["lista-Micro"], true);
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo microcategorie non settao";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo microcategorie non settao");
    }

    if (empty($titolo) || !preg_match(Patterns::$NAME_GENERIC, $titolo)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo  nome annuncio contiene caratteri speciali o è vuoto";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo name non corretto");
    }
    if (empty($descrizione) || !preg_match(Patterns::$NAME_GENERIC, $descrizione) || strlen($descrizione) > 300) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo descrizione annuncio contine carratteri spaciali o è vuoto o ha una lunghezza di più di 300 caratteri";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo descrizione non corretto");
    }
    if (empty($retribuzione) || floatval($retribuzione) == 0 || floatval($retribuzione) < 0) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo retribuzione non corretto deve essere un numero maggiore o uguale a zero";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo retribuzione non corretto");
    }

    if (empty($luogo) || !preg_match(Patterns::$NAME_GENERIC, $descrizione)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo vuoto o contiene caratteri speciali";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo vuoto o contiene caratteri speciali\"");
    }
    if (empty($tipologia)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo tipologia non settato";
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo tipologia non settato");
    }
    if (empty($listaMicrocategorie) || count($listaMicrocategorie) <= 0) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "L' annuncio deve contenere minimo una microcategoria ";
        header("Location:"  . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo lista micro non settato");
    }
    $data = date("Y-m-d H:i:s");
    for ($i = 0; $i < count($listaMicrocategorie); $i++) {
        array_push($arrayMicro, $listaMicrocategorie[$i]["idMicro"]);
    }

    try {
        $annuncioManager->createAnnuncio($userID,
            $data,
            $titolo,
            $luogo,
            $arrayMicro,
            $retribuzione,
            $tipologia,
            $descrizione);
        $_SESSION['toast-type'] = "success";
        $_SESSION['toast-message'] = "L'annuncio è in fase di lavorazione";
        header("Location:".DOMINIO_SITO."/ProfiloPersonale");

    } catch (ApplicationException $a) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Problemi con l'inserimento dell'annuncio";
        header("Location:". getReferer(DOMINIO_SITO));
    }

?>