<?php

/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 01/12/2016
 * Time: 10:12
 */

include_once "Filter.php";

/**
 * OrderByDateFilter abstract class modelling filters for orderby statements
 * NOTE: Always call after other Filters!
 */
class OrderType{
    const DESC = "DESC";
    const ASC = "ASC";
}

/**
 * @param $orderType
 */
abstract class OrderFilter extends Filter
{
    public function setFilter(&$query){
        $query.=" ORDER BY ".$this->filterString . "DESC";
    }

    /**
     * concatenate filter to base query
     * @param $query
     */
    public function addFilter(&$query){
        $query.=" , ".$this->filterString;
    }
}