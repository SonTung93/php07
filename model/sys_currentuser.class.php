<?php

class sys_currentuser {

    public function __construct() {
        
    }

    private $sessionname = 'user';

    public function signin($userdata, $remember = 0) {
        $_SESSION[$this->sessionname] = $userdata;
    }

    public function signout() {
        unset($_SESSION[$this->sessionname]);
    }

    public function isLogin() {
        $existed = isset($_SESSION[$this->sessionname]) ? 1 : 0;
        return $existed;
    }

    public function getUserID() {

        if ($this->isLogin() == 1) {
            return $_SESSION[$this->sessionname]['id'];
        }
        return "";
    }

    public function getUsername() {

        if ($this->isLogin() == 1) {
            return $_SESSION[$this->sessionname]['username'];
        }
        return "";
    }

    public function getPassword() {
        if ($this->isLogin() == 1) {
            return $_SESSION[$this->sessionname]['password'];
        }
        return "";
    }

}

?>
