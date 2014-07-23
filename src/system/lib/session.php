<?php
namespace MICOXCMS\Lib {
  
  class TSession extends \MICOXCMS\Lib\TSingletonComponent implements \SessionHandlerInterface, \MICOXCMS\Interfaces\ISession {
    protected static $initDone = false;
    protected static $isStarted = false;
    protected $shutdownList;
    protected $engine;
    
    public function __construct() {
      parent::__construct();
      $this->shutdownList = array();
      $engine = '\\MICOXCMS\\Lib\\Session\\T'.\MICOXCMS\SystemConfig::Get('session.engine');
      $this->engine = new $engine();
    }
    
    public function __destruct() {
      if(count($this->shutdownList) > 0) {
        foreach($this->shutdownList as $object) {
          $object->SaveToSession(true);
        }
      }
      parent::__destruct();
    }

    public static function Instance() {
      $object = parent::Instance();
      if(static::$initDone === false) {
        static::$initDone = true;
        ini_set('session.use_cookies', 0);
        ini_set('session.use_only_cookies', 0);
        session_set_save_handler($object, true);
      }
      return $object;
    }
    
    public function Start() {
      if(static::$isStarted === false) {
        // Select which type of session should be used
        session_start();
        static::$isStarted = true;
      }
      return $this;
    }
    
    public function Has($name) {
      return isset($_SESSION[$name]);
    }
    
    public function Get($name) {
      if(isset($_SESSION[$name])) {
        return $_SESSION[$name];
      }
      return null;
    }
    
    public function Set($name, $value) {
      $_SESSION[$name] = $value;
      return $this;
    }
    
    public function Remove($name) {
      if(isset($_SESSION[$name])) {
        unset($_SESSION[$name]);
      }
      return null;
    }
    
    public function ShutdownSession() {
      if(count($this->shutdownList) > 0) {
        foreach($this->shutdownList as $object) {
          $object->SaveToSession(true);
        }
        $this->shutdownList = array();
      }
    }
    
    public function RegisterShutdown($object) {
      $this->shutdownList[] = $object;
    }
    
    public function UnregisterShutdown($object) {
      $kill = false;
      foreach($this->shutdownList as $idx => $obj) {
        if($obj === $object) {
          $kill = $idx;
          break;
        }
      }
      if($kill !== false) {
        unset($this->shutdownList[$kill]);
      }
    }
    
    public function close() {
      
    }

    public function destroy($session_id) {
      
    }

    public function gc($maxlifetime) {
      
    }

    public function open($save_path, $name) {
      return $this->engine->Open($save_path, $name);
    }

    public function read($session_id) {
      return $this->engine->Read($session_id);
    }

    public function write($session_id, $session_data) {
      return $this->engine->Write($session_id, $session_data);
    }

  }
  
}