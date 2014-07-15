<?php
namespace MICOXCMS\Lib\Cache {
  class TMemCache extends \MICOXCMS\Lib\TCache {
    protected $memcache;
    protected $isValid;
    
    public function __construct($host = 'localhost', $port = 11211) {
      parent::__construct();
      $this->memcache = new \Memcached();
      $this->isValid = $this->memcache->connect($host, $port);
      if($this->isValid === false) {
        // Failed
      }
    }
    
    public function __destruct() {
      $this->memcache->close();
      parent::__destruct();
    }
    
    public function Get($name) {
      
    }
    
    public function Set($name, $value, $timeout = 3600) {
      
    }
    
  }
}