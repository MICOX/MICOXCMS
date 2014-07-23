<?php
namespace MICOXCMS\Lib {
  class TFuseArray extends \MICOXCMS\Lib\TArray {
    protected $dataFuse;
    
    public function __construct() {
      parent::__construct();
      $this->dataFuse = array();
    }
    
    public function __destruct() {
      parent::__destruct();
      $this->dataFuse = null;
    }
    
  }
}