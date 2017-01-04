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
define('FILTER_DIR', CORE_DIR. "filter". DIRECTORY_SEPARATOR);
define('CONTROL_DIR', CORE_DIR . "control" . DIRECTORY_SEPARATOR);
define('UPLOADS_DIR', DOMINIO_SITO . "/uploads/");
define('STYLE_DIR', DOMINIO_SITO . DIRECTORY_SEPARATOR . "style" . DIRECTORY_SEPARATOR);
define('AJAX_DIR', CORE_DIR . DIRECTORY_SEPARATOR . "ajax" . DIRECTORY_SEPARATOR);
define('UTILS_DIR', CORE_DIR . "utils" . DIRECTORY_SEPARATOR);
define('ATTIVO',"attivo");
define('SEGNALATO',"segnalato");
define('ELIMINATO',"eliminato");
define('REVISIONE',"revisione");
define('DISATTIVATO',"disattivato");
define('AMMINISTRATORE',"amministratore");
define('REVISIONE_MODIFICA',"revisione_modifica");
define('RICORSO',"ricorso");
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
    include_once MODEL_DIR  .  'Utente.php';

    if (!defined("TESTING")) {
        switch (isset($_URL[0]) ? $_URL[0] : '') {
            case '':
                $user=StringUtils::checkPermission(Permissions::ALL);
                include_once CONTROL_DIR . "visualizzaHome.php";
                break;
            case 'template':
                header("location: http://crowdmine.altervista.org/dist/html/");
                break;
            case 'ProfiloUtente':
                $user = StringUtils::checkPermission(Permissions::ALL);
                include_once CONTROL_DIR . "ProfiloUtenteControl.php";
                break;
            case 'ProfiloPersonale':
                $user = StringUtils::checkPermission(Permissions::UTENTE);
                include_once CONTROL_DIR . "ProfiloPersonaleControl.php";
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
            case 'getMacrosForInsertAnnuncio':
                include_once CONTROL_DIR . "getMacrosForInsertAnnuncio.php";
                break;
            case 'getMicrosByMacroForInsertAnnuncio':
                include_once CONTROL_DIR . "getMicrosByMacroForInsertAnnuncio.php";
                break;
            case 'inserisciEsperienza':
                StringUtils::checkPermission("Cliente");
                include_once VIEW_DIR . "inserisciEsperienza.php";
                break;
//          case 'standard':
//                include_once "standard.html";
//                break;
            case 'ricercaAnnuncio':
                include_once VIEW_DIR . "ricercaAnnuncio.php";
                break;
            case 'banned':
                $user=StringUtils::checkPermission(Permissions::BANNED_ONLY);
                include_once VIEW_DIR . "paginaBanUtente.php";
                break;
            case 'ricorso':
                $user=StringUtils::checkPermission(Permissions::BANNED_ONLY);
                include_once CONTROL_DIR . "ricorsoControl.php";
                break;
            case 'auth':
                StringUtils::checkPermission(Permissions::NOT_LOGGED_ONLY);
                include_once VIEW_DIR . "login-registrazione.php";
                break;
            case 'register':
                StringUtils::checkPermission(Permissions::NOT_LOGGED_ONLY);
                include_once VIEW_DIR . "login-registrazione.php";
                break;
            case 'effettuaRegistrazione':
                StringUtils::checkPermission(Permissions::NOT_LOGGED_ONLY);
                include_once CONTROL_DIR . "RegisterCM.php";
                break;
            case 'inserimentoEsperienza':
                StringUtils::checkPermission("all");
                include_once CONTROL_DIR . "InserisciEsperienza.php";
                break;
            case 'effettuaLogin':
                StringUtils::checkPermission(Permissions::NOT_LOGGED_ONLY);
		        include_once CONTROL_DIR . "LoginCM.php";
                break;
            case 'logout':
                include_once CONTROL_DIR . "Logout.php";
                break;
            case 'livesearch':
                include_once CONTROL_DIR . "SearchController.php";
                break;
            case 'cercaUtente':
                include_once CONTROL_DIR . "UtenteFinder.php";
                break;
            case 'segnalaUtente':
                $user = StringUtils::checkPermission(Permissions::MODERATORE);
                include_once CONTROL_DIR . "SegnalaUtente.php";
                break;
            case 'feedbackListRetrive':
            	include_once CONTROL_DIR . "feedbackListRetrive.php";
            	break;
            case 'CancellaAccount':
                $user = StringUtils::checkPermission(Permissions::UTENTE);
                include_once CONTROL_DIR . "CancellazioneUtente.php";
                break;
            case 'modificaDati':
                $user = StringUtils::checkPermission(Permissions::UTENTE);
                include_once CONTROL_DIR . "ModificaDati.php";
                break;
            case 'riattivaUtente':
                $user = StringUtils::checkPermission(Permissions::MODERATORE);
                include_once CONTROL_DIR . "RiattivaUtente.php";
                break;
            case 'banUtente':
                $user = StringUtils::checkPermission(Permissions::MODERATORE);
                include_once CONTROL_DIR . "BanUtente.php";
                break;
            case 'eleggiModeratore':
                $user = StringUtils::checkPermission(Permissions::AMMINISTRATORE);
                include_once CONTROL_DIR . "EleggiModeratore.php";
                break;
            case 'destituisciModeratore':
                $user = StringUtils::checkPermission(Permissions::AMMINISTRATORE);
                include_once CONTROL_DIR . "DestituisciModeratore.php";
                break;            case 'cercaAnnunci':
                StringUtils::checkPermission("all");
                include_once CONTROL_DIR . "CercaAnnunci.php";
                break;
            case 'inserisciFeedback':
                include_once CONTROL_DIR . "inserisciFeedbackControl.php";
                break;
            case 'modificaPassword':
                $user = StringUtils::checkPermission(RuoloUtente::UTENTE);
                include_once CONTROL_DIR . "CambiaPasswordControl.php";
                break;
            case 'rimuoviMacroUtenteControl':
                $user = StringUtils::checkPermission(RuoloUtente::UTENTE);
                include_once CONTROL_DIR . "RimuoviMacroUtenteControl.php";
                break;
            case 'rimuoviMicroUtenteControl':
                $user = StringUtils::checkPermission(RuoloUtente::UTENTE);
                include_once CONTROL_DIR . "RimuoviMicroUtenteControl.php";
                break;
            case 'SegnalazioneUtenteControl':
                $user=StringUtils::checkPermission(Permissions::MODERATORE);
                include_once CONTROL_DIR . "SegnalazioneUtenteControl.php";
                break;
            case 'aggiungiMacroUtente':
                $user=StringUtils::checkPermission(Permissions::UTENTE);
                include_once CONTROL_DIR . "AggiungiMacroUtenteControl.php";
                break;
            case 'asyncMicroListByMacro':
                $user=StringUtils::checkPermission(Permissions::UTENTE);
                include_once CONTROL_DIR . "asyncMicroListByMacro.php";
                break;
            case 'asyncRicercaUtente':
                $user=StringUtils::checkPermission(Permissions::UTENTE);
                include_once CONTROL_DIR . "asyncRicercaUtente.php";
                break;
            case 'aggiungiMicroUtente':
                $user=StringUtils::checkPermission(Permissions::UTENTE);
                include_once CONTROL_DIR . "AggiungiMicroUtenteControl.php";
                break;
            case 'bloccaUtente':
                $user=StringUtils::checkPermission(Permissions::UTENTE);
                include_once CONTROL_DIR . "BloccaUtenteControl.php";
                break;
            case 'sbloccaUtente':
                $user=StringUtils::checkPermission(Permissions::UTENTE);
                include_once CONTROL_DIR . "SbloccaUtenteControl.php";
                break;
            case 'UtentiBannati':
                $user=StringUtils::checkPermission(Permissions::MODERATORE);
                include_once CONTROL_DIR . "ListaUtentiBannati.php";
                break;
            case "ricercaUtente":
                include_once CONTROL_DIR . "RicercaUtente.php";
                break;
            case "cercaAnnunciNavBar":
                $user = StringUtils::checkPermission(Permissions::ALL);
                include_once CONTROL_DIR . "cercaAnnunciNavBar.php";
                break;
            case 'paginaPrincipaleModeratore':
                $user=StringUtils::checkPermission(Permissions::MODERATORE);
                include_once VIEW_DIR . "paginaPrincipaleModeratore.php";
                break;
            case 'visualizzaAnnunciSegnalati':
                $user=StringUtils::checkPermission(Permissions::MODERATORE);
                include_once VIEW_DIR . "visualizzaAnnunciSegnalati.php";
                break;
            case 'visualizzaFeedbackSegnalati':
                $user=StringUtils::checkPermission(Permissions::MODERATORE);
                include_once VIEW_DIR . "visualizzaFeedbackSegnalati.php";
                break;
            case 'visualizzaIndexMacrocategorie':
                $user=StringUtils::checkPermission(Permissions::MODERATORE);
                include_once VIEW_DIR . "visualizzaIndexMacrocategorie.php";
                break;
            case 'IndexMacrocategorie':
                $user=StringUtils::checkPermission(Permissions::MODERATORE);
                include_once CONTROL_DIR . "IndexMacrocategorieControl.php";
                break;
            case 'IndexMicrocategorie':
                $user=StringUtils::checkPermission(Permissions::MODERATORE);
                include_once CONTROL_DIR . "IndexMicrocategorieControl.php";
                break;
            case 'visualizzaIndexStatistiche':
                include_once VIEW_DIR . "visualizzaIndexStatistiche.php";
                break;
            case 'risultatoRicercaUtente':
                include_once VIEW_DIR . "RisultatiRicercaUtente.php";
                break;
            case 'visualizzaRicorsiAlBan':
                include_once VIEW_DIR . "visualizzaRicorsiAlBan.php";
                break;
            case 'visualizzaRicorsiAnnunci':
                include_once VIEW_DIR . "visualizzaRicorsiAnnunci.php";
                break;
            case 'UtentiSegnalati':
                $user=StringUtils::checkPermission(Permissions::MODERATORE);
                include_once CONTROL_DIR . "UtentiSegnalatiControl.php";
                break;
            case 'annunciSegnalati':
                $user=StringUtils::checkPermission(Permissions::MODERATORE);
                include_once CONTROL_DIR . "annunciSegnalati.php";
                break;
            case 'cancellaAnnuncio':
                include_once CONTROL_DIR . "cancellaAnnuncio.php";
                break;
            case 'annuncioUtenteLoggato';
                include_once VIEW_DIR . "annuncioUtenteLoggato.php";
                break;
            case 'annuncioProprietario';
                include_once VIEW_DIR . "annuncioProprietario.php";
                break;
            case 'visualizzaAnnuncioProprietario';
                include_once CONTROL_DIR . "visualizzaAnnunci.php";
                break;
            case 'rimuoviCandidatura';
                include_once CONTROL_DIR. "rimuoviCandidatura.php";
                break;
            case 'inserisciAnnuncio';
                $user = StringUtils::checkPermission(Permissions::UTENTE);
                include_once CONTROL_DIR . "inserisciAnnuncio.php";
                break;
            case 'inserisciAnnuncioControl';
                $user=StringUtils::checkPermission(Permissions::UTENTE);
                include_once CONTROL_DIR . "getDatiAnnuncio.php";
                break;
            case 'ricercaAnnuncioControl';
                include_once CONTROL_DIR . "getDatiAnnuncioRicercato.php";
                break;
            case 'modificaAnnuncio';
                $user=StringUtils::checkPermission(Permissions::UTENTE);
                include_once CONTROL_DIR . "modificaAnnuncio.php";
                break;
            case 'modificaAnnuncioControl';
                include_once CONTROL_DIR . "getDatiAnnuncioModificato.php";
                break;
            case 'aggiungiPreferitiControl';
                $user=StringUtils::checkPermission(Permissions::UTENTE);
                include_once CONTROL_DIR . "aggiungiPreferiti.php";
                break;
            case 'ricercaAnnuncio';
                include_once CONTROL_DIR . "ricercaAnnuncio.php";
                break;
            case 'annunciPreferiti';
                $user=StringUtils::checkPermission(Permissions::UTENTE);
                include_once CONTROL_DIR . "visualizzaPreferiti.php";
                break;
            case 'rimuoviPreferitiControl';
                include_once CONTROL_DIR . "rimuoviPreferiti.php";
                break;
            case 'aggiungiCandidaturaControl';
                include_once CONTROL_DIR . "aggiungiCandidatura.php";
                break;
            case 'segnalaAnnuncioControl';
                include_once CONTROL_DIR . "segnalaAnnuncio.php";
                break;
            case 'attivaAnnuncioControl';
                include_once CONTROL_DIR . "attivaAnnuncio.php";
                break;
            case 'disattivaAnnuncioControl';
                include_once CONTROL_DIR . "disattivaAnnuncio.php";
                break;
            case 'commentaAnnuncioControl';
                $user=StringUtils::checkPermission(Permissions::UTENTE);
                include_once CONTROL_DIR . "commentaAnnuncio.php";
                break;
            case 'annunciProprietari';
                include_once CONTROL_DIR . "visualizzaAnnunci.php";
                break;
            case 'getHome';
                include_once CONTROL_DIR . "visualizzaHome.php";
                break;
            case 'asynAnnunci';
                include_once AJAX_DIR . "asynAnnunci.php";
                break;
            case 'visualizzaAnnunciRicercati';
                include_once VIEW_DIR . "visualizzaAnnunciRicercati.php";
                break;
            case 'nothingFound';
                include_once VIEW_DIR . "nothingFound.php";
                break;
            case 'inviaAnnuncioAdmin';
                include_once CONTROL_DIR . "inviaAnnuncioAdmin.php";
                break;
            case 'visualizzaAnnunciConflitto';
                include_once CONTROL_DIR . "annunciConflitto.php";
                break;
            case 'annunciReclamati';
                $user=StringUtils::checkPermission(Permissions::MODERATORE);
                include_once CONTROL_DIR . "annunciReclamati.php";
                break;
            case 'annunciModificati';
                $user=StringUtils::checkPermission(Permissions::MODERATORE);
                include_once CONTROL_DIR . "annunciModificati.php";
                break;
            case 'annunciRevisione';
                $user=StringUtils::checkPermission(Permissions::AMMINISTRATORE);
                include_once CONTROL_DIR . "annunciRevisione.php";
                break;
            case 'annuncio';
                include_once VIEW_DIR . "annuncioStileNuovo.php";
                break;
            case 'immprofilo';
                include_once CORE_DIR . "/template/assets/images/profile.png";
                break;
            case 'segnalaCommento';
                include_once CONTROL_DIR . "segnalaCommento.php";
                break;
            case 'annuncioNew';
                include_once VIEW_DIR . "annuncioNew.php";
                break;
            case 'headerStart';
                include_once VIEW_DIR . "headerStart.php";
                break;
            case 'annunciControl';
                include_once CONTROL_DIR . "annunciControl.php";
                break;
            case 'cancellaMacroControl';
                $user=StringUtils::checkPermission(Permissions::MODERATORE);
                include_once CONTROL_DIR . "cancellaMacroControl.php";
                break;
            case 'cancellaMicroControl';
                $user=StringUtils::checkPermission(Permissions::MODERATORE);
                include_once CONTROL_DIR . "cancellaMicroControl.php";
                break;
            case 'InserisciNuovaMacroControl';
                $user=StringUtils::checkPermission(Permissions::MODERATORE);
                include_once CONTROL_DIR . "InserisciNuovaMacroControl.php";
                break;
            case 'InserisciNuovaMicroControl';
                $user=StringUtils::checkPermission(Permissions::MODERATORE);
                include_once CONTROL_DIR . "InserisciNuovaMicroControl.php";
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
