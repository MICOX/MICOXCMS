<?php
namespace MICOXCMS\Application\CMS {
  
  class TApplication extends \MICOXCMS\Lib\TApplication {
 
    protected function _Init() {
      $user = \MICOXCMS\Lib\TUser::Instance();
      echo "Welcome to CMS";
    }

    protected function _Run() {
    }

    protected function _Done() {
    }

  }
  
}