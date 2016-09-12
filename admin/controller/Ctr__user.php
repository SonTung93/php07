<?php
	Class Ctr__user Extends Template {
	    public $common = null;
	    public $currentUser = null;
	    public $result = null;
	    public $pagination = null;
	    public $search = null;
	    public $limit = null;
	    public $page = null;
	    public $user = null;

	    public function __construct() {
	        $this->common = new sys_common();
	        $this->user = new User();
	        $this->currentUser = new sys_currentuser();
    	}

    	public function index(){
    		$this->temp_title = "Quản lý thành viên";

	        $this->search = isset($_GET['search']) ? $_GET['search'] : '';
	        $this->page = isset($_GET['page']) ? $_GET['page'] : 1;
	        $this->limit = isset($_GET['size']) ? $_GET['size'] : 3;

	        $arr = array();

	        $arr = $this->user->getAllUser($this->search, 'id', 'DESC', $this->page, $this->limit);

	        $this->result = $arr['data'];
	        $this->pagination = $arr['pager'];

	        $this->show("user");
    	}


    	public function edit(){
    		$this->temp_title = "Chỉnh sửa thông tin";

        	if (isset($_POST['save'])) {
        		$this->user->id = isset($_POST['eid']) ? $_POST['eid'] : '';
        		$this->user->name = isset($_POST['name']) ? $_POST['name'] : '';
        		$this->user->password = isset($_POST['password']) ? md5($_POST['password']) : '';
        		$this->user->phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        		$this->user->address = isset($_POST['address']) ? $_POST['address'] : '';
        		$this->user->email = isset($_POST['email']) ? $_POST['email'] : '';
        		$this->user->status = isset($_POST['status']) ? $_POST['status'] : '';
        		$this->user->modified = date('Y/m/d H:i:s', time());
        		$this->user->modified_by = $this->currentUser->getUsername();
        		$rs = $this->user->updateData();
	            if ($rs > 0) {
	            	if($this->user->password != '') $this->user->updatePassword();
	                flashmessage::setMessage('Cập nhật thành công !');
	            } else {
	                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	            }
	            $this->common->redirectUrl('admin/user/edit/' . $this->user->id);
        	}else{
        		 $id = isset($_GET['id']) ? $_GET['id'] : '';

	            $this->result = $this->user->getUserByID($id);

	            if ($this->result == '') {
	                flashmessage::setMessageError('Không tìm thấy dữ liệu !');
	                $this->common->redirectUrl('admin/user');
	            } else {
	                $this->show("user_edit");
	            }
        	}
    	}
    	public function delete() {
	        $id = isset($_POST['id']) ? $_POST['id'] : '';

	        $rs = $this->user->deleteData($id);

	        echo $rs;

	        if ($rs > 0) {
	            flashmessage::setMessage('Cập nhật thành công !');
	        } else {
	            flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	        }
	    }

	    public function change_status() {
	        $status = isset($_POST['status']) ? $_POST['status'] : 0;
	        $list_id = isset($_POST['list_id']) ? $_POST['list_id'] : 0;
	        $rs = $this->user->updateMultiStatus($status, $list_id);
	        if ($rs > 0) {
	            flashmessage::setMessage('Cập nhật thành công!');
	        } else {
	            flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	        }
	    }
	}
?>