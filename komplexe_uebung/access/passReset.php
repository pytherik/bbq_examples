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
<div class="page-container">
  <h1 class="header">Bitte hier jetzt Name usw..!</h1>
<?php

include('../connectDB.php');

$nameMSG = '';
$emailMSG = '';
$name = '';
$email = '';

if (isset($_POST['regName']) && isset($_POST['email'])) {
  $name = $_POST['regName'];
  $email = $_POST['email'];
  
  try {
    $conn = conn_admin();
    $res = $conn->query("SELECT spielername, email FROM spieler WHERE spielername='$name' AND email='$email'");
    if (mysqli_num_rows($res) == 1) {

      setcookie('username', $name);
      $conn->close();
      header('Location:./passMail.php');
    } else {
      $nameMSG = "Diesen Spieler gibt es nicht!";
    }
  } catch (Exception $e) {
    echo $e->getMessage();
    $conn->close();
  }
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
          <button class="logging" type="submit">Mail schicken</button></br>
        </div>
      </form>
    </div>
  </div>
</body>
</html>