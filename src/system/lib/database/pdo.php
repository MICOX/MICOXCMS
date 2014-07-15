<?php
namespace MICOXCMS\Lib\Database {
  
  class TPDO extends \MICOXCMS\Lib\Database\TDatabase {
    protected $pdo;
    
    public function __construct() {
      parent::__construct();
      $dsn = \MICOXCMS\SystemConfig::Get('database.connectionstring');
      $username = \MICOXCMS\SystemConfig::Get('database.username');
      $password = \MICOXCMS\SystemConfig::Get('database.password');
      if($dsn === null) {
        $type = \MICOXCMS\SystemConfig::Get('database.type');
        $host = \MICOXCMS\SystemConfig::Get('database.host');
        $port = \MICOXCMS\SystemConfig::Get('database.port');
        $database = \MICOXCMS\SystemConfig::Get('database.database');
        $dsn = $type;
        $dsn .= ':dbname='.$database;
        if($host !== null) {
          $dsn .= ';host='.$host;
        }
        if($port !== null) {
          $dsn .= ';port='.$port;
        }
        $options = array();
        $this->pdo = new \PDO($dsn, $username, $password, $options);
      } else {
        $this->pdo = new \PDO($dsn, $username, $password, $options);
      }
    }
    
    public function Execute($sql) {
      return $this->pdo->exec($sql);
    }
  }
  
}