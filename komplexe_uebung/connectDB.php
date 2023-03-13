<?php

function conn_admin($user='select_admin', $pw='321null') {
  $host = 'localhost';
  $db = 'quizdb';
  try {
    $conn = new mysqli($host,$user,$pw,$db);
    return $conn;
  } catch (Exception $e) {
    echo "Verbindungsfehler: ".$e->getMessage();
    exit();
  }   
}

function getEmail($name) {
  try {
    $conn = conn_admin();
    $result = $conn->query("SELECT email FROM spieler WHERE spielername='$name'");
    $row = $result->fetch_assoc();
    $email = $row['email'];
    $conn->close();
    return $email;
  } catch (Exception $e) {
    echo $e->getMessage();
  }
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

function logout($name) {
    session_destroy();
    unset($_COOKIE['username']);
    setcookie('username', null, -1);
    unset($_POST);
    try {
      $conn = conn_admin('update_admin');
      $conn->query("UPDATE spieler SET zeitstempel=NULL WHERE spielername='$name'");
      $conn->close();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
    header("Location:./index.php");
}

function anybodyIn() {
  $conn = conn_admin();
  $row = $conn->query("SELECT zeitstempel FROM spieler WHERE zeitstempel IS NOT NULL");
  if (mysqli_num_rows($row) == 0) {
    $conn->close();
    header('Location:./index.php');
    exit();
  } else {
    $conn->close();
  }
}

function isActive($name) {
  $conn = conn_admin();
  try {
    $row = $conn->query("SELECT active FROM spieler WHERE spielername='$name'");
    $res = $row->fetch_assoc();
    if (!$res['active']){
      $conn->close();  
      header('Location:./access/activation.php');
      exit();
    }
  } catch (Exception $e) {
    echo $e->getMessage();
    $conn->close();  
  }
} 

function checkTime() {
  anybodyIn();
  $name = $_COOKIE['username'];
  isActive($name);
  $new = new DateTime('now');
  $now = $new->format('Y-m-d H:i:s');
  
  $conn = conn_admin();
  try {
    $result = $conn->query("SELECT zeitstempel FROM spieler WHERE spielername='$name'");
    $res = $result->fetch_assoc();
    $conn->close();
    
    $start_time = new DateTime($res['zeitstempel']);
    $time_delta = $new->diff($start_time);
    $time_passed = ($time_delta->d*24*60)+($time_delta->h*60)+$time_delta->i;
  
    if ($time_passed > 1) {
      logout($name);
      exit();
    } else {
      $conn = conn_admin('update_admin');
      $conn->query("UPDATE spieler SET zeitstempel='$now' WHERE spielername='$name'");
    }
  } catch (Exception $e) {
    echo $e->getMessage();
  }
}

?>
