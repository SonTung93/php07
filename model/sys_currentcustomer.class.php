<?php

class sys_currentcustomer {

    public function __construct() {
        /*         * * maybe set the db name here later ** */
    }

    private $sessionname = '###customer###';

    public function signin($userdata, $remember = 0) {
        if ($remember == '0') {
            $_SESSION[$this->sessionname] = $userdata;
        } else {
            unset($_COOKIE[$this->sessionname]);

            $serializedata = serialize($userdata);
            $encrypted_string = base64_encode($serializedata);

            setcookie($this->sessionname, $encrypted_string, time() + (86400 * 30), '/');
        }
    }

    public function signout() {
        unset($_SESSION[$this->sessionname]);
        unset($_COOKIE[$this->sessionname]);
    }

    public function getCustomerData() {

        $session_customer = null;

        if (isset($_SESSION[$this->sessionname])) {
            $session_customer = $_SESSION[$this->sessionname];
        } elseif (isset($_COOKIE[$this->sessionname])) {
            $session_customer = base64_decode($_COOKIE[$this->sessionname]);
        }

        return $session_customer;
    }

    public function isLogin() {

        $existed = isset($_SESSION[$this->sessionname]) ? 1 : 0;
        return $existed;
    }

    public function getUsername() {

        if ($this->isLogin() == 1) {
            $session_customer = $this->getCustomerData();
            return $session_customer['name'];
        }
        return "";
    }
    public function getPhone() {

        if ($this->isLogin() == 1) {
            $session_customer = $this->getCustomerData();
            return $session_customer['phone'];
        }
        return "";
    }
    public function getEmail() {

        if ($this->isLogin() == 1) {
            $session_customer = $this->getCustomerData();
            return $session_customer['email'];
        }
        return "";
    }

    public function getAddress() {

        if ($this->isLogin() == 1) {
            $session_customer = $this->getCustomerData();
            return $session_customer['address'];
        }
        return "";
    }

    public function getPassword() {
        if ($this->isLogin() == 1) {
            $session_customer = $this->getCustomerData();
            return $session_customer['password'];
        }
        return "";
    }

     public function getCreated() {
        if ($this->isLogin() == 1) {
            $session_customer = $this->getCustomerData();
            return $session_customer['created'];
        }
        return "";
    }

    public function getID() {
        if ($this->isLogin() == 1) {
            $session_customer = $this->getCustomerData();
            return $session_customer['id'];
        }
        return "";
    }

}

?>
