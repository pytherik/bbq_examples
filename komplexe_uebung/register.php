<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="./public/css/style.css">
    <title>quiz-register</title>
  </head>
  <body>
    <div class="page-container">
      <h1 class="header big-header">Konto erstellen</h1>

<?php

include('./connectDB.php');


$name ='';
$email = '';

$nameMSG = '';
$emailMSG = '';
$passMSG = '';


function checkName($name) {
  if (strlen($name) < 4) {
    $msg = "wähle einen längeren Namen!";
    return $msg;
  } else {
    try {
      $conn = conn_admin();
      $userExists = $conn->query("SELECT spielername FROM spieler WHERE spielername = '$name'");
      if (mysqli_num_rows($userExists) == 0){
        $conn->close();
        return true;
      } else {
        $conn->close();
        return "Dieser Name ist schon vergeben!";
      }
    } catch (Exception $e) {
        $conn->close();
        echo $e->getMessage();
    }
  }
}

function checkEmail($email) {
  $isValid = "/^([\w.-]+)@([\w.-_]+)\.([a-zA-Z]{2,6})$/";
  if (preg_match($isValid, $email) == 1) {
    $msg = true;
  } else {
    $msg = "Mit deiner Email stimmt was nicht!";
  }
  return $msg;
}

function checkPass($pass, $pass2) {
  if ($pass == '' || $pass2 == '') {
    $msg = "Hier fehlt noch was!";
  } else if ($pass != $pass2) {
    $msg = "Die Eingaben sind unterschiedlich!";
  } else {  
    //: regex patterns                         
    $hasCapital = "/^.*[A-Z].*$/";
    $hasCorrectLength = "/^.{8,12}$/";
    $containsNumber = "/^.*[0-9].*$/";
    $hasSpecialChar = "/^.*[^A-Za-z0-9\s].*$/"; 
    $perfectMatch = "/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[^A-Za-z0-9\ ])(?=\S*[\d])\S*$/";
  
    //: Vergleich der patterns mit Eingabe
    if (!preg_match($perfectMatch, $pass) == 1){
      if (preg_match($hasCapital, $pass) == 0) {
        $msg = "Großbuchstabe fehlt!";
      } else if (preg_match($hasCorrectLength, $pass) == 0) {
        $msg = "Bitte 8-12 Buchstaben!";
      } else if (preg_match($containsNumber, $pass) == 0) {
        $msg = "Keine Zahl drin!";
      } else if (preg_match($hasSpecialChar, $pass) == 0) {
        $msg = "Kein Sonderzeichen drin!";
      }
    } else {
      $msg = true;
    }
  }
  return $msg;
}

if (isset($_POST['regName']) && (isset($_POST['pass'])) && (isset($_POST['pass2'])) &&  (isset($_POST['email']))) {
  $name = $_POST['regName'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $pass2 = $_POST['pass2'];

  $nameMSG = checkName($name);
  $emailMSG = checkEmail($email);
  $passMSG = checkPass($pass, $pass2);

  if (($nameMSG === true) && ($emailMSG === true) && ($passMSG === true)){
    try {
      $conn = conn_admin('insert_admin');
      $now = new DateTime('now');
      $pass_hash = password_hash($pass, PASSWORD_BCRYPT);
      $zeitstempel = $now->format('Y-m-d H:i:s');
      $conn->query("INSERT INTO spieler VALUES('$name', '$email', '$pass_hash', NULL, NULL, NULL, false)");
      $conn->close();
      setcookie('username', $name); 
      header('Location:./mailserver.php');
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  } 
} else if (isset($_POST['regName']) || isset($_POST['pass']) || isset($_POST['pass2']) || isset($_POST['email'])) {
  $name = $_POST['regName'];
  $email = $_POST['email'];
  echo "<h1 class='header'>Du musst alle Felder ausfüllen!</h1>";
}
 
?>
        <div class="log-container">
          <form method="POST">
            <div class="input-container">
              <label for="username">Spielername</label></br>
              <span class="msg">
                <?php if (gettype($nameMSG) != 'boolean') echo $nameMSG; ?>
              </span>
              <input class="logging" id="username" type="text" name="regName" value="<?php echo $name;?>" autocomplete="off" autofocus></br>
            </div>
            <div class="input-container">
              <label for="email">Email</label></br>
              <span class="msg">
                <?php if (gettype($emailMSG) != 'boolean') echo $emailMSG; ?>
              </span>
              <input class="logging" id="email" type="text" name="email" value="<?php echo $email;?>" autocomplete="off"></br>
            </div>
            <div class="input-container">
              <label for="pw">Passwort</label></br>
              <span class="msg">
                <?php if (gettype($passMSG) != 'boolean') echo $passMSG; ?>
              </span>
              <input class="logging" id="pw" type="password" name="pass" autocomplete="off"></br>
            </div>
            <div class="input-container">
              <label for="pw2">Passwort bestätigen</label></br>
              <input class="logging" id="pw2" type="password" name="pass2" autocomplete="off"></br>
            </div>
            <div class="input-container">
              <button class="logging" type="submit">Konto erstellen</button></br>
              <a href="./index.php"><span class="log-toggle">Ich hab schon ein Konto :-)</span></a>
            </div>
          </form>
        </div>
    </div>
  </body>
</html>
