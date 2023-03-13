<?php

include('../connectDB.php');

if (isset($_GET['name'])) {
  $name = $_GET['name'];
  setcookie('username', $name);
  
  try {
    $conn = conn_admin('update_admin');
    $now = new DateTime('now');
    $zeitstempel = $now->format('Y-m-d H:i:s');
    $conn->query("UPDATE spieler SET zeitstempel='$zeitstempel', active = true WHERE spielername='$name'");
    $conn->close();
    header('Location:../quiz.php');
  } catch (Exception $e) {
    echo $e->getMessage();
    exit();
  }
} 

?>