<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="./public/css/style.css">
    <title>pampel-mailer</title>
  </head>
  <body>
    <div class="page-container">
      <h1 class="header big-header">Passwort Reset</h1>

<?php

include('./connectDB.php');
include('./passVar.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$name = $_COOKIE['username'];
$email = getEmail($name);

$body = "Bitte klicke <a href='http://10.101.214.120/ebweb/bbq_examples/komplexe_uebung/passResetNew.php'>hier</a> um ein neues Passwort anzulegen!";

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
$mail->Subject = "Kontoaktivierung";
$mail->Body = $body;

if($mail->send()){
    echo "
    <div class='log-container'>
      <h3>Wir haben dir eine Email gesendet</h3>
      <h3>Sieh in deinem Postfach nach</h3>
      <h3>klicke dort den Link</h3>
      <hr>
      <h3>Viel Spass!</h3>
    </div>
  </div>
</body>
</html>";
} else {
    echo "Es gab einen Fehler ".$mail->ErrorInfo;
}

?>
        
