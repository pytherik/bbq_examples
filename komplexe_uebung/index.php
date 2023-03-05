<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="./public/css/style.css">
    <title>quiz-login</title>
  </head>
  <body>
    <div class="page-container">
      <h1 class="header big-header">Log dich ein</h1>

<?php

include('./connectDB.php');

$nameMSG = '';
$passMSG = '';

$conn = conn_admin();
$spieler = '';
if(isset($_POST['loginName']) && isset($_POST['pass'])) {
  $spieler = $_POST['loginName'];
  $pw = $_POST['pass'];
  $rows = $conn->query("SELECT spielername, passwort FROM spieler WHERE spielername='$spieler'");
  $conn->close();
  if (mysqli_num_rows($rows) == 0) {
    $nameMSG = "Dieser Spieler existiert nicht!";
  } else {
    $row = $rows->fetch_assoc();
    $user = $row['spielername'];
    $pass = $row['passwort'];
    if (password_verify($pw, $pass)) {
      setcookie('username', $user);
      isActive($spieler);
      $now = new DateTime('now');
      $zeitstempel = $now->format('Y-m-d H:i:s');
      $conn = conn_admin('update_admin');
      $conn->query("UPDATE spieler SET zeitstempel='$zeitstempel' WHERE spielername='$user'");
      $conn->close();
      // $_SESSION['username'] = $user;
      setcookie('username', $user);
      header('Refresh:0;url=./quiz.php');
    } else {
      $passMSG = "Das Passwort stimmt nicht!";
    }
  }
}

?>
      <div class="log-container">
        <form method="POST" autocomplete="off">
          <div class="input-container">
            <label for="username">Spielername</label></br>
            <span class="msg">
              <?php echo $nameMSG; ?>
            </span>
            <input class="logging" type="text" name="loginName" value="<?php echo $spieler;?>" autocomplete="off" autofocus></br>
          </div>
          <div class="input-container">
            <label for="pw">Passwort</label></br>
            <span class="msg">
              <?php echo $passMSG; ?>
            </span>
            <input class="logging" id="pw" type="password" name="pass" autocomplete="off"></br>
          </div>
          <div class="input-container">
            <button class="logging" type="submit">Anmelden</button></br>
            <a href="./register.php"><span class="log-toggle">Ich hab noch kein Konto :-(</span></a>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
