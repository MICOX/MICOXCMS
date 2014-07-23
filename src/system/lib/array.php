<?php
namespace MICOXCMS\Lib {
  class TArray extends \MICOXCMS\Lib\TObject implements \Iterator, \Countable, \Traversable {
    protected $data;
    
    public function __construct() {
      parent::__construct();
      $this->data = array();
    }
    
    public function __destruct() {
      parent::__destruct();
      $this->data = null;
    }

    public function __get($name) {
      return isset($this->data[$name])?$this->data[$name]:null;
    }
    
    public function __set($name, $value) {
      $this->data[$name] = $value;
    }
    
    public function count() {
      return count($this->data);
    }

    public function current() {
      return current($this->data);
    }

    public function key() {
      return key($this->data);
    }

    public function next() {
      return next($this->data);
    }

    public function rewind() {
      return reset($this->data);
    }

    public function valid() {
      return (key($this->data) !== null);
    }

  }
}