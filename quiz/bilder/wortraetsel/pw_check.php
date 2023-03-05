
<form method="post">
    <div>
        <label>
        Passwort: <input type="password" name="password">
        </label>
    </div>
    <input type="submit" value="Absenden">
</form>

<?php

// Überprüfen, ob die Anfrage eine POST-Anfrage ist
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Einbinden der Klasse "PasswordValidator"
    require '../../code/class/class_pw.php';

    // Übernehmen des Passworts aus dem POST-Array
    $password = $_POST['password'];

    // Instanziierung eines Objekts von "PasswordValidator" mit dem Passwort
    $validator = new PasswordValidator($password);

    // Überprüfen, ob das Passwort die Anforderungen erfüllt
    if ($validator->validate()) {
        // Ausgabe, dass das Passwort die Anforderungen erfüllt
        echo 'Das Passwort erfüllt alle Anforderungen.';
    } else {
        // Ausgabe, dass das Passwort die Anforderungen nicht erfüllt
        echo 'Das Passwort erfüllt nicht alle Anforderungen:<br>';
        // Durchlaufen der Fehlermeldungen
        foreach ($validator->getErrors() as $error) {
            // Ausgabe jeder Fehlermeldung
            echo "- $error<br>";
        }
    }
}
?>

