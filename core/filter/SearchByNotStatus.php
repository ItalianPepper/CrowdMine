<?php
include_once FILTER_DIR ."/Filter.php";
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 14/12/2016
 * Time: 15:10
 */
class SearchByNotStatus extends Filter
{
    /**
     * SearchByCommentoNotEliminated constructor.
     */
    public function __construct($status){
        $this->setStatus($status);
    }

    public function setStatus($status){

        parent::setFilterString(" `annuncio`.`stato` != '".$status."' ");
    }
}