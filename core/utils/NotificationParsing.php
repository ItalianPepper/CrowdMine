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

//aggiungere notifiche per il moderatore: segnalazione;
//aggiungere notifiche per l'admin:segnalazioni;

    public function __construct()
    {

    }

    public function formattingNotify($notifyObject, $typeUser)
    {
        if($typeUser =="USR") {
            $result = array();
            for ($i = 0; $i < $notifyObject . sizeof(); $i++) {

                $type = $notifyObject[$i]->getTipo();
                $infoNotify = json_decode($notifyObject[$i]->getInfo(), true);

                if ($type == "INSERIMENTO") {

                    $obj = $infoNotify["TIPOOGGETTO"];
                    $href = $infoNotify["ID"]; //da sostituire con l'href

                    if ($obj == "ANNUNCIO") {
                        $result[$href] = NotificationParsing::$INSERIMENTO_ANNUNCIO;
                    } else if ($obj == "COMMENTO") {
                        $referName = $infoNotify["NOMEANNUNCIO"];
                        $result[$href] = sprintf(NotificationParsing::$INSERIMENTO_COMMENTO, $referName);
                    } else if ($obj == "FEEDBACK") {
                        $referName = $infoNotify["NOMEANNUNCIO"];
                        $result[$href] = sprintf(NotificationParsing::$INSERIMENTO_FEEDBACK, $referName);
                    } else if ($obj == "CANDIDATURA") {
                        $referName = $infoNotify["NOMEANNUNCIO"];
                        $result[$href] = sprintf(NotificationParsing::$INSERIMENTO_CANDIDATURA, $referName);
                    }

                } else if ($type == "RISOLUZIONE") {

                    $obj = $infoNotify["TIPOOGGETTO"];
                    $href = $infoNotify["ID"];//da sostituire con l'href
                    $esit = $infoNotify["ESITO"];

                    if ($obj == "ANNUNCIO") {
                        if ($esit == "true") {
                            $result[$href] = sprintf(NotificationParsing::$RISOLUZIONE_POSITIVA, "annuncio");
                        } else if ($esit == "false") {
                            $result[$href] = sprintf(NotificationParsing::$RISOLUZIONE_NEGATIVA, "annuncio");
                        }

                    } else if ($obj == "COMMENTO") {
                        if ($esit == "true") {
                            $result[$href] = sprintf(NotificationParsing::$RISOLUZIONE_POSITIVA, "commento");
                        } else if ($esit == "false") {
                            $result[$href] = sprintf(NotificationParsing::$RISOLUZIONE_NEGATIVA, "commento");
                        }

                    } else if ($obj == "FEEDBACK") {
                        if ($esit == "true") {
                            $result[$href] = sprintf(NotificationParsing::$RISOLUZIONE_POSITIVA, "feedback");
                        } else if ($esit == "false") {
                            $result[$href] = sprintf(NotificationParsing::$RISOLUZIONE_NEGATIVA, "feedback");
                        }

                    }

                } else if ($type == "DECISIONE") {
                    $obj = $infoNotify["TIPOOGGETTO"];
                    $href = $infoNotify["ID"];
                    $referName = $infoNotify["NOMEANNUNCIO"];
                    $esit = $infoNotify["ESITO"];

                    if ($obj == "CANDIDATURA") {
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
            return $result;


        }else if($typeUser =="ADN"){
            $result = array();
            return $result;
        }
    }
}
