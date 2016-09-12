<?php 
	class E_Transaction{
		public $id = null;
		public $user_id = null;
		public $user_name = null;
		public $user_email = null;
		public $user_phone = null;
		public $user_address = null;
		public $amount = null;
		public $payment= null;
		public $message = null;
		public $created = null;
		public $status = null;
	}
	class Transaction extends E_Transaction{
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

	    public function getTransactionByUserID($id){
	    	try {
	            $s_Query = 'SELECT * FROM transaction WHERE user_id="' . $id . '" ORDER BY id DESC';
	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	    public function getCountTransaction($search = '') {
	        try {
	            $s_Query = 'SELECT COUNT(id) FROM transaction WHERE 1';

	            $s_Query .= ($search != '') ? (' AND user_name like "%' . addslashes($search) . '%" OR user_email like "%' . addslashes($search) . '%" OR user_phone like "%' . addslashes($search) . '%" OR user_address like "%' . addslashes($search) . '%" ') : '';

	            $s_Query .= ' AND status !="-1" ';

	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows[0];
	    }

	    public function getAllTransaction($search = '',$order = 'id', $order_type = 'DESC', $current = 0, $limit = 10) {

	        $total_result = $this->getCountTransaction($search);

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
	            $s_Query = 'SELECT * FROM transaction WHERE 1';

	            $s_Query .= ' AND status != "-1" ';

	            $s_Query .= ($search != '') ? (' AND user_name like "%' . addslashes($search) . '%" OR user_email like "%' . addslashes($search) . '%" OR user_phone like "%' . addslashes($search) . '%" OR user_address like "%' . addslashes($search) . '%" ') : '';

	            $s_Query .= ' ORDER BY ' . $order . ' ' . $order_type . ' ';

	            $s_Query .= ' LIMIT ' . $show . ',' . $limit . ' ';

	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return array('data' => $this->arr_Rows, 'pager' => $total_page);
	    }

	    public function updateData() {
	        try {
	            $s_Query = 'UPDATE transaction SET payment="' . intval($this->payment) . '", user_id = "' . intval($this->user_id) . '", user_name = "' . addslashes($this->user_name) . '", user_email = "' . addslashes($this->user_email) . '", user_phone = "' . addslashes($this->user_phone) . '", status = "' . intval($this->status) . '", amount = "' . intval($this->amount) . '",user_address = "' . addslashes($this->user_address) . '", message = "' . addslashes($this->message) . '" WHERE id = "' . intval($this->id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function insertData() {
	        try {
	            $s_Query = 'INSERT INTO transaction( payment, user_id, user_name, user_email, user_phone,user_address,status,amount,message,created) VALUES ("' . intval($this->payment) . '","' . intval($this->user_id) . '","' . addslashes($this->user_name) . '","' . addslashes($this->user_email) . '","' . addslashes($this->user_phone) . '","' . addslashes($this->user_address) . '","' . intval($this->status) . '","' . intval($this->amount) . '","' . addslashes($this->message) . '","' . $this->created . '")';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function getTransactionByID($id = 0) {
	        try {
	            $s_Query = 'SELECT * FROM transaction WHERE id="' . $id . '"';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function getTopID() {
	        try {
	            $s_Query = 'SELECT id FROM transaction ORDER BY id DESC LIMIT 1';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows[0];
	    }

	    public function deleteData($id = 0) {
	        try {
	            $s_Query = 'UPDATE transaction SET status="-1" WHERE id="' . intval($id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
   		}
   		public function updateMultiStatus($status = 0, $arr = array()) {
	        $list_id = is_array($arr) ? implode(',', $arr) : '0';
	        try {
	            $s_Query = 'UPDATE transaction SET status="' . intval($status) . '" WHERE id in (' . $list_id . ')';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	}
?>