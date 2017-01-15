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

    try {

        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $userName = $_POST["nome"];

            if (empty($userName) || !preg_match(Patterns::$NAME_GENERIC, $userName)) {
                throw new IllegalArgumentException("Nome non valido");
            }

        } else {
            throw new IllegalArgumentException("Campo nome non settato");
        }

        if (isset($_POST['cognome']) && !empty($_POST['cognome'])) {
            $userSurname = $_POST["cognome"];
            if (empty($userSurname) || !preg_match(Patterns::$NAME_GENERIC, $userSurname)) {
                throw new IllegalArgumentException("Cognome non valido");
            }
        } else {
            throw new IllegalArgumentException("Campo cognome non settato");
        }
        if (isset($_POST['telefono']) && !empty($_POST['telefono'])) {
            $userPhone = $_POST["telefono"];
            if (!preg_match(Patterns::$TELEPHONE, $userPhone)) {
                throw new IllegalArgumentException("Recapito telefonico non valido");
            }

        } else {
            throw new IllegalArgumentException("Campo telefono non settato");
        }

        if (isset($_POST['datanascita']) && !empty($_POST['datanascita'])) {

            $userDateOfBirth = $_POST["datanascita"];
            if (!preg_match(Patterns::$GENERIC_DATE, $userDateOfBirth)) {
                throw new IllegalArgumentException("Data di nascita non valida, inserire la data di nascita nel formato: dd/mm/yyyy");
            }

        } else {
            throw new IllegalArgumentException("Campo data di nascita non settato");
        }
        if (isset($_POST['citta']) && !empty($_POST['citta'])) {
            $userCity = $_POST["citta"];

            if (!preg_match(Patterns::$NAME_GENERIC, $userCity)) {
                throw new IllegalArgumentException("Nome citta' non valido");
            }

        } else {
            throw new IllegalArgumentException("Campo citta' non settato");
        }

        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $userMail = $_POST["email"];

            if (!preg_match(Patterns::$EMAIL, $userMail)) {
                throw new IllegalArgumentException("Email non valida, inserire l'email nel formato: name@exemple.com");
            }

            if (($utenteManager->checkEmail($userMail)) == true) {
                throw new IllegalArgumentException("Email già collegata ad un'altro account");
            }

        } else {
            throw new IllegalArgumentException("Campo email non settato");
        }

        if (isset($_POST['password']) && !empty($_POST['password'])) {
            $userPassword = $_POST["password"];

            if (!preg_match(Patterns::$PASSWORD, $userPassword)) {
                throw new IllegalArgumentException("Password non valida");
            }
        } else {
            throw new IllegalArgumentException("Campo password non settato");
        }

        if (isset($_POST['passwordretyped']) && !empty($_POST['passwordretyped'])) {
            $userPasswordRetyped = $_POST["passwordretyped"];

            if ($userPasswordRetyped != $userPassword) {
                throw new IllegalArgumentException("Le password devono essere uguali");
            }
        } else {
            throw new IllegalArgumentException("Reinserire la password");
        }

        if (isset($_POST['partitaIva']) && !empty($_POST['partitaIva'])) {
            $userPI = $_POST["partitaIva"];
            if (!preg_match(Patterns::$PI_GENERIC, $userPI)) {
                throw new IllegalArgumentException("Partita iva non valida");
            }
        }

        if (isset($_POST['tipologia'])) {
            $userType = testInput($_POST["tipologia"]);
        }

        if (isset($_POST['descrizione'])) {
            $userDescription = testInput($_POST["descrizione"]);
        }
        if (!isset($_POST['accetto'])) {
            throw new IllegalArgumentException("Bisogna autorizzare il trattamento dei dati per potersi registrare!");
        }

        if (isset($_FILES['image'])) {
            if ($_FILES['image']['size'] < $max_file_size) {

                // get file type
                $typ = $_FILES['image']['type'];

                $bigpath = UPLOAD_FOLDER . '/images/profile/150x150/';

                /* new random file name */
                while (true) {
                    $filename = uniqid('', false);
                    $search = glob($bigpath . $filename);
                    if (!$search || count($search) <= 0) break;
                }

                if (in_array($typ, $valid_typs)) {
                    /* resize image */
                    foreach ($sizes as $w => $h) {

                        /* file upload folder*/
                        $path = UPLOAD_FOLDER . '/images/profile/' . $w . 'x' . $h . '/';
                        $userImage = resize($w, $h, $filename, $path);
                    }
                } else {
                    throw new IllegalArgumentException("Immagine non supportata");
                }
            } else {
                throw new IllegalArgumentException("Caricare una immagine con dimensioni inferiori a 1MB");
            }
        }

        $userToReg = new Utente(null, $userName, $userSurname, $userPhone, $userDateOfBirth, $userCity, $userMail, $userPassword, StatoUtente::ATTIVO, RuoloUtente::UTENTE, $userDescription, $userImage, $userPI);
        $utenteManager->register($userToReg);
        $user = $utenteManager->login($userMail, $userPassword);

        // verificare il valore di ritorno nel manager
        if ($user != false) {
            $_SESSION['user'] = serialize($user);
            $_SESSION['loggedin'] = true;
            $_SESSION['toast-type'] = "success";
            $_SESSION['toast-message'] = "Benvenuto " . $user->getNome() . " :)";

            echo "ok";
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
