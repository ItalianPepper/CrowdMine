<?php

/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 28/12/16
 * Time: 21:23
 */
class StatisticheProfiloUtenteUtils
{
    private $id;
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
    public function __construct($id, $microCategoria, $feedbackPositivi, $feedbackNegativi)
    {
        $this->id = $id;
        $this->microCategoria = $microCategoria;
        $this->feedbackPositivi = $feedbackPositivi;
        $this->feedbackNegativi = $feedbackNegativi;
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

}