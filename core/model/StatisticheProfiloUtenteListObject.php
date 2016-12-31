<?php

/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 28/12/16
 * Time: 21:23
 */
class StatisticheProfiloUtenteListObject implements JsonSerializable
{
    private $microCategoria;
    private $feedbackPositivi;
    private $feedbackNegativi;


    /**
     * StatisticheProfiloUtenteUtils constructor.
     * @param $id
     * @param $microCategoria
     * @param $feedbackPositivi
     * @param $feedbackNegativi
     */
    public function __construct($microCategoria, $feedbackPositivi, $feedbackNegativi)
    {
        $this->microCategoria = $microCategoria;
        $this->feedbackPositivi = $feedbackPositivi;
        $this->feedbackNegativi = $feedbackNegativi;
    }

    /**
     * @return mixed
     */
    public function getMicroCategoria()
    {
        return $this->microCategoria;
    }

    /**
     * @param mixed $microCategoria
     */
    public function setMicroCategoria($microCategoria)
    {
        $this->microCategoria = $microCategoria;
    }

    /**
     * @return mixed
     */
    public function getFeedbackPositivi()
    {
        return $this->feedbackPositivi;
    }

    /**
     * @param mixed $feedbackPositivi
     */
    public function setFeedbackPositivi($feedbackPositivi)
    {
        $this->feedbackPositivi = $feedbackPositivi;
    }

    /**
     * @return mixed
     */
    public function getFeedbackNegativi()
    {
        return $this->feedbackNegativi;
    }

    /**
     * @param mixed $feedbackNegativi
     */
    public function setFeedbackNegativi($feedbackNegativi)
    {
        $this->feedbackNegativi = $feedbackNegativi;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            "microcategoria" => $this->getMicroCategoria(),
            "feedbackpositivi" => $this->getFeedbackPositivi(),
            "feedbacknegativi" => $this->getFeedbackNegativi(),
        ];
    }
}