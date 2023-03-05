<!DOCTYPE html>
<html>
	<head>
		<title>Quiz Rätsel</title>
	</head>
<body>
<table border="1px solid black" align="center">
	<caption>
		<h1>Wähle ein Quiz</h1>
	</caption>
  	<tr>
    	<td>
			<img src="bilder/vorschaubilder/thumbnail_1.png" alt="Bilderrätsel" width="400" height="250">
		</td>
        <td>
			<img src="bilder/vorschaubilder/thumbnail_2.jpg" alt="Farbenmischen" width="400" height="250">
		</td>
    	<td>
			<img src="bilder/vorschaubilder/thumbnail_3.jpg" alt="Wortquiz" width="400" height="250">
		</td>
  	</tr>
	<tr>	
		<td>
			<p>Hier findest du Bilderrätsel</p>
		</td>
        <td>
			<p>Hier findest du Farbmischrätsel</p>
        </td>
        <td>
			<p>Hier findest du Worträtsel</p>
		</td>
    <form method="get" action="quiz.php">
        </tr>	
            <td>
                <input type="submit" name="auswahl_1" value="Bilderquiz Starten">
            </td>
            <td>
                <input type="submit" name="auswahl_2" value="Farbenquiz Starten">
            </td>
            <td>
                <input type="submit" name="auswahl_3" value="Wortquiz Starten">
            </td>
        </tr>
	</form>
</table>
</body>
</html>
