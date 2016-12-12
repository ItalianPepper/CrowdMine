<?php
include_once MANAGER_DIR . 'AnnuncioManager.php';
include_once MANAGER_DIR . 'UtenteManager.php';
include_once FILTER_DIR . 'SearchByTitleFilter.php';
include_once FILTER_DIR . 'SearchByDateInterval.php';



$manager = new AnnuncioManager();
$utenteObj = new UtenteManager();
$filters = array();


if (isset($_POST['titolo'])) {
    $titleObj = new SearchByTitleFilter($_POST['titolo']);
    array_push($filters, $titleObj);
}

if (isset($_POST['data'])) {
    $dataObj = new SearchByDateInterval("", $_POST['data']);
    array_push($filters, $dataObj);
}

if (isset($_POST['utente'])) {
    echo $_POST['utente'];
    //$user = $utenteObj->getUtenteByName($_POST['utente']); Query ricerca utente
    $user = new Utente(1, "Severino", "Ammirati", "3333", "", "Striano", "", "", "", "", "");
    $userObj = new SearchByUserIdFilter($user->getId());
    array_push($filters, $userObj->setUserId($user->getId()));
}

$annunci = $manager->searchAnnuncio($filters);
$_SESSION['searched'] = $annunci;
header("Location:" . DOMINIO_SITO . "/visualizzaAnnunciRicercati");








?>