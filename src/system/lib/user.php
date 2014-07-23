<?php
namespace MICOXCMS\Lib {
  
  class TUser extends \MICOXCMS\Lib\TSingletonComponent implements \MICOXCMS\Interfaces\IUser, \MICOXCMS\Interfaces\Session\ISessionSave {
    protected $userData;
    
    public function __construct() {
      parent::__construct();
      $this->userData = array();
      $session = \MICOXCMS\Lib\TSession::Instance()->Start();
      $session->RegisterShutdown($this);
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
      $_SESSION['nisse'] = 42;
    }
    
    public function __destruct() {
      parent::__destruct();
      if(is_array($this->userData)) {
        $this->SaveToSession();
      }
    }
    
    public function SaveToSession($shutdown = false) {
      if(is_array($this->userData)) {
        \MICOXCMS\Lib\TSession::Instance()->Set('user', $this->userData);
      } else {
        \MICOXCMS\Lib\TSession::Instance()->Remove('user');
      }
      if($shutdown === true) {
        $this->userData = false;
      }
    }
    
  }
  
}