<?php 
	class E_Category {
	    public $id = null;
	    public $parent_id = null;
	    public $name = null;
	    public $description = null;
	    public $featured = null;
	    public $image = null;
	    public $created_by = null;
	    public $modified_by = null;
	    public $created = null;
	    public $modified = null;
	    public $status = null;
	}

	class Category Extends E_Category {
		public $bj_BD = null;
		public $arr_Row = null;
		public $ck_count = 0;

		public function __construct() {
        	$this->obj_DB = new sys_db();
	    }

	    public function __set($s_key, $obj_value) {
	        $this->$s_key = $obj_value;
	    }

	    public function __get($s_key) {
	        return $this->$s_key;
	    }

	    public function getAllCategory() {
	    	try{
	    		$s_Query = 'SELECT * FROM category WHERE status !="-1"';
	    		$this->arr_Row = $this->obj_DB->ExecQuery($s_Query);
	    	}catch(Exception $ex){
	    		echo $ex;
	    	}
	    	return $this->arr_Row;
	    }

	    public function getCategoryByID($id = 0) {
	    	try{
	    		$s_Query = 'SELECT * FROM category WHERE id="' . $id . '"';
	    		$this->arr_Row = $this->obj_DB->ExecScalar($s_Query);
	    	}catch(Exception $ex){
	    		echo $ex;
	    	}
	    	return $this->arr_Row;
	    }

	    public function getParentIDByID($id) {
	        try {
	            $s_Query = 'SELECT parent_id FROM category WHERE status != "-1" AND id="' . intval($id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows[0];
	    }

	    public function getCategoryNameByID($id = 0) {
	        try {
	            $s_Query = 'SELECT name FROM category WHERE id="' . $id . '"';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows[0];
	    }

	    public function getCategoryByParentID($parent_id = 0) {
	        try {
	            $s_Query = 'SELECT * FROM category WHERE parent_id="' . $parent_id . '" AND status!="-1" ORDER BY id ASC';
	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	    public $list_cat = array();
    
	    public function getAllCategoryChildByParent($id) {
	        try {
	            $s_Query = 'SELECT id, parent_id FROM category WHERE status!="-1" AND parent_id="' . intval($id) . '"';

	            $rs = $this->obj_DB->ExecQuery($s_Query);

	            if (count($rs) > 0) {
	                foreach ($rs as $key => $value) {
	                    array_push($this->list_cat, $value['id']);
	                    $this->getAllCategoryChildByParent($value['id']);
	                }
            	}
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->list_cat;
	    }
	    public function getCountParent($parent_id) {
	        try {
	            $s_Query = 'SELECT id, parent_id FROM category WHERE id="' . $parent_id . '";';
	            $arr_Rows = $this->obj_DB->ExecScalar($s_Query);

	            if ($arr_Rows['parent_id'] != 0) {
	                $this->ck_count++;
	                $this->getCountParent($arr_Rows['parent_id']);
	            }
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->ck_count;
	    }
	    public function deleteData($id = 0) {
	        try {
	            $s_Query = 'UPDATE category SET status="-1" WHERE id="' . intval($id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function updateFeatured() {
	        try {
	            $s_Query = 'UPDATE category SET featured="' . intval($this->featured) . '", modified_by="' . $this->modified_by . '", modified="' . addslashes($this->modified) . '" WHERE id="' . intval($this->id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function updateMultiStatus($status = 0, $arr = array()) {
	        $list_id = is_array($arr) ? implode(',', $arr) : '0';
	        try {
	            $s_Query = 'UPDATE category SET status="' . intval($status) . '" WHERE id in (' . $list_id . ')';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function insertData() {
	        try {
	            $s_Query = 'INSERT INTO category(parent_id, name, created_by, created ,description,image,featured, status) VALUES ("' . intval($this->parent_id) . '","' . addslashes($this->name) . '","' . addslashes($this->created_by) . '","' . addslashes($this->created) . '","' . addslashes($this->description) . '","' . addslashes($this->image) . '","' . intval($this->featured) . '","' . intval($this->status) . '")';

	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	    
	    public function getTopID() {
	        try {
	            $s_Query = 'SELECT id FROM category ORDER BY id DESC LIMIT 1';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows[0];
    	}

	    public function updateData() {
	        try {
	            $s_Query = 'UPDATE category SET parent_id="' . intval($this->parent_id) . '",name="' . addslashes($this->name) . '",description="' . addslashes($this->description) . '",image="' . addslashes($this->image) . '",modified_by="' . addslashes($this->modified_by) . '",modified="' . addslashes($this->modified) . '",status="' . intval($this->status) . '", featured="' . intval($this->featured) . '" WHERE id="' . intval($this->id) . '"';

	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

    	public function getParentCategory($id,&$cate_id=0) {
	        try {
	            $s_Query = 'SELECT id, parent_id FROM category WHERE status="1" AND id="' . intval($id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);

	            if ($this->arr_Rows['parent_id'] != '0') {                	                                
	                $this->getParentCategory($this->arr_Rows['parent_id'], $cate_id);
	            }else{
	            	$cate_id = $this->arr_Rows['id'];
	            }
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $cate_id;
	    }

    	public function getAllParentCategoryByIDClient($id, &$list = array()) {
	        try {
	            $s_Query = 'SELECT id, parent_id FROM category WHERE status="1" AND id="' . intval($id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);

	            if ($this->arr_Rows['parent_id'] != '0') {
	                array_push($list, $this->arr_Rows['id']);
	                $this->getAllParentCategoryByIDClient($this->arr_Rows['parent_id'], $list);
	            }else {
	                array_push($list, $this->arr_Rows['id']);
	            }
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $list;
	    }
	    public function getCategoryByIDClient($id = 0) {
	        try {
	            $s_Query = 'SELECT * FROM category WHERE id="' . $id . '" AND status=1';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	    public $count = 0;

	    public function getCountSubCate($id = '0') {
	        try {
	            $s_Query = 'SELECT id FROM ' . TB_PREFIX . 'category WHERE status ="1" AND parent_id IN (-1,' . $id . ') ';

	            $rs = $this->obj_DB->ExecQuery($s_Query);

	            if (count($rs) > 0) {
	                $this->count++;

	                $id = '';

	                foreach ($rs as $key => $value) {
	                    $id .= $key == 0 ? $value['id'] : ',' . $value['id'];
	                }
	                $this->getCountSubCate($id);
	            } else {
	                return $this->count;
	            }
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->count;
	    }
	}
?>