<form method='GET'>
  <div class='choices-container'>

<?php 

foreach($riddles as $index=>$riddle) {

echo "<div class='choice' id='choice1'>
        <div class='img-thumb'>
          <img src='$riddle->image' alt=''>
        </div>
        <div>
          <input type='submit' name='choice' value='$riddle->name'>
        </div>
      </div>";
}
?>

  </div>
</form>
