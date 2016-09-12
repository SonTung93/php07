<?php 
	class E_Attribute{
		public $id = null;
		public $category_id =null;
		public $name = null;
		public $description = null;
		public $created = null;
		public $created_by = null;
		public $modified = null;
		public $modified_by = null;
		public $status = null;
	}

	class Attribute extends E_Attribute{
		public $obj_DB = null;
    	private $arr_Rows = null; 

    	public function __construct(){
    		$this->obj_DB = new sys_db();
    	}
    	public function __set($s_key, $obj_value) {
	        $this->$s_key = $obj_value;
	    }

	    public function __get($s_key) {
	        return $this->$s_key;
	    }
	    public function getAllAttribute() {
	    	try{
	    		$s_Query = 'SELECT * FROM attribute WHERE status !="-1"';
	    		$this->arr_Row = $this->obj_DB->ExecQuery($s_Query);
	    	}catch(Exception $ex){
	    		echo $ex;
	    	}
	    	return $this->arr_Row;
	    }
	    public function getAttributeNameByCategoryID($id) {
	        try {
	            $s_Query = 'SELECT id,name FROM attribute WHERE status ="1" AND category_id LIKE "%'.$id.'%" ';
	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function getAttributeNameByID($id = 0) {
	        try {
	            $s_Query = 'SELECT name FROM attribute WHERE id="' . $id . '"';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows[0];
	    }
	    
	    public function getAttributeByID($id = 0) {
	        try {
	            $s_Query = 'SELECT * FROM attribute WHERE id="' . $id . '" AND status !="-1"';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	    
	    public function deleteData($id = 0) {
	        try {
	            $s_Query = 'UPDATE attribute SET status="-1" WHERE id = "' . intval($id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function updateData() {
	        try {
	            $s_Query = 'UPDATE attribute SET  name="' . addslashes($this->name) . '",description="' . addslashes($this->description) . '",category_id="' . addslashes($this->category_id) . '",modified="' . $this->modified . '",modified_by="' . addslashes($this->modified_by) . '",status="' . intval($this->status) . '" WHERE id="' . intval($this->id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function insertData() {
	        try {
	            $s_Query = 'INSERT INTO attribute( name, category_id, description,created,created_by,status) VALUES ("' . addslashes($this->name) . '","' . addslashes($this->category_id) . '","' . addslashes($this->description) . '","' . $this->created . '","' . addslashes($this->created_by) . '","' . intval($this->status) . '")';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	    public function getTopID() {
	        try {
	            $s_Query = 'SELECT id FROM attribute ORDER BY id DESC LIMIT 1';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows[0];
	    }
	}
?>