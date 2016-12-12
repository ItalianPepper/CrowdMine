<?php

/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 12/12/2016
 * Time: 19:25
 */
class SearchByMacroFilter extends Filter
{
    /**
     * SearchByMacroFilter constructor.
     * @param $title
     */
    public function __construct($idMacro)
    {
        $this->setMicro($idMacro);
    }

    public function setMicro($idMacro)
    {
        parent::setFilterString(" 
            annuncio.id IN (
                SELECT DISTINCT riferito.id_annuncio
                FROM riferito JOIN microcategoria
                        ON riferito.id_microcategoria = microcategoria.id
                     JOIN macrocategoria
                        ON microcategoria.id_macrocategoria = macrocategoria.id
                
                WHERE riferito.id_annuncio = annuncio.id AND macrocategoria.id = '".$idMacro."'
            )
        ");

    }
}