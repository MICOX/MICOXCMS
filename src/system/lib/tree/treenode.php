<?php

namespace MICOXCMS\Lib\Tree {
  
  class TTreeNode implements \ArrayAccess, \Countable, \Iterator {
    protected $key;
    protected $prev;
    protected $left;
    protected $parent;
    protected $right;
    protected $next;
    protected $payload;
    protected $activePayload;
    protected $arrayAccess;

    function __construct($data) {
      $this->key = null;
      $this->prev = null;
      $this->left = null;
      $this->parent = null;
      $this->right = null;
      $this->next = null;
      $this->payload = array();
      if($data instanceof TTreeData) {
        $this->payload[0] = $data;
      } elseif(is_array($data)) {
        $this->payload[0] = new TTreeData($data);
      } else {
        throw new Exception('Can only add an array or an instance of TTreeData');
      }
      $this->activePayload = 0;
      $this->arrayAccess = null;
    }

    function __get($name) {
      switch($name) {
        case 'key':
          return $this->key;
        case 'prev':
          return $this->prev;
        case 'left':
          return $this->left;
        case 'parent':
          return $this->parent;
        case 'right':
          return $this->right;
        case 'next':
          return $this->next;
        default:
          return $this->offsetGet($name);
      }
    }

    function __set($name, $value) {
      switch($name) {
        case 'key':
          $this->key = $value;
          break;
        case 'prev':
        case 'left':
        case 'parent':
        case 'right':
        case 'next':
          break;
        default:
          $this->offsetSet($name, $value);
      }
    }

    public function count() {
      if($this->arrayAccess === null) {
        $this->arrayAccess = $this->payload[$this->activePayload]->GetKeys();
      }
      return \count($this->arrayAccess);
    }

    public function current() {
      if($this->arrayAccess === null) {
        $this->arrayAccess = $this->payload[$this->activePayload]->GetKeys();
      }
      $key = \current($this->arrayAccess);
      return $this->payload[$this->activePayload][$key];
    }

    public function key() {
      if($this->arrayAccess === null) {
        $this->arrayAccess = $this->payload[$this->activePayload]->GetKeys();
      }
      $key = \current($this->arrayAccess);
      return $key;
    }

    public function next() {
      if($this->arrayAccess === null) {
        $this->arrayAccess = $this->payload[$this->activePayload]->GetKeys();
      }
      $key = \next($this->arrayAccess);
      return $this->payload[$this->activePayload][$key];
    }

    public function offsetExists($offset) {
      return isset($this->payload[$this->activePayload][$offset]);
    }

    public function offsetGet($offset) {
      if(isset($this->payload[$this->activePayload][$offset])) {
        return $this->payload[$this->activePayload][$offset];
      }
      return null;
    }

    public function offsetSet($offset, $value) {
      if($offset === null) {
        $this->payload[$this->activePayload][] = $value;
      } else {
        $this->payload[$this->activePayload][$offset] = $value;
      }
    }

    public function offsetUnset($offset) {
      unset($this->payload[$this->activePayload][$offset]);
    }

    public function rewind() {
      if($this->arrayAccess === null) {
        $this->arrayAccess = $this->payload[$this->activePayload]->GetKeys();
      }
      $key = reset($this->arrayAccess);
      return $this->payload[$this->activePayload][$key];
    }

    public function valid() {
      if($this->arrayAccess === null) {
        $this->arrayAccess = $this->payload[$this->activePayload]->GetKeys();
      }
      $key = \key($this->arrayAccess);
      return ($key !== null);
    }

    public function AddPayload($node) {
      $this->payload[] = $node;
    }

    public function PayloadCount() {
      return \count($this->payload);
    }

    public function PayloadKeys() {
      return \array_keys($this->payload);
    }

    public function SetActivePayload($key) {
      if(isset($this->payload[$key])) {
        $this->activePayload = $key;
      }
    }

    public function SetPrev($node, $doReverse = true) {
      if($node === null) {
        if($doReverse) {
          if($this->prev !== null) {
            $this->prev->SetNext($this->next, false);
          }
        }
        $this->prev = null;
      } elseif($node instanceof TTreeNode) {
        if($doReverse) {
          if($this->prev !== null) {
            $this->prev->SetNext($node, false);
          }
        }
        $this->prev = $node;
      }
    }

    public function SetLeft($node, $doReverse = true) {
      if($node === null) {
        if($doReverse) {

        }
        $this->left = null;
      } elseif($node instanceof TTreeNode) {
        if($doReverse) {

        }
        $this->left = $node;
      }
    }

    public function SetParent($node, $doReverse = true) {
      if($node === null) {
        if($doReverse) {

        }
        $this->parent = null;
      } elseif($node instanceof TTreeNode) {
        if($doReverse) {

        }
        $this->parent = $node;
      }
    }

    public function SetRight($node, $doReverse = true) {
      if($node === null) {
        if($doReverse) {

        }
        $this->right = null;
      } elseif($node instanceof TTreeNode) {
        if($doReverse) {

        }
        $this->right = $node;
      }
    }

    public function SetNext($node, $doReverse = true) {
      if($node === null) {
        if($doReverse) {
          if($this->next !== null) {
            $this->next->SetPrev($this->prev, false);
          }
        }
        $this->next = null;
      } elseif($node instanceof TTreeNode) {
        if($doReverse) {
          if($this->next !== null) {
            $this->next->SetPrev($node, false);
          }
        }
        $this->next = $node;
      }
    }

  }
}
