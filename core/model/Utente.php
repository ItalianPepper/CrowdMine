<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class StatoUtente{
    const REVISIONE = "revisione";
    const ATTIVO = "attivo";
    const SEGNALATO = "segnalato";
    const DISATTIVATO = "disattivato";
    const RICORSO = "ricorso";
    const BANNATO = "bannato";
    const AMMINISTRATORE = "amministratore";
    const REVISIONE_MODIFICA = "revisione_modifica";
}

class RuoloUtente{
    const UTENTE = "utente";
    const MODERATORE = "moderatore";
    const AMMINISTRATORE = "amministratore";
}

class Utente {

    private $id;
    private $nome;
    private $cognome;
    private $telefono;
    private $dataNascita;
    private $citta;
    private $email;
    private $password;
    private $stato;
    private $ruolo;
    private $immagineProfilo;

    /**
     * Utente constructor.
     * @param $id
     * @param $nome
     * @param $cognome
     * @param $telefono
     * @param $dataNascita
     * @param $citta
     * @param $email
     * @param $password
     * @param $stato
     * @param $ruolo
     * @param $immagineProfilo
     */
    public function __construct($id, $nome, $cognome, $telefono, $dataNascita, $citta, $email, $password, $stato, $ruolo, $immagineProfilo)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->telefono = $telefono;
        $this->dataNascita = $dataNascita;
        $this->citta = $citta;
        $this->email = $email;
        $this->password = $password;
        $this->stato = $stato;
        $this->ruolo = $ruolo;
        $this->immagineProfilo = $immagineProfilo;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return mixed
     */
    public function getCognome()
    {
        return $this->cognome;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @return mixed
     */
    public function getDataNascita()
    {
        return $this->dataNascita;
    }

    /**
     * @return mixed
     */
    public function getCitta()
    {
        return $this->citta;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getStato()
    {
        return $this->stato;
    }

    /**
     * @return mixed
     */
    public function getRuolo()
    {
        return $this->ruolo;
    }

    /**
     * @return mixed
     */
    public function getImmagineProfilo()
    {
        return $this->immagineProfilo;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @param mixed $cognome
     */
    public function setCognome($cognome)
    {
        $this->cognome = $cognome;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @param mixed $dataNascita
     */
    public function setDataNascita($dataNascita)
    {
        $this->dataNascita = $dataNascita;
    }

    /**
     * @param mixed $citta
     */
    public function setCitta($citta)
    {
        $this->citta = $citta;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $stato
     */
    public function setStato($stato)
    {
        $this->stato = $stato;
    }

    /**
     * @param mixed $ruolo
     */
    public function setRuolo($ruolo)
    {
        $this->ruolo = $ruolo;
    }

    /**
     * @param mixed $immagineProfilo
     */
    public function setImmagineProfilo($immagineProfilo)
    {
        $this->immagineProfilo = $immagineProfilo;
    }

}
