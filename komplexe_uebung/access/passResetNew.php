<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../public/css/style.css">
  <title>Passwort Reset</title>
</head>
<body>
  <h1 class="header">Hier kannst du dein Passwort zurücksetzen!</h1>
<?php

include('../connectDB.php');

$passMSG = '';
if (isset($_GET['name'])) {
  $name = $_GET['name'];
  setcookie('username',$name);
  if (isset($_POST['pass']) && isset($_POST['pass2'])) {
    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];
    $name = $_COOKIE['username'];
    $passMSG = checkPass($pass, $pass2);
    if ($passMSG === true) {
      try {
        $now = new DateTime('now');
        $pass_hash = password_hash($pass, PASSWORD_BCRYPT);
        $zeitstempel = $now->format('Y-m-d H:i:s');
  
        $conn = conn_admin('update_admin');
        $conn->query("UPDATE spieler SET passwort='$pass_hash', zeitstempel='$zeitstempel', logfails = 0, active = 1 WHERE spielername='$name'");
        $conn->close();
        header('Location:../quiz.php');
      } catch (Exception $e) {
        echo $e->getMessage();
        $conn->close();
      }
    }
  }
}

?>

  <div class="page-container">
    <div class="log-container">
      <form method="POST">
        <div class="input-container">
          <label for="pw">Neues Passwort</label></br>
          <span class="msg">
          <?php if (gettype($passMSG) != 'boolean') echo $passMSG; ?>
          </span>
          <input class="logging" id="pw" type="password" name="pass" autocomplete="off"></br>
        </div>
        <div class="input-container">
          <label for="pw2">Neues Passwort bestätigen</label></br>
          <input class="logging" id="pw2" type="password" name="pass2" autocomplete="off"></br>
        </div>
        <div class="input-container">
          <button class="logging" type="submit">Passwort Reset</button></br>
        </div>
      </form>
    </div>
  </div>
</body>
</html>