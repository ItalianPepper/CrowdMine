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

        $ordering = false;
        $size = count($filters);
        //start where clause
        $query .= " WHERE ";

        if($size > 0){

            //if there are no filters before orderFilters, set the base query as WHERE 1
            if($filters[0] instanceof OrderFilter){
                $query.= " 1 ";
                $ordering = true;
            }

            //use of setFilter for the first statement
            $filters[0]->setFilter($query);

        }else{
            //no filters, apply base query
            $query.= " 1 ";
        }

        for($i=1;$i<$size;$i++){
            $f = $filters[$i];
            if (is_object($f) && $f instanceof Filter) {
                //look for the first order filter
                if($f instanceof OrderFilter && $ordering==false){
                    //gotcha! now we can apply the first ORDER BY statement
                    $ordering = true;
                    $f->setFilter($query);
                }else{
                    //concatenation (AND "," ecc..)
                    $f->addFilter($query);
                }
            }
        }
    }

}