<?php 
	class Ctr__user extends Template{
		public $currentcustomer = null;
		public $result = null;
		public $user = null;
		public $cart = null;
		public $common = null;
		public $order = null;
		public $product = null;
		public $transaction = null;
		public $attribute_product = null;
		public function __construct(){
			$this->currentcustomer = new sys_currentcustomer();
			$this->user = new User();
			$this->order = new Order();
			$this->product = new Product();
			$this->transaction = new Transaction();
			$this->common = new sys_common();
			$this->cart = new sys_cart();
			$this->attribute_product = new Attribute_Product();
		}

		public function index(){
			if ($this->currentcustomer->isLogin()) {
				$this->temp_title = "Thành viên";
				$this->show('user');
			}else{
				$this->temp_title = '404 lỗi';
	        	$this->show("error404");
			}		
		}
		public function created(){
				$this->user->name =  isset($_POST['name'])?$_POST['name']:'';
				$email =  isset($_POST['email'])?$_POST['email']:'';
				if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false){
					$this->user->email = $email;
				}
				$password =  isset($_POST['password'])?$_POST['password']:'';
				$re_password =  isset($_POST['repassword'])?$_POST['repassword']:'';
				if($password == $re_password){ 
					$this->user->password = md5($password);
				}
				$this->user->phone = isset($_POST['phone'])?$_POST['phone']:'';
				$this->user->address = isset($_POST['address'])?$_POST['address']:'';
				$this->user->created = date('Y/m/d H:i:s', time());
				$this->user->status = 1;
				$rs = $this->user->insertData();
				if($rs>0){
					send_gmail($this->user->email,$this->user->name,'Đăng ký tài khoản','Chào mừng bạn đã trở thành thành viên của website','Shop');
					flashmessage::setMessageMainClient('Đăng ký tài khoản thành công !');
					$this->common->redirectUrl('');
				}else{
					flashmessage::setMessageMainClient('Có lỗi xảy ra !');
					$this->common->redirectUrl('');
				}
		}
		public function history(){
			$this->temp_title = "Lịch sử";
			$id = $this->currentcustomer->getID();
			$this->result = $this->transaction->getTransactionByUserID($id);
			$this->show('history');
		}
		public function forgot_pass(){
			if(isset($_POST['save'])){
				$this->user->email = isset($_POST['email'])?$_POST['email']:'';
				$result = $this->user->getUserByEmail($this->user->email);
				if(empty($result)){
					flashmessage::setMessageMainClient('Email không tồn tại !');
					$this->common->redirectUrl('user/forgot/pass');
				}
				$capcha = isset($_POST['capcha'])?$_POST['capcha']:'';
				if($capcha == capcha::getCode()){
					$password = substr(md5("shop".time()),0,8);
					$this->user->password = md5($password);
					$rs = $this->user->fogotPassword();
					if($rs>0){
						send_gmail($this->user->email,"Thành viên",'Quên mật khẩu','Mật khẩu mới của bạn là : '.$password.'','Shop');
						flashmessage::setMessageMainClient('Mật khẩu đã được gửi đến email của bạn !');
						capcha::clearCapcha();
						$this->common->redirectUrl('');
					}
				}else{
					flashmessage::setMessageMainClient('Có lỗi xảy ra !');
					$this->common->redirectUrl('user/forgot/pass');
				}
			}else{
				$this->temp_title = "Quên mật khẩu";
				$this->show('forgot_password');
			}
		}
		public function change_pass(){
			if(isset($_POST['save'])){
				$this->user->id = $this->currentcustomer->getID();
				$oldpassword = isset($_POST['oldpassword'])?$_POST['oldpassword']:'';
				$newpassword = isset($_POST['newpassword'])?$_POST['newpassword']:'';
				$re_password = isset($_POST['re-password'])?$_POST['re-password']:'';
				$error = array();
				if($this->user->getUserByID($this->user->id)['password'] != md5($oldpassword)){
					$error[] = "oldpass";
				}
				if($newpassword != $re_password){
					$error[] = 'newpass';
				}	
				if(empty($error)){
					$this->user->password = md5($newpassword);
					$rs = $this->user->changePassword();
					if($rs>0){
						flashmessage::setMessageMainClient('Đổi mật khẩu thành công !');
						$this->common->redirectUrl('user');
					}else{
						flashmessage::setMessageMainClient('Có lỗi xảy ra !');
						$this->common->redirectUrl('user');
					}
				}else{
					flashmessage::setMessageMainClient('Có lỗi xảy ra !');
					$this->common->redirectUrl('user/change/pass');
				}
			}else{
				$this->temp_title = "Đổi mật khẩu";
				$this->show('changepass');
			}
		}
	}

?>