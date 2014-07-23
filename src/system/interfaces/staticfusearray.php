<?php
namespace MICOXCMS\Interfaces {
  interface IStaticFuseArray extends IStaticArray {
    public static function Get($name);
    public static function Set($name, $value, $fuseOut = false);
    public static function FuseOut($name);
    public static function SetArray($array, $fuseOut = false, $baseKey = false);
  }
}