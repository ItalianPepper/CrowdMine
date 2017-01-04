<?php

/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 01/12/2016
 * Time: 10:12
 */

include_once "Filter.php";

class SearchByTypeFilter extends Filter
{

    /**
     * SearchByType constructor.
     * @param $type
     */
    public function __construct($type)
    {
        $this->setType($type);
    }

    public function setType($type)
    {
        parent::setFilterString(" `annuncio`.`tipo` = '".$type."' ");
    }

}