<?php
/**
 * Logout
 *
 * @author Sergio Shevchenko
 * @version 1.1
 * @since 29/11/15
 */
include_once CORE_DIR . 'Config.php';
if (!isset($_SESSION['loggedin'])) {
    header('Location: '.DOMINIO_SITO.'/auth');
}
logOut();
header('Location: '.DOMINIO_SITO.'/auth');

function logOut() {
    unset($_SESSION['loggedin']);
    unset($_SESSION['user']);
}
