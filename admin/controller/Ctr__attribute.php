<?php 
	Class Ctr__attribute Extends Template {
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
	    public $attribute = null;
	    public $attribute_product = null;
	    public $data_product = null;
	    public $data_attribute = null;

	    public function __construct() {
	    	$this->category = new Category();
	        $this->common = new sys_common();
	        $this->product = new Product();
	        $this->attribute = new Attribute();
	        $this->attribute_product = new Attribute_Product();
	        $this->currentUser = new sys_currentuser();
    	}

    	public function index(){
    		$this->temp_title = "Quản trị thuộc tính";
    		$this->result = $this->attribute->getAllAttribute();
    		$this->show("attribute");
    	}
    	public function create(){
    		$this->temp_title = "Thêm mới thuộc tính";

        	if (isset($_POST['save'])) {
        		$this->attribute->name = isset($_POST['name']) ? $_POST['name'] : '';
	           	$category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
	           	$this->attribute->category_id = implode(',', $category_id);
	            $this->attribute->description = isset($_POST['description']) ? $_POST['description'] : '';
	            $this->attribute->created = date('Y/m/d H:i:s', time());
           		$this->attribute->created_by = $this->currentUser->getUsername();
	            $this->attribute->status = isset($_POST['status']) ? $_POST['status'] : '';
	            $rs = $this->attribute->insertData();

	            if ($rs > 0) {
	                $id = $this->attribute->getTopID();
	                flashmessage::setMessage('Thêm mới thành công !');
	                $this->common->redirectUrl('admin/attribute/edit/' . $id);
	            } else {
	                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	                $this->common->redirectUrl('admin/attribute/create');
	            }
        	}else{
        		$this->show("attribute_create");
        	}
    	}
    	public function edit(){
    		$this->temp_title = "Sửa thuộc tính";
    		$this->attribute->id = isset($_GET['id'])?$_GET['id']:'';
    		if (isset($_POST['save'])) {
        		$this->attribute->name = isset($_POST['name']) ? $_POST['name'] : '';
	           	$category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
	           	$this->attribute->category_id = implode(',', $category_id);
	            $this->attribute->description = isset($_POST['description']) ? $_POST['description'] : '';
	            $this->attribute->modified = date('Y/m/d H:i:s', time());
           		$this->attribute->modified_by = $this->currentUser->getUsername();
	            $this->attribute->status = isset($_POST['status']) ? $_POST['status'] : '';
	            $rs = $this->attribute->updateData();

	            if ($rs > 0) {
	                $id = $this->attribute->getTopID();
	                flashmessage::setMessage('Thêm mới thành công !');
	                $this->common->redirectUrl('admin/attribute/edit/' . $id);
	            } else {
	                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	                $this->common->redirectUrl('admin/attribute/create');
	            }
        	}else{
        		$this->result = $this->attribute->getAttributeByID(	$this->attribute->id);
        		if ($this->result == '') {
	                flashmessage::setMessageError('Không tìm thấy dữ liệu !');
	                $this->common->redirectUrl('admin/attribute/');
	            } else {
	                $this->show("attribute_edit");
	            }
        		
        	}
    	}

    	public function delete() {
	        $id = isset($_POST['id']) ? $_POST['id'] : '';

	        $rs = $this->attribute->deleteData($id);

	        echo $rs;

	        if ($rs > 0) {
	            flashmessage::setMessage('Cập nhật thành công !');
	        } else {
	            flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	        }
	    }
	    
    	public function add_attribute (){
    		$this->temp_title = "Thêm mới giá trị thuộc tính ";
    		$id = isset($_GET['id'])?$_GET['id']:'';
    		$this->data_product = $this->product->getProductByID($id);
			$cate_id = $this->category->getParentCategory($this->data_product['category_id']);
			$this->result = $this->attribute->getAttributeNameByCategoryID($cate_id);
			$this->data_attribute = $this->attribute_product->getAllAttributeProductByProductID($id);
    		if(isset($_POST['save'])){
    			$this->attribute_product->product_id = $id;
    			$this->attribute_product->attribute_id = isset($_POST['attribute'])?$_POST['attribute']:'';
    			$this->attribute_product->name = isset($_POST['name'])?$_POST['name']:'';
    			$this->attribute_product->value = isset($_POST['value'])?$_POST['value']:'';
    			$this->attribute_product->price = isset($_POST['price'])?$_POST['price']:'';
    			$this->attribute_product->status = isset($_POST['status'])?$_POST['status']:'';
    			$file = isset($_FILES['image_upload']) ? $_FILES['image_upload'] : '';
	            if ($file['name'] != '') {
	                if ($this->common->isTrueTypeImage($file) != '') {
	                    if ($this->common->isTrueSizeImage($file) != '') {
	                        $this->attribute_product->image = $this->common->move_file($file, 'Attribute_Product');
	                    } else {
	                        flashmessage::setMessageError('Ảnh có dung lượng quá lớn');
	                        $this->common->redirectUrl('admin/attribute/add_attribute/'.$id);
	                    }
	                } else {
	                    flashmessage::setMessageError('Tập tin không đúng định dạng ảnh');
	                    $this->common->redirectUrl('admin/attribute/add_attribute/'.$id);
	                }
	            } else {
	                $this->attribute_product->image = isset($_POST['image']) ? $_POST['image'] : '';
	            }

	            $file_image = isset($_FILES['image_list']) ? $_FILES['image_list'] : '';

	            $this->attribute_product->image_list = '';

	            $temp_name_files = array();

	            if ($file_image != '') {
	                if ($file_image['name'][0] != '') {
	                    $file_image_convert = $this->common->convertListImagesToImage($file_image);
	                    foreach ($file_image_convert as $key => $value) {
	                        $name_file_uploaded = $this->common->upload_file_attachment($value, 'Attribute_Product');

	                        array_push($temp_name_files, $name_file_uploaded);
	                    }

	                    $this->attribute_product->image_list = implode('###', $temp_name_files);
	                }
	            }
	            $rs = $this->attribute_product->insertData();

	            if ($rs > 0) {
	                flashmessage::setMessage('Thêm mới thành công !');
	                $this->common->redirectUrl('admin/attribute/add_attribute/'.$id);
	            } else {
	                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	                $this->common->redirectUrl('admin/attribute/add_attribute/'.$id);
	            }
    		}else{
    			$this->show("attribute_product");
    		}
    	}

    	public function edit_attribute(){
    		$this->temp_title = "Sửa thuộc tính sản phẩm";
    		$id = isset($_GET['id']) ? $_GET['id'] : '';	
        	$pid = isset($_GET['pid']) ? $_GET['pid'] : '';
        	if (isset($_POST['save'])) {
        		$this->attribute_product->id = $id;
        		$this->attribute_product->attribute_id = isset($_POST['attribute'])?$_POST['attribute']:'';
        		$this->attribute_product->product_id = isset($_POST['product_id'])?$_POST['product_id']:'';
    			$this->attribute_product->name = isset($_POST['name'])?$_POST['name']:'';
    			$this->attribute_product->value = isset($_POST['value'])?$_POST['value']:'';
    			$this->attribute_product->price = isset($_POST['price'])?$_POST['price']:'';
    			$this->attribute_product->status = isset($_POST['status'])?$_POST['status']:'';
        		$really_file = array();

	            if (isset($_POST['image_list'])) {
	                $really_file = $_POST['image_list'] != '' ? explode('###', $_POST['image_list']) : array();
	            }

	            $file_removed = isset($_POST['file_remove']) ? $_POST['file_remove'] : array();

	            if (count($file_removed) > 0) {
	                foreach ($file_removed as $key => $value) {
	                    if (in_array($value, $really_file)) {
	                        $really_key = array_search($value, $really_file);
	                        unset($really_file[$really_key]);
	                        unlink('../upload/Files/Attribute_Product/'.$value);
	                    }
	                }
	            }
	            $file_image = isset($_FILES['image_list']) ? $_FILES['image_list'] : '';

	            $this->attribute_product->image_list = '';
	            $temp_name_files = array();

	            foreach ($really_file as $key => $value) {
	                array_push($temp_name_files, $value);
	            }

	            if ($file_image != '') {
	                if ($file_image['name'][0] != '') {
	                    $file_image_convert = $this->common->convertListImagesToImage($file_image);
	                    foreach ($file_image_convert as $key => $value) {
	                        $name_file_uploaded = $this->common->upload_file_attachment($value, 'Attribute_Product');

	                        array_push($temp_name_files, $name_file_uploaded);
	                    }
	                    $this->attribute_product->image_list = implode('###', $temp_name_files);
	                }else{
	                	$this->attribute_product->image_list = implode('###', $temp_name_files);
	                }
	            } else {
	                $this->attribute_product->image_list = implode('###', $temp_name_files);
	            }

	            $file = isset($_FILES['image_upload']) ? $_FILES['image_upload'] : '';

	            if ($file['name'] != '') {
	                if ($this->common->isTrueTypeImage($file) != '') {
	                    if ($this->common->isTrueSizeImage($file) != '') {
	                        $this->attribute_product->image = $this->common->move_file($file, 'Attribute_Product');
	                    } else {
	                        flashmessage::setMessageError('Ảnh có dung lượng quá lớn');
	                        $this->common->redirectUrl('admin/attribute/'.$this->attribute_product->product_id.'/edit_attribute/' . $this->attribute_product->id);
	                    }
	                } else {
	                    flashmessage::setMessageError('Tập tin không đúng định dạng ảnh');
	                    $this->common->redirectUrl('admin/attribute/'.$this->attribute_product->product_id.'/edit_attribute/' . $this->attribute_product->id);
	                }
	            } else {
	                $this->attribute_product->image = isset($_POST['image']) ? $_POST['image'] : '';
	            }
        		echo $rs = $this->attribute_product->updateData();

	            if ($rs > 0) {
	                flashmessage::setMessage('Cập nhật thành công !');
	            } else {
	                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	            }
	            $this->common->redirectUrl('admin/attribute/'.$this->attribute_product->product_id.'/edit_attribute/' . $this->attribute_product->id);
        	}else{    	
        		
        		$this->data_product = $this->product->getProduct();
	            $this->result = $this->attribute_product->getAttributeProductByID($id);
	            $product = $this->product->getProductByID($id);
				$cate_id = $this->category->getParentCategory($product['category_id']);
				$this->data_attribute = $this->attribute->getAttributeNameByCategoryID($cate_id);
	            if ($this->result == '') {
	                flashmessage::setMessageError('Không tìm thấy dữ liệu !');
	                $this->common->redirectUrl('admin/attribute/add_attribute/'.$pid);
	            } else {
	                $this->show("attribute_product_edit");
	            }
        	}
    	}

    	public function delete_attribute() {
	        $id = isset($_POST['id']) ? $_POST['id'] : '';

	        $rs = $this->attribute_product->deleteData($id);

	        echo $rs;

	        if ($rs > 0) {
	            flashmessage::setMessage('Cập nhật thành công !');
	        } else {
	            flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	        }
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