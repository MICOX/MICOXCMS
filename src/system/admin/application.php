<?php
namespace MICOXCMS\Admin {
  
  class TApplication extends \MICOXCMS\Lib\TApplication {
  
    protected function _Init() {
      $user = \MICOXCMS\Lib\TSystemUser::Instance();
    }

    protected function _Run() {
    }

    protected function _Done() {
    }

  }
  
}