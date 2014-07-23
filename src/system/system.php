<?php
namespace MICOXCMS {
  error_reporting(E_ALL);
  define('DIR_SEP', DIRECTORY_SEPARATOR);
  define('DIRECTORY_THIS', '.'.DIR_SEP);
  define('DIRECTORY_UP', '..'.DIR_SEP);
  define('DIRECTORY_WRAPPED_UP', DIR_SEP.'..'.DIR_SEP);

  class Autoloader {
    public static function Load($class) {
      $filename = false;
      $parts = explode('\\', $class);
      $className = array_pop($parts);
      $base = array_shift($parts);
      if($base == 'MICOXCMS') {
        $group = array_shift($parts);
        if($group == 'Lib') {
          $filename = MICOXCMS_PATH_SYSTEM.'lib'.DIR_SEP;
          if(count($parts) > 0) {
            $filename .= strtolower(implode(DIR_SEP, $parts));
            $filename .= DIR_SEP;
          }
          if($className{0} == 'T') {
            $filename .= strtolower(substr($className, 1));
          } else {
            $filename = strtolower($className);
          }
        } else {
          $filename = MICOXCMS_PATH_SYSTEM.strtolower($group).DIR_SEP;
          if(count($parts) > 0) {
            $filename .= strtolower(implode(DIR_SEP, $parts));
            $filename .= DIR_SEP;
          }
          if($className{0} == 'T') {
            $filename .= strtolower(substr($className, 1));
          } else {
            $filename = strtolower($className);
          }
        }
      }
      if($filename !== false) {
        if(file_exists($filename.'.php')) {
          include_once($filename.'.php');
          return true;
        } elseif(file_exists($filename.'.inc')) {
          include_once($filename.'.inc');
          return true;
        } elseif(file_exists($filename) && is_file($filename)) {
          include_once($filename);
          return true;
        }
      }
      return false;
    }
  }
  
  class System {
    protected static $initDone = false;
    
    public static function Init() {
      if(static::$initDone === false) {
        static::$initDone = true;
        define('MICOXCMS_PATH_SYSTEM', __DIR__.DIR_SEP);
        if(!defined('MICOXCMS_PATH_CONFIG')) {
          if(is_dir(__DIR__.DIRECTORY_WRAPPED_UP.'configuration')) {
            define('MICOXCMS_PATH_CONFIG', realpath(__DIR__.DIRECTORY_WRAPPED_UP.'configuration').DIR_SEP);
          } else {
            die('Whoooops!!!'.PHP_EOL.'Config path not defined');
          }
        }
        if(!file_exists(MICOXCMS_PATH_CONFIG.'system.json')) {
          if(file_exists(MICOXCMS_PATH_CONFIG.DIR_SEP.'system.json')) {
            $json = file_get_contents(MICOXCMS_PATH_CONFIG.DIR_SEP.'system.json');
          } else {
            die('Configuration file not found');
          }
        } else {
          $json = file_get_contents(MICOXCMS_PATH_CONFIG.'system.json');
        }
        $config = json_decode($json, true);
        if(!is_array($config)) {
          die('No valid config');
        }
        SystemConfig::SetArray($config, true);
        
        $uri = $_SERVER['REQUEST_URI'];
        $script = $_SERVER['SCRIPT_NAME'];
        $base = rtrim(dirname($script), DIR_SEP);
        $request = substr($uri, strlen($base));
        SystemConfig::Set('request.realuri', $uri);
        SystemConfig::Set('request.basepath', $base);
        SystemConfig::Set('request.uri', $request);
        if(SystemConfig::Get('runmode') == 'debug') {
          error_reporting(E_ALL);
          ini_set('display_errors', true);
        } else {
          error_reporting(0);
          ini_set('display_errors', false);
        }
      }
    }
  }
  
  class SystemConfig {
    protected static $config = array();
    protected static $configFuse = array();
    
    public static function Get($name) {
      if(isset(static::$configFuse[$name])) {
        return static::$configFuse[$name];
      } elseif(isset(static::$config[$name])) {
        return static::$config[$name];
      }
      return null;
    }
    
    public static function Set($name, $value, $fuseOut = false) {
      if($fuseOut === true) {
        if(isset(static::$configFuse[$name])) {
          return static::$configFuse[$name];
        }
        static::$configFuse[$name] = $value;
      } else {
        static::$config[$name] = $value;
      }
      return $value;
    }
    
    public static function FuseOut($name) {
      if(!isset(static::$configFuse[$name])) {
        if(isset(static::$config[$name])) {
          static::$configFuse[$name] = static::$config[$name];
          return true;
        }
        return false;
      }
      return true;
    }
    
    public static function SetArray($array, $fuseOut = false, $baseKey = false) {
      if(\is_array($array)) {
        foreach($array as $key => $value) {
          if($baseKey === false) {
            static::SetArray($value, $fuseOut, $key);
          } else {
            static::SetArray($value, $fuseOut, $baseKey.'.'.$key);
          }
        }
      } elseif($baseKey !== false) {
        static::Set($baseKey, $array, $fuseOut);
      }
    }
  
    public static function GetConfig() {
      $values = array();
      foreach(static::$config as $key => $value) {
        $values[$key] = $value;
      }
      foreach(static::$configFuse as $key => $value) {
        $values[$key] = $value;
      }
      return $values;
    }
    
  }
  
  class ObjectFactory {
    
    public static function Instance($class) {
      if(is_callable($class.'::Instance')) {
        $function = $class.'::Instance()';
        return $function();
      }
    }
    
  }
  
  spl_autoload_register('\MICOXCMS\Autoloader::Load');
  \MICOXCMS\System::Init();
}