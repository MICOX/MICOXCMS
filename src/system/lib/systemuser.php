<?php
namespace MICOXCMS\Lib {
  
  class TSystemUser extends \MICOXCMS\Lib\TSingletonComponent implements \MICOXCMS\Interfaces\ISystemUser {
    
    public function __construct() {
      parent::__construct();
      $session = \MICOXCMS\Lib\TSession::Instance();
    }
    
    public function __destruct() {
      parent::__destruct();
    }
    
    
  }
  
}