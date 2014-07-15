<?php

namespace MICOXCMS\Lib\Tree {
  
  class TTreeData implements \ArrayAccess, \Serializable, \Countable, \Iterator {
    protected $data;

    function __construct($data = null) {
      if($data === null) {
        $this->data = array();
      }  elseif(is_array($data)) {
        $this->data = $data;
      } elseif($data instanceof TTreeData) {
        $this->data = $data->ClonedData();
      } elseif($data instanceof TTreeNode) {
        // Hur ska man veta vilken data som ska klonas om det finns dubletter????
      }
    }

    function __get($name) {
      if($name == 'data') {
        return $this->data;
      }
      return $this->offsetGet($name);
    }

    function __set($name, $value) {
      if($name != 'data') {
        $this->offsetSet($name, $value);
      }
    }

    public function ClonedData() {
      $data = array();
      foreach($this->data as $key => $value) {
        $data[$key] = $value;
      }
      return $data;
    }

    public function count() {
      return \count($this->data);
    }

    public function current() {
      return \current($this->data);
    }

    public function key() {
      return \key($this->data);
    }

    public function next() {
      return \next($this->data);
    }

    public function offsetExists($offset) {
      return isset($this->data[$offset]);
    }

    public function offsetGet($offset) {
      if(isset($this->data[$offset])) {
        return $this->data[$offset];
      }
      return null;
    }

    public function offsetSet($offset, $value) {
      if($offset === null) {
        $this->data[] = $value;
      } else {
        $this->data[$offset] = $value;
      }
    }

    public function offsetUnset($offset) {
      unset($this->data[$offset]);
    }

    public function rewind() {
      return \reset($this->data);
    }

    public function serialize() {

    }

    public function unserialize($serialized) {

    }

    public function valid() {
      return (\key($this->data) !== null);
    }

    public function GetKeys() {
      return \array_keys($this->data);
    }

  }

}