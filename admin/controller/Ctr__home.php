<?php

Class Ctr__home Extends Template {
    
    public $fmessage = null;
    public $common = null;

    public function __construct() {
            
    }

    public function index() {
        $this->temp_title = "Quản trị hệ thống";
        $this->show("home");
    }

}

?>
