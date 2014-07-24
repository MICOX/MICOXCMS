<?php
namespace MICOXCMS\Application\ECommerceAdmin {
  
  class TApplication extends \MICOXCMS\Lib\TApplication {
  
    protected function _Init() {
      $user = \MICOXCMS\Lib\TUser::Instance();
      echo "Welcome to ECommerceAdmin";
    }

    protected function _Run() {

    }

    protected function _Done() {
    }

  }
  
}