<?php

/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 01/12/2016
 * Time: 10:12
 */

include_once "Filter.php";

class SearchByDateInterval extends Filter
{

    /**
     * SearchByDateInterval constructor.
     * @param $status
     */
    public function __construct($initDate,$endDate)
    {
        $this->setInterval($initDate,$endDate);
    }

    public function setInterval($initDate,$endDate)
    {
        parent::setFilterString(" `annuncio`.`data` BETWEEN '".$initDate."' AND '".$endDate."'");
    }

}