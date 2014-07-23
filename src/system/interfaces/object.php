<?php
namespace MICOXCMS\Interfaces {
  interface IObject {
    public static function ___GetObjectCounter();
    public static function ___GetObjectAliveCounter();
    public function ___GetObjectID();
    public static function Instance();
  }
}