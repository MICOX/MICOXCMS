<?php
namespace MICOXCMS\Lib {
  abstract class TApplication extends \MICOXCMS\Lib\TSingletonComponent {
    const UNINITIALIZED = 0;
    const INIT = 1;
    const RUN = 2;
    const DONE = 3;
    
    protected $state;
    
    public function __construct() {
      parent::__construct();
      $this->state = TApplication::UNINITIALIZED;
    }
    
    public function __destruct() {
      parent::__destruct();
    }
    
    public function Init() {
      echo "INIT";
      switch($this->state) {
        case static::UNINITIALIZED:
          break;
        case static::INIT:
          die('Init already run');
          break;
        case static::RUN:
          die('Run already run');
          break;
        case static::DONE:
          die('Done already run');
          break;
        default:
          die('Unknown state');
          break;
      }
      $this->state = static::INIT;
      $this->_Init();
      return $this;
    }
    
    public function Run() {
      echo "RUN";
      switch($this->state) {
        case static::UNINITIALIZED:
          $this->state = static::INIT;
          $this->_Init();
          break;
        case static::INIT:
          break;
        case static::RUN:
          die('Run already run');
          break;
        case static::DONE:
          die('Done already run');
          break;
        default:
          die('Unknown state');
          break;
      }
      $this->state = static::RUN;
      $this->_Run();
      return $this;
    }
    
    public function Done() {
      echo "Done";
      switch($this->state) {
        case static::UNINITIALIZED:
          break;
        case static::INIT:
          break;
        case static::RUN:
          break;
        case static::DONE:
          die('Done already run');
          break;
        default:
          die('Unknown state');
          break;
      }
      $this->state = static::DONE;
      $this->_Done();
      return $this;
    }

    protected abstract function _Init();    
    protected abstract function _Run();
    protected abstract function _Done();
    
  }
}