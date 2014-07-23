<?php
namespace MICOXCMS\Lib {
  
  class TUser extends \MICOXCMS\Lib\TSingletonComponent {
    protected $userData;
    
    public function __construct() {
      parent::__construct();
      $this->userData = array();
      $session = \MICOXCMS\Lib\TSession::Instance()->Start();
      if($session->Has('user')) {
        $temp = $session->Get('user');
        if(is_array($temp)) {
          // Validate user access and that no timeout has occured
        } else {
          $this->userData['userid'] = false;
        }
      } else {
        $this->userData['userid'] = false;
      }
    }
    
    public function __destruct() {
      parent::__destruct();
    }
    
  }
  
}