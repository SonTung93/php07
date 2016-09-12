<?php

class E_Admin {

    public $id = null;
    public $username = null;
    public $password = null;
    public $modified = null;
    public $status = null;

}

class Admin Extends E_Admin {

    public $obj_DB = null;
    private $arr_Rows = null;

    public function __construct() {
        $this->obj_DB = new sys_db();
    }

    public function __set($s_key, $obj_value) {
        $this->$s_key = $obj_value;
    }

    public function __get($s_key) {
        return $this->$s_key;
    }

    public function checkLogin($username = '', $password = '') {
        try {
            $s_Query = 'SELECT * FROM ' . TB_PREFIX . 'admin WHERE username="' . addslashes($username) . '" AND password="' . addslashes($password) . '"';
            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows;
    }

    public function updatePassword() {
        try {
            $s_Query = 'UPDATE ' . TB_PREFIX . 'admin SET modified="' . addslashes($this->modified) . '",password="' . addslashes($this->password) . '" WHERE id="' . intval($this->id) . '"';
            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows;
    }

}

?>
