<?php 
	class E_Menu{
		public $id = null;
		public $name = null;
		public $parent_id = null;
		public $position = null;
		public $icon = null;
		public $target_id = null;
		public $type = null;
		public $url = null;
		public $sort_menu = null;
		public $created_by = null;
		public $created = null;
		public $modified_by = null;
		public $modified = null;
		public $status = null;
	}

	class Menu extends E_Menu{
		public $obj_DB = null;
	    public $ck_count = 0;
	    private $arr_Rows = null;

	    public function __construct() {
	        $this->obj_DB = new sys_db();
	    }

	    public function __set($s_key, $obj_value) {
	        $this->$s_key = $obj_value;
	    }

	    public function __get($s_key) {
	        return $this->$s_key;
	    }

	    public function getMenuByID($id = 0) {
	        try {
	            $s_Query = 'SELECT * FROM ' . TB_PREFIX . 'menu WHERE id="' . $id . '"';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function getAllMenuByParentID($parent_id = '0', $position = '0') {
	        try {
	            $s_Query = 'SELECT id, name	, parent_id, position, target_id, type, url,icon, sort_menu FROM menu WHERE 1 AND parent_id="' . intval($parent_id) . '" AND position="' . intval($position) . '" AND status ="1" ORDER BY position ASC, sort_menu ASC';
	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
    	}

	    public function getMenuByParentID($parent_id = 0, $postion = '') {
	        try {
	            $s_Query = 'SELECT * FROM ' . TB_PREFIX . 'menu WHERE parent_id="' . $parent_id . '" AND status !="-1"';
	            $s_Query .= ($postion != '') ? ('AND position=' . intval($postion)) : '';
	            $s_Query .= ' ORDER BY position ASC';
	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
        return $this->arr_Rows;
   	 	}

   	 	
   	 	public function getCountParent($parent_id = 0) {
	        try {
	            $s_Query = 'SELECT id,parent_id FROM ' . TB_PREFIX . 'menu WHERE id="' . $parent_id . '";';
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
	            $s_Query = 'UPDATE menu SET status="-1" WHERE id="' . intval($id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
   		}

   		public function updateMultiStatus($status = 0, $arr = array()) {
	        $list_id = is_array($arr) ? implode(',', $arr) : '0';
	        try {
	            $s_Query = 'UPDATE menu SET status="' . intval($status) . '",modified_by="' . addslashes($this->modified_by) . '",modified="' . addslashes($this->modified) . '" WHERE id in (' . $list_id . ')';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function updateData() {
	        try {
	            $s_Query = 'UPDATE menu SET position = "' . intval($this->position) . '", parent_id="' . intval($this->parent_id) . '", type = "' . intval($this->type) . '", name = "' . addslashes($this->name) . '", url = "' . addslashes($this->url) . '", icon = "' . addslashes($this->icon) . '", status = "' . intval($this->status) . '", target_id = "' . intval($this->target_id) . '",sort_menu = "' . intval($this->sort_menu) . '", modified_by = "' . addslashes($this->modified_by) . '",modified = "' . addslashes($this->modified) . '" WHERE id = "' . intval($this->id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function insertData() {
	        try {
	            $s_Query = 'INSERT INTO menu(position, parent_id, type, name, url,icon, status, target_id, created_by, created, sort_menu) VALUES ("' . intval($this->position) . '","' . intval($this->parent_id) . '","' . intval($this->type) . '","' . addslashes($this->name) . '","' . addslashes($this->url) . '","' . addslashes($this->icon) . '","' . intval($this->status) . '","' . intval($this->target_id) . '","' . addslashes($this->created_by) . '","' . addslashes($this->created) . '","' . intval($this->sort_menu) . '")';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function getTopID() {
	        try {
	            $s_Query = 'SELECT id FROM menu ORDER BY id DESC LIMIT 1';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows[0];
	    }
	    public function changeOrder(){
	    	try {
	    		$s_Query = 'UPDATE menu SET sort_menu = "' . intval($this->sort_menu) . '" , modified_by = "'. addslashes($this->modified_by) .'" , modified = "'. addslashes($this->modified) .'" WHERE id = "' . intval($this->id) . '"';
	    		$this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	    	} catch (Exception $ex) {
	    		echo $ex;
	    	}
	    	return $this->arr_Rows;
	    }
	    public function updateMenuOrder() {
	        try {
	            $s_Query = 'UPDATE menu SET sort_menu="' . intval($this->sort_menu) . '",modified="' . addslashes($this->modified) . '",modified_by="' . addslashes($this->modified_by) . '" WHERE id="' . intval($this->id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    /*     * ** Front-End *** */

	    public $count = 0;

	    public function getCountSubMenu($id = '0', $position = '0') {
	        try {
	            $s_Query = 'SELECT id FROM ' . TB_PREFIX . 'menu WHERE status ="1" AND parent_id IN (-1,' . $id . ') AND position="' . intval($position) . '"';

	            $rs = $this->obj_DB->ExecQuery($s_Query);

	            if (count($rs) > 0) {
	                $this->count++;

	                $id = '';

	                foreach ($rs as $key => $value) {
	                    $id .= $key == 0 ? $value['id'] : ',' . $value['id'];
	                }
	                $this->getCountSubMenu($id, $position);
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