<?php

include_once "Filter.php";

class SearchByLocationFilter extends Filter{
    /**
     * SearchByLocationFilter constructor.
     * @param $location
     */
    public function __construct($location)
    {
        $this->setLocation($location);
    }

    public function setLocation($location)
    {
        parent::setFilterString(" `annuncio`.`luogo` LIKE '".$location."' ");
    }

}





?>