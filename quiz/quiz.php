<!DOCTYPE html>
<html>
	<head>
		<title>Willkommen im Quiz</title>
	</head>
<body>
    <?php
    /* PHP AUF */

        // Default Wert für die SWITCH-Anweisung vorbereiten
        $auswahl = "<h1>! Hier findest du erst ein Quiz bei getätigter Auswahl im Menü !</h1>";

        // Superglobale Variable $_GET mittels Schleife auslesen
        // wenn ein Wert gesetzt ist, dann der Variable $auswahl zuweisen 
        foreach($_GET as $value){
            if (isset($value)){
                $auswahl = $value;
            }
        }
        //SWITCH-Anwesiung, welche mittels der Variable $auswahl das jeweilige Spiel aktiviert
        switch ($auswahl) {

            // Fall *** Bilderquiz Starten ***
            case "Bilderquiz Starten":
                include 'code/bilder_raetsel.php'; 
                break;                                                                                          //STOP für Fall *** Bilderquiz Starten ***

            // Fall *** Farbquiz Starten ***
            case "Farbenquiz Starten":
                include 'code/farb_raetsel.php';
                break;                                                                                          //STOP für Fall *** Farbquiz Starten ***

            // Fall *** Wortquiz Starten ***
            case "Wortquiz Starten":
                include 'code/wort_raetsel.php';
                break;                                                                                          //STOP für Fall *** Wortquiz Starten ***

            // DEFAULT Wert setzen, wenn OHNE Auswahl die quiz.php Seite aufgerufen wird
            default:
                echo "<table>";
                    echo "<tr>";
                        echo "<td>";
                            echo $auswahl . "<h2>Kehre zurück zur Quizauswahl</h2>";
                        echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td>";
                            echo "<form method='post' action='menueauswahl.php'>";
                                echo "<input type='submit' value='Quiz Auswahl'>";
                            echo "</form>";
                        echo "</td>";
                    echo "</tr>";
                echo "</table>";
        }
    /* PHP ZU */
    ?>   
</body>
</html>
