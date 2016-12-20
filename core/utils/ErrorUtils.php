<?php

/**
 * @author Fabiano Pecorelli
 * @version 1.0
 * @since 30/05/16
 */
class ErrorUtils {

    public static $VALORE_DUPLICATO = "Impossibile inserire nel database, riga gia esistente";
    public static $INSERIMENTO_FALLITO = "Impossibile inserire nel database";
    public static $AGGIORNAMENTO_FALLITO = "Impossibile aggiornare il database";
    public static $CANCELLAZIONE_FALLITA = "Impossibile cancellare dal database";
    public static $CONTATTO_NON_TROVATO = "Nessun contatto trovato";
    public static $ELABORATO_NON_TROVATO = "Nessun elaborato trovato";
    public static $RISPOSTA_NON_TROVATA = "Nessuna risposta trovata";
    public static $NO_APERTE = "L'elaborato non ha risposte aperte";
    public static $CDL_NON_TROVATO = "Nessun corso di laurea trovato";
    public static $CORSO_NON_TROVATO = "Nessun corso trovato";
    public static $INSEGNAMENTO_NON_TROVATO = "Nessun insegnamento trovato";
    public static $SESSIONE_NON_TROVATA = "Nessuna sessione trovata";
    public static $STUDENTE_NON_TROVATO = "Nessuno studente trovato";
    public static $TEST_NON_TROVATO = "Nessun test trovato";
    public static $ARGOMENTO_NON_TROVATO = "Nessun argomento trovato";
    public static $DOMANDA_APERTA_NON_TROVATA = "Nessuna domanda aperta trovata";
    public static $DOMANDA_MULTIPLA_NON_TROVATA = "Nessuna domanda mutlipla trovata";
    public static $ALTERNATIVA_NON_TROVATA = "Nessuna alternativa trovata";


    /*
     * Account model exceptions
     */

    public static $UTENTE_NON_TROVATO = "Utente non trovato";
    public static $EMAIL_NON_VALIDA = "L'email inserita non è corretta";
    public static $PASS_CORTA = "Lunghezza password non valida";
    public static $MATRICOLA_INESISTENTE = "Matricola inesistente";
    public static $NOME_NON_VALIDO = "Nome non valido";
    public static $CONGNOME_NON_VALIDO = "Cognome non valido";
    public static $TIPO_UTENTE_ERRATO = "Tipo utente errato";
    public static $EMAIL_ESISTE = "Utente con questa e-mail esiste già";
}

?>
