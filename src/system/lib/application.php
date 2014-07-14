<?php
namespace MICOXCMS\Lib {
  class TApplication extends \MICOXCMS\Lib\TSingletonComponent {
    const UNINITIALIZED = 0;
    const INIT = 1;
    const RUN = 2;
    const DONE = 3;
    
    protected static $state = TApplication::UNINITIALIZED;
    
    public static function Init() {
      $class = get_called_class();
      if(static::$state == static::UNINITIALIZED) {
      } elseif(static::$state == static::INIT) {
        die('Init already run');
      } elseif(static::$state == static::RUN) {
        die('Run already run');
      } elseif(static::$state == static::DONE) {
        die('Done already run');
      } else {
        die('Unknown state');
      }
      static::$state = static::INIT;
      
    }
    
    public static function Run() {
      $class = get_called_class();
      if(static::$state == static::UNINITIALIZED) {
        $class::Init();
      } elseif(static::$state == static::INIT) {
      } elseif(static::$state == static::RUN) {
        die('Run already run');
      } elseif(static::$state == static::DONE) {
        die('Done already run');
      } else {
        die('Unknown state');
      }
      static::$state = static::RUN;
      echo "Here we go";
    }
    
    public static function Done() {
      $class = get_called_class();
      if(static::$state == static::UNINITIALIZED) {
        // die('Init never run');
      } elseif(static::$state == static::INIT) {
        // die('Run never run');
      } elseif(static::$state == static::RUN) {
      } elseif(static::$state == static::DONE) {
        die('Done already run');
      } else {
        die('Unknown state');
      }
      static::$state = static::DONE;
      
    }
    
  }
}