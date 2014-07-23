<?php
namespace MICOXCMS\Lib {
  
  class TSession extends \MICOXCMS\Lib\TSingletonComponent implements \SessionHandlerInterface {
    protected static $initDone = false;
    protected static $isStarted = false;
    
    public function __construct() {
      parent::__construct();
      $type = \MICOXCMS\SystemConfig::Get('session.type');
      $storage = \MICOXCMS\SystemConfig::Get('session.storage');
      $activelevel = \MICOXCMS\SystemConfig::Get('session.activelevel');
      echo "Storage: $storage, Type: $type, Interact: $interact".PHP_EOL;
    }
    
    public function __destruct() {
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
    
    public function close() {
      
    }

    public function destroy($session_id) {
      
    }

    public function gc($maxlifetime) {
      
    }

    public function open($save_path, $name) {
      echo serialize($name);
      echo serialize($save_path);
    }

    public function read($session_id) {
      
    }

    public function write($session_id, $session_data) {
      
    }

  }
  
}