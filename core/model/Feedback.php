<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once MODEL_DIR."Commento.php";

class Feedback extends Commento
{

    private $valutazione;
    private $idValutato;
    private $titolo;

    /**
     * Feedback constructor.
     * @param $id
     * @param $idUtente
     * @param $idAnnuncio
     * @param $valutazione
     * @param $corpo
     * @param $data
     */
    public function __construct($id, $idAnnuncio, $idUtente, $idValutato, $corpo, $data, $stato, $valutazione, $titolo)
    {
        parent::__construct($id, $idAnnuncio, $idUtente, $corpo, $data, $stato);
        $this->valutazione = $valutazione;
        $this->idValutato = $idValutato;
        $this->titolo = $titolo;

    }

    /**
     * @return mixed
     */
    public function getValutazione()
    {
        return $this->valutazione;
    }

    /**
     * @param mixed $valutazione
     */
    public function setValutazione($valutazione)
    {
        $this->valutazione = $valutazione;
    }

    public function getIdValutato()
    {
        return $this->idValutato;
    }

    public function getTitolo()
    {
        return $this->titolo;
    }

    public function setTitolo($titolo)
    {
        $this->titolo = $titolo;
    }



}
