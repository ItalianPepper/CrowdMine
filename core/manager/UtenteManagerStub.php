<?php

include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . 'MicroCategoriaManager.php';
include_once MODEL_DIR . 'Annuncio.php';

/**
 * Created by PhpStorm.
 * User: Dario Galiani
 * Date: 28/11/2016
 * Time: 23.25
 */

class UtenteManagerStub extends Manager{
    /**
     * UtenteManager constructor.
     */
    public function __construct()
    {

    }

   
    /**
     * [STUB] 
     * $id id dell'utente
     * return il model utente
     */
    public function getUtenteByID($id){
        
            $utente = null;
            if($id==1)
                $utente = new Utente(1, 'Simone', 'Giak', "38093", "Sal", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
            else if($id==2)
                $utente = new Utente(2, 'Giancarlo', 'Mannara', "38093", "Rom", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
            else if($id==3)
                $utente = new Utente(3, 'Luca', 'PM', "38093", "Rom", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
            else if($id==4)
                $utente = new Utente(4, 'Fabiano', 'Pecorelli', "38093", "Rom", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );

            return $utente;
    }





}
