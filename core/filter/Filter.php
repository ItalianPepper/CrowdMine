<?php

/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 01/12/2016
 * Time: 10:10
 */

/*
    Class FILTER:
    This class provides the skeleton of the filter feature.

    Any class that extends this one, must define a search criteria to be placed inside a WHERE clause.
    Es: `username` LIKE 'Ant'%

*/
abstract class Filter
{

    protected $filterString = "";

    /**
     * filter string setter
     * NOTE: this method actually defines the filter, do no override the others
     * @param string $fString
     */
    public function setFilterString($fString)
    {
        $this->filterString = $fString;
    }


    /**
     * apply filter to base query without concatenation
     * @param $query
     */
    public function setFilter(&$query){
        $query.=$this->filterString;
    }

    /**
     * concatenate filter to base query
     * @param $query
     */
    public function addFilter(&$query){
        $query.=" AND ";
        $this->setFilter($query);
    }
}