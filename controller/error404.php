<?php
	Class Ctr__error404 Extends Template {
		public $currentcustomer = null;
		public $cart = null;
		public function __construct(){
			$this->cart = new sys_cart();
			$this->currentcustomer = new sys_currentcustomer();
		}
    	public function index() {
	        $this->temp_title = '404 lỗi';
	        //$this->blog_heading = '404 lỗi';
	        $this->show('error404');
    	}
	}
?>
