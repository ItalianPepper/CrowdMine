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
class OrderByDateFilter extends Filter
{
    /**
     * OrderByDateFilter constructor.
     * @param $title
     */
    public function __construct($orderType)
    {
        $this->setOrder($orderType);
    }

    /**
     * @param $orderType
     */
    public function setOrder($orderType)
    {
        parent::setFilterString(" 
           ORDER BY annuncio.data ".$orderType."  
        ");
    }

}