<?php 
	class E_Order{
		public $id = null;
		public $transaction_id = null;
		public $product_id = null;
		public $attribute_product_id = null;
		public $quantity = null;
		public $amount = null;
		public $status = null;
	}
	class Order extends E_Order{
		public $obj_DB = null;
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
	    public function getCountOrder() {
	        try {
	            $s_Query = 'SELECT COUNT(id) FROM  `order` WHERE 1 AND status !="-1" ';

	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows[0];
	    }
	    public function getAllOrder($order = 'id', $order_type = 'DESC', $current = 0, $limit = 10) {

	        $total_result = $this->getCountOrder();

	        $total_page = ceil($total_result / $limit);

	        if (!$current || empty($current) || $current > $total_page || $current < 0 || $current == 0) {
	            $current = 1;
	        }

	        $show = -1;
	        if ($current == 1) {
	            $show = 0;
	        } else {
	            $show = ($current - 1) * $limit;
	        }

	        try {
	            $s_Query = 'SELECT * FROM  `order` WHERE 1';

	            $s_Query .= ' AND status != "-1" ';

	            $s_Query .= ' ORDER BY ' . $order . ' ' . $order_type . ' ';

	            $s_Query .= ' LIMIT ' . $show . ',' . $limit . ' ';

	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return array('data' => $this->arr_Rows, 'pager' => $total_page);
	    }

	    public function getOrderByID($id = 0) {
	        try {
	            $s_Query = 'SELECT * FROM  `order` WHERE id="' . $id . '"';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function getOrderByTransactionID($id = 0) {
	        try {
	            $s_Query = 'SELECT * FROM  `order` WHERE transaction_id="' . $id . '"';
	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function getTopID() {
	        try {
	            $s_Query = 'SELECT id FROM  `order` ORDER BY id DESC LIMIT 1';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows[0];
	    }

	    public function deleteData($id = 0) {
	        try {
	            $s_Query = 'UPDATE  `order` SET status="-1" WHERE id="' . intval($id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
   		}

   		public function updateMultiStatus($status = 0, $arr = array()) {
	        $list_id = is_array($arr) ? implode(',', $arr) : '0';
	        try {
	            $s_Query = 'UPDATE  `order` SET status="' . intval($status) . '" WHERE id in (' . $list_id . ')';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	    
	    public function updateData() {
	        try {
	            $s_Query = 'UPDATE  `order` SET transaction_id="' . intval($this->transaction_id) . '", product_id = "' . intval($this->product_id) . '",attribute_product_id = "' . intval($this->attribute_product_id) . '", quantity = "' . intval($this->quantity) . '", amount = "' . intval($this->amount) . '", status = "' . intval($this->status) . '"  WHERE id = "' . intval($this->id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function insertData() {
	        try {
	            $s_Query = 'INSERT INTO  `order`( transaction_id, product_id,attribute_product_id, quantity, amount, status) VALUES ("' . intval($this->transaction_id) . '","' . intval($this->product_id) . '","' . intval($this->attribute_product_id) . '","' . intval($this->quantity) . '","' . intval($this->amount) . '","' . intval($this->status) . '")';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function getListProductIdTopOrder(){
	    	try {
	            $s_Query = 'SELECT product.* FROM `order`, product WHERE `order`.product_id = product.id GROUP BY product_id ORDER BY COUNT(product_id) DESC limit 0,4';
	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	}
?>