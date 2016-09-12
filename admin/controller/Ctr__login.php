<?php 
	Class Ctr__login Extends Template {
		public $admin = null;
	    public $result = null;
	    public $mgs = null;
	    public $currentuser = null;
	    public $common = null;

	    public function __construct() {
	        $this->admin = new Admin();
	        $this->currentuser = new sys_currentuser();
	        $this->common = new sys_common();
	    }

	    public function index() {
	        $this->temp_title = "Đăng nhập";
	        $this->tempf_default = 'empty.php';
	        $this->show("login");
	    }

	    public function submit(){
	    	$this->temp_title = "Đăng nhập";

	    	$username = isset($_POST['username']) ? $_POST['username'] : '';
	    	$password = isset($_POST['password']) ? $_POST['password'] : '';
	    	if (strlen($username) > 0 && strlen($password) > 0) {
            	$this->result = $this->admin->checkLogin($username, md5($password));
            	if(count($this->result)>0){
            		$this->currentuser->signin($this->result[0]);
            		print_r($_SESSION['user']);
                	$this->common->redirectUrl('admin');
            	}else {
                	flashmessage::setMessageError("Tên đăng nhập hoặc mật khẩu không đúng");
            	}
        	}else{
        		flashmessage::setMessageError("Hãy nhập tên đăng nhập hoặc mật khẩu");
        	}
        	$this->common->redirectUrl('admin');
	    }

	    public function logout() {
	        $this->currentuser->signout();
	        $this->common->redirectUrl('admin');
    	}
	}
?>