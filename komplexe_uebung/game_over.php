<div class="success-modal">
  <div <?php echo ($status == 'win') ? 'class="success-container win"' : 'class="success-container lose"'; ?>>
    <div class="row-top">

      <?php

      $status == 'win' ? $out = "<h1>gewonnen</h1>" : $out = "<h1>verloren</h1>";
      echo $out;


      ?>

    </div>
    <div class="row-top">
      <a href="quiz.php">
        </form method="post">
        <button class="btn" type="submit" name="playNow" value="new">
          weitermachen
        </button>
        </form>
      </a>
    </div>
  </div>
</div>
</div>