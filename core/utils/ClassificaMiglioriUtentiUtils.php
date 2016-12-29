<?php

/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 28/12/16
 * Time: 21:16
 */
class ClassificaMiglioriUtentiUtils
{

    private $nome;
    private $feedbackPositivi;
    private $microCategoria;
    private $macroCategoria;


    /**
     * ClassificaMiglioriUtentiUtils constructor.
     * @param $nome
     * @param $feedbackPositivi
     * @param $microCategoria
     * @param $macroCategoria
     */
    public function __construct($nome, $feedbackPositivi, $microCategoria, $macroCategoria)
    {
        $this->nome = $nome;
        $this->feedbackPositivi = $feedbackPositivi;
        $this->microCategoria = $microCategoria;
        $this->macroCategoria = $macroCategoria;
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
    public function getMacroCategoria()
    {
        return $this->macroCategoria;
    }

    /**
     * @param mixed $macroCategoria
     */
    public function setMacroCategoria($macroCategoria)
    {
        $this->macroCategoria = $macroCategoria;
    }



}