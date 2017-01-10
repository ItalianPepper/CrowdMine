<?php
/**
 * Created by PhpStorm.
 * User: LongSky
 * Date: 07/01/2017
 * Time: 23:50
 */

include_once MANAGER_DIR . 'MessaggioManager.php';

$manager_msg = new MessaggioManager();
$num = $manager_msg->numberMessaggiNotVisualized($user->getID());
$a = array(
    "num" => (int)$num
);
$json = json_encode($num);
echo $json;
