<?php
namespace MICOXCMS\HTML {
  class TApplication extends \MICOXCMS\Lib\TApplication {
    public static function Init() {
      parent::Init();
      echo "HTML Init";
    }
    
    public static function Run() {
      parent::Run();
      echo "HTML Run";
    }
    
    public static function Done() {
      parent::Done();
      echo "HTML Done";
    }
    
  }
}