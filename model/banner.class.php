<?php 
	class E_Banner{
		public $id = null;
		public $name = null;
		public $content = null;
		public $image = null;
		public $created = null;
		public $url = null;
		public $position = null;
		public $modified = null;
		public $status = null;
	}

	class Banner extends E_Banner{
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

	    public function getAllBanner() {
        try {
            $s_Query = 'SELECT * FROM banner WHERE status != "-1"';
            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows;
    	}

	    public function getBannerByID($id = 0) {
	        try {
	            $s_Query = 'SELECT * FROM banner WHERE id="' . $id . '"';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function getTopID() {
	        try {
	            $s_Query = 'SELECT id FROM banner ORDER BY id DESC LIMIT 1';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows[0];
	    }

	    public function deleteData($id = 0) {
	        try {
	            $s_Query = 'UPDATE banner SET status="-1" WHERE id = "' . intval($id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function updateMultiStatus($status = 0, $arr = array()) {
	        $list_id = is_array($arr) ? implode(',', $arr) : '0';
	        try {
	            $s_Query = 'UPDATE banner SET status="' . intval($status) . '" WHERE id in (' . $list_id . ')';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function updateData() {
	        try {
	            $s_Query = 'UPDATE banner SET  name="' . addslashes($this->name) . '",content="' . addslashes($this->content) . '",image="' . addslashes($this->image) . '",url="' . addslashes($this->url) . '",position="' . intval($this->position) . '",status="' . intval($this->status) . '",modified="' . $this->modified . '"  WHERE id="' . intval($this->id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function insertData() {
	        try {
	            $s_Query = 'INSERT INTO banner( name, content, image, url,position,status,created) VALUES ("' . addslashes($this->name) . '","' . addslashes($this->content) . '","' . addslashes($this->image) . '","' . addslashes($this->url) . '","' . intval($this->position) . '","' . intval($this->status) . '","' . $this->created . '")';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    /*     * ** Front-End *** */
	
		public function client_getAllBanner($position = 0) {
	        try {
	            $s_Query = 'SELECT * FROM banner WHERE status = "1" and position = "' . intval($position) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	}

?>