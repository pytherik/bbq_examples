<?php

include('./header.php');

$riddle_dir = scandir('./riddles/');
$img_dir = scandir('./public/images/');
$riddles = [];
$images = [];


foreach($img_dir as $is_quest_img) {
  $prefix = substr($is_quest_img,0, -6);
  if ($prefix == 'quest') {
    array_push($images, $is_quest_img);
  }
}
$i = 0;
foreach($riddle_dir as $is_riddle) {
  $riddle = substr($is_riddle, 3, -4);

  if (preg_match('/^([0-9]{2}_)(.*)(.php)/', $is_riddle) == 1) {
    $riddle = substr($is_riddle, 3, -4);
    $riddle = new Riddle();
    array_push($riddles, $riddle);
    $riddle->set_path("./riddles/".$is_riddle);
    $riddle->set_image("./public/images/".$images[$i]);
    $i++;
  }
}

  if (isset($_GET['choice'])) {
    $choice = $_GET['choice'];
    foreach($riddles as $riddle) {
      if ($choice == $riddle->name) {
        checkTime();
        include($riddle->path);
        unset($_SERVER['REQUEST_METHOD']);
      }
    } 
  }

if (isset($_SERVER['REQUEST_METHOD'])) {
  unset($_SERVER['REQUEST_METHOD']);
  include_once('./make_your_choice.php');
}

?>

  </div>
</body>

</html>