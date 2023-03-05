<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="./public/css/style.css">
    <title>pampel-active</title>
  </head>
  <body>
    <div class="page-container">
      <h1 class="header big-header">Konto (re)aktivieren</h1>
        <div class='log-container'>
          <h3>Dein Konto ist noch nicht oder nicht mehr</h3>
          <h3>aktiv. Du kannst es aktivieren indem du </h3>
          <h3>jetzt eine Aktivierungs-Mail anforderst.</h3></br>
          <form method="POST">
            <div class="input-container">
              <input class="logging" type="submit" name="mail" value="Aktivierungs-Mail anfordern">
            </div>
          </form>
<?php

include('./connectDB.php');
include('./passVar.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['mail'])){
  
  $name = $_COOKIE['username'];
  $email = getEmail($name);
  
  // $body = "Bitte klicke <a href='http://192.168.178.31/bbq_examples/komplexe_uebung/activationLink.php'>hier</a> um zum Spiel zu kommen!";
  
  $htmlBody = file_get_contents('./mailTemplate.html');

  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 465;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->SMTPAuth = true;
  
  $mail->Username = $mailFrom;
  $mail->Password = $mailPass;
  
  $mail->setFrom("pampelhans102@gmail.com", "Pampelmann");
  $mail->addAddress($email, $name);
  
  // $mail->addAttachment("Anhang.zip", "Test.zip");
  $mail->isHTML(true);
  $mail->Subject = "Erneute Aktivierung";
  $mail->Body = $htmlBody;
  
  if($mail->send()){
      echo "
      <hr>
      <h3>Wir haben dir eine Email gesendet!</h3></br>
        <h3>Sieh in deinem Postfach nach und</h3>
        <h3>klicke dort auf den Link</h3>
        <h3>Viel Spass!</h3>
      </div>
    </div>
  </body>
  </html>";
  } else {
      echo "Es gab einen Fehler ".$mail->ErrorInfo;
  }
}
   
?>
        
