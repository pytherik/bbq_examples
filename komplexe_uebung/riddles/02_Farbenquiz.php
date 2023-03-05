  <div class="header"><h3>Farbenrätsel</h3></div>
  <div class="small-container">
    <div class="small-box bg-green">
    </div>
    <div class="form-container">
      <p>Welche Farben muss man mischen um Grün zu erhalten?</p>
      <form method="POST">
        <div class="check-input">
          <label for="r">Rot</label>
          <input id="r" type="checkbox" name="r">
        </div>
        <div class="check-input">
          <label for="g">Gelb</label>
          <input id="y" type="checkbox" name="y">
        </div>
        <div class="check-input">
          <label for="b">Blau</label>
          <input id="b" type="checkbox" name="b">
        </div>
        <div class="check-input">
          <button type="submit">so isses</button>
        </div>
      </form>
    </div>
    <div class="header">

<?php

checkTime();

if (!isset($_SESSION['answers'])){
  // session_start();
  $_SESSION['answers'] = 0;
}

$tries_left = $max_tries - $_SESSION['answers'];
echo "noch $tries_left Versuch(e)";

if ($_SESSION['answers'] == $max_tries) {
  session_destroy();
  $status = 'lose';
  include('./game_over.php');
}

if (count($_POST) == 2) {
  if (isset($_POST['y']) && (isset($_POST['b']))) {
    echo "<h3>Richtig</h3>";
    $status = 'win';
    session_destroy();
    include('./game_over.php');
  } else {
    $_SESSION['answers']++;
    echo "<h3>Falsch</h3>";        
  }
} else {
    if(count($_POST) < 2){
      $_SESSION['answers']++;
      echo "<h3>bitte 2 Farben wählen!</h3>";
    } 
}
      
?>

    </div>
  </div>