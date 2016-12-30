<?php

class NotificationParsing
{
    const RISOLUZIONE_POSITIVA = "Il tuo %s è stato valutato con esito postivo.";
    const RISOLUZIONE_NEGATIVA = "Il tuo %s è stato valutato con esito negativo.";
    const INSERIMENTO_ANNUNCIO = "È stato inserito un nuovo annuncio in una categoria di interesse.";
    const INSERIMENTO_FEEDBACK = "È stato inserito un nuovo feedback relativo al tuo annuncio: %s .";
    const INSERIMENTO_COMMENTO = "È stato inserito un nuovo commento relativo al tuo annuncio: %s .";
    const INSERIMENTO_CANDIDATURA = "È stato inserita una nuova candidatura al tuo annuncio: %s .";
    const DECISIONE_CANDIDATURA_DOMANDA_ACCETTATA = "È stata accetta la tua candidatura relativa all'annuncio: %s.";
    const DECISIONE_CANDIDATURA_DOMANDA_RIFIUTATA = "È stata rifiutata la tua candidatura relativa all'annuncio: %s.";
    const MOD_SEGNALAZIONE_FEEDBACK_E_COMMENTO = "Il %s dell'annuncio %s è stato segnalato.";
    const MOD_SEGNALAZIONE_UTENTE = "L'utente %s è stato segnalato.";
    const MOD_SEGNALAZIONE_ANNUNCIO = "L'annuncio %s è stato segnalato.";
    const ADM_CONTROVERSIA_TRA_MOD = "È stata aperta una nuova controversia tra moderatori.";

    public function __construct()
    {

    }

    /**This function return a list of notify-object formatted by the role of user.
     *
     * @param $notifyObject
     * @param $typeUser
     *
     * @return array
     */
    public function formattingNotify($notifyObject, $typeUser)
    {
        $size = sizeof($notifyObject);

        if ($typeUser == RuoloUtente::UTENTE) {
            $result = array();
            for ($i = 0; $i < $size; $i++) {

                $type = $notifyObject[$i]->getTipo();
                $infoNotify = json_decode($notifyObject[$i]->getInfo(), true);

                if ($type == tipoNotifica::INSERIMENTO) {

                    $obj = $infoNotify[ElementiInfoNotifica::TIPO_OGGETTO];
                    $id = $infoNotify[ElementiInfoNotifica::ID_OGGETTO];

                    if ($obj == SoggettiNotifiche::ANNUNCIO) {
                        $href = $this->rounting(SoggettiNotifiche::ANNUNCIO);
                        $href = sprintf($href, $id);
                        $result[$href] = NotificationParsing::INSERIMENTO_ANNUNCIO;
                    } else if ($obj == SoggettiNotifiche::COMMENTO) {
                        $href = $this->rounting(SoggettiNotifiche::COMMENTO);
                        $href = sprintf($href, $id);
                        $referName = $infoNotify[ElementiInfoNotifica::NOME_OGGETTO];
                        $result[$href] = sprintf(NotificationParsing::INSERIMENTO_COMMENTO, $referName);
                    } else if ($obj == SoggettiNotifiche::FEEDBACK) {
                        $href = $this->rounting(SoggettiNotifiche::FEEDBACK);
                        $href = sprintf($href, $id);
                        $referName = $infoNotify[ElementiInfoNotifica::NOME_OGGETTO];
                        $result[$href] = sprintf(NotificationParsing::INSERIMENTO_FEEDBACK, $referName);
                    } else if ($obj == SoggettiNotifiche::CANDIDATURA) {
                        $href = $this->rounting(SoggettiNotifiche::CANDIDATURA);
                        $href = sprintf($href, $id);
                        $referName = $infoNotify[ElementiInfoNotifica::NOME_OGGETTO];
                        $result[$href] = sprintf(NotificationParsing::INSERIMENTO_CANDIDATURA, $referName);
                    }

                } else if ($type == tipoNotifica::RISOLUZIONE) {

                    $obj = $infoNotify[ElementiInfoNotifica::TIPO_OGGETTO];
                    $id = $infoNotify[ElementiInfoNotifica::ID_OGGETTO];
                    $esit = $infoNotify[ElementiInfoNotifica::ESITO_OGGETTO];

                    if ($obj == SoggettiNotifiche::ANNUNCIO) {
                        $href = $this->rounting(SoggettiNotifiche::ANNUNCIO);
                        $href = sprintf($href, $id);
                        if ($esit == true) {
                            $result[$href] = sprintf(NotificationParsing::RISOLUZIONE_POSITIVA, "annuncio");
                        } else if ($esit == false) {
                            $result[$href] = sprintf(NotificationParsing::RISOLUZIONE_NEGATIVA, "annuncio");
                        }

                    } else if ($obj == SoggettiNotifiche::COMMENTO) {
                        $href = $this->rounting(SoggettiNotifiche::COMMENTO);
                        $href = sprintf($href, $id);
                        if ($esit == true) {
                            $result[$href] = sprintf(NotificationParsing::RISOLUZIONE_POSITIVA, "commento");
                        } else if ($esit == false) {
                            $result[$href] = sprintf(NotificationParsing::RISOLUZIONE_NEGATIVA, "commento");
                        }

                    } else if ($obj == SoggettiNotifiche::FEEDBACK) {
                        $href = $this->rounting(SoggettiNotifiche::FEEDBACK);
                        $href = sprintf($href, $id);
                        if ($esit == true) {
                            $result[$href] = sprintf(NotificationParsing::RISOLUZIONE_POSITIVA, "feedback");
                        } else if ($esit == false) {
                            $result[$href] = sprintf(NotificationParsing::RISOLUZIONE_NEGATIVA, "feedback");
                        }

                    }

                } else if ($type == tipoNotifica::DECISIONE) {

                    $obj = $infoNotify[ElementiInfoNotifica::TIPO_OGGETTO];
                    $id = $infoNotify[ElementiInfoNotifica::ID_OGGETTO];
                    $esit = $infoNotify[ElementiInfoNotifica::ESITO_OGGETTO];
                    $referName = $infoNotify[ElementiInfoNotifica::NOME_OGGETTO];

                    if ($obj == SoggettiNotifiche::CANDIDATURA) {
                        $href = $this->rounting(SoggettiNotifiche::CANDIDATURA);
                        $href = sprintf($href, $id);
                        if ($esit == true) {
                            $result[$href] = sprintf(NotificationParsing::DECISIONE_CANDIDATURA_DOMANDA_ACCETTATA, $referName);
                        } else if ($esit == false) {
                            $result[$href] = sprintf(NotificationParsing::DECISIONE_CANDIDATURA_DOMANDA_RIFIUTATA, $referName);
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

                    $obj = $infoNotify[ElementiInfoNotifica::TIPO_OGGETTO];
                    $id = $infoNotify[ElementiInfoNotifica::ID_OGGETTO];
                    $referName = $infoNotify[ElementiInfoNotifica::NOME_OGGETTO];

                    if ($obj == SoggettiNotifiche::ANNUNCIO) {
                        $href = $this->rounting(SoggettiNotifiche::SEGNALAZIONE_ANNUNCIO);
                        $href = sprintf($href, $id);
                        $result[$href] = sprintf(NotificationParsing::MOD_SEGNALAZIONE_ANNUNCIO, $referName);
                    } else if ($obj == SoggettiNotifiche::COMMENTO) {
                        $href = $this->rounting(SoggettiNotifiche::SEGNALAZIONE_COMMENTO);
                        $href = sprintf($href, $id);
                        $result[$href] = sprintf(NotificationParsing::MOD_SEGNALAZIONE_FEEDBACK_E_COMMENTO, "commento", $referName);
                    } else if ($obj == SoggettiNotifiche::FEEDBACK) {
                        $href = $this->rounting(SoggettiNotifiche::SEGNALAZIONE_FEEDBACK);
                        $href = sprintf($href, $id);
                        $result[$href] = sprintf(NotificationParsing::MOD_SEGNALAZIONE_FEEDBACK_E_COMMENTO, "feedback", $referName);
                    } else if ($obj == SoggettiNotifiche::UTENTE) {
                        $href = $this->rounting(SoggettiNotifiche::SEGNALAZIONE_UTENTE);
                        $href = sprintf($href, $id);
                        $result[$href] = sprintf(NotificationParsing::MOD_SEGNALAZIONE_UTENTE, $referName);
                    }
                }
            }
            return $result;

        } else if ($typeUser == RuoloUtente::AMMINISTRATORE) {
            $result = array();

            for ($i = 0; $i < $size; $i++) {
                $type = $notifyObject[$i]->getTipo();
                $infoNotify = json_decode($notifyObject[$i]->getInfo(), true);

                if ($type == tipoNotifica::SEGNALAZIONE) {

                    $obj = $infoNotify[ElementiInfoNotifica::TIPO_OGGETTO];
                    $id = $infoNotify[ElementiInfoNotifica::ID_OGGETTO];
                    $referName = $infoNotify[ElementiInfoNotifica::NOME_OGGETTO];

                    if ($obj == SoggettiNotifiche::ANNUNCIO) {
                        $href = $this->rounting(SoggettiNotifiche::SEGNALAZIONE_ANNUNCIO);
                        $href = sprintf($href, $id);
                        $result[$href] = sprintf(NotificationParsing::MOD_SEGNALAZIONE_ANNUNCIO, $referName);
                    } else if ($obj == SoggettiNotifiche::COMMENTO) {
                        $href = $this->rounting(SoggettiNotifiche::SEGNALAZIONE_COMMENTO);
                        $href = sprintf($href, $id);
                        $result[$href] = sprintf(NotificationParsing::MOD_SEGNALAZIONE_FEEDBACK_E_COMMENTO, "commento", $referName);
                    } else if ($obj == SoggettiNotifiche::FEEDBACK) {
                        $href = $this->rounting(SoggettiNotifiche::SEGNALAZIONE_FEEDBACK);
                        $href = sprintf($href, $id);
                        $result[$href] = sprintf(NotificationParsing::MOD_SEGNALAZIONE_FEEDBACK_E_COMMENTO, "feedback", $referName);
                    } else if ($obj == SoggettiNotifiche::UTENTE) {
                        $href = $this->rounting(SoggettiNotifiche::SEGNALAZIONE_UTENTE);
                        $href = sprintf($href, $id);
                        $result[$href] = sprintf(NotificationParsing::MOD_SEGNALAZIONE_UTENTE, $referName);
                    } else if ($obj == SoggettiNotifiche::CONTROVERSIA_MOD) {
                        $href = $this->rounting(SoggettiNotifiche::CONTROVERSIA_MOD);
                        $href = sprintf($href, $id);
                        $result[$href] = sprintf(NotificationParsing::ADM_CONTROVERSIA_TRA_MOD);
                    }
                }
            }
            return $result;
        }
    }

    /**This function return a standard link to page
     *
     * @param $destination
     * @return string
     */
    private function rounting($destination)
    {
        if ($destination == SoggettiNotifiche::ANNUNCIO) {
            return DOMINIO_SITO . "/Annuncio&id=%s";

        } else if ($destination == SoggettiNotifiche::COMMENTO) {
            return DOMINIO_SITO . "/Annuncio&id=%s";

        } else if ($destination == SoggettiNotifiche::FEEDBACK) {
            return DOMINIO_SITO . "/Feedback&id=%s";

        } else if ($destination == SoggettiNotifiche::CANDIDATURA) {
            return DOMINIO_SITO . "/Annuncio=%s";

        } else if ($destination == SoggettiNotifiche::UTENTE) {
            return DOMINIO_SITO . "/VisitaProfiloUtente&id=%s";

        } else if ($destination == SoggettiNotifiche::CONTROVERSIA_MOD) {
            return DOMINIO_SITO . "/ControversiaMod&id=%s";

        } else if ($destination == SoggettiNotifiche::SEGNALAZIONE_UTENTE) {
            return DOMINIO_SITO . "/VisualizzaUtentiSegnalati&id=%s";

        } else if ($destination == SoggettiNotifiche::SEGNALAZIONE_ANNUNCIO) {
            return DOMINIO_SITO . "/VisualizzaAnnunciSegnalati&id=%s";

        } else if ($destination == SoggettiNotifiche::SEGNALAZIONE_COMMENTO) {
            return DOMINIO_SITO . "/VisualizzaCommentiSegnalati&id=%s";

        } else if ($destination == SoggettiNotifiche::SEGNALAZIONE_FEEDBACK) {
            return DOMINIO_SITO . "/VisualizzaFeedbackSegnalati&id=%s";
        }
    }
}