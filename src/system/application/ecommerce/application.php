<?php
namespace MICOXCMS\Application\ECommerce {
  
  class TApplication extends \MICOXCMS\Lib\TApplication {
  
    protected function _Init() {
      $user = \MICOXCMS\Lib\TUser::Instance();
      echo "Welcome to ECommerce";
    }

    protected function _Run() {
    }

    protected function _Done() {
    }

  }
  
}