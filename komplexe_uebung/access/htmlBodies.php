<?php
$mailTemplate = "<html>
<head>
  <meta charset='UTF-8'>
  <link rel='preconnect' href='https://fonts.googleapis.com'>
  <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
  <link href='https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;600;800&display=swap' rel='stylesheet'>  
  <style>

    body {
    background-color: #345370;
    background-image: url('https://images.unsplash.com/photo-1637087383682-40f325297582?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MzV8fGxhYnlyaW50aHxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60');
    background-size: cover;
    background-attachment: fixed;
    font-family: 'Raleway', Arial, Helvetica, sans-serif;
    color: #ddd;
  }
  h1 {
    text-align: center;
  }

  .header {
    font-size: 3rem;
    text-shadow: 2px 2px #333;
  }

  .container {
    margin-top: 2rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .mail {
    background-color: #345370aa;
    width: 65%;
    border: 1px solid #888;
    border-radius: 1rem;
  }

  p {
    text-align: center;
    font-size: 1.4rem;
  }
  a {
    color: lightgreen;
  }

  a:hover {
    color: white;
  }
    </style>
</head>
  <body>
    <div class='container'>
      <h1 class='header'>Das komplexe Quiz!</h1>
      <div class='mail'>
        <h1>Quiz Aktivierung f&uuml;r $name</h1>
        <p>Bitte klicke 
          <a href='http://localhost/ebweb/bbq_examples/komplexe_uebung/access/activationLink.php?name=$name'> hier </a>
          um zum Spiel zu kommen!
        </p>
      </div>
    </div>
  </body>
</html>";

$passTemplate = "
<html>
<head>
  <meta charset='UTF-8'>
  <link rel='preconnect' href='https://fonts.googleapis.com'>
  <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
  <link href='https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;600;800&display=swap' rel='stylesheet'>  
  <style>

    body {
    background-color: #345370;
    background-image: url('https://images.unsplash.com/photo-1637087383682-40f325297582?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MzV8fGxhYnlyaW50aHxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60');
    background-size: cover;
    background-attachment: fixed;
    font-family: 'Raleway', Arial, Helvetica, sans-serif;
    color: #ddd;
  }
  h1 {
    text-align: center;
  }

  .header {
    font-size: 3rem;
    text-shadow: 2px 2px #333;
  }

  .container {
    margin-top: 2rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .mail {
    background-color: #345370aa;
    width: 65%;
    border: 1px solid #888;
    border-radius: 1rem;
  }

  p {
    text-align: center;
    font-size: 1.4rem;
  }
  a {
    color: lightgreen;
  }

  a:hover {
    color: white;
  }
    </style>
</head>
  <body>
    <div class='container'>
      <h1 class='header'>Das komplexe Quiz!</h1>
      <div class='mail'>
        <h1>Passwort Reset f&uuml;r $name</h1>
        <p>Bitte klicke 
          <a href='http://localhost/ebweb/bbq_examples/komplexe_uebung/access/passResetNew.php?name=$name'> hier </a>
          um ein neues Passwort zu setzen!
        </p>
      
      </div>
    </div>
  </body>
</html>
";

?>