<?php

/* 
 * Modificata da Angelo Caputo
 * 26/11/16  00:40
 */

class StatoAnnuncio{
    const REVISIONE = "revisione";
    const ATTIVO = "attivo";
    const SEGNALATO = "segnalato";
    const DISATTIVATO = "disattivato";
    const RICORSO = "ricorso";
    const ELIMINATO = "eliminato";
    const AMMINISTRATORE = "amministratore";
    const REVISIONE_MODIFICA = "revisione_modifica";
}

class TipoAnnuncio{
    const DOMANDA = "domanda";
    const OFFERTA = "offerta";
}


class Annuncio {
    
    private $id;
    private $idUtente;
    private $data;
    private $titolo;
    private $descrizione;
    private $luogo;
    private $stato;
    private $retribuzione;
    private $tipologia;

    /**
     * Annuncio constructor.
     * @param $id
     * @param $idUtente
     * @param $data
     * @param $titolo
     * @param $descrizione
     * @param $luogo
     * @param $stato
     * @param $retribuzione
     * @param $tipologia
     */
    public function __construct($id, $idUtente, $data, $titolo, $descrizione, $luogo, $stato, $retribuzione, $tipologia)
    {
        $this->id = $id;
        $this->idUtente = $idUtente;
        $this->data = $data;
        $this->titolo = $titolo;
        $this->descrizione = $descrizione;
        $this->luogo = $luogo;
        $this->stato = $stato;
        $this->retribuzione = $retribuzione;
        $this->tipologia = $tipologia;
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
    public function getIdUtente()
    {
        return $this->idUtente;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getTitolo()
    {
        return $this->titolo;
    }

    /**
     * @return mixed
     */
    public function getDescrizione()
    {
        return $this->descrizione;
    }

    /**
     * @return mixed
     */
    public function getLuogo()
    {
        return $this->luogo;
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
    public function getRetribuzione()
    {
        return $this->retribuzione;
    }

    /**
     * @return mixed
     */
    public function getTipologia()
    {
        return $this->tipologia;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @param mixed $titolo
     */
    public function setTitolo($titolo)
    {
        $this->titolo = $titolo;
    }

    /**
     * @param mixed $descrizione
     */
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;
    }

    /**
     * @param mixed $luogo
     */
    public function setLuogo($luogo)
    {
        $this->luogo = $luogo;
    }

    /**
     * @param mixed $stato
     */
    public function setStato($stato)
    {
        $this->stato = $stato;
    }

    /**
     * @param mixed $retribuzione
     */
    public function setRetribuzione($retribuzione)
    {
        $this->retribuzione = $retribuzione;
    }

    /**
     * @param mixed $tipologia
     */
    public function setTipologia($tipologia)
    {
        $this->tipologia = $tipologia;
    }

}