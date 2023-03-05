<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Quiz-Spiel</title>
<?php  
    $file = 'code/strikes/strikes.txt';
    if (isset($_POST['quizAuswahl'])) {
        header('Location:menueauswahl.php');
        unlink($file);
        exit;
    }
?>
</head>
<body>
<?php
    $maxStrikes = 3;
    $gameOver=0;
?>

<form method="post">
    <table align="center">
        <caption>
            <h1>Wort Quiz</h1>
        </caption>
        <tr>
            <td> 
                <p>Welche Farbe hat der Himmel?</P>
            </td>
        </tr>
        <?php

// Überprüfen, ob Formular abgesendet wurde
if (isset($_POST['submit'])) {
echo "<tr><td>";
// Überprüfen, ob Antwortfeld nicht leer ist
if (!empty($_POST['answer'])) {
    $answer = $_POST['answer'];

    // Überprüfen, ob Antwort richtig ist und strike.txt löschen
    if (strtolower($answer) === "blau") {
        echo "Korrekt!<br>";
        $gameOver=1;
        if (file_exists($file)) {
            unlink($file);
        }
    } else {
        echo "Falsch!<br>";

        // Überprüfen, ob die Datei bereits existiert
        if (file_exists($file)) {
            // Öffnen der Datei für Hinzufügen am Ende
            $datei_handhabung = fopen($file, 'a');
        } else {
            // Erstelle neue Datei
            $datei_handhabung = fopen($file, 'w');
        }

        // Schreibe Strike in Datei
        fwrite($datei_handhabung, "strike\n");

        // Schließe Datei
        fclose($datei_handhabung);

        // Zähle Strikes in Datei
        $strikeCount=0;
        $datei_handhabung = fopen($file, 'r');
        while (!feof($datei_handhabung)) {
            $line = trim(fgets($datei_handhabung));
            if (!empty($line)) {
                $strikeCount++;
            }
        }
        fclose($datei_handhabung);
        // Überprüfen, ob das Maximum an Strikes erreicht wurde
        if ($strikeCount >= $maxStrikes) {
            echo "Game Over!<br>";
            unlink($file);
            $gameOver=1;
        } else {
            echo "Noch " . ($maxStrikes - $strikeCount) . " Versuche übrig.<br>";
        }
    }
} else {
    echo "Fehler: Antwortfeld ist leer.<br>";
}
echo "</td></tr>";
}
?>        

        <tr>
            <td> 
                <input type="text" name="answer" <?php if ($gameOver==1) echo "disabled"; ?>>
            </td>
        </tr>
        <?php if ($gameOver!=1) { ?>
            <tr>
                <td> 
                    <input type="submit" name="submit" value="Antworten">
                </td>
            </tr>
        <?php
        }else{
            echo "<tr><td>";
            echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
            echo "<input type='submit' name='neustart_btn' value='Neustarten'>";
            echo "</form>";
            echo "</td></tr>";
        }
        ?>
                    <tr>
                        <td>
                            <form method='post' action='http://localhost/quiz/menueauswahl.php'>
                                <input type='submit' name="quizAuswahl"value='Quiz Auswahl'>
                            </form>
                        </td>
                    </tr>

    </table> 
</form>
</body>
</html>
