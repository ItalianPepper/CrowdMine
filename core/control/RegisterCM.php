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

header('Content-Type: application/json');

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

    $message["result"] = "errore nella registrazione";

        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $userName = $_POST["nome"];

            if (empty($userName) || !preg_match(Patterns::$NAME_GENERIC, $userName)) {
                $message["result"] = "Nome non valido";
                echo json_encode($message);exit();
            }

        } else {
            $message["result"] = "Nome non settato";
            echo json_encode($message);exit();
        }

        if (isset($_POST['cognome']) && !empty($_POST['cognome'])) {
            $userSurname = $_POST["cognome"];
            if (empty($userSurname) || !preg_match(Patterns::$NAME_GENERIC, $userSurname)) {
                $message["result"] = "Cognome non valido";
                echo json_encode($message);exit();
            }
        } else {
            $message["result"] = "Cognome non settato";
            echo json_encode($message);exit();
        }

        if (isset($_POST['partitaIva']) && !empty($_POST['partitaIva'])) {
            $userPI = $_POST["partitaIva"];
            if (!preg_match(Patterns::$PI_GENERIC, $userPI)) {
                $message["result"] = "Partita iva non valida, inserire 11 cifre";
                echo json_encode($message);exit();
            }
        }
        if (isset($_POST['telefono']) && !empty($_POST['telefono'])) {
            $userPhone = $_POST["telefono"];
            if (!preg_match(Patterns::$TELEPHONE, $userPhone)) {
                $message["result"] = "Recapito telefonico non valido";
                echo json_encode($message);exit();
            }

        } else {
            $message["result"] = "Campo telefono non settato";
            echo json_encode($message);exit();
        }

        if (isset($_POST['datanascita']) && !empty($_POST['datanascita'])) {

            $userDateOfBirth = $_POST["datanascita"];
            if (!preg_match(Patterns::$GENERIC_DATE, $userDateOfBirth)) {
                $message["result"] = "Data di nascita non valida, inserire la data di nascita nel formato: dd/mm/yyyy";
                echo json_encode($message);exit();
            }

        } else {
            $message["result"] = "Campo data di nascita non settato";
            echo json_encode($message);exit();
        }
        if (isset($_POST['citta']) && !empty($_POST['citta'])) {
            $userCity =  testInput($_POST["citta"]);
        } else {
            $message["result"] = "Campo citta' non settato";
            echo json_encode($message);exit();
        }

        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $userMail = $_POST["email"];

            if (!preg_match(Patterns::$EMAIL, $userMail)) {
                $message["result"] = "Email non valida, inserire l'email nel formato: name@exemple.com";
                echo json_encode($message);exit();
            }

            if (($utenteManager->checkEmail($userMail)) == true) {
                $message["result"] = "Email già collegata ad un'altro account";
                echo json_encode($message);exit();
            }

        } else {
            $message["result"] = "Campo email non settato";
            echo json_encode($message);exit();
        }

        if (isset($_POST['password']) && !empty($_POST['password'])) {
            $userPassword = $_POST["password"];

            if (!preg_match(Patterns::$PASSWORD, $userPassword)) {
                $message["result"] = "Password non valida";
                echo json_encode($message);exit();
            }
        } else {

            $message["result"] ="Campo password non settato";
            echo json_encode($message);exit();
        }

        if (isset($_POST['passwordretyped']) && !empty($_POST['passwordretyped'])) {
            $userPasswordRetyped = $_POST["passwordretyped"];

            if ($userPasswordRetyped != $userPassword) {
                $message["result"] = "Le password devono essere uguali";
                echo json_encode($message);exit();
            }
        } else {
            $message["result"] ="Seconda password non inserita";
            echo json_encode($message);exit();
        }

        if (isset($_POST['tipologia'])) {
            $userType = testInput($_POST["tipologia"]);
        }

        if (isset($_POST['descrizione'])) {
            $userDescription = testInput($_POST["descrizione"]);
        }
        if (!isset($_POST['accetto'])) {
            $message["result"] = "Bisogna autorizzare il trattamento dei dati per potersi registrare!";
            echo json_encode($message);exit();
        }

        ob_start();
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
                    $message["result"] = "Immagine non supportata";
                    echo json_encode($message);exit();
                }
            } else {
                $message["result"] = "Caricare una immagine con dimensioni inferiori a 1MB";
                echo json_encode($message);exit();
            }
        }

        $userToReg = new Utente(null, $userName, $userSurname, $userPhone, $userDateOfBirth, $userCity, $userMail, $userPassword, StatoUtente::ATTIVO, RuoloUtente::UTENTE, $userDescription, $userImage, $userPI);
        $utenteManager->register($userToReg);
        $user = $utenteManager->login($userMail, $userPassword);

        ob_end_clean();

        // verificare il valore di ritorno nel manager
        if ($user != false) {
            $_SESSION['user'] = serialize($user);
            $_SESSION['loggedin'] = true;
            $_SESSION['toast-type'] = "success";
            $_SESSION['toast-message'] = "Benvenuto " . $user->getNome() . " :)";

            $message["result"] = "ok";
        }

    echo json_encode($message);
}
