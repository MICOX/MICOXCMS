<?php
namespace MICOXCMS\Application\GED {
  
  class TApplication extends \MICOXCMS\Lib\TApplication {
  
    protected function _Init() {
      $user = \MICOXCMS\Lib\TUser::Instance();
      echo "Welcome to GED";
    }

    protected function _Run() {
    }

    protected function _Done() {
    }

    protected function _OutputBuffer($buffer) {
      return $buffer;
    }
    
  }
  
}