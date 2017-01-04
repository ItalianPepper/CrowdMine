<?php

/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 03/01/2017
 * Time: 22:16
 */
class SearchByPreferedAds extends Filter
{
    /**
     * SearchByMicroFilter constructor.
     * @param $title
     */
    public function __construct($idUtente)
    {
        $this->getAnnunciPreferitiByUser($idUtente);
    }

    public function getAnnunciPreferitiByUser($idUtente)
    {
        parent::setFilterString(" 
            annuncio.id IN (
                 SELECT DISTINCT preferito.id_annuncio
                FROM preferito
                WHERE preferito.id_annuncio = annuncio.id AND preferito.id_utente= '".$idUtente."'
            )
        ");
    }

}