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
    public static $MOD_SEGNALAZIONE_ANNUNCIO = "L'annuncio %s è stato segnalato.";
    public static $ADM_CONTROVERSIA_TRA_MOD = "È stata aperta una nuova controversia tra moderatori.";

    public function __construct()
    {

    }

    public function formattingNotify($notifyObject, $typeUser)
    {
        $size = sizeof($notifyObject);

        if ($typeUser == RuoloUtente::UTENTE) {
            $result = array();
            for ($i = 0; $i < $size; $i++) {

                $type = $notifyObject[$i]->getTipo();
                $infoNotify = json_decode($notifyObject[$i]->getInfo(), true);

                if ($type == tipoNotifica::INSERIMENTO) {

                    $obj = $infoNotify["TIPOOGGETTO"];
                    $id = $infoNotify["ID"];

                    if ($obj == "ANNUNCIO") {
                        $href = $this->rounting("ANNUNCIO");
                        $href = sprintf($href, $id);
                        $result[$href] = NotificationParsing::$INSERIMENTO_ANNUNCIO;
                    } else if ($obj == "COMMENTO") {
                        $href = $this->rounting("COMMENTO");
                        $href = sprintf($href, $id);
                        $referName = $infoNotify["NOME"];
                        $result[$href] = sprintf(NotificationParsing::$INSERIMENTO_COMMENTO, $referName);
                    } else if ($obj == "FEEDBACK") {
                        $href = $this->rounting("FEEDBACK");
                        $href = sprintf($href, $id);
                        $referName = $infoNotify["NOME"];
                        $result[$href] = sprintf(NotificationParsing::$INSERIMENTO_FEEDBACK, $referName);
                    } else if ($obj == "CANDIDATURA") {
                        $href = $this->rounting("CANDIDATURA");
                        $href = sprintf($href, $id);
                        $referName = $infoNotify["NOME"];
                        $result[$href] = sprintf(NotificationParsing::$INSERIMENTO_CANDIDATURA, $referName);
                    }

                } else if ($type == tipoNotifica::RISOLUZIONE) {

                    $obj = $infoNotify["TIPOOGGETTO"];
                    $id = $infoNotify["ID"];
                    $esit = $infoNotify["ESITO"];

                    if ($obj == "ANNUNCIO") {
                        $href = $this->rounting("ANNUNCIO");
                        $href = sprintf($href, $id);
                        if ($esit == "true") {
                            $result[$href] = sprintf(NotificationParsing::$RISOLUZIONE_POSITIVA, "annuncio");
                        } else if ($esit == "false") {
                            $result[$href] = sprintf(NotificationParsing::$RISOLUZIONE_NEGATIVA, "annuncio");
                        }

                    } else if ($obj == "COMMENTO") {
                        $href = $this->rounting("COMMENTO");
                        $href = sprintf($href, $id);
                        if ($esit == "true") {
                            $result[$href] = sprintf(NotificationParsing::$RISOLUZIONE_POSITIVA, "commento");
                        } else if ($esit == "false") {
                            $result[$href] = sprintf(NotificationParsing::$RISOLUZIONE_NEGATIVA, "commento");
                        }

                    } else if ($obj == "FEEDBACK") {
                        $href = $this->rounting("FEEDBACK");
                        $href = sprintf($href, $id);
                        if ($esit == true) {
                            $result[$href] = sprintf(NotificationParsing::$RISOLUZIONE_POSITIVA, "feedback");
                        } else if ($esit == false) {
                            $result[$href] = sprintf(NotificationParsing::$RISOLUZIONE_NEGATIVA, "feedback");
                        }

                    }

                } else if ($type == tipoNotifica::DECISIONE) {
                    $obj = $infoNotify["TIPOOGGETTO"];
                    $id = $infoNotify["ID"];
                    $referName = $infoNotify["NOME"];
                    $esit = $infoNotify["ESITO"];

                    if ($obj == "CANDIDATURA") {
                        $href = $this->rounting("CANDIDATURA");
                        $href = sprintf($href, $id);
                        if ($esit == true) {
                            $result[$href] = sprintf(NotificationParsing::$DECISIONE_CANDIDATURA_DOMANDA_ACCETTATA, $referName);
                        } else if ($esit == false) {
                            $result[$href] = sprintf(NotificationParsing::$DECISIONE_CANDIDATURA_DOMANDA_RIFIUTATA, $referName);
                        }
                    }
                }


            }
            return $result;

        } else if ($typeUser == RuoloUtente::MODERATORE) {
            $result = array();
            for ($i = 0; $i < $size; $i++) {
                $type = $notifyObject[$i]->getTipo();
                $infoNotify = json_decode($notifyObject[$i]->getInfo(), true);

                if ($type == tipoNotifica::SEGNALAZIONE) {

                    $obj = $infoNotify["TIPOOGGETTO"];
                    $id = $infoNotify["ID"];
                    $referName = $infoNotify["NOME"];

                    if ($obj == "ANNUNCIO") {
                        $href = $this->rounting("ANNUNCIO");
                        $href = sprintf($href, $id);
                        $result[$href] = sprintf(NotificationParsing::$MOD_SEGNALAZIONE_ANNUNCIO, $referName);
                    } else if ($obj == "COMMENTO") {
                        $href = $this->rounting("ANNUNCIO");
                        $href = sprintf($href, $id);
                        $result[$href] = sprintf(NotificationParsing::$MOD_SEGNALAZIONE_FEEDBACK_E_COMMENTO, "commento", $referName);
                    } else if ($obj == "FEEDBACK") {
                        $href = $this->rounting("FEEDBACK");
                        $href = sprintf($href, $id);
                        $result[$href] = sprintf(NotificationParsing::$MOD_SEGNALAZIONE_FEEDBACK_E_COMMENTO, "feedback", $referName);
                    } else if ($obj == "UTENTE") {
                        $href = $this->rounting("UTENTE");
                        $href = sprintf($href, $id);
                        $result[$href] = sprintf(NotificationParsing::$MOD_SEGNALAZIONE_UTENTE, $referName);
                    }
                }
            }
            return $result;
        } else if ($typeUser == RuoloUtente::AMMINISTRATORE){
            $result = array();

            for ($i = 0; $i < $size; $i++) {
                $type = $notifyObject[$i]->getTipo();
                $infoNotify = json_decode($notifyObject[$i]->getInfo(), true);

                if ($type == tipoNotifica::SEGNALAZIONE) {

                    $obj = $infoNotify["TIPOOGGETTO"];
                    $id = $infoNotify["ID"];
                    $referName = $infoNotify["NOME"];

                    if ($obj == "ANNUNCIO") {
                        $href = $this->rounting("ANNUNCIO");
                        $href = sprintf($href, $id);
                        $result[$href] = sprintf(NotificationParsing::$MOD_SEGNALAZIONE_ANNUNCIO, $referName);
                    } else if ($obj == "COMMENTO") {
                        $href = $this->rounting("ANNUNCIO");
                        $href = sprintf($href, $id);
                        $result[$href] = sprintf(NotificationParsing::$MOD_SEGNALAZIONE_FEEDBACK_E_COMMENTO, "commento", $referName);
                    } else if ($obj == "FEEDBACK") {
                        $href = $this->rounting("FEEDBACK");
                        $href = sprintf($href, $id);
                        $result[$href] = sprintf(NotificationParsing::$MOD_SEGNALAZIONE_FEEDBACK_E_COMMENTO, "feedback", $referName);
                    } else if ($obj == "UTENTE") {
                        $href = $this->rounting("UTENTE");
                        $href = sprintf($href, $id);
                        $result[$href] = sprintf(NotificationParsing::$MOD_SEGNALAZIONE_UTENTE, $referName);
                    } else if ($obj == "CONTROVERSIAMOD") {
                        $href = $this->rounting("CONTROVERSIAMOD");
                        $href = sprintf($href, $id);
                        $result[$href] = sprintf(NotificationParsing::$ADM_CONTROVERSIA_TRA_MOD);
                    }
                }
            }
            return $result;
        }
    }

    private function rounting($destination)
    {
        if ($destination == "ANNUNCIO") {
            return DOMINIO_SITO . "/Annuncio&id=%s";
        } else if ($destination == "COMMENTO") {
            return DOMINIO_SITO . "/Annuncio&id=%s";
        } else if ($destination == "FEEDBACK") {
            return DOMINIO_SITO . "/Feedback&id=%s";
        } else if ($destination == "CANDIDATURA") {
            return DOMINIO_SITO . "/Annuncio=%s";
        } else if ($destination == "SEGNALAZIONE") {
            return DOMINIO_SITO . "/AnnuncioSegnalati&id=%s";
        } else if ($destination =="UTENTE") {
            return DOMINIO_SITO . "/VisitaProfiloUtente&id=%s";
        } else if ($destination =="CONTROVERSIAMOD"){
            return DOMINIO_SITO . "/ControversiaMod&id=%s";
        }
    }
}
