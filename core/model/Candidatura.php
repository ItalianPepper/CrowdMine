<?php

/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 27/11/16
 * Time: 14:21
 */


class RichiestaInviataCandidatura{
    const INVIATA = "inviata";
    const NON_INVIATA = "non_inviata";
    const NON_VALUTATA  = "non_valutata";
}

class RichiestaAccettataCandidatura{
    const NON_VALUTATO = "non_valutato";
    const ACCETTATO = "accettato";
    const RIFIUTATO  = "rifiutato";
}

class Candidatura
{
    private $id;
    private $idUtente;
    private $idAnnuncio;
    private $corpo;
    private $dataRisposta;
    private $dataInviata;
    private $richiestaInviata;
    private $richiestaAccettata;

    /**
     * Candidatura constructor.
     * @param $id
     * @param $idUtente
     * @param $idAnnuncio
     * @param $corpo
     * @param $dataRisposta
     * @param $dataInviata
     * @param $richiestaInviata
     * @param $richiestaAccettata
     */
    public function __construct($id, $idUtente, $idAnnuncio, $corpo, $dataRisposta, $dataInviata, $richiestaInviata, $richiestaAccettata)
    {
        $this->id = $id;
        $this->idUtente = $idUtente;
        $this->idAnnuncio = $idAnnuncio;
        $this->corpo = $corpo;
        $this->dataRisposta = $dataRisposta;
        $this->dataInviata = $dataInviata;
        $this->richiestaInviata = $richiestaInviata;
        $this->richiestaAccettata = $richiestaAccettata;
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
    public function getIdAnnuncio()
    {
        return $this->idAnnuncio;
    }

    /**
     * @return mixed
     */
    public function getCorpo()
    {
        return $this->corpo;
    }

    /**
     * @return mixed
     */
    public function getDataRisposta()
    {
        return $this->dataRisposta;
    }

    /**
     * @return mixed
     */
    public function getDataInviata()
    {
        return $this->dataInviata;
    }

    /**
     * @return mixed
     */
    public function getRichiestaInviata()
    {
        return $this->richiestaInviata;
    }

    /**
     * @return mixed
     */
    public function getRichiestaAccettata()
    {
        return $this->richiestaAccettata;
    }

    /**
     * @param mixed $corpo
     */
    public function setCorpo($corpo)
    {
        $this->corpo = $corpo;
    }

    /**
     * @param mixed $dataRisposta
     */
    public function setDataRisposta($dataRisposta)
    {
        $this->dataRisposta = $dataRisposta;
    }

    /**
     * @param mixed $dataInviata
     */
    public function setDataInviata($dataInviata)
    {
        $this->dataInviata = $dataInviata;
    }

    /**
     * @param mixed $richiestaInviata
     */
    public function setRichiestaInviata($richiestaInviata)
    {
        $this->richiestaInviata = $richiestaInviata;
    }

    /**
     * @param mixed $richiestaAccettata
     */
    public function setRichiestaAccettata($richiestaAccettata)
    {
        $this->richiestaAccettata = $richiestaAccettata;
    }

}