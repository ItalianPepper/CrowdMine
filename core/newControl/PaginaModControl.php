<?php
/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 03/12/2016
 * Time: 12:24
 */

include_once MODEL_DIR . 'Utente.php';

$utente = unserialize($_SESSION['user']);

header("Location:" . DOMINIO_SITO . "/paginaPrincipaleModeratore");

