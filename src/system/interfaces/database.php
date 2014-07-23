<?php
namespace MICOXCMS\Interfaces {
  interface IDatabase extends ISingletonComponent {
    public function Connect($reuse = true);
  }
}