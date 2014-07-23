<?php
namespace MICOXCMS\Lib\Session {
  
  class Tsystem implements \MICOXCMS\Interfaces\Session\IEngine {
    protected $path;
    protected $name;

    public function Open($save_path, $name) {
      $save_path = rtrim($save_path, DIR_SEP).DIR_SEP;
      $this->path = $save_path;
      $this->name = $name;
    }

    public function Read($session_id) {
      if(file_exists($this->path.$session_id)) {
        return file_get_contents($this->path.$session_id);
      }
      return '';
    }

    public function Write($session_id, $session_data) {
      return file_put_contents($this->path.$session_id, $session_data);
    }

  }
}