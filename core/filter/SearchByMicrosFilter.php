<?php

/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 01/12/2016
 * Time: 10:12
 */

include_once "Filter.php";

class SearchByMicrosFilter extends Filter
{
    /**
     * SearchByMicroFilter constructor.
     * @param $title
     */
    public function __construct($idMicros)
    {
        $this->setMicro($idMicros);
    }

    public function setMicro($idMicros)
    {
        $query = " 
            annuncio.id IN (
                SELECT DISTINCT riferito.id_annuncio
                FROM riferito
                WHERE riferito.id_annuncio = id ";

        for ($i = 0; $i < count($idMicros); $i++) {
            $query .= "AND riferito.id_microcategoria = '" . $idMicros[$i] . "'";
        }
        $query.=")";

        parent::setFilterString($query);
    }

}