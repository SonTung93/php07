<?php 
	class E_Attribute_Product{
		public $id = null;
		public $attribute_id =null;
		public $product_id =null;
		public $name = null;
		public $value = null;
		public $price = null;
		public $image = null;
		public $image_list = null;
		public $status = null;
	}

	class Attribute_Product extends E_Attribute_Product{
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
	    public function getAllAttributeProduct() {
	    	try{
	    		$s_Query = 'SELECT * FROM attribute_product WHERE status !="-1"';
	    		$this->arr_Row = $this->obj_DB->ExecQuery($s_Query);
	    	}catch(Exception $ex){
	    		echo $ex;
	    	}
	    	return $this->arr_Row;
	    }
	    public function getAllAttributeProductByProductID($id) {
	    	try{
	    		$s_Query = 'SELECT * FROM attribute_product WHERE status !="-1" and product_id ="'.$id.'"';
	    		$this->arr_Row = $this->obj_DB->ExecQuery($s_Query);
	    	}catch(Exception $ex){
	    		echo $ex;
	    	}
	    	return $this->arr_Row;
	    }
	    public function getAttributeColor($id) {
	    	try{
	    		$s_Query = 'SELECT * FROM attribute_product WHERE status !="-1" AND product_id ="'.$id.'" AND attribute_id ="1" ';
	    		$this->arr_Row = $this->obj_DB->ExecQuery($s_Query);
	    	}catch(Exception $ex){
	    		echo $ex;
	    	}
	    	return $this->arr_Row;
	    }
	    public function getAttributeProductByID($id = 0) {
	        try {
	            $s_Query = 'SELECT * FROM attribute_product WHERE id="' . $id . '" AND status !="-1"';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	    public function updateData() {
	        try {
	            $s_Query = 'UPDATE attribute_product SET  name="' . addslashes($this->name) . '",value="' . addslashes($this->value) . '",product_id="' . intval($this->product_id) . '",attribute_id="' . intval($this->attribute_id) . '",image="' . addslashes($this->image) . '",image_list="' . addslashes($this->image_list) . '",price="' . intval($this->price) . '",status="' . intval($this->status) . '" WHERE id="' . intval($this->id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function insertData() {
	        try {
	            $s_Query = 'INSERT INTO attribute_product(name, value, product_id, attribute_id, image, image_list, price, status) VALUES ("' . addslashes($this->name) . '","' . addslashes($this->value) . '","' . intval($this->product_id) . '","' . intval($this->attribute_id) . '","' . addslashes($this->image) . '","' . addslashes($this->image_list) . '","' . intval($this->price) . '","' . intval($this->status) . '")';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	    public function getTopID() {
	        try {
	            $s_Query = 'SELECT id FROM attribute_product ORDER BY id DESC LIMIT 1';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows[0];
	    }

	    public function deleteData($id = 0) {
	        try {
	            $s_Query = 'UPDATE attribute_product SET status="-1" WHERE id="' . intval($id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	}
?>