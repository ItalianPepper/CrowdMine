<?php

/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 01/12/2016
 * Time: 10:12
 */

include_once "Filter.php";

/**
 * OrderByDateFilter
 * NOTE: Always call as last Filter!
 */
class OrderType{
    const DESC = "DESC";
    const CRESC = "CRESC";
}

/**
 * @param $orderType
 */
abstract class OrderFilter
{
    public function setFilter(&$query){
        $query.=" ORDER BY ".$this->filterString;
    }

    /**
     * concatenate filter to base query
     * @param $query
     */
    public function addFilter(&$query){
        $query.=" , ".$this->filterString;
    }
}