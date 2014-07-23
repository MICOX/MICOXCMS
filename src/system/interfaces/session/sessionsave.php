<?php
namespace MICOXCMS\Interfaces\Session {
  interface ISessionSave {
    public function SaveToSession($shutdown = false);
  }
}
