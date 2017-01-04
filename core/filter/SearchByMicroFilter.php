<?php

/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 01/12/2016
 * Time: 10:12
 */

include_once "Filter.php";

class SearchByMicroFilter extends Filter
{
    /**
     * SearchByMicroFilter constructor.
     * @param $title
     */
    public function __construct($idMicro)
    {
        $this->setMicro($idMicro);
    }

    public function setMicro($idMicro)
    {
        parent::setFilterString(" 
            annuncio.id IN (
                SELECT DISTINCT riferito.id_annuncio
                FROM riferito
                WHERE riferito.id_annuncio = id AND riferito.id_microcategoria = '".$idMicro."'
            )
        ");
    }

}