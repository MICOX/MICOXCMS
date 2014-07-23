<?php
namespace MICOXCMS\Lib {
  
  class TSingletonComponent extends \MICOXCMS\Lib\TComponent implements \MICOXCMS\Interfaces\ISingletonComponent {
    protected static $objectList = array();
    
    public function __construct() {
      parent::__construct();
      $class = get_called_class();
      if(isset(static::$objectList[$class])) {
        throw new TSingletonException('Attempting to recreate a singleton object');
      }
      static::$objectList[$class] = $this;
    }
    
    public function __destruct() {
      parent::__destruct();
    }
    
    public static function Instance() {
      $class = get_called_class();
      if(!isset(static::$objectList[$class])) {
        parent::Instance();
        // new $class();
      }
      return static::$objectList[$class];
    }
    
  }
  
  class TSingletonException extends \Exception {
    
  }
  
}