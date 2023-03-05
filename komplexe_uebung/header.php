<?php

include('./connectDB.php');
ob_start();
session_start();

checkTime();

$max_tries = 5;
$cookie_name = 'counter';
$answers_file = './answers.txt';

include('./class.php');

if (isset($_POST['logout'])) {
  $name = $_COOKIE['username'];
  logout($name);
}

if (isset($_POST['play'])){
  if (isset($_SESSION['answers'])){
    session_destroy();
  }

  if (isset($_COOKIE[$cookie_name])){
    setcookie($cookie_name, 0, time() + 120);
  }

  if(is_file($answers_file)) {
    unlink($answers_file);
  }

  header("Refresh:0;url=./quiz.php");
}

if (isset($_POST['playNow'])) {
  header("Refresh:0; url=./quiz.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="public/css/style.css">
  <link rel="icon" href="public/images/icons/favicon.ico">
  <title>Pampel-Komplex</title>
</head>

<body>
  <div class="page-container">
        <form method="post">
          <div class="navHead">
            <a href="./quiz.php">
              <button class="small-button" type="submit" name="play">Zurück</button>
            </a>
            <h1 >Hallo <?php echo $_COOKIE['username']; ?></h1>
            <button class="small-button" type="submit" name="logout">logout</button>
          </div>
        </form>
      <h1 class="header big-header">Das komplexe Rätsel</h1>
