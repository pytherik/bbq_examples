<?php
require 'code/class/class_bilder_quiz.php';

if (isset($_POST["restart"])) {
  $game = new Game();
  $game->restart();
} else {
  $game = new Game();
}

$game->play();
?>

<table border="1px solid black" align="center">
    <caption>
        <h1>Bilder Quiz</h1>
    </caption>
    <tr>
        <td>
            <img src="bilder/bilderraetsel/bilder_raetsel_1.png" alt="Bilderrätsel 1" width="400" height="250">
        </td>
    </tr>
    <tr>	
        <td>
            <p>Hier sind deine Antwortmöglichkeiten - Bitte auswählen:</p>
        </td>
    </tr>
    <form method="post">
    <tr>
        <td>
            <label><input type="radio" name="answer" value="false1" <?php if ($game->gameOver==1) echo "disabled"; ?>>Affenbrotbaum</label>
        </td>
    </tr>
    <tr>
        <td>
            <label><input type="radio" name="answer" value="false2" <?php if ($game->gameOver==1) echo "disabled"; ?>>Der blinde Schiedsrichter steht im Wald</label>
        </td>
    </tr>
    <tr>
        <td>
            <label><input type="radio" name="answer" value="true" <?php if ($game->gameOver==1) echo "disabled"; ?>>Den Wald vor lauter Bäumen nicht sehen</label>
        </td>
    </tr>
    <tr>
        <td>
            <label><input type="radio" name="answer" value="false3" <?php if ($game->gameOver==1) echo "disabled"; ?>>Da liegt der Hase im Pfeffer</label>
        </td>
    </tr>
    <tr>
        <td>
            <?php 
                if (!$game->gameOver==1) {
                echo "<input type='submit' name='absenden' value='Absenden'>";
                }
            ?> 
                <input type="submit" name="restart" value="Neustart">
        </td>
    </tr>
    <tr>
        <td>
                <input type='submit' name="quizAuswahl" value='Quiz Auswahl'>
        </td>
    </tr>
    </form>        

    <?php
        if (isset($_POST["absenden"])) {
            echo "<tr><td>";
            echo $game->nutzerHinweis;
            echo "</td></tr>";
        }
    ?>
</table>

