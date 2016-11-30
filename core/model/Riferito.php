<?php

/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 28/11/2016
 * Time: 09:33
 */
class Riferito
{
    private $idAnnuncio;
    private $idMicrocategoria;

    /**
     * Riferito constructor.
     * @param $idAnnuncio
     * @param $idMicrocategoria
     */
    public function __construct($idAnnuncio, $idMicrocategoria)
    {
        $this->idAnnuncio = $idAnnuncio;
        $this->idMicrocategoria = $idMicrocategoria;
    }

    /**
     * @return mixed
     */
    public function getIdAnnuncio()
    {
        return $this->idAnnuncio;
    }

    /**
     * @param mixed $idAnnuncio
     */
    public function setIdAnnuncio($idAnnuncio)
    {
        $this->idAnnuncio = $idAnnuncio;
    }

    /**
     * @return mixed
     */
    public function getIdMicrocategoria()
    {
        return $this->idMicrocategoria;
    }

    /**
     * @param mixed $idMicrocategoria
     */
    public function setIdMicrocategoria($idMicrocategoria)
    {
        $this->idMicrocategoria = $idMicrocategoria;
    }

}