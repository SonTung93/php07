<?php 
	class Ctr__login extends Template{
		public $result = null;
		public $user = null;
		public $cart = null;
		public $common = null;
		public $currentcustomer = null;
		public function __construct(){
			$this->user = new User();
			$this->cart = new sys_cart();
			$this->common = new sys_common();
			$this->currentcustomer = new sys_currentcustomer();
		}

		public function index() {
	        $this->temp_title = "Đăng nhập";
	        $this->show("login");
	    }

	    public function submit(){
	    	$this->temp_title = "Đăng nhập";

	    	$email = isset($_POST['email']) ? $_POST['email'] : '';
	    	$password = isset($_POST['password']) ? $_POST['password'] : '';
	    	if (strlen($email) > 0 && strlen($password) > 0) {
            	$this->result = $this->user->checkLogin($email, md5($password));
            	if(count($this->result)>0){
            		$this->currentcustomer->signin($this->result[0]);
                	echo "Login";
            	}
            }
	    }
	    public function logout(){
	    	$this->currentcustomer->signout();
	    	$this->common->redirectUrl();
	    }
	}
?>