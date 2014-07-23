<?php
namespace MICOXCMS\Interfaces\Session {
  interface IEngine {
    public function Open($save_path, $name);
    public function Read($session_id);
    public function Write($session_id, $session_data);
  }
}
