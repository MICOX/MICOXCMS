<?php
namespace MICOXCMS\Lib\Cache {
  abstract class TCache extends \MICOXCMS\Lib\TComponent {
    
    public function __construct() {
      parent::__construct();
    }
    
    public function __destruct() {
      parent::__destruct();
    }
    
    public function __get($name) {
      
    }
    
    public function __set($name, $value) {
      
    }
    
    public abstract function Get($name);
    public abstract function Set($name, $value, $timeout = false);
  }
}