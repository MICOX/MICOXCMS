<?php
namespace MICOXCMS\Application\GEDAdmin {
  
  class TApplication extends \MICOXCMS\Lib\TApplication {
  
    protected function _Init() {
      $user = \MICOXCMS\Lib\TUser::Instance();
      echo "Welcome to GEDAdmin";
    }

    protected function _Run() {
    }

    protected function _Done() {
    }

  }
  
}