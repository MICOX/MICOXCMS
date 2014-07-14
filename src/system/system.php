<?php
namespace MICOXCMS {
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
    protected static $config = null;
    
    public static function Init() {
      if(static::$config === null) {
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
        static::$config = json_decode($json, true);
        if(!is_array(static::$config)) {
          die('No valid config');
        }
      }
    }
  }
  
  spl_autoload_register('\MICOXCMS\Autoloader::Load');
  \MICOXCMS\System::Init();
}