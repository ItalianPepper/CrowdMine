<?php
/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 17/12/2016
 * Time: 18:50
 */


include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . 'UtenteManager.php';
include_once CONTROL_DIR ."ControlUtils.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
   // $user = unserialize($_SESSION['user']);

    if(isset($_POST["nome"])){
        $userName = testInput($_POST["nome"]);
        $manager = new UtenteManager();

        $listResultFindUser = $manager->findUserOneInput($userName);

            $toReturn = "";
            foreach ($listResultFindUser as $u) {
                    $toReturn = $toReturn . "<option value=" . $u->getId() . ">" . $u->getNome() . "</option>";
            }

            if($toReturn=="")
                echo "<option value='' disabled selected>Non ci sono utenti disponibili.</option>";
            else
                echo $toReturn."<option value='' disabled selected>Seleziona l'utente</option>";
    }

}
?>