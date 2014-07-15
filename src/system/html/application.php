<?php
namespace MICOXCMS\HTML {
  
  class TApplication extends \MICOXCMS\Lib\TApplication {
 
    protected function _Init() {
      $db = \MICOXCMS\Lib\TDatabase::Instance()->Connect();
//      echo serialize($db->Execute('SELECT * FROM nisse'));
    }

    protected function _Run() {
    }

    protected function _Done() {
    }

  }
  
}