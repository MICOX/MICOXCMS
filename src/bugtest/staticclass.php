<?php
namespace DummyTest\Lib {
  class TObject {
    public function __construct() {
    }
  }
  class TComponent extends \DummyTest\Lib\TObject {
    public function __construct() {
      parent::__construct();
    }
  }
  class TSingletonComponent extends \DummyTest\Lib\TComponent {
    public function __construct() {
      parent::__construct();
    }
  }
  class TDatabase extends \DummyTest\Lib\TSingletonComponent {
    public function __construct() {
      parent::__construct();
    }

    public static function Init() {
      $db = new \DummyTest\Lib\Database\TPDO();
    }
  }
}

namespace DummyTest\Lib\Database {
  class TDatabase extends \DummyTest\Lib\TComponent {
    public function __construct() {
      parent::__construct();
    }
  }
  class TPDO extends \DummyTest\Lib\Database\TDatabase {
    protected $pdo;

    public function __construct() {
      parent::__construct();
      echo serialize(\DummyTest\SystemConfig::Get('xxx'));
    }
  }
}

namespace DummyTest {
  class SystemConfig {
    protected static $config = array();

    public function Get($name) {
      echo get_called_class().PHP_EOL;
      if(isset(static::$config[$name])) {
        return static::$config[$name];
      }
      return null;
    }

    public function Set($name, $value) {
      static::$config[$name] = $value;
    }
  }

  error_reporting(E_ALL);
  ini_set('display_errors', true);
  SystemConfig::Set('xxx', 'yyy');
  \DummyTest\Lib\TDatabase::Init();
  echo PHP_EOL;
}

/*
 * Status: Solved
 * Programmers mistake
 * The functions on line 48 and 56 should be declared as static.
 * PHP responds on line 49 with the calling objects class while HHVM
 * responds with DummyTest\SystemConfig.
 * It turns out that HHVM doesn't care about the missing static.
 * But PHP doesn't return any warnings about missing static.
 */