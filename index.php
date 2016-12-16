<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 08:58
 */
define('ROOT_DIR', dirname(__FILE__)); //costante root dir
define('DOMINIO_SITO', "/CrowdMine"); //costante root dir
define('CORE_DIR', ROOT_DIR . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR); //costante core directory
define('VIEW_DIR', CORE_DIR . "view" . DIRECTORY_SEPARATOR); //ecc
define('TEMPLATE_DIR', CORE_DIR . "template" . DIRECTORY_SEPARATOR); //ecc
define('EXCEPTION_DIR', CORE_DIR . "exception" . DIRECTORY_SEPARATOR);
define('MODEL_DIR', CORE_DIR . "model" . DIRECTORY_SEPARATOR);
define('MANAGER_DIR', CORE_DIR . "manager" . DIRECTORY_SEPARATOR);
define('CONTROL_DIR', CORE_DIR . "control" . DIRECTORY_SEPARATOR);
define('UPLOADS_DIR', DOMINIO_SITO . "/uploads/");
define('STYLE_DIR', DOMINIO_SITO . DIRECTORY_SEPARATOR . "style" . DIRECTORY_SEPARATOR);
define('UTILS_DIR', CORE_DIR . "utils" . DIRECTORY_SEPARATOR);
define('ATTIVO',"attivo");
define('SEGNALATO',"segnalato");
define('ELIMINATO',"eliminato");
define('AMMINISTRATORE',"amministratore");
define('DEBUG', true);

try {
    if (DEBUG == true) {
        ini_set("max_execution_time", '30');
        ini_set('display_errors', 'on');
        error_reporting(E_ALL);
    } else {
        ini_set('display_errors', 'off');
    }

    /*
     * URL Parsing, in pratica qualsiasi richiesta al sito arriva a questo file,
     * e quindi possiamo ricavare la richiesta da $_SERVER['SCRIPT_NAME']
     *
     * Successivamente rimuovo tutto ciò che non dovrebbe stare nella richiesta e faccio split
     *
     */
    $_URL = preg_replace("/^(.*?)index.php$/", "$1", $_SERVER['SCRIPT_NAME']);
    $_URL = preg_replace("/^" . preg_quote($_URL, "/") . "/", "", urldecode($_SERVER['REQUEST_URI']));
    $_URL = preg_replace("/(\/?)(\?.*)?$/", "", $_URL);
    $_URL = explode("/", $_URL);
    if (preg_match("/^index.(?:html|php)$/i", $_URL[count($_URL) - 1]))
        unset($_URL[count($_URL) - 1]);
    // definisco costante IP contenente l'ip del client
    if (isset($_SERVER['HTTP_X_REAL_IP'])) {
        define('IP', $_SERVER['HTTP_X_REAL_IP']);
    } else {
        define('IP', $_SERVER['REMOTE_ADDR']);
    }
    session_start(); //facciamo partire la sessione

    include_once UTILS_DIR . "Patterns.php";
    include_once UTILS_DIR . "ErrorUtils.php";
    include_once UTILS_DIR . "StringUtils.php";
    include_once EXCEPTION_DIR . "ApplicationException.php";

    if (!defined("TESTING")) {
        switch (isset($_URL[0]) ? $_URL[0] : '') {
            case '':
                include_once VIEW_DIR . "home.php";
                break;
            case 'template':
                header("location: http://crowdmine.altervista.org/dist/html/");
                break;
            case 'visitaProfiloUtente':
                include_once VIEW_DIR . "visitaProfiloUtente.php";
                break;
            case 'visitaProfiloPersonale':
                include_once VIEW_DIR . "visitaProfiloPersonale.php";
                break;
            case 'visualizzaStatisticheMacroCategorie':
                include_once VIEW_DIR . "visualizzaStatisticheMacroCategorie.php";
                break;
            case 'classificaMiglioriUtenti':
                include_once VIEW_DIR . "classificaMiglioriUtenti.php";
                break;
            case 'classificaMiglioriSocieta':
                include_once VIEW_DIR . "classificaMiglioriSocieta.php";
                break;
            case 'annuncioModeratore':
                include_once VIEW_DIR . "annuncioModeratore.php";
                break;
            case 'statisticheAvanzateAdmin':
                include_once VIEW_DIR ."statisticheAvanzateAdmin.php";
                break;
            case 'paginaStatistiche':
                include_once VIEW_DIR . "paginaStatistiche.php";
                break;
            case 'conversazionePrivata':
                include_once VIEW_DIR . "conversazionePrivata.php";
                break;
            case 'footer':
                include_once VIEW_DIR . "footer.php";
                break;
            
            case 'inserisciEsperienza':
                StringUtils::checkPermission("Cliente");
                include_once VIEW_DIR . "inserisciEsperienza.php";
                break;
//          case 'standard':
//                include_once "standard.html";
//                break;
            case 'ricercaAnnuncio':
                StringUtils::checkPermission("all");
                include_once VIEW_DIR . "ricercaAnnuncio.php";
                break;
            case 'profilo':
                StringUtils::checkPermission("all");
                include_once VIEW_DIR . "profilo.php";
                break;
            case 'auth':
                StringUtils::checkPermission("not_logged");
                include_once VIEW_DIR . "login-registrazione.php";
                break;
            case 'register':
                StringUtils::checkPermission("not_logged");
                include_once VIEW_DIR . "login-registrazione.php";
                break;
            case 'effettuaRegistrazione':
                StringUtils::checkPermission("not_logged");
                include_once CONTROL_DIR . "RegisterCM.php";
                break;
            case 'inserimentoEsperienza':
                StringUtils::checkPermission("all");
                include_once CONTROL_DIR . "InserisciEsperienza.php";
                break;
            case 'effettuaLogin':
                StringUtils::checkPermission("not_logged");
				include_once CONTROL_DIR . "LoginCM.php";
                break;
            case 'logout':
                StringUtils::checkPermission("all");
                include_once CONTROL_DIR . "Logout.php";
                break;
            case 'livesearch':
                include_once CONTROL_DIR . "SearchController.php";
                break;
            case 'cercaUtente':
                include_once CONTROL_DIR . "UtenteFinder.php";
                break;
            case 'segnalaUtente':
                include_once CONTROL_DIR . "SegnalaUtente.php";
                break;
            case 'feedbackListRetrive':
            	include_once CONTROL_DIR . "feedbackListRetrive.php";
            	break;
            case 'cancellaAccount':
                include_once CONTROL_DIR . "CancellazioneUtente.php";
                break;
            case 'riattivaUtente':
                include_once CONTROL_DIR . "RiattivaUtente.php";
                break;
            case 'banUtente':
                include_once CONTROL_DIR . "BanUtente.php";
                break;
            case 'visualizzaProfiloPersonale':
                include_once CONTROL_DIR . "VisualizzaProfiloPersonaleControl.php";
                break;
            case 'cercaAnnunci':
                StringUtils::checkPermission("all");
                include_once CONTROL_DIR . "CercaAnnunci.php";
                break;
            case 'inserisciFeedback':
                include_once CONTROL_DIR . "inserisciFeedbackControl.php";
                break;
            case 'modificaPassword':
                include_once CONTROL_DIR . "CambiaPasswordControl.php";
                break;
            case 'ConfermaSegnalazioneUtenteControl':
                include_once MODEL_DIR . "Utente.php";
                //StringUtils::checkPermission(RuoloUtente::MODERATORE);
                include_once CONTROL_DIR . "ConfermaSegnalazioneUtenteControl.php";
                break;
            case 'paginaPrincipaleModeratore':
                include_once VIEW_DIR . "paginaPrincipaleModeratore.php";
                break;
            case 'visualizzaAnnunciSegnalati':
                include_once VIEW_DIR . "visualizzaAnnunciSegnalati.php";
                break;
            case 'visualizzaFeedbackSegnalati':
                include_once VIEW_DIR . "visualizzaFeedbackSegnalati.php";
                break;
            case 'visualizzaIndexMacrocategorie':
                include_once VIEW_DIR . "visualizzaIndexMacrocategorie.php";
                break;
            case 'indexMacrocategorie':
                include_once MODEL_DIR . "Utente.php";
                //StringUtils::checkPermission(RuoloUtente::MODERATORE);
                include_once CONTROL_DIR . "IndexMacrocategorieControl.php";
                break;
            case 'visualizzaIndexMicrocategorie':
                include_once VIEW_DIR . "visualizzaIndexMicrocategorie.php";
                break;
            case 'visualizzaIndexStatistiche':
                include_once VIEW_DIR . "visualizzaIndexStatistiche.php";
                break;
            case 'visualizzaRicorsiAlBan':
                include_once VIEW_DIR . "visualizzaRicorsiAlBan.php";
                break;
            case 'visualizzaRicorsiAnnunci':
                include_once VIEW_DIR . "visualizzaRicorsiAnnunci.php";
                break;
            case 'visualizzaUtentiBannati':
                include_once VIEW_DIR . "visualizzaUtentiBannati.php";
                break;
            case 'visualizzaUtentiSegnalati':
                include_once VIEW_DIR . "visualizzaUtentiSegnalati.php";
                break;
            case 'annuncioUtenteLoggato';
                include_once VIEW_DIR . "annuncioUtenteLoggato.php";
                break;
            case 'annuncioProprietario';
                include_once VIEW_DIR . "annuncioProprietario.php";
                break;
            case 'inserisciAnnuncio';
                include_once VIEW_DIR . "inserisciAnnuncio.php";
                break;
                case 'modificaAnnuncio';
                include_once VIEW_DIR . "modificaAnnuncio.php";
                break;        
            default:
                header('Location: ' . DOMINIO_SITO . '/');
                exit;
        }
    }
} catch (Exception $ex) {
    if (DEBUG == true)
        throw $ex;
    include_once VIEW_DIR . "design/fatalException.php";
}
