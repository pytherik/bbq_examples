<?php
// Diese Klasse definiert das Spiel
class Game {
    //Anzahl der Versuche, die der Benutzer braucht, um die richtige Farbmischung zu erraten
    public $strikes;
    //Maximale Anzahl an Versuchen, bevor das Spiel beendet wird
    private $maxStrikes = 3;
    //Sitzungsschlüssel, der verwendet wird, um die Anzahl der Versuche zu speichern
    private $session_key = 'strikes';
    //Variable, die angibt, ob das Spiel vorbei ist
    public $gameOver;
    //Nachricht an den Benutzer, die angibt, ob seine Farbmischung richtig oder falsch ist
    public $nutzerHinweis;

    //Konstruktor-Funktion
    public function __construct() {
        //Überprüfung, ob eine Sitzung mit dem Namen "strikes" bereits existiert
        if (!isset($_SESSION[$this->session_key])) {
            //Erstellung einer neuen Sitzung "strikes" mit Wert 0
            $_SESSION[$this->session_key] = 0;
        }
    }

    //Funktion, die das Spiel neu startet
    public function restart() {
        //Löschen der vorhandenen Sitzung
        $this->delete_session();
        //Starten einer neuen Sitzung
        session_start();
    }

    //Funktion, die eine Sitzung löscht
    private function delete_session() {
        //Löschen der Sitzung
        session_destroy();
        //Leeren des $_SESSION-Arrays
        $_SESSION = array();
        //Überprüfung, ob Cookies zur Speicherung von Sitzungen verwendet werden
        if (ini_get("session.use_cookies")) {
            //Abrufen der Cookie-Parameter
            $params = session_get_cookie_params();
            //Löschen des Cookies
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
    }

public function play() {
    // Überprüft, ob das Formular abgeschickt wurde
    if (isset($_POST['submit'])) {

    // Zähler für die Anzahl der ausgewählten Farben
    $farbauswahl_zaehler = 0;
    
    // Array zur Speicherung der ausgewählten Farben
    $farbauswahl = array();
                /*  1. Superglobales Array $_POST durchlaufen
                    2. die einzelnen Werte in das array $farbauswahl an den Schlüsselwert $farbauswahl_zaehler zuweisen
                    3. $farbauswahl_zaehler inkrementieren */
                foreach ($_POST as $value){    
                    $farbauswahl[$farbauswahl_zaehler] = $value;
                    $farbauswahl_zaehler++;
                }
                
    // Überprüft, ob die richtigen Farben ausgewählt wurden
    if(array_key_exists(0,$farbauswahl) and array_key_exists(1,$farbauswahl)){
        if (!($farbauswahl[0] == "gruen" and $farbauswahl[1] == "blau")){
            
            // Falls die Farben nicht richtig ausgewählt wurden, wird ein Hinweis ausgegeben und die Anzahl der Versuche (strikes) inkrementiert
            $this->nutzerHinweis = "Deine Farben ergeben nicht die gewünschte Kombination";
            $this->strikes = ++$_SESSION[$this->session_key];

            }else{
                $this->nutzerHinweis = "Farbe wurde richtig gemischt";
                
                // Falls die Farben richtig ausgewählt wurden, ist das Spiel beendet
                $this->gameOver = 1;
                $this->delete_session();
            }
        }else{
    
            // Falls nicht mindestens 2 Farben ausgewählt wurden, wird ein Hinweis ausgegeben und die Anzahl der Versuche (strikes) inkrementiert
            $this->nutzerHinweis = "Eine Farbmischung besteht aus mindestens 2 Farben";
            $this->strikes = ++$_SESSION[$this->session_key];
        }  
    // Überprüft, ob das Quiz erneut ausgewählt wurde
    }elseif(isset($_POST["quizAuswahl"])){                          
            
        // Löscht die aktuelle Session und leitet zur Menüauswahl weiter
        $this->delete_session();
         header("Location: menueauswahl.php");
        exit;
    }   

    // Überprüft, ob die maximale anzahl an fehlversuchen erreicht ist, wenn ja = Game Over
    // inklusive löschen der session()
    if ($this->strikes >= $this->maxStrikes){{
        $this->nutzerHinweis = "Game Over";
        $this->delete_session();
        $this->gameOver = 1;
    }
    }
}
}
?>