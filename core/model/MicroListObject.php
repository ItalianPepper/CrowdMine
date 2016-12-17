<?php

/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 16/12/2016
 * Time: 01:37
 */
class MicroListObject
{
    private $microCategoria;
    private $macroCategoria;

    /**
     * MicroListObject constructor.
     * @param $microCategoria
     * @param $macroCategoria
     */
    public function __construct($microCategoria, $macroCategoria)
    {
        $this->microCategoria = $microCategoria;
        $this->macroCategoria = $macroCategoria;
    }

    /**
     * @return mixed
     */
    public function getMicroCategoria()
    {
        return $this->microCategoria;
    }


    /**
     * @return mixed
     */
    public function getMacroCategoria()
    {
        return $this->macroCategoria;
    }


}