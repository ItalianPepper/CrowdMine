<?php

/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 01/12/2016
 * Time: 10:12
 */

include_once "Filter.php";

class SearchByIdFilter extends Filter
{

    /**
     * SearchByIdFilter constructor.
     * @param $title
     */
    public function __construct($id)
    {
        $this->setId($id);
    }

    public function setId($id)
    {
        parent::setFilterString(" `annuncio`.`id` = '".$id."' ");
    }

}