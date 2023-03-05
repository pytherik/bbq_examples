<?php
// Diese Klasse definiert das Spiel
class Game {
  // Anzahl der Strike (Fehlversuche)
  private $strikes;
  // Maximale Anzahl an Strikes, bevor das Spiel beendet wird
  private $maxStrikes = 3;
  // Name des Cookies, das die Anzahl der Strikes speichert
  private $cookieName;

  // Variablen, die den Zustand des Spiels speichern
  public $gameOver;
  public $nutzerHinweis;

  // Konstruktor, wird bei der Erstellung eines neuen Spiels aufgerufen
  public function __construct() {
    // Setze den Namen des Cookies
    $this->cookieName = "strikes";

    // Überprüfe, ob das Cookie bereits gesetzt ist
    if (isset($_COOKIE[$this->cookieName])) {
      // Konvertiere den Wert des Cookies in eine Zahl und speichere es in $strikes
      $this->strikes = intval($_COOKIE[$this->cookieName]);
    } else {
      // Falls das Cookie nicht gesetzt ist, setze die Anzahl der Strikes auf 0
      $this->strikes = 0;
    }
  }

// Die Funktion restart, um das Spiel neu zu starten
public function restart() {
  // Setzen des Cookies auf 0 mit einer Lebensdauer von 1 Stunde
  setcookie($this->cookieName, 0, time() + 3600);
}

// Private Funktion zum Löschen des Cookies
private function delete_cookie() {
  // Löschen des Cookies
  setcookie($this->cookieName, "", 1);
}

  // Die Funktion play, um das Spiel zu spielen
  public function play() {

    // Prüfen, ob der Nutzer eine Antwort ausgewählt hat
    if (isset($_POST["answer"])) {
    // Prüfen, ob die Antwort "true" ist
      if ($_POST["answer"] == "true") {
      // Benachrichtigung für den Nutzer ausgeben, dass er die richtige Antwort ausgewählt hat
      $this->nutzerHinweis = "Glückwunsch! Richtige Antwort";
      // Löschen des Cookies
      $this->delete_cookie();
      // Setzen des gameOver-Flags auf 1, um anzuzeigen, dass das Spiel beendet ist
      $this->gameOver = 1;
    
      // Wenn die Antwort nicht "true" ist
      }else {                     
      // Anzahl der Fehlversuche um 1 erhöhen
      $this->strikes++;
      // Wenn die Anzahl der Fehlversuche 3 erreicht hat
      if ($this->strikes >= 3) {
        // Benachrichtigung für den Nutzer ausgeben, dass das Spiel beendet ist
        $this->nutzerHinweis = "Game Over";
        // Setzen des gameOver-Flags auf 1, um anzuzeigen, dass das Spiel beendet ist
        $this->gameOver = 1;
        // Löschen des Cookies
        $this->delete_cookie();

      // Wenn die Anzahl der Fehlversuche kleiner als 3 ist
      }else {
        // Speichern der Anzahl der Fehlversuche im Cookie
        setcookie($this->cookieName, $this->strikes, time() + 3600);
        // Benachrichtigung für den Nutzer ausgeben, wie viele Versuche er noch hat
        $this->nutzerHinweis = "Du hast noch " . ($this->maxStrikes - $this->strikes) . " Versuche";
      }
    }
    }
    // Prüfen, ob der Nutzer auf den "Absenden"-Button geklickt hat, ohne eine Antwort auszuwählen
    elseif(isset($_POST["absenden"])){
      // Benachrichtigung für den Nutzer ausgeben, dass er eine Auswahl treffen muss
      $this->nutzerHinweis = "Bitte triff EINE Auswahl";

    // Prüfen, ob der Nutzer auf den "Quiz-Auswahl"-Button geklickt hat
    }elseif(isset($_POST["quizAuswahl"])){
      // Löschen des Cookies
      $this->delete_cookie();
      // Weiterleitung zur Seite "menueauswahl.php"
      header("Location: menueauswahl.php");
      // Beenden des Skripts
      exit;
    }
  }


}
?>