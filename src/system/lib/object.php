<?php
namespace MICOXCMS\Lib {
  class TObject {
    public function __construct() {
      echo get_called_class();
    }
  }
}