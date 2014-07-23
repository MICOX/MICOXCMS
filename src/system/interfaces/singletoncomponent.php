<?php
namespace MICOXCMS\Interfaces {
  interface ISingletonComponent extends IComponent {
    public static function Instance();
  }
}