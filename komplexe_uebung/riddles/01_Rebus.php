<div class="container">
  <table>
    <caption>
      <h1>Bilder Quiz</h1>
    </caption>
    <tr>
      <td>
        <img class='pic' src='public/images/rebus03.png' alt='pic 1'>
        <img class='pic' src='public/images/rebus02.png' alt='pic 2'>
        <img class='pic' src='public/images/rebus01.png' alt='pic 3'>
      </td>
    </tr>
    <tr>
      <td>
        <p>Such dir die schönste Antwort aus:</p>
        <hr>
      </td>
    </tr>
    <tr>
      <form method='POST'>

  <?php

  checkTime();
  //:  Array für alle Antwortmöglichkeiten
  $antworten = array(
    ' Antwörd 1' => 'falsch',
    ' Antwort 2' => 'richtig',
    ' Antword 3' => 'falsch',
    ' AntwÖrt 4' => 'falsch'
  );
  //: Variable für $_POST - array_key  
  $name = 'antwort_gruppe';

  //: create html table rows for answers
  foreach ($antworten as $key => $value) {
    echo "
          <tr>
            <td>
              <label>$key</label>
              </td>
              <td>
                <input type='radio' name=$name value=$value> 
            </td>
          </tr>";
  }

?>
    </tr>
    <tr>
      <td>
        <button type='submit'>antworten</button>
      </td>
    </tr>
    <tr>
      <td>

<?php

//: Auswertung der gesendeten Daten
if (!(is_file($answers_file))) {
  fopen($answers_file, 'w');
} else {
  $answers = fopen($answers_file, 'a');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!array_key_exists('antwort_gruppe', $_POST)) {
    echo "<h2>Du musst etwas auswählen!</h2>";
  } else {
    $inhalt = $_POST['antwort_gruppe'];
    if ($inhalt == 'falsch') {
      fwrite($answers, "$inhalt\n");
      echo "<h2>$inhalt 🤮 😡 🥴</h2>";
      $wrongCount = count(file($answers_file));
      if ($wrongCount == 3) {
        echo "<h2>zu viele falsche Antworten</h2>";
        unlink($answers_file);
        $status = 'lose';
        include('./game_over.php');
      }
    } else {
      unlink($answers_file);
      $status = 'win';
      include('./game_over.php');
      echo "<h2>$inhalt 🍬 🍺 🍰</h2>";
    }
  }
}

?>

      </td>
    </tr>
    </form>
  </table>
</div>