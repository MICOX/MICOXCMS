<?php
namespace MICOXCMS\HTML {
  
  class TApplication extends \MICOXCMS\Lib\TApplication {
 
    protected function _Init() {
      $user = \MICOXCMS\Lib\TUser::Instance();
      echo "Welcome to HTML";
    }

    protected function _Run() {
    }

    protected function _Done() {
    }

  }
  
}