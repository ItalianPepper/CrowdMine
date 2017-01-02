<?php

include_once MODEL_DIR . "NotifyViewListObject";
include_once MODEL_DIR . "Notifica.php";
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
     * @param $notifyObjects
     * @param $typeUser
     *
     * @return array
     */
    public function formattingNotify($notifyObjects, $typeUser)
    {
        $size = sizeof($notifyObjects);

        if ($typeUser == RuoloUtente::UTENTE) {
            $result = array();

            for ($i = 0; $i < $size; $i++) {

                $idNotify = $notifyObjects[$i]->getId();

                $type = $notifyObjects[$i]->getTipo();
                $read = $notifyObjects[$i]->getLetto();

                $infoNotify = json_decode($notifyObjects[$i]->getInfo(), true);

                if ($type == tipoNotifica::INSERIMENTO) {

                    $obj = $infoNotify[ElementiInfoNotifica::TIPO_OGGETTO];
                    $idobj = $infoNotify[ElementiInfoNotifica::ID_OGGETTO];

                    if ($obj == SoggettiNotifiche::ANNUNCIO) {


                        $href = $this->rounting(SoggettiNotifiche::ANNUNCIO);
                        $href = sprintf($href, $idobj);
                        $text = NotificationParsing::INSERIMENTO_ANNUNCIO;

                        $resObject = new NotifyViewListObject($idNotify,$href,$text,$read);

                        array_push($result,$resObject);

                    } else if ($obj == SoggettiNotifiche::COMMENTO) {

                        $href = $this->rounting(SoggettiNotifiche::COMMENTO);
                        $href = sprintf($href, $idobj);

                        $referName = $infoNotify[ElementiInfoNotifica::NOME_OGGETTO];
                        $text = sprintf(NotificationParsing::INSERIMENTO_COMMENTO, $referName);

                        $resObject = new NotifyViewListObject($idNotify,$href,$text,$read);

                        array_push($result,$resObject);

                    } else if ($obj == SoggettiNotifiche::FEEDBACK) {

                        $href = $this->rounting(SoggettiNotifiche::FEEDBACK);
                        $href = sprintf($href, $idobj);
                        $referName = $infoNotify[ElementiInfoNotifica::NOME_OGGETTO];
                        $text = sprintf(NotificationParsing::INSERIMENTO_FEEDBACK, $referName);

                        $resObject = new NotifyViewListObject($idNotify,$href,$text,$read);

                        array_push($result,$resObject);

                    } else if ($obj == SoggettiNotifiche::CANDIDATURA) {

                        $href = $this->rounting(SoggettiNotifiche::CANDIDATURA);
                        $href = sprintf($href, $idobj);
                        $referName = $infoNotify[ElementiInfoNotifica::NOME_OGGETTO];
                        $text = sprintf(NotificationParsing::INSERIMENTO_CANDIDATURA, $referName);

                        $resObject = new NotifyViewListObject($idNotify,$href,$text,$read);

                        array_push($result,$resObject);
                    }

                } else if ($type == tipoNotifica::RISOLUZIONE) {

                    $obj = $infoNotify[ElementiInfoNotifica::TIPO_OGGETTO];
                    $idobj = $infoNotify[ElementiInfoNotifica::ID_OGGETTO];
                    $esit = $infoNotify[ElementiInfoNotifica::ESITO_OGGETTO];

                    if ($obj == SoggettiNotifiche::ANNUNCIO) {

                        $href = $this->rounting(SoggettiNotifiche::ANNUNCIO);
                        $href = sprintf($href, $idobj);
                        $text = null;

                        if ($esit == true) {
                            $text = sprintf(NotificationParsing::RISOLUZIONE_POSITIVA, "annuncio");
                        } else {
                            $text = sprintf(NotificationParsing::RISOLUZIONE_NEGATIVA, "annuncio");
                        }

                        $resObject = new NotifyViewListObject($idNotify,$href,$text,$read);

                        array_push($result,$resObject);


                    } else if ($obj == SoggettiNotifiche::COMMENTO) {
                        $href = $this->rounting(SoggettiNotifiche::COMMENTO);
                        $href = sprintf($href, $idobj);
                        $text = null;

                        if ($esit == true) {
                            $text = sprintf(NotificationParsing::RISOLUZIONE_POSITIVA, "commento");
                        } else {
                            $text = sprintf(NotificationParsing::RISOLUZIONE_NEGATIVA, "commento");
                        }

                        $resObject = new NotifyViewListObject($idNotify,$href,$text,$read);

                        array_push($result,$resObject);

                    } else if ($obj == SoggettiNotifiche::FEEDBACK) {
                        $href = $this->rounting(SoggettiNotifiche::FEEDBACK);
                        $href = sprintf($href, $idobj);
                        $text = null;

                        if ($esit == true) {
                            $text = sprintf(NotificationParsing::RISOLUZIONE_POSITIVA, "feedback");
                        } else {
                            $text = sprintf(NotificationParsing::RISOLUZIONE_NEGATIVA, "feedback");
                        }

                        $resObject = new NotifyViewListObject($idNotify,$href,$text,$read);

                        array_push($result,$resObject);

                    }

                } else if ($type == tipoNotifica::DECISIONE) {

                    $obj = $infoNotify[ElementiInfoNotifica::TIPO_OGGETTO];
                    $idobj = $infoNotify[ElementiInfoNotifica::ID_OGGETTO];
                    $esit = $infoNotify[ElementiInfoNotifica::ESITO_OGGETTO];
                    $referName = $infoNotify[ElementiInfoNotifica::NOME_OGGETTO];

                    if ($obj == SoggettiNotifiche::CANDIDATURA) {

                        $href = $this->rounting(SoggettiNotifiche::CANDIDATURA);
                        $href = sprintf($href, $idobj);
                        $text = null;

                        if ($esit == true) {
                            $text = sprintf(NotificationParsing::DECISIONE_CANDIDATURA_DOMANDA_ACCETTATA, $referName);
                        } else {
                            $text = sprintf(NotificationParsing::DECISIONE_CANDIDATURA_DOMANDA_RIFIUTATA, $referName);
                        }

                        $resObject = new NotifyViewListObject($idNotify,$href,$text,$read);

                        array_push($result,$resObject);
                    }
                }
            }
            return $result;

        } else if ($typeUser == RuoloUtente::MODERATORE) {

            $result = array();

            for ($i = 0; $i < $size; $i++) {

                $idNotify = $notifyObjects[$i]->getId();

                $type = $notifyObjects[$i]->getTipo();
                $read = $notifyObjects[$i]->getLetto();

                $infoNotify = json_decode($notifyObjects[$i]->getInfo(), true);

                if ($type == tipoNotifica::SEGNALAZIONE) {

                    $obj = $infoNotify[ElementiInfoNotifica::TIPO_OGGETTO];
                    $id = $infoNotify[ElementiInfoNotifica::ID_OGGETTO];
                    $referName = $infoNotify[ElementiInfoNotifica::NOME_OGGETTO];

                    if ($obj == SoggettiNotifiche::ANNUNCIO) {

                        $href = $this->rounting(SoggettiNotifiche::SEGNALAZIONE_ANNUNCIO);
                        $href = sprintf($href, $id);
                        $text = sprintf(NotificationParsing::MOD_SEGNALAZIONE_ANNUNCIO, $referName);

                        $resObject = new NotifyViewListObject($idNotify,$href,$text,$read);
                        array_push($result,$resObject);

                    } else if ($obj == SoggettiNotifiche::COMMENTO) {
                        $href = $this->rounting(SoggettiNotifiche::SEGNALAZIONE_COMMENTO);
                        $href = sprintf($href, $id);
                        $text = sprintf(NotificationParsing::MOD_SEGNALAZIONE_FEEDBACK_E_COMMENTO, "commento", $referName);

                        $resObject = new NotifyViewListObject($idNotify,$href,$text,$read);
                        array_push($result,$resObject);
                    } else if ($obj == SoggettiNotifiche::FEEDBACK) {
                        $href = $this->rounting(SoggettiNotifiche::SEGNALAZIONE_FEEDBACK);
                        $href = sprintf($href, $id);
                        $text = sprintf(NotificationParsing::MOD_SEGNALAZIONE_FEEDBACK_E_COMMENTO, "feedback", $referName);

                        $resObject = new NotifyViewListObject($idNotify,$href,$text,$read);
                        array_push($result,$resObject);

                    } else if ($obj == SoggettiNotifiche::UTENTE) {
                        $href = $this->rounting(SoggettiNotifiche::SEGNALAZIONE_UTENTE);
                        $href = sprintf($href, $id);
                        $text = sprintf(NotificationParsing::MOD_SEGNALAZIONE_UTENTE, $referName);

                        $resObject = new NotifyViewListObject($idNotify,$href,$text,$read);
                        array_push($result,$resObject);
                    }
                }
            }
            return $result;

        } else if ($typeUser == RuoloUtente::AMMINISTRATORE) {

            $result = array();

            for ($i = 0; $i < $size; $i++) {

                $idNotify = $notifyObjects[$i]->getId();

                $type = $notifyObjects[$i]->getTipo();
                $read = $notifyObjects[$i]->getLetto();

                $infoNotify = json_decode($notifyObjects[$i]->getInfo(), true);

                if ($type == tipoNotifica::SEGNALAZIONE) {

                    $obj = $infoNotify[ElementiInfoNotifica::TIPO_OGGETTO];
                    $id = $infoNotify[ElementiInfoNotifica::ID_OGGETTO];
                    $referName = $infoNotify[ElementiInfoNotifica::NOME_OGGETTO];

                    if ($obj == SoggettiNotifiche::ANNUNCIO) {

                        $href = $this->rounting(SoggettiNotifiche::SEGNALAZIONE_ANNUNCIO);
                        $href = sprintf($href, $id);
                        $text = sprintf(NotificationParsing::MOD_SEGNALAZIONE_ANNUNCIO, $referName);

                        $resObject = new NotifyViewListObject($idNotify,$href,$text,$read);
                        array_push($result,$resObject);

                    } else if ($obj == SoggettiNotifiche::COMMENTO) {

                        $href = $this->rounting(SoggettiNotifiche::SEGNALAZIONE_COMMENTO);
                        $href = sprintf($href, $id);
                        $text = sprintf(NotificationParsing::MOD_SEGNALAZIONE_FEEDBACK_E_COMMENTO, "commento", $referName);

                        $resObject = new NotifyViewListObject($idNotify,$href,$text,$read);
                        array_push($result,$resObject);

                    } else if ($obj == SoggettiNotifiche::FEEDBACK) {

                        $href = $this->rounting(SoggettiNotifiche::SEGNALAZIONE_FEEDBACK);
                        $href = sprintf($href, $id);
                        $text = sprintf(NotificationParsing::MOD_SEGNALAZIONE_FEEDBACK_E_COMMENTO, "feedback", $referName);

                        $resObject = new NotifyViewListObject($idNotify,$href,$text,$read);
                        array_push($result,$resObject);

                    } else if ($obj == SoggettiNotifiche::UTENTE) {

                        $href = $this->rounting(SoggettiNotifiche::SEGNALAZIONE_UTENTE);
                        $href = sprintf($href, $id);
                        $text = sprintf(NotificationParsing::MOD_SEGNALAZIONE_UTENTE, $referName);

                        $resObject = new NotifyViewListObject($idNotify,$href,$text,$read);
                        array_push($result,$resObject);

                    } else if ($obj == SoggettiNotifiche::CONTROVERSIA_MOD) {

                        $href = $this->rounting(SoggettiNotifiche::CONTROVERSIA_MOD);
                        $href = sprintf($href, $id);
                        $text = sprintf(NotificationParsing::ADM_CONTROVERSIA_TRA_MOD);

                        $resObject = new NotifyViewListObject($idNotify,$href,$text,$read);
                        array_push($result,$resObject);
                    }
                }
            }
            return $result;
        }
    }

    /**This function return a standard link to page
     *
     * @param $destination
     * @return string, standard link to a page
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