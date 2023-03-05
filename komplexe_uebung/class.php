<?php

class Riddle {
  public $path;
  public $image;
  public $name;
  
  function set_path($path) {
    $this->path = $path;
    $this->name = substr($path, 13, -4);
  }
  function set_image($image) {
    $this->image = $image;
  }
}

?>