<?php

namespace MICOXCMS\Lib\Tree {
  
  class TTreeList implements \ArrayAccess, \Countable, \Serializable, \Iterator {
    protected $root;
    protected $first;
    protected $last;
    protected $nodes;
    protected $isDirty;
    protected $treeCount;
    protected $buildFilters;

    function __construct() {
      $this->root = null;
      $this->first = null;
      $this->last = null;
      $this->nodes = array();
      $this->isDirty = false;
      $this->treeCount = 0;
      $this->buildFilters = array();
    }

    function __get($name) {
      switch($name) {
        case 'root':
          return $this->GetRoot();
        case 'first':
          return $this->GetFirst();
        case 'last':
          return $this->GetLast();
        case 'treecount':
        case 'treeCount':
          return $this->GetTreeCount();
        case 'isDirty':
        case 'isdirty':
          return $this->isDirty;
      }
    }

    function __set($name, $value) {
    }

    public function AssignPDO($rs) {
      $this->Clear();
      $this->nodes = array();
      if($rs instanceof \PDOStatement) {
        foreach($rs as $row) {
          $this->nodes[] = new TTreeData($row);
        }
      }
      if(count($this->nodes)) {
        $this->isDirty = true;
      }
    }

    public function AssignArray($array) {
      $this->Clear();
      $this->nodes = array();
      if(is_array($array)) {
        foreach($array as $id => $item) {
          if(\is_array($item)) {
            $this->nodes[] = new TTreeData($item);
          }
        }
      }
      if(count($this->nodes)) {
        $this->isDirty = true;
      }
    }

    public function GetRoot() {
      if(!$this->isDirty) {
        return $this->root;
      }
      return null;
    }

    public function GetFirst() {
      if(!$this->isDirty) {
        return $this->first;
      }
      return null;
    }

    public function GetLast() {
      if(!$this->isDirty) {
        return $this->last;
      }
      return null;
    }

    public function GetTreeCount() {
      if(!$this->isDirty) {
        return $this->treeCount;
      }
      return 0;
    }

    public function AddNode($node) {
      if($node instanceof TTreeData) {
        $this->nodes[] = $node;
        $this->isDirty = true;
      } elseif(\is_array($node)) {
        $this->nodes[] = new TTreeData($node);
        $this->isDirty = true;
      }
    }

    public function Clear() {
      $this->root = null;
      $this->first = null;
      $this->last = null;
      $this->isDirty = false;
      $this->treeCount = 0;
    }

    public function Clean() {
      $this->nodes = array();
      $this->root = null;
      $this->first = null;
      $this->last = null;
      $this->isDirty = false;
      $this->treeCount = 0;
    }

    public function count() {
      return \count($this->nodes);
    }

    public function serialize() {
      return \serialize(array('nodes'=>$this->nodes));
    }

    public function unserialize($serialized) {
      $data = \unserialize($serialized);
      if(\is_array($data) && isset($data['nodes'])) {
        $this->nodes = $data['nodes'];
        $this->isDirty = true;
        $this->first = null;
        $this->last = null;
        $this->root = null;
        $this->treeCount = 0;
      }
    }

    public function AddBuildFilter($function) {
      if(\is_callable($function)) {
        $this->buildFilters[] = $function;
      }
    }

    public function ClearBuildFilter() {
      $this->buildFilters = array();
    }

    public function Build($key) {
      $this->Clear();
      $nodeList = array();
      foreach($this->nodes as $node) {
        $filterResult = true;
        foreach($this->buildFilters as $filter) {
          $filterResult &= $filter($node);
        }
        if(!$filterResult) {
          continue;
        }
        if(isset($node[$key])) {
          $keyValue = $node[$key];
          if($keyValue === null) {
            continue;
          }
          if(isset($nodeList[$keyValue])) {
            $nodeList[$keyValue]->AddPayload($node);
          } else {
            $nodeList[$keyValue] = new TTreeNode($node);
            $nodeList[$keyValue]->key = $keyValue;
          }
        }
      }
      if(($this->treeCount = \count($nodeList)) > 0) {
        $keys = \array_keys($nodeList);
        \natsort($keys);
        $prev = null;
        $current = null;
        $nodes = array();
        foreach($keys as $sKey) {
          $current = $nodeList[$sKey];
          $nodes[] = $current;
          $current->SetPrev($prev, false);
          if($prev !== null) {
            $prev->SetNext($current, false);
          } else {
            $this->first = $current;
          }
          $prev = $current;
        }
        if($current !== null) {
          $current->SetNext(null, false);
          $this->last = $current;
        }
        do {
          $popList = array();
          while(\count($nodes) > 0) {
            $left = array_shift($nodes);
            if(\count($nodes) > 0) {
              $parent = array_shift($nodes);
              $popList[] = $parent;
              if(\count($nodes) > 0) {
                $right = array_shift($nodes);
                if(\count($nodes) > 0) {
                  $popList[] = array_shift($nodes);
                }
              } else {
                $right = null;
              }
              $parent->SetLeft($left, false);
              $left->SetParent($parent);
              $parent->SetRight($right, false);
            } else {
              $popList[] = $left;
            }
          }
          $nodes = $popList;
          $popList = array();
        } while(\count($nodes) > 1);
        $this->root = array_shift($nodes);
        return $this->root;
      }
      return null;
    }

    public function offsetExists($offset) {
      return isset($this->nodes[$offset]);
    }

    public function offsetGet($offset) {
      if(isset($this->nodes[$offset])) {
        return $this->nodes[$offset];
      }
      return null;
    }

    public function offsetSet($offset, $value) {
      if($value === null) {
        unset($this->nodes[$offset]);
      } elseif($value instanceof TTreeData) {
        if($offset === null) {
          $this->nodes[] = $value;
        } else {
          $this->nodes[$offset] = $value;
        }
      }
    }

    public function offsetUnset($offset) {
      unset($this->nodes[$offset]);
    }

    public function current() {
      return \current($this->nodes);
    }

    public function key() {
      return \key($this->nodes);
    }

    public function next() {
      return \next($this->nodes);
    }

    public function rewind() {
      return \reset($this->nodes);
    }

    public function valid() {
      return (\key($this->nodes) !== null);
    }

    public function Seek($value) {
      if(!$this->isDirty) {
        $node = $this->root;
        while($node !== null) {
          $match = \strnatcmp($value, $node->key);
          if($match === 0) {
            break;
          } elseif($match > 0) {
            $node = $node->right;
          } elseif($match < 0) {
            $node = $node->left;
          }
        }
        return $node;
      }
      return null;
    }

  }

}