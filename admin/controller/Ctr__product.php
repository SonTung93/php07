<?php
	Class Ctr__product Extends Template {
	    public $common = null;
	    public $currentUser = null;
	    public $result = null;
	    public $pagination = null;
	    public $search = null;
	    public $limit = null;
	    public $page = null;
	    public $product = null;
	    public $search_category = null;
	    public $category = null;
	    public function __construct() {
	    	$this->category = new Category();
	        $this->common = new sys_common();
	        $this->product = new Product();
	        $this->currentUser = new sys_currentuser();
    	}

    	public function index(){
    		$this->temp_title = "Quản trị sản phẩm";

	        $this->search_category = isset($_GET['category']) ? $_GET['category'] : '';
	        $this->search = isset($_GET['search']) ? $_GET['search'] : '';
	        $this->page = isset($_GET['page']) ? $_GET['page'] : 1;
	        $this->limit = isset($_GET['size']) ? $_GET['size'] : 3;

	        $list_id = array();

	        if ($this->search_category != '') {
	            $list_id = $this->category->getAllCategoryChildByParent($this->search_category);

	            array_push($list_id, $this->search_category);
	        }
	        $arr = array();

	        $arr = $this->product->getAllProduct($this->search, implode(',', $list_id), 'id', 'DESC', $this->page, $this->limit);

	        $this->result = $arr['data'];
	        $this->pagination = $arr['pager'];

	        $this->show("product");
    	}

    	public function create(){
    		$this->temp_title = "Thêm mới sản phẩm";

        	if (isset($_POST['save'])) {

	            $file = isset($_FILES['image_upload']) ? $_FILES['image_upload'] : '';

	            if ($file['name'] != '') {
	                if ($this->common->isTrueTypeImage($file) != '') {
	                    if ($this->common->isTrueSizeImage($file) != '') {
	                        $this->product->image = $this->common->move_file($file, 'Product');
	                    } else {
	                        flashmessage::setMessageError('Ảnh có dung lượng quá lớn');
	                        $this->common->redirectUrl('admin/product/create');
	                    }
	                } else {
	                    flashmessage::setMessageError('Tập tin không đúng định dạng ảnh');
	                    $this->common->redirectUrl('admin/product/create');
	                }
	            } else {
	                $this->product->image = isset($_POST['image']) ? $_POST['image'] : '';
	            }
	            $this->product->name = isset($_POST['name']) ? $_POST['name'] : '';
	            $this->product->price = isset($_POST['price']) ? $_POST['price'] : '';
	            $this->product->price_old = isset($_POST['price_old']) ? $_POST['price_old'] : '';
	            $this->product->description = isset($_POST['description']) ? $_POST['description'] : '';
	            $this->product->promotion = isset($_POST['promotion']) ? $_POST['promotion'] : '';
	            $this->product->created = date('Y/m/d H:i:s', time());
           		$this->product->created_by = $this->currentUser->getUsername();
           		$this->product->status = isset($_POST['status']) ? $_POST['status'] : '';
           		$this->product->category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
           		$this->product->featured = isset($_POST['featured']) ? $_POST['featured'] : '';;

           		$rs = $this->product->insertData();

	            if ($rs > 0) {
	                $id = $this->product->getTopID();
	                flashmessage::setMessage('Thêm mới thành công !');
	                $this->common->redirectUrl('admin/product/edit/' . $id);
	            } else {
	                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	                $this->common->redirectUrl('admin/product/create');
	            }
        	}else{
        		$this->show("product_create");
        	}
    	}

    	public function edit(){
    		$this->temp_title = "Sửa sản phẩm";

        	if (isset($_POST['save'])) {

	            $file = isset($_FILES['image_upload']) ? $_FILES['image_upload'] : '';

	            if ($file['name'] != '') {
	                if ($this->common->isTrueTypeImage($file) != '') {
	                    if ($this->common->isTrueSizeImage($file) != '') {
	                        $this->product->image = $this->common->move_file($file, 'Product');
	                    } else {
	                        flashmessage::setMessageError('Ảnh có dung lượng quá lớn');
	                        $this->common->redirectUrl('admin/product/edit/' . $this->product->id);
	                    }
	                } else {
	                    flashmessage::setMessageError('Tập tin không đúng định dạng ảnh');
	                    $this->common->redirectUrl('admin/product/edit/' . $this->product->id);
	                }
	            } else {
	                $this->product->image = isset($_POST['image']) ? $_POST['image'] : '';
	            }
	            $this->product->id = isset($_POST['eid']) ? $_POST['eid'] : '';
	            $this->product->name = isset($_POST['name']) ? $_POST['name'] : '';
	            $this->product->price = isset($_POST['price']) ? $_POST['price'] : '';
	            $this->product->price_old = isset($_POST['price_old']) ? $_POST['price_old'] : '';
	            $this->product->description = isset($_POST['description']) ? $_POST['description'] : '';
	            $this->product->promotion = isset($_POST['promotion']) ? $_POST['promotion'] : '';
	            $this->product->modified = date('Y/m/d H:i:s', time());
           		$this->product->modified_by = $this->currentUser->getUsername();
           		$this->product->status = isset($_POST['status']) ? $_POST['status'] : '';
           		$this->product->category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
           		$this->product->featured = isset($_POST['featured']) ? $_POST['featured'] : '';;
           		$rs = $this->product->updateData();

	            if ($rs > 0) {
	                flashmessage::setMessage('Cập nhật thành công !');
	            } else {
	                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	            }
	            $this->common->redirectUrl('admin/product/edit/' . $this->product->id);
        	}else{
        		$id = isset($_GET['id']) ? $_GET['id'] : '';

	            $this->result = $this->product->getProductByID($id);

	            if ($this->result == '') {
	                flashmessage::setMessageError('Không tìm thấy dữ liệu !');
	                $this->common->redirectUrl('admin/article');
	            } else {
	                $this->show("product_edit");
	            }
        	}
    	}

    	public function change_status() {
	        $status = isset($_POST['status']) ? $_POST['status'] : 0;
	        $list_id = isset($_POST['list_id']) ? $_POST['list_id'] : 0;
	        $rs = $this->product->updateMultiStatus($status, $list_id);
	        if ($rs > 0) {
	            flashmessage::setMessage('Cập nhật thành công!');
	        } else {
	            flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	        }
	    }

	    public function delete() {
	        $id = isset($_POST['id']) ? $_POST['id'] : '';

	        $rs = $this->product->deleteData($id);

	        echo $rs;

	        if ($rs > 0) {
	            flashmessage::setMessage('Cập nhật thành công !');
	        } else {
	            flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	        }
	    }
	    
	    public function change_featured() {
	    	$featured_temp = isset($_POST['featured']) ? $_POST['featured'] : 0;

	    	if($featured_temp ==0){
	    		$this->product->featured =1;
	    	}else{
	    		$this->product->featured =0;
	    	}
	    	$this->product->id = isset($_POST['eid']) ? $_POST['eid'] : '';
	    	$this->product->modified = date('Y/m/d H:i:s', time());
	    	$this->product->modified_by = $this->currentUser->getUsername();
	    	$rs = $this->product->updateFeatured();
	    	if ($rs > 0) {
            	flashmessage::setMessage('Cập nhật thành công !');
	        } else {
	            flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	        }
	        
	        $this->common->redirectUrl('/admin/product');
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