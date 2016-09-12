<?php 
	class E_Setting {
		public $id = null;
		public $name = null;
		public $category_box1 = null;
		public $category_box2 = null;
		public $category_box3 = null;
		public $category_box4 = null;
		public $contact_content = null;
		public $contact_address = null;
		public $contact_phone = null;
		public $contact_email = null;
		public $contact_map = null;
		public $contact_facebook = null;
		public $modified = null;
	}

	class Setting extends E_Setting{

		public function __construct() {
	        $this->obj_DB = new sys_db();
	    }

	    public function __set($s_key, $obj_value) {
	        $this->$s_key = $obj_value;
	    }

	    public function __get($s_key) {
	        return $this->$s_key;
	    }

		public function getSettingCategoryBox($box = '1') {
        try {
            $s_Query = 'SELECT category_box' . $box . ' FROM  setting WHERE id="1"';
            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows[0];
    	}

    	public function getSettingDataByID($id) {
	        try {
	            $s_Query = 'SELECT * FROM ' . TB_PREFIX . 'setting WHERE id="' . intval($id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
    	}

    	public function updateCategoryHomeData(){
    		try {
	            $s_Query = 'UPDATE setting SET  category_box1="' . intval($this->category_box1) . '",category_box2="' . intval($this->category_box2) . '",category_box3="' . intval($this->category_box3) . '", category_box4="' . intval($this->category_box4) . '" ,modified="' . $this->modified . '" WHERE id="1"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
    	}
    	public function updateFooter(){
    		try {
	            $s_Query = 'UPDATE setting SET  contact_content="' . addslashes($this->contact_content) . '",contact_address="' . addslashes($this->contact_address) . '",contact_phone="' . addslashes($this->contact_phone) . '",contact_email="' . addslashes($this->contact_email) . '", contact_map="' . addslashes($this->contact_map) . '" ,contact_facebook="' . addslashes($this->contact_facebook) . '",modified="' . $this->modified . '"  WHERE id="2"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
    	}
	}
?>