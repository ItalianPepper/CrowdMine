<?php

include_once MODEL_DIR . "Messaggio.php";
include_once MODEL_DIR . "Candidatura.php";

include_once MANAGER_DIR . "Manager.php"; 
/**
 * Created by PhpStorm.
 * User: Andrea Sarto
 * Date: 30/11/2016
 * Time: 11.24
 */

class MessaggioManagerStub extends Manager
{

    /**
     * MessaggioManager constructor.
     */
    public function __construct()
    {

    }

    /**
     * Send an object Messaggio
     * @param Double $idMittente
     * @param Double $idDestinatario
     * @param Messaggio $messaggio
     */
    public function getConversazione($id_Mittente, $id_Destinatario){
      
        if($id_Destinatario==1){
            $lista_messaggio[0] = new Messaggio(0, $id_Mittente, $id_Destinatario, "Ciao Simone", "16/04/2007", false );
            $lista_messaggio[1] = new Messaggio(0, $id_Destinatario, $id_Mittente, "Ciao Alfredo", "16/04/2007", false );
            $lista_messaggio[2] = new Messaggio(0, $id_Mittente, $id_Destinatario, "Voglio lavorare per te", "16/04/2007", false );

        }else if($id_Destinatario==2){
            $lista_messaggio[0] = new Messaggio(0, $id_Destinatario, $id_Mittente, "Ciao Alfredo", "16/04/2007", false );
            $lista_messaggio[1] = new Messaggio(0, $id_Destinatario, $id_Mittente, "Io e te non abbiamo niente da dirci", "16/04/2007", false );

        }else if($id_Destinatario==3){
            $lista_messaggio[0] = new Messaggio(0, $id_Mittente,$id_Destinatario, "Ciao Luca", "16/04/2007", false );
            $lista_messaggio[1] = new Messaggio(0, $id_Destinatario, $id_Mittente, "Ciao Alfredo", "16/04/2007", false );
            $lista_messaggio[2] = new Messaggio(0, $id_Mittente, $id_Destinatario, "Voglio dirti una cosa:", "16/04/2007", false );
            $lista_messaggio[3] = new Messaggio(0, $id_Mittente, $id_Destinatario, "Non vedo l'ora di chiamarti Dottore.", "16/04/2007", false );
            $lista_messaggio[4] = new Messaggio(0, $id_Mittente, $id_Destinatario, "Ok?", "16/04/2007", false );
            $lista_messaggio[5] = new Messaggio(0, $id_Destinatario,$id_Mittente, "Sei Idiota?", "16/04/2007", false );

        }else if($id_Destinatario==4){
            $lista_messaggio[0] = new Messaggio(0, $id_Destinatario, $id_Mittente, "Ciao Alfredo", "16/04/2007", false );
            $lista_messaggio[1] = new Messaggio(0, $id_Mittente, $id_Destinatario, "Ciao Fabiano", "16/04/2007", false );
            $lista_messaggio[2] = new Messaggio(0, $id_Destinatario,$id_Mittente, "Come hai detto scusa?", "16/04/2007", false );
            $lista_messaggio[3] = new Messaggio(0, $id_Mittente, $id_Destinatario,  "Cosa?", "16/04/2007", false );
            $lista_messaggio[4] = new Messaggio(0, $id_Destinatario, $id_Mittente, "Vaffanculo, scriverò sulla minuta che mi hai insultato.", "16/04/2007", false );   
        }
        
        return $lista_messaggio;
    }
    
    public function inviaMessaggio($id_Mittente, $id_Destinatario){
        
        
        
        return true; //invio con successo   
    }
    
    
    //l'id_utente è candidato ad un annuncio dell'utente id_Proprietario?
    public function isCandidato($id_Proprietario_annuncio, $id_Utente){
        /*
        //l'ID_proprietario Alfredo ha un annuncio. I suoi desintari Simone e Giancarlo sono candidati al suo annuncio ID=4     
        if($id_Destinatario==1){
            new Candidatura(1, $id_Utente, 4, "Ciao, vorrei candidarmi a questo annuncio", null, null, INVIATO, NON_VALUTATO);
        }
        //l'ID_proprietario Alfredo ha due annunci ID=5; ID=6. Luca è candidato a tutti e due i suoi annunci     
        if($id_Destinatario==1){
            new Candidatura(1, $id_Utente, 4, "Ciao, vorrei candidarmi a questo annuncio", null, null, INVIATO, NON_VALUTATO);
        }
        
        
        return $lista_Candidature; //ritorna un vettore di Candidature con tutti gli ID degli annunci in cui id_Utente è candidato
        */
    }
  
 
}