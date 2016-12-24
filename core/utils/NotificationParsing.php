<?php

class NotificationParsing
{
    public static $RISOLUZIONE_POSITIVA = "Il tuo %s è stato valutato con esito postivo.";
    public static $RISOLUZIONE_NEGATIVA = "Il tuo %s è stato valutato con esito negativo.";
    public static $INSERIMENTO_ANNUNCIO = "È stato inserito un nuovo annuncio in una categoria di interesse.";
    public static $INSERIMENTO_FEEDBACK = "È stato inserito un nuovo feedback relativo al tuo annuncio: %s .";
    public static $INSERIMENTO_COMMENTO = "È stato inserito un nuovo commento relativo al tuo annuncio: %s .";
    public static $INSERIMENTO_CANDIDATURA = "È stato inserita una nuova candidatura al tuo annuncio: %s .";
    public static $DECISIONE_CANDIDATURA_DOMANDA_ACCETTATA = "È stata accetta la tua candidatura relativa all'annuncio: %s.";
    public static $DECISIONE_CANDIDATURA_DOMANDA_RIFIUTATA = "È stata rifiutata la tua candidatura relativa all'annuncio: %s.";
    public static $MOD_SEGNALAZIONE_FEEDBACK_E_COMMENTO = "Il %s dell'annuncio %s è stato segnalato.";
    public static $MOD_SEGNALAZIONE_UTENTE = "L'utente %s è stato segnalato.";
    public static $MOD_SEGNALAZIONE_ANNUNCIO ="L'annuncio %s è stato segnalato.";
    public static $ADM_CONTESTAZIONE_TRA_MOD ="È stata aperta una nuova contestazione tra moderatori.";
/**TO DO LIST
 *manca rounting per le notifiche admin e moderatore;
 *manca struttura di controllo per admin e moderatore;
 *decidere formattazione JSON per admin e moderatore;
 **/

    public function __construct()
    {

    }

    public function formattingNotify($notifyObject, $typeUser)
    {
        $size = sizeof($notifyObject);

        if($typeUser =="USR") {
            $result = array();
            for ($i = 0; $i < $size; $i++) {

                $type = $notifyObject[$i]->getTipo();
                $infoNotify = json_decode($notifyObject[$i]->getInfo(), true);

                if ($type == "INSERIMENTO") {

                    $obj = $infoNotify["TIPOOGGETTO"];
                    $id = $infoNotify["ID"]; //da sostituire con l'href

                    if ($obj == "ANNUNCIO") {
                        $href = $this->rounting("ANNUNCIO");
                        $href = sprintf($href,$id);
                        $result[$href] = NotificationParsing::$INSERIMENTO_ANNUNCIO;
                    } else if ($obj == "COMMENTO") {
                        $href = $this->rounting("COMMENTO");
                        $href = sprintf($href,$id);
                        $referName = $infoNotify["NOMEANNUNCIO"];
                        $result[$href] = sprintf(NotificationParsing::$INSERIMENTO_COMMENTO, $referName);
                    } else if ($obj == "FEEDBACK") {
                        $href = $this->rounting("FEEDBACK");
                        $href = sprintf($href,$id);
                        $referName = $infoNotify["NOMEANNUNCIO"];
                        $result[$href] = sprintf(NotificationParsing::$INSERIMENTO_FEEDBACK, $referName);
                    } else if ($obj == "CANDIDATURA") {
                        $href = $this->rounting("CANDIDATURA");
                        $href = sprintf($href,$id);
                        $referName = $infoNotify["NOMEANNUNCIO"];
                        $result[$href] = sprintf(NotificationParsing::$INSERIMENTO_CANDIDATURA, $referName);
                    }

                } else if ($type == "RISOLUZIONE") {

                    $obj = $infoNotify["TIPOOGGETTO"];
                    $id = $infoNotify["ID"];//da sostituire con l'href
                    $esit = $infoNotify["ESITO"];

                    if ($obj == "ANNUNCIO") {
                        $href = $this->rounting("ANNUNCIO");
                        $href = sprintf($href,$id);
                        if ($esit == "true") {
                            $result[$href] = sprintf(NotificationParsing::$RISOLUZIONE_POSITIVA, "annuncio");
                        } else if ($esit == "false") {
                            $result[$href] = sprintf(NotificationParsing::$RISOLUZIONE_NEGATIVA, "annuncio");
                        }

                    } else if ($obj == "COMMENTO") {
                        $href = $this->rounting("COMMENTO");
                        $href = sprintf($href,$id);
                        if ($esit == "true") {
                            $result[$href] = sprintf(NotificationParsing::$RISOLUZIONE_POSITIVA, "commento");
                        } else if ($esit == "false") {
                            $result[$href] = sprintf(NotificationParsing::$RISOLUZIONE_NEGATIVA, "commento");
                        }

                    } else if ($obj == "FEEDBACK") {
                        $href = $this->rounting("FEEDBACK");
                        $href = sprintf($href,$id);
                        if ($esit == "true") {
                            $result[$href] = sprintf(NotificationParsing::$RISOLUZIONE_POSITIVA, "feedback");
                        } else if ($esit == "false") {
                            $result[$href] = sprintf(NotificationParsing::$RISOLUZIONE_NEGATIVA, "feedback");
                        }

                    }

                } else if ($type == "DECISIONE") {
                    $obj = $infoNotify["TIPOOGGETTO"];
                    $id = $infoNotify["ID"];
                    $referName = $infoNotify["NOMEANNUNCIO"];
                    $esit = $infoNotify["ESITO"];

                    if ($obj == "CANDIDATURA") {
                        $href = $this->rounting("CANDIDATURA");
                        $href = sprintf($href,$id);
                        if ($esit == "true") {
                            $result[$href] = sprintf(NotificationParsing::$DECISIONE_CANDIDATURA_DOMANDA_ACCETTATA, $referName);
                        } else if ($esit == "false") {
                            $result[$href] = sprintf(NotificationParsing::$DECISIONE_CANDIDATURA_DOMANDA_RIFIUTATA, $referName);
                        }
                    }
                }


            }
            return $result;

        }else if($typeUser =="MOD"){
            $result = array();
            for ($i = 0; $i < $size; $i++) {


            }
            return $result;


        }else if($typeUser =="ADM"){
            $result = array();
            for ($i = 0; $i < $size; $i++) {


            }


            return $result;
        }
    }


    private function rounting($destination){

        if($destination == "ANNUNCIO"){
            return DOMINIO_SITO."/Annuncio&id=%s";
        }else if($destination =="COMMENTO"){
            return DOMINIO_SITO."/Annuncio#Commento&id=%s";
        }else if($destination =="FEEDBACK"){
            return DOMINIO_SITO."/Annuncio#Feedback&id=%s";
        }else if($destination =="CANDIDATURA"){
            return DOMINIO_SITO."/Annuncio#Candidatura&id=%s";
        }else if($destination =="SEGNALAZIONE"){
            return DOMINIO_SITO."/AnnuncioSegnalati&id=%s";
        }
    }
}
