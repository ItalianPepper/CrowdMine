<?php
/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 14/12/2016
 * Time: 17:26
 */

include_once MODEL_DIR . "Candidatura.php";
include_once MODEL_DIR . "Commento.php";

class annuncioBaseControl
{

    private $annunci;
    private $listaUtenti;
    private $listaCommenti;
    private $listaCandidature;
    private $listaMicro;
    private $AnnunciMicroRef;


    public function __construct($managerAnnuncio, $filters, $inCandidacies = false, $inComments = false, $micros = false)
    {
        //search in temporary table, existing only through the session
        $this->annunci = $managerAnnuncio->temporaryTableSearchAnnunci($filters);

        //total list of involved Users
        $this->listaUtenti = $managerAnnuncio->getUsersInSearchedAnnunci($inCandidacies,$inComments);

        if($inComments){
            //comments for each annuncio
            $this->listaCommenti = $managerAnnuncio->getCommentsInSearchedAnnunci();
        }

        if($inCandidacies) {
            //candidacies for each annuncio
            $this->listaCandidature = $managerAnnuncio->getCandidatiInSearchedAnnunci();
        }

        if($micros) {
            //total list of involved Micros
            $this->listaMicro = $managerAnnuncio->getMicrosInSearchedAnnunci();

            //microcategories references
            $this->AnnunciMicroRef = $managerAnnuncio->getSearchedAnnunciMicrosReference();
        }
    }

    /**
     * @return mixed
     */
    public function getAnnunci()
    {
        return $this->annunci;
    }

    /**
     * @return mixed
     */
    public function getListaUtenti()
    {
        return $this->listaUtenti;
    }

    /**
     * @return mixed
     */
    public function getListaCommenti()
    {
        return $this->listaCommenti;
    }

    /**
     * @return mixed
     */
    public function getListaCandidature()
    {
        return $this->listaCandidature;
    }

    /**
     * @return mixed
     */
    public function getListaMicro()
    {
        return $this->listaMicro;
    }

    /**
     * @return mixed
     */
    public function getAnnunciMicroRef()
    {
        return $this->AnnunciMicroRef;
    }


}



?>