<?php

/** a)Aggiungere MANAGER_DIR
 *  b) Controllo sugli accessi con un oggetto session (da discutere)
 *  c) metodi dei manager (da discutere)
 */

if($SERVER["REQUEST_METHOD"]=="POST"){
    $adsManager = new AnnuncioManager();

    $adsNumber = $adsManager->getNumberAdsToday();

    var_dump($adsManager);

    header("Content-Type: application/json");
    echo json_encode($adsNumber);
}