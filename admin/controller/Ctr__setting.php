<?php 
	Class Ctr__setting Extends Template {
		public $common = null;
	    public $currentUser = null;
	    public $result = null;
	    public $category = null;
	    public $setting = null;
	    public function __construct(){
	    	$this->common = new sys_common();
	    	$this->category = new Category();
	    	$this->currentUser = new sys_currentuser();
	    	$this->setting = new Setting();
	    }
	    public function index(){

	    }
	    public function footer(){
	    	$this->temp_title = 'Quản lý footer';
	    	if (isset($_POST['save'])) {
	    		$this->setting->contact_content = isset($_POST['content'])?$_POST['content']:"";
	    		$this->setting->contact_address = isset($_POST['address'])?$_POST['address']:"";
	    		$this->setting->contact_phone = isset($_POST['phone'])?$_POST['phone']:"";
	    		$this->setting->contact_email = isset($_POST['email'])?$_POST['email']:"";
	    		$this->setting->contact_map = isset($_POST['map'])?$_POST['map']:"";
	    		$this->setting->contact_facebook = isset($_POST['facebook'])?$_POST['facebook']:"";
	    		$this->setting->modified = date('Y/m/d H:i:s', time());
	    		$rs = $this->setting->updateFooter();
	    		if($rs>0){
	    			flashmessage::setMessage('Cập nhật thành công');
	    		}else{
	    			flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	    		}
	    		$this->common->redirectUrl('admin/setting/footer');
	    	}else{
	    		$this->result = $this->setting->getSettingDataByID(2);
	    		$this->show('setting_footer');
	    	}
	    }
	    public function home(){
	    	$this->temp_title = 'Thông tin trang chủ';
	    	if (isset($_POST['save'])) {
	    		$this->setting->category_box1 = isset($_POST['category_box1'])?$_POST['category_box1']:"";
	    		$this->setting->category_box2 = isset($_POST['category_box2'])?$_POST['category_box2']:"";
	    		$this->setting->category_box3 = isset($_POST['category_box3'])?$_POST['category_box3']:"";
	    		$this->setting->category_box4 = isset($_POST['category_box4'])?$_POST['category_box4']:"";
	    		$this->setting->modified = date('Y/m/d H:i:s', time());
	    		$rs = $this->setting->updateCategoryHomeData();
	    		if($rs>0){
	    			flashmessage::setMessage('Cập nhật thành công');
	    		}else{
	    			flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	    		}
	    		$this->common->redirectUrl('admin/setting/home');
	    	}

	    	$this->result = $this->setting->getSettingDataByID(1);

        	$this->show("setting_home_category");
	    }

	    public function loadSelect($parent_id = 0, $current = 0) {
	        $list_category = $this->category->getCategoryByParentID($parent_id);

	        if (count($list_category) > 0) {
	            foreach ($list_category as $key => $value) {
	                if ($value['parent_id'] == 0) {
	                    $first_char = '';
	                    $char_space = '';
	                } else {
	                    $first_char = '&boxur;&boxh; ';
	                    $this->category->ck_count = 0;
	                    $char = $this->category->getCountParent($value['parent_id']);
	                    if ($char > 0) {
	                        $char_space = str_repeat('&cir;&nbsp;&nbsp;', $char + 1);
	                    } else {
	                        $char_space = '&cir;&nbsp;&nbsp;';
	                    }
	                }

	                $selector = ($value['id'] == $current) ? 'selected = "selected"' : '';


	                echo '<option value = "' . $value['id'] . '" ' . $selector . '>';
	                echo $char_space . $first_char . $value['name'];
	                echo '</option>';

	                $this->loadSelect($value['id'], $current);
	            }
	        }
	    }
	}
?>