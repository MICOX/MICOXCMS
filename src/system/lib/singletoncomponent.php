<?php
namespace MICOXCMS\Lib {
  
  class TSingletonComponent extends \MICOXCMS\Lib\TComponent {
    protected static $objectList = array();
    
    public static function Instance() {
      $class = get_called_class();
      if(!isset(static::$objectList[$class])) {
        static::$objectList[$class] = new $class();
      }
      return static::$objectList[$class];
    }
    
  }
  
}