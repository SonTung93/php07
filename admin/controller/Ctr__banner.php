<?php 
	class Ctr__banner extends Template{
		public $common = null;
	    public $currentUser = null;
	    public $result = null;
	    public $banner = null;

	    public function __construct(){
	    	$this->common = new sys_common();
	        $this->banner = new Banner();
	        $this->currentUser = new sys_currentuser();
	    }

	    public function index(){
	    	$this->temp_title = "Quản lý banner";

	    	$this->result = $this->banner->getAllBanner();
	    	$this->show('banner');
	    }

	    public function create(){
	    	$this->temp_title = "Thêm banner";
	    	if (isset($_POST['save'])) {
	    		$file = isset($_FILES['image_upload']) ? $_FILES['image_upload'] : '';

	            if ($file['name'] != '') {
	                if ($this->common->isTrueTypeImage($file) != '') {
	                    if ($this->common->isTrueSizeImage($file) != '') {
	                        $this->banner->image = $this->common->move_file($file, 'Banner');
	                    } else {
	                        flashmessage::setMessageError('Ảnh có dung lượng quá lớn');
	                        if ($this->banner->id != '') {
	                            $this->common->redirectUrl('admin/banner/edit/' . $this->article->id);
	                        } else {
	                            $this->common->redirectUrl('admin/banner/create');
	                        }
	                    }
	                } else {
	                    flashmessage::setMessageError('Tập tin không đúng định dạng ảnh');
	                    if ($this->banner->id != '') {
	                        $this->common->redirectUrl('admin/banner/edit/' . $this->article->id);
	                    } else {
	                        $this->common->redirectUrl('admin/banner/create');
	                    }
	                }
	            } else {
	                $this->banner->image = isset($_POST['image']) ? $_POST['image'] : '';
	            }
	            $this->banner->name = isset($_POST['name'])?$_POST['name']:'';
	            $this->banner->content = isset($_POST['content'])?$_POST['content']:'';
	            $this->banner->url = isset($_POST['url'])?$_POST['url']:'';
	            $this->banner->position = isset($_POST['position'])?$_POST['position']:'';
	            $this->banner->created = date('Y/m/d H:i:s', time());
	            $this->banner->status = isset($_POST['status'])?$_POST['status']:'';
	            $rs = $this->banner->insertData();

                if ($rs > 0) {
                    $id = $this->banner->getTopID();
                    flashmessage::setMessage('Thêm mới thành công !');

                    $this->common->redirectUrl('admin/banner/edit/' . $id);
                } else {
                    flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
                }
	    	}else{
	    		$this->show('banner_create');
	    	}
	    }

	    public function edit(){
	    	$this->temp_title = "Sửa banner";
	    	if (isset($_POST['save'])) {
	    		$file = isset($_FILES['image_upload']) ? $_FILES['image_upload'] : '';
	            if ($file['name'] != '') {
	                if ($this->common->isTrueTypeImage($file) != '') {
	                    if ($this->common->isTrueSizeImage($file) != '') {
	                        $this->banner->image = $this->common->move_file($file, 'Banner');
	                        unlink('../upload/Images/Banner/'.$_POST['image']);
	                    } else {
	                        flashmessage::setMessageError('Ảnh có dung lượng quá lớn');
	                        $this->common->redirectUrl('admin/banner/edit/' . $this->banner->id);
	                    }
	                } else {
	                    flashmessage::setMessageError('Tập tin không đúng định dạng ảnh');
	                    $this->common->redirectUrl('admin/banner/edit/' . $this->banner->id);
	                }
	            } else {
	                $this->banner->image = isset($_POST['image']) ? $_POST['image'] : '';
	            }
	            $this->banner->id = isset($_POST['eid'])?$_POST['eid']:'';
	            $this->banner->name = isset($_POST['name'])?$_POST['name']:'';
	            $this->banner->content = isset($_POST['content'])?$_POST['content']:'';
	            $this->banner->url = isset($_POST['url'])?$_POST['url']:'';
	            $this->banner->position = isset($_POST['position'])?$_POST['position']:'';
	            $this->banner->modified = date('Y/m/d H:i:s', time());
	            $this->banner->status = isset($_POST['status'])?$_POST['status']:'';
	            $this->banner->id = isset($_POST['eid'])?$_POST['eid']:'';
	            $rs = $this->banner->updateData();

	            if ($rs > 0) {
	                flashmessage::setMessage('Cập nhật thành công !');
	            } else {
	                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	            }
	            $this->common->redirectUrl('admin/banner/edit/' . $this->article->id);
	    	}else{
	    		$id = isset($_GET['id']) ? $_GET['id'] : '';

                $this->result = $this->banner->getBannerByID($id);
                if ($this->result == '') {
                    flashmessage::setMessageError('Không tìm thấy dữ liệu !');
                    $this->common->redirectUrl('admin/menu');
                } else {
                    $this->show("banner_edit");
                }
	    	}

	    }
	    public function change_status() {
	        $status = isset($_POST['status']) ? $_POST['status'] : 0;
	        $list_id = isset($_POST['list_id']) ? $_POST['list_id'] : 0;
	        $rs = $this->banner->updateMultiStatus($status, $list_id);
	        if ($rs > 0) {
	            flashmessage::setMessage('Cập nhật thành công!');
	        } else {
	            flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	        }
	    }

	    public function delete() {
            $id = isset($_POST['id']) ? $_POST['id'] : '';

            $rs = $this->banner->deleteData($id);

            echo $rs;

            if ($rs > 0) {
                flashmessage::setMessage('Cập nhật thành công !');
            } else {
                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
            }
        }
	}
	
?>