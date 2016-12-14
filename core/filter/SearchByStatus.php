<?php

/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 01/12/2016
 * Time: 10:12
 */

include_once "Filter.php";

class SearchByStatus extends Filter
{

    /**
     * SearchByStatus constructor.
     * @param $status
     */
    public function __construct($status)
    {
        $this->setStatus($status);
    }

    public function setStatus($status)
    {
        parent::setFilterString(" `annuncio`.`stato` = '".$status."' ");
    }

}