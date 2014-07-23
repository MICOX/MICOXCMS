<?php
namespace MICOXCMS\Lib {
  class TDatabase extends \MICOXCMS\Lib\TSingletonComponent {
    protected $reuse;
    protected $dbEngine;
    
    public function __construct() {
      parent::__construct();
      $this->reuse = null;
      $this->dbEngine = \MICOXCMS\SystemConfig::Get('database.engine');
    }
    
    public function __destruct() {
      parent::__destruct();
    }
    
    public function Connect($reuse = true) {
      if(($reuse === true) && ($this->reuse)) {
        return $this->reuse;
      }
      if($this->dbEngine === null) {
        throw new DatabaseException('No database engine defined in configuration');
      }
      $class = __NAMESPACE__.'\\Database\\T'.$this->dbEngine;
      if($reuse === true) {
        $this->reuse = $class::Instance();
        return $this->reuse;
      } else {
        return $class::Instance();
      }
    }
    
  }
  
  class DatabaseException extends \Exception {
    
  }
  
}