<div class="header"><h2>Passworträtsel</h2></div>
<div class="container">
  <div class="small-container">
    <div class="form-container">
      <h2>Passworteingabe</h2>
      <p>dein Passwort muss 8 - 12 Zeichen lang sein, mindestens ein Sonderzeichen, eine Zahl und einen Großbuchstaben enthalten.</p>
      <form method="POST">
        <div class="check-input">
          <input type="text" name="word" placeholder="Passwort" required autocomplete="off" autofocus>
        </div>
        <div class="check-input">
          <button id="pwbutton" type="submit">so isses</button>
        </div>
      </form>
    </div>
    <div class="header">

<?php

checkTime();

if (!isset($_COOKIE[$cookie_name])) {
  $cookie_name = $cookie_name;
  $cookie_val = 0;
  setcookie($cookie_name, $cookie_val, time() + 120);
}

$tries_left = $max_tries - $_COOKIE[$cookie_name];
echo "noch $tries_left Versuch(e)";

//: Eingabe wurde abgeschickt
if (isset($_POST['word'])) {         
  $word = $_POST['word'];
    
  function inc_cookie_val($cookie_name, $max_tries) {
    $cookie_val = $_COOKIE[$cookie_name];
    $cookie_val++;
    if ($cookie_val > $max_tries) {
      setcookie($cookie_name, 1, time() - 120);
      $status = 'lose';
      include('./game_over.php');
    } else {
      setcookie($cookie_name, $cookie_val, time() + 120);
    }
    return $cookie_val;
  } 
  
  //: regex patterns                         
  $hasCapital = "/^.*[A-Z].*$/";
  $hasCorrectLength = "/^.{8,12}$/";
  $containsNumber = "/^.*[0-9].*$/";
  $hasSpecialChar = "/^.*[^A-Za-z0-9\s].*$/"; 
  $perfectMatch = "/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[^A-Za-z0-9\ ])(?=\S*[\d])\S*$/";
  
  //: Vergleich der patterns mit Eingabe
  if (!preg_match($perfectMatch, $word) == 1){
    $cookie_val = inc_cookie_val($cookie_name, $max_tries);
    if (preg_match($hasCapital, $word) == 0) {
      echo "<h3>Großbuchstabe fehlt!</h3>";
    } else if (preg_match($hasCorrectLength, $word) == 0) {
      echo "<h3>bitte 8-12 Buchstaben!</h3>";
    } else if (preg_match($containsNumber, $word) == 0) {
      echo "<h3>Keine Zahl drin!</h3>";
    } else if (preg_match($hasSpecialChar, $word) == 0) {
      echo "<h3>Kein Sonderzeichen drin!</h3>";
    }
  } else {
    echo "<h3>Passwort okay!</h3>";
    $status = 'win';
    setcookie($cookie_name, 1, time() - 120);
    include('./game_over.php');
  }
}

?>
  
    </div>
  </div>
</div>