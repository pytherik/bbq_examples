<?php

// Klasse "PasswordValidator" für die Überprüfung von Passwörtern
class PasswordValidator
{
    // Private Variable zum Speichern des Passworts
    private $password;
    // Private Array zum Speichern von Fehlermeldungen
    private $errors = array();

    // Konstruktor, der bei der Instanziierung des Objekts das Passwort übernimmt
    public function __construct($password)
    {
        $this->password = $password;
    }

    // Methode zur Überprüfung des Passworts auf Anforderungen
    public function validate()
    {
        // Überprüfen, ob das Passwort mindestens 8 Zeichen hat
        if (strlen($this->password) < 8) {
            $this->errors[] = 'Das Passwort muss mindestens 8 Zeichen enthalten.';
        }

        // Überprüfen, ob das Passwort mindestens einen Kleinbuchstaben enthält
        if (!preg_match('/[a-z]/', $this->password)) {
            $this->errors[] = 'Das Passwort muss mindestens einen Kleinbuchstaben enthalten.';
        }

        // Überprüfen, ob das Passwort mindestens einen Großbuchstaben enthält
        if (!preg_match('/[A-Z]/', $this->password)) {
            $this->errors[] = 'Das Passwort muss mindestens einen Großbuchstaben enthalten.';
        }

        // Überprüfen, ob das Passwort mindestens eine Zahl enthält
        if (!preg_match('/\d/', $this->password)) {
            $this->errors[] = 'Das Passwort muss mindestens eine Zahl enthalten.';
        }

        // Überprüfen, ob das Passwort mindestens ein Sonderzeichen enthält
        if (!preg_match('/[@$!%*?&]/', $this->password)) {
            $this->errors[] = 'Das Passwort muss mindestens ein Sonderzeichen enthalten.';
        }

        // Rückgabe, ob das Array mit Fehlermeldungen leer ist (das Passwort erfüllt alle Anforderungen)
        return empty($this->errors);
    }

    // Methode zur Rückgabe der Fehlermeldungen
    public function getErrors()
    {
        return $this->errors;
    }
}
?>
