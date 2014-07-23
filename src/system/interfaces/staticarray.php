<?php
namespace MICOXCMS\Interfaces {
  interface IStaticArray extends IStaticObject {
    public static function Get($name);
    public static function Set($name, $value);
    public static function SetArray($array, $baseKey = false);
  }
}