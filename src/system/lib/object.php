<?php
namespace MICOXCMS\Lib {
  class TObject implements \MICOXCMS\Interfaces\IObject {
    protected static $objectCounter = 0;
    protected static $objectAliveCounter = 0;
    protected $objectID;
    
    public function __construct() {
      self::$objectCounter++;
      self::$objectAliveCounter++;
      $this->objectID = sha1(microtime().self::$objectCounter);
    }

    public function __destruct() {
      self::$objectAliveCounter++;
    }
    
    public static function ___GetObjectCounter() {
      return self::$objectCounter;
    }
    
    public static function ___GetObjectAliveCounter() {
      return self::$objectAliveCounter;
    }
    
    public function ___GetObjectID() {
      return $this->objectID;
    }
    
    public static function Instance() {
      $class = get_called_class();
      $args = func_get_args();
      switch(count($args)) {
        case 0:
          return new $class();
        case 1:
          return new $class($args[0]);
        case 2:
          return new $class($args[0], $args[1]);
        case 3:
          return new $class($args[0], $args[1], $args[2]);
        case 4:
          return new $class($args[0], $args[1], $args[2], $args[3]);
        case 5:
          return new $class($args[0], $args[1], $args[2], $args[3], $args[4]);
        case 6:
          return new $class($args[0], $args[1], $args[2], $args[3], $args[4], $args[5]);
        case 7:
          return new $class($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6]);
        case 8:
          return new $class($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7]);
        case 9:
          return new $class($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7], $args[8]);
        case 10:
          return new $class($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7], $args[8], $args[9]);
      }
      return new $class();
    }
    
  }
}