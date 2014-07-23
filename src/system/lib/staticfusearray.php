<?php
namespace MICOXCMS\Lib {
  class TStaticFuseArray extends \MICOXCMS\Lib\TStaticArray {
    protected static $dataFuse = array();
    
    public static function Get($name) {
      if(isset(static::$dataFuse[$name])) {
        return static::$dataFuse[$name];
      }
      return parent::Get($name);
    }
    
    public static function Set($name, $value, $fuseOut = false) {
      if($fuseOut === true) {
        if(isset(static::$dataFuse[$name])) {
          return static::$dataFuse[$name];
        }
        static::$dataFuse[$name] = $value;
      }
      return parent::Set($name, $value);
    }
    
    public static function FuseOut($name) {
      if(!isset(static::$dataFuse[$name])) {
        if(isset(static::$data[$name])) {
          static::$dataFuse[$name] = static::$data[$name];
          return true;
        }
        return false;
      }
      return true;
    }
    
    public static function SetArray($array, $fuseOut = false, $baseKey = false) {
      if(\is_array($array)) {
        foreach($array as $key => $value) {
          if($baseKey === false) {
            static::SetArray($value, $fuseOut, $key);
          } else {
            static::SetArray($value, $fuseOut, $baseKey.'.'.$key);
          }
        }
      } elseif($baseKey !== false) {
        static::Set($baseKey, $array, $fuseOut);
      }
    }
    
    
  }
}