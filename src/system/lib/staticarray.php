<?php
namespace MICOXCMS\Lib {
  class TStaticArray extends \MICOXCMS\Lib\TStaticObject implements \MICOXCMS\Interfaces\IStaticArray {
    protected static $data = array();
    
    public static function Get($name) {
      if(isset(static::$data[$name])) {
        return static::$data[$name];
      }
      return null;
    }
    
    public static function Set($name, $value) {
      static::$data[$name] = $value;
      return $value;
    }
    
    public static function SetArray($array, $baseKey = false) {
      if(\is_array($array)) {
        foreach($array as $key => $value) {
          if($baseKey === false) {
            static::SetArray($value, $key);
          } else {
            static::SetArray($value, $baseKey.'.'.$key);
          }
        }
      } elseif($baseKey !== false) {
        static::Set($baseKey, $array);
      }
    }
    
  }
}