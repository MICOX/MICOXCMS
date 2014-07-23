<?php
namespace MICOXCMS\Interfaces {
  interface ISession extends ISingletonComponent {
    public static function Instance();
    public function Start();
    public function Has($name);
    public function Get($name);
    public function Set($name, $value);
    public function Remove($name);
    public function RegisterShutdown($object);
  }
}