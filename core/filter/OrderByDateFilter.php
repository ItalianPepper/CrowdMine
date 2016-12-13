<?php

/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 01/12/2016
 * Time: 10:12
 */

include_once "OrderFilter.php";


/**
 * OrderByDateFilter
 */
class OrderByDateFilter extends OrderFilter
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
           annuncio.data = '$orderType' 
        ");
    }

}