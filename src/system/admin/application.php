<?php
namespace MICOXCMS\Admin {
  class TApplication extends \MICOXCMS\Lib\TApplication {
    public static function Init() {
      parent::Init();
      echo "Admin Init";
    }
    
    public static function Run() {
      parent::Run();
      echo "Admin Run";
    }
    
    public static function Done() {
      parent::Done();
      echo "Admin Done";
    }
    
  }
}