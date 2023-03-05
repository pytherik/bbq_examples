<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <title>Spiel mit Checkboxen</title>
</head>
<body>
<?php
require 'code/class/class_farb_quiz.php';

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
    <h1>Farb Quiz</h1>
  </caption>
  <tr>
    <td>
      <img src="bilder/farbraetsel/tuerkis.PNG" alt="Farbrätsel 1" width="400" height="250">
    </td>
  </tr>
  <tr>	
    <td>
      <p>Finde die richtige Farbkombination - Bitte auswählen:</p>
    </td>
  </tr>
  <form method="post">
  <tr>
    <td>
      <input type="checkbox" name="farbe_1" value="rot" <?php if ($game->gameOver==1) echo "disabled"; ?>>Rot
    </td>
  </tr>  
  <tr>
    <td>
      <input type="checkbox" name="farbe_2" value="gruen" <?php if ($game->gameOver==1) echo "disabled"; ?>>Grün
      </td>
  </tr>  
  <tr>
    <td>
      <input type="checkbox" name="farbe_3" value="blau" <?php if ($game->gameOver==1) echo "disabled"; ?>>Blau
    </td>
  </tr>  
  <tr>
    <td>
<?php 
    if (!$game->gameOver==1) {
      echo "<input type='submit' name='submit' value='Absenden'>";
    }
?> 
    </td>
  </tr>  
  <tr>
    <td>
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
        if (isset($_POST["submit"])) {
            echo "<tr><td>";
            echo $game->nutzerHinweis;
            echo "</td></tr>";
        }
    ?>

</body>
</html>
