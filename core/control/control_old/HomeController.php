<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once CONTROL_DIR . "Controller.php";
include_once MODEL_DIR . "Utente.php";
include_once MODEL_DIR . "Annuncio.php";

class HomeController extends Controller{
    
    private static $GET_ALL_ANNUNCI = "SELECT * FROM `annuncio`";
    private static $GET_ANNUNCI_OFFERTA = "SELECT * FROM `annuncio`WHERE `tipologia` = 'Offerta'";
    private static $GET_ANNUNCI_RICHIESTA = "SELECT * FROM `annuncio`WHERE `tipologia` = 'Richiesta'";
    private static $GET_UTENTE_EMAIL = "SELECT * FROM `utente` WHERE `e-mail` = '%s'";
    
    public function getAllAnnunci() {
        $query = sprintf(self::$GET_ALL_ANNUNCI);
        $res = Controller::getDB()->query($query);
        $annunci = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $annuncio = new Annuncio($obj['id'], $obj['titolo'], $obj['data'], $obj['descrizione'], $obj['luogo'], $obj['data_pubblicazione'], $obj['tipologia'], $obj['email_utente']);
                $annuncio->setId($obj['id']);
                $annunci[] = $annuncio;            }
        }
        return $annunci;
    }
    
    
    public function getAllAnnunciOfferta() {
        $query = sprintf(self::$GET_ANNUNCI_OFFERTA);
        $res = Controller::getDB()->query($query);
        $annunci = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $annuncio = new Annuncio($obj['id'], $obj['titolo'], $obj['data'], $obj['descrizione'], $obj['luogo'], $obj['data_pubblicazione'], $obj['tipologia'], $obj['email_utente']);
                $annuncio->setId($obj['id']);
                $annunci[] = $annuncio;            }
        }
        return $annunci;
    }
    
    
    public function getAllAnnunciRichiesta() {
        $query = sprintf(self::$GET_ANNUNCI_RICHIESTA);
        $res = Controller::getDB()->query($query);
        $annunci = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $annuncio = new Annuncio($obj['id'], $obj['titolo'], $obj['data'], $obj['descrizione'], $obj['luogo'], $obj['data_pubblicazione'], $obj['tipologia'], $obj['email_utente']);
                $annuncio->setId($obj['id']);
                $annunci[] = $annuncio;            }
        }
        return $annunci;
    }
    
    public function getUtenteByEmail($email){
        $query = sprintf(self::$GET_UTENTE_EMAIL, $email);

        $res = Controller::getDB()->query($query);
        return $this->parseUtente($res);
    }
    
    
    private function parseUtente($res) {
        if ($obj = $res->fetch_assoc()) {
            return new Utente($obj['nome'], $obj['cognome'], $obj['telefono'], $obj['e-mail'], $obj['citta'], $obj['password'], $obj['descrizione'], $obj['immagine'], $obj['tipologia'], $obj['data'], $obj['id'],$obj['professione']);
        } else {
            throw new ApplicationException(ErrorUtils::$UTENTE_NON_TROVATO);
        }
    }
        
    }
    
    
    
    
    
    
