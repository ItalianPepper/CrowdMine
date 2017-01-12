<?php

/**
 * User: Andrea Buonaguro   
 * Date: 7/12/2016
 * Time: 19:07
 */
include_once MANAGER_DIR . "UtenteManager.php";
include_once CONTROL_DIR . "ControlUtils.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";


include_once UTILS_DIR . "ImageUpload.php";

if ($_SERVER["REQUEST_METHOD"]== "POST"){
    
    $utenteManager = new UtenteManager();
    $userName = NULL;
    $userSurname = NULL;
    $userPhone = NULL;
    $userDateOfBirth = NULL;
    $userCity = NULL;
    $userMail = NULL;
    $userPassword = NULL;
    $userPasswordRetyped = NULL;
    $userPI = NULL;
    $userType = NULL;
    $userDescription = NULL;
    $userImage = NULL;

    // settings
    $max_file_size = 1024*1024; // 1MB
    $valid_typs = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif');

    // thumbnail sizes
    $sizes = array(150 => 150,20 => 20);

    if (isset($_POST['nome'])) {
        $userName = $_POST["nome"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo nome non settato";
        throw new IllegalArgumentException("Campo nome non settato");
    }

    if (isset($_POST['cognome'])) {
        $userSurname = $_POST["cognome"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo cognome non settato";
        throw new IllegalArgumentException("Campo cognome non settato");
    }
    if (isset($_POST['telefono'])) {
        $userPhone = $_POST["telefono"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo telefono non settato";
        throw new IllegalArgumentException("Campo telefono non settato");
    }

    if (isset($_POST['datanascita'])) {
        $userDateOfBirth = $_POST["datanascita"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo data di nascita non settato";
        throw new IllegalArgumentException("Campo data di nascita non settato");
    }
    if (isset($_POST['citta'])) {
        $userCity = $_POST["citta"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo citta' non settato";
        throw new IllegalArgumentException("Campo citta' non settato");
    }
    
    if (isset($_POST['email'])) {
        $userMail = $_POST["email"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo email non settato";
        throw new IllegalArgumentException("Campo email non settato");
    }
    
    if (isset($_POST['password'])) {
        $userPassword = $_POST["password"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo password non settato";
        throw new IllegalArgumentException("Campo password non settato");
    }
    
    if (isset($_POST['passwordretyped'])) {
        $userPasswordRetyped = $_POST["passwordretyped"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Reinserire la password";
        throw new IllegalArgumentException("Reinserire la password");
    }
    
    if (isset($_POST['partitaIva'])) {
        $userPI = $_POST["partitaIva"];
    }
    
    if (isset($_POST['tipologia'])) {
        $userType = $_POST["tipologia"];
    }
    
    if (isset($_POST['descrizione'])) {
        $userDescription = $_POST["descrizione"];
    }

    if ($_POST['accetto']) {
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Bisogna autorizzare il trattamento dei dati per potersi registrare!";
        throw new IllegalArgumentException("Bisogna autorizzare il trattamento dei dati per potersi registrare!");
    }
    
    if (empty($userName) || !preg_match(Patterns::$NAME_GENERIC, $userName)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Nome non valido";
        throw new IllegalArgumentException("Nome non valido");
    }
    
    if (empty($userSurname) || !preg_match(Patterns::$NAME_GENERIC, $userSurname)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Cognome non valido";
        throw new IllegalArgumentException("Cognome non valido");
    }
    
    if (empty($userPhone) || !preg_match(Patterns::$TELEPHONE, $userPhone)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Recapito telefonico non valido";
        throw new IllegalArgumentException("Recapito telefonico non valido");
    }
    
    if (empty($userDateOfBirth) || !preg_match(Patterns::$GENERIC_DATE, $userDateOfBirth)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Data di nascita non valida, inserire la data di nascita nel formato: dd/mm/yyyy";
        throw new IllegalArgumentException("Data di nascita non valida");
    }
    
    if (empty($userCity) || !preg_match(Patterns::$NAME_GENERIC, $userCity)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Nome citta' non valido";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Nome citta' non valido");
    }
    
    if (empty($userMail) || !preg_match(Patterns::$EMAIL, $userMail)) { 
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Email non valida, inserire l'email nel formato: name@exemple.com";
        throw new IllegalArgumentException("Email non valida");
    }
    
    if (empty($userPassword)){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Password non inserita";
        throw new IllegalArgumentException("Password non inserita");
    }else {
        if (!preg_match(Patterns::$PASSWORD, $userPassword)) {
            $_SESSION['toast-type'] = "error";
            $_SESSION['toast-message'] = "Password non valida, inserire almeno 8 caratteri, di cui almeno uno minuscolo, uno maiuscolo e un numero";
            throw new IllegalArgumentException("Password non valida");
        }
    }
    
    if (empty($userPasswordRetyped) || ($userPasswordRetyped != $userPassword)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Le password devono essere uguali";
        throw new IllegalArgumentException("Le password devono essere uguali");
    }
     if (!empty($userPI) && !preg_match(Patterns::$PI_GENERIC, $userPI)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Partita iva non valida";
        throw new IllegalArgumentException("Partita iva non valida");
    }

    if(($utenteManager->checkEmail($userMail)) == false){

        if (isset($_FILES['image'])) {
            if( $_FILES['image']['size'] < $max_file_size ){

                // get file type
                $typ = $_FILES['image']['type'];

                $bigpath = UPLOAD_FOLDER.'/images/profile/150x150/';

                /* new random file name */
                while (true) {
                    $filename = uniqid('', false);
                    $search = glob($bigpath.$filename);
                    if (!$search || count($search)<=0) break;
                }

                if (in_array($typ, $valid_typs)) {
                    /* resize image */
                    foreach ($sizes as $w => $h) {

                        /* file upload folder*/
                        $path = UPLOAD_FOLDER.'/images/profile/'.$w.'x'.$h.'/';
                        $userImage = resize($w, $h,$filename,$path);
                    }
                } else {
                    $_SESSION['toast-type'] = "error";
                    $_SESSION['toast-message'] = "Immagine non supportata";
                    throw new IllegalArgumentException("Caricamento immagine non riuscito");
                }
            } else{
                $_SESSION['toast-type'] = "error";
                $_SESSION['toast-message'] = "Caricare una immagine con dimensioni inferiori a 1MB";
                throw new IllegalArgumentException("Caricamento immagine non riuscito");
            }
        }

       $userToReg = new Utente(null, $userName, $userSurname, $userPhone, $userDateOfBirth, $userCity, $userMail, $userPassword, StatoUtente::ATTIVO,RuoloUtente::UTENTE,$userDescription,$userImage,$userPI);
       $utenteManager->register($userToReg);
       $user = $utenteManager-> login($userMail, $userPassword);    
    }
    
    else{
       $_SESSION['toast-type'] = "error";
       $_SESSION['toast-message'] = "Email già collegata ad un'altro account";
       throw new IllegalArgumentException("Email già collegata ad un'altro account");
    }
    // verificare il valore di ritorno nel manager
    if($user != false){
        $_SESSION['user'] = serialize($user);
        $_SESSION['loggedin'] = true; 
        $_SESSION['toast-type'] = "success";
        $_SESSION['toast-message'] = "Benvenuto".$user->getNome()." :)";
    }
}
