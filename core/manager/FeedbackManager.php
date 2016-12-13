<?php

/**
 * Created by PhpStorm.
 * User: LongSky
 * Date: 28/11/2016
 * Time: 11:43
 */

include_once MODEL_DIR . 'Feedback.php';
include_once MANAGER_DIR . 'Manager.php';

/**
 * Class FeedbackManager
 * This Class provides the business logic for the Feedback Management and methods for database access.
 */
class FeedbackManager extends Manager
{

    /**
     * FeedbackManager constructor.
     */
    public function __construct()
    {
    }

    /**
     * Create a new persistent Feedback
     *
     * @param $id
     * @param $idAnnuncio
     * @param $idUtente
     * @param $corpo
     * @param $data
     * @param $valutazione
     * @return Feedback
     */
    public function createFeedback($id, $idAnnuncio, $idUtente, $corpo, $data, $valutazione){
        return new Feedback($id, $idAnnuncio, $idUtente, $corpo, $data, $valutazione);
    }

    /**
     * return a collection of Feedback about an User
     * @param $idUtente
     */
    public function getListaFeedback($idUtente){

    }

    /**
     * return a collection of Feedback about an User and a microCategory
     * @param $idUtente
     * @param $microCategoria
     */
    public function getListaFeedbackByMicrocategoria($idUtente, $microCategoria){

    }

    /**
     * find an User by the following parameters
     * @param $microCategoria
     * @param $macroCategoria
     * @param $numStelle
     */
    public function findUserBy($microCategoria, $macroCategoria, $numStelle){

    }

    /**
     * return the passed list of Feedback sorted on the basis of a parameters
     * @param $list
     * @param $param
     */
    public function sortListaFeedback($list, $param){

    }

    /**
     * return a collection of Feedback with status attribute setted to "segnalato"
     */
    public function getFeedbackSegnalati(){

    }

    /**
     * Delete permanently a Feedback identified by the passed id from the database
     * @param $idFeedback
     */
    public function removeFeedback($idFeedback){

    }



}