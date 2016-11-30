<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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
    private $listaUtenteBloccati;
    private $listaAnnunciPreferiti;
    private $listaNotifiche;
    private $listaMicrocategorie;

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
     * @param $listaUtenteBloccati
     * @param $listaAnnunciPreferiti
     * @param $listaNotifiche
     * @param $listaMicrocategorie
     */
    public function __construct($id, $nome, $cognome, $telefono, $dataNascita, $citta, $email, $password, $stato, $ruolo, $listaUtenteBloccati, $listaAnnunciPreferiti, $listaNotifiche, $listaMicrocategorie)
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
        $this->listaUtenteBloccati = $listaUtenteBloccati;
        $this->listaAnnunciPreferiti = $listaAnnunciPreferiti;
        $this->listaNotifiche = $listaNotifiche;
        $this->listaMicrocategorie = $listaMicrocategorie;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getCognome()
    {
        return $this->cognome;
    }

    /**
     * @param mixed $cognome
     */
    public function setCognome($cognome)
    {
        $this->cognome = $cognome;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getDataNascita()
    {
        return $this->dataNascita;
    }

    /**
     * @param mixed $dataNascita
     */
    public function setDataNascita($dataNascita)
    {
        $this->dataNascita = $dataNascita;
    }

    /**
     * @return mixed
     */
    public function getCitta()
    {
        return $this->citta;
    }

    /**
     * @param mixed $citta
     */
    public function setCitta($citta)
    {
        $this->citta = $citta;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getStato()
    {
        return $this->stato;
    }

    /**
     * @param mixed $stato
     */
    public function setStato($stato)
    {
        $this->stato = $stato;
    }

    /**
     * @return mixed
     */
    public function getRuolo()
    {
        return $this->ruolo;
    }

    /**
     * @param mixed $ruolo
     */
    public function setRuolo($ruolo)
    {
        $this->ruolo = $ruolo;
    }

    /**
     * @return mixed
     */
    public function getListaUtenteBloccati()
    {
        return $this->listaUtenteBloccati;
    }

    /**
     * @param mixed $listaUtenteBloccati
     */
    public function setListaUtenteBloccati($listaUtenteBloccati)
    {
        $this->listaUtenteBloccati = $listaUtenteBloccati;
    }

    /**
     * @return mixed
     */
    public function getListaAnnunciPreferiti()
    {
        return $this->listaAnnunciPreferiti;
    }

    /**
     * @param mixed $listaAnnunciPreferiti
     */
    public function setListaAnnunciPreferiti($listaAnnunciPreferiti)
    {
        $this->listaAnnunciPreferiti = $listaAnnunciPreferiti;
    }

    /**
     * @return mixed
     */
    public function getListaNotifiche()
    {
        return $this->listaNotifiche;
    }

    /**
     * @param mixed $listaNotifiche
     */
    public function setListaNotifiche($listaNotifiche)
    {
        $this->listaNotifiche = $listaNotifiche;
    }

    /**
     * @return mixed
     */
    public function getListaMicrocategorie()
    {
        return $this->listaMicrocategorie;
    }

    /**
     * @param mixed $listaMicrocategorie
     */
    public function setListaMicrocategorie($listaMicrocategorie)
    {
        $this->listaMicrocategorie = $listaMicrocategorie;
    }

}
