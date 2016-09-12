<?php 
	class Ctr__category extends Template {
		public $common = null;
		public $category = null;
		public $currentUser = null;
		public $result = null;

		public function __construct() {
	        $this->category = new Category();
	        $this->common = new sys_common();
	        $this->currentUser = new sys_currentuser();
    	}

    	public function index() {
	        $this->temp_title = "Quản trị category";
	        $this->show("category");
	    }

	    public function edit(){
			$this->temp_title = "Sửa category";
			if (isset($_POST['save'])) {

				$file = isset($_FILES['image_upload']) ? $_FILES['image_upload'] : '';

	            if ($file['name'] != '') {
	                if ($this->common->isTrueTypeImage($file) != '') {
	                    if ($this->common->isTrueSizeImage($file) != '') {
	                        $this->category->image = $this->common->move_file($file, 'Category');
	                    } else {
	                        flashmessage::setMessageError('Ảnh có dung lượng quá lớn');
	                        $this->common->redirectUrl('admin/category/edit/' . $this->category->id);
	                    }
	                } else {
	                    flashmessage::setMessageError('Tập tin không đúng định dạng ảnh');
	                    $this->common->redirectUrl('admin/category/edit/' . $this->category->id);
	                }
	            } else {
	                $this->category->image = isset($_POST['image']) ? $_POST['image'] : '';
	            }

				$this->category->id = isset($_POST['eid']) ? $_POST['eid'] : '';
				$this->category->parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : '';
        		$this->category->name = isset($_POST['name']) ? $_POST['name'] : '';
	            $this->category->modified = date('Y/m/d H:i:s', time());
	            $this->category->modified_by = $this->currentUser->getUsername();
	            $this->category->description = isset($_POST['description']) ? $_POST['description'] : '';
	            $this->category->status = isset($_POST['status']) ? $_POST['status'] : '';
       			$this->category->featured = isset($_POST['featured']) ? $_POST['featured'] : '0';
       			$rs = $this->category->updateData();
       			if ($rs > 0) {
	                flashmessage::setMessage('Cập nhật thành công !');

	                $this->common->redirectUrl('admin/category/edit/' . $this->category->id);
	            } else {
	                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	            }
			}else{
				$id = isset($_GET['id']) ? $_GET['id'] : '';

	            $this->result = $this->category->getCategoryByID($id);
	            //print_r($this->result);
	            if ($this->result == '') {
	                flashmessage::setMessageError('Không tìm thấy dữ liệu !');
	                $this->common->redirectUrl('admin/category');
	            } else {
	                $this->show("category_edit");
	            }
			}
	    }

	    public function create(){
	    	$this->temp_title = "Thêm category";
	    	if (isset($_POST['save'])) {
	    		if (isset($_POST['save'])) {

	    			$file = isset($_FILES['image_upload']) ? $_FILES['image_upload'] : '';

		            if ($file['name'] != '') {
		                if ($this->common->isTrueTypeImage($file) != '') {
		                    if ($this->common->isTrueSizeImage($file) != '') {
		                        $this->category->image = $this->common->move_file($file, 'Category');
		                    } else {
		                        flashmessage::setMessageError('Ảnh có dung lượng quá lớn');
		                        $this->common->redirectUrl('admin/category/create');
		                    }
		                } else {
		                    flashmessage::setMessageError('Tập tin không đúng định dạng ảnh');
		                    $this->common->redirectUrl('admin/category/create');
		                }
		            } else {
		                $this->category->image = isset($_POST['image']) ? $_POST['image'] : '';
		            }
	    			$this->category->parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : '';
            		$this->category->name = isset($_POST['name']) ? $_POST['name'] : '';
	    			$this->category->created = date('Y/m/d H:i:s', time());
		            $this->category->created_by = $this->currentUser->getUsername();
		            $this->category->status = isset($_POST['status']) ? $_POST['status'] : '';
           			$this->category->featured = isset($_POST['featured']) ? $_POST['featured'] : '0';
           			$rs = $this->category->insertData();
           			if ($rs > 0) {
		                $id = $this->category->getTopID();
		                flashmessage::setMessage('Thêm mới thành công !');

		                $this->common->redirectUrl('admin/category/');
		            } else {
		                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
		            }
			    }
	    	}else{
	    		$this->show("category_create");
	    	}
	    }

	    public function loadTable($parent_id = 0){
	    	$list_category = $this->category->getCategoryByParentID($parent_id);

	    	if(count($list_category) >0){
	    		foreach ($list_category as $key => $value) {
	    			if($value['parent_id'] ==0){
	    				$first_char ='';
	    				$char_space ='';
	    			}else{
	    				$first_char = '<big>&boxur;&boxh;</big> ';
	    				$this->category->ck_count = 0;
	    				$char = $this->category->getCountParent($value['parent_id']);

	    				if($char >0){
	    					$char_space = str_repeat('<span style="padding-right:10px;">&cir;</span>', $char + 1);
	    				}else{
	    					$char_space = '<span style="padding-right:10px;">&cir;</span>'; 
	    				}

	    			}
	    			echo '<tr>';
	    			echo '<td class="vam"><div class="checkbox icheck"><input type="checkbox" name="checkbox_item[]" class="checkbox_item" value="' . $value['id'] . '" /></div></td>';
					echo '<td>'.$value['id'].'</td>';
					echo '<td>'.$char_space.$first_char.'<a href="'.ROOT.'/admin/category/edit/'.$value['id'].'">'.$value['name'].'</a></td>';
					echo '<td>';
					echo '<form method="POST" action="' . ROOT . '/admin/category/change_featured" enctype="multipart/form-data">';
					echo '<input type="hidden" name="featured" value="' . $value['featured'] . '" />';
					echo '<input type="hidden" name="eid" value="' . $value['id'] . '" />';
					echo '<button type="submit" class="btn-star" title="' . $this->common->getFeaturedCategory($value['featured']) . '">';
	                echo '<i class="fa ' . ($value['featured'] == '0' ? 'fa-star-o' : 'fa-star') . '"></i>';
	                echo '</button>';
	                echo '</form>';
	                echo '</td>';
	                echo '<td>';
	                if ($value['status'] == 0) {
	                    echo '<span class = "label label-danger w-300">Ẩn</span>';
	                } elseif ($value['status'] == 1) {
	                    echo '<span class = "label label-success w-300">Hiển thị</span>';
	                }
	                echo '</td>';
	                echo '<td>';
	                echo '<a href = "' . ROOT . '/admin/category/edit/' . $value['id'] . '" class="view btn btn-xs btn-default "><i class="fa fa-info-circle"></i> Sửa</a>&nbsp;&nbsp;';
	                echo '<a href = "' . ROOT . '/admin/category/delete/' . $value['id'] . '" class="view btn btn-xs btn-default  btn-delete-data" data-id="' . $value['id'] . '"><i class="fa fa-times-circle"></i> Xóa</a>';
	                echo '</td>';
					echo '</tr>';
					$this->loadTable($value['id']);
	    		}
	    	}
	    }

	    public function delete() {
	        $id = isset($_POST['id']) ? $_POST['id'] : '';

	        $rs = $this->category->deleteData($id);

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
	    		$this->category->featured =1;
	    	}else{
	    		$this->category->featured =0;
	    	}
	    	$this->category->id = isset($_POST['eid']) ? $_POST['eid'] : '';
	    	$this->category->modified = date('Y/m/d H:i:s', time());
	    	$this->category->modified_by = $this->currentUser->getUsername();
	    	$rs = $this->category->updateFeatured();
	    	if ($rs > 0) {
            	flashmessage::setMessage('Cập nhật thành công !');
	        } else {
	            flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	        }
	        
	        $this->common->redirectUrl('/admin/category');
		}

		    public function change_status() {
		    	$status = isset($_POST['status']) ? $_POST['status'] : 0;
		        $list_id = isset($_POST['list_id']) ? $_POST['list_id'] : 0;
		        $rs = $this->category->updateMultiStatus($status, $list_id);
		        if ($rs > 0) {
		            flashmessage::setMessage('Cập nhật thành công!');
		        } else {
		            flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
		        }	        	
	    	}
	    	public function loadSelect($parent_id = 0, $current = 0, $active = 0) {
		        $list_category = $this->category->getCategoryByParentID($parent_id);

		        if (count($list_category) > 0) {
		            foreach ($list_category as $key => $value) {
		                if ($value['id'] != $current) {
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

		                    $selector = '';
		                    if ($value['parent_id'] != 0) {
		                        $selector = ($value['id'] == $active) ? 'selected = "selected"' : '';
		                    }

		                    if ($value['id'] == $active) {
		                        $selector = ($value['id'] == $active) ? 'selected = "selected"' : '';
		                    }

		                    echo '<option value = "' . $value['id'] . '" ' . $selector . '>';
		                    echo $char_space . $first_char . $value['name'];
		                    echo '</option>';

		                    $this->loadSelect($value['id'], $current, $active);
		                }
		            }
		        }
		    }
		}

?>