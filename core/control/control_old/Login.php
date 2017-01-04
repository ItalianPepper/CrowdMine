<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once CONTROL_DIR . 'Controller.php';

include_once MODEL_DIR . 'Utente.php';

login($_POST['email'], $_POST['password'], (@$_POST['remember'] == "1" ? true : false));

function login($email, $password, $remember) {
    if (!preg_match(Patterns::$EMAIL, $email)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Email non valida";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        throw new ApplicationException(Error::$EMAIL_NON_VALIDA);
    }
    if (strlen($password) < Config::$MIN_PASSWORD_LEN) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Password troppo corta";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        throw new ApplicationException(ErrorUtils::$PASS_CORTA);
    }

    $user = getUtente($email, $password);
    if ($user) {
        $_SESSION['loggedin'] = true;
        $_SESSION['user'] = serialize($user);

        if ($remember) {
            setPermanentCookie($user->getPassword());
        }
        $_SESSION['toast-type'] = "success";
        $_SESSION['toast-message'] = "Bentornato ".$user->getNome();
        header("Location:" . DOMINIO_SITO . "/");
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Utente non trovato";
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
    return $user;
}

/**
 * Restituisce utente dato email e password
 * @param $email La mail dell'utente
 * @param $password La password dell'utente
 * @return Utente L'utente
 * @throws ConnectionException
 * @throws ApplicationException
 */
function getUtente($email, $password) {
    return getUtenteByIdentity(createIdentity($email, $password));
}

/**
 * @param $identity L'identità dell'utente
 * @return Utente L'utente trovato
 * @throws ConnectionException
 * @throws ApplicationException
 */
function getUtenteByIdentity($identity) {
    $SELECT_UTENTE = "SELECT * FROM `utente` WHERE `password`='%s' LIMIT 1";
    $qr = sprintf($SELECT_UTENTE, $identity);

    $res = Controller::getDB()->query($qr);
    return parseUtente($res);
}

/**
 * Serializza tupla dal db in un oggetto Utente
 * @param mysqli_result $res
 * @return Utente
 * @throws ApplicationException [$UTENTE_NON_TROVATO]
 */
function parseUtente($res) {
    if ($res && $obj = $res->fetch_assoc()) {
        return new Utente($obj['nome'], $obj['cognome'], $obj['telefono'], $obj['e-mail'], $obj['citta'], $obj['password'], $obj['descrizione'], $obj['immagine'], $obj['tipologia'], $obj['data'], $obj['id']);
    } else {
        header("Location:" . DOMINIO_SITO . "/auth");
    }
}

/**
 * Setta il cookie permanente nel browser
 * @param $getPassword identity dell'utente
 */
function setPermanentCookie($getPassword) {
    $getPassword = $getPassword . "|" . md5(uniqid());
    setcookie(Config::$PERMA_COOKIE, StringUtils::encrypt($getPassword), time() + 365 * 24 * 60 * 60);
}

function createIdentity($email, $pass) {
    $SALT = "r#*1542&ztnsa7uABN83gtkw7lcSjy";
    return md5(md5(strtolower($email) . $pass . $SALT) . $SALT);
}
