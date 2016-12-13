 <?php

/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 01/12/2016
 * Time: 17:43
 */

include_once "Filter.php";
include_once "OrderFilter.php";

class FilterUtils
{
    /**
     * this method applies an array of filters to a single query
     * @param array $filters
     * @param string $query
     */
    public static function applyFilters($filters,&$query = "")
    {

        $size = count($filters);
        //start where clause
        $query .= " WHERE ";

        if($size > 0 ){

            if($filters[0] instanceof OrderFilter){
                $query.= " 1 ";
            }
            $filters[0]->setFilter($query);

        }else{
            $query.= " 1 ";
        }

        for($i=1;$i<$size;$i++){
            $f = $filters[$i];
            if (is_object($f) && $f instanceof Filter) {
                $f->addFilter($query);
            }
        }
    }

}