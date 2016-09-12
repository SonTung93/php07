<?php 
	class E_User {
	    public $id = null;
	    public $name = null;
	    public $email = null;
	    public $phone = null;
	    public $address = null;
	    public $password = null;
	    public $created = null;
	    public $modified = null;
	    public $modified_by = null;
	    public $status = null;
	}

	class User Extends E_User {
		public $obj_DB = null;
   		private $arr_Rows = null;

   		public function __construct() {
	        $this->obj_DB = new sys_db();
	    }

	    public function checkLogin($email = '', $password = '') {
	        try {
	            $s_Query = 'SELECT * FROM user WHERE email="' . addslashes($email) . '" AND password="' . addslashes($password) . '" AND status NOT IN (0,-1) ';
	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	    public function getCountUser($search = '') {
	        try {
	            $s_Query = 'SELECT COUNT(id) FROM user WHERE 1';

	            $s_Query .= ($search != '') ? (' AND name like "%' . addslashes($search) . '%" OR email like "%' . addslashes($search) . '%" OR address like "%' . addslashes($search) . '%" ') : '';

	            $s_Query .= ' AND status !="-1" ';

	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows[0];
	    }

	    public function getAllUser($search = '',$order = 'id', $order_type = 'DESC', $current = 0, $limit = 10) {

	        $total_result = $this->getCountUser($search);

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
	            $s_Query = 'SELECT * FROM user WHERE 1';

	            $s_Query .= ' AND status != "-1" ';

	            $s_Query .= ($search != '') ? (' AND (name like "%' . addslashes($search) . '%" OR email like "%' . addslashes($search) . '%" OR address like "%' . addslashes($search) . '%" ) ') : '';

	            $s_Query .= ' ORDER BY ' . $order . ' ' . $order_type . ' ';

	            $s_Query .= ' LIMIT ' . $show . ',' . $limit . ' ';

	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return array('data' => $this->arr_Rows, 'pager' => $total_page);
	    }

	    public function updateMultiStatus($status = 0, $arr = array()) {
	        $list_id = is_array($arr) ? implode(',', $arr) : '0';
	        try {
	            $s_Query = 'UPDATE user SET status="' . intval($status) . '" WHERE id in (' . $list_id . ')';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function getTopID() {
	        try {
	            $s_Query = 'SELECT id FROM user ORDER BY id DESC LIMIT 1';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows[0];
	    }

	    public function deleteData($id = 0) {
	        try {
	            $s_Query = 'UPDATE user SET status="-1" WHERE id = "' . intval($id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	    public function getUserByID($id = 0) {
	        try {
	            $s_Query = 'SELECT * FROM user WHERE id="' . $id . '" AND status !="-1"';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	    public function getUserByEmail($email = 0) {
	        try {
	            $s_Query = 'SELECT * FROM user WHERE email="' . $email . '" AND status !="-1"';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	    public function changePassword(){
	    	try {
	            $s_Query = 'UPDATE user SET  password="' . addslashes($this->password) . '"  WHERE id="' . intval($this->id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	    public function fogotPassword(){
	    	try {
	            $s_Query = 'UPDATE user SET  password="' . addslashes($this->password) . '"  WHERE email="' . addslashes($this->email) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	    public function updateData() {
	        try {
	            $s_Query = 'UPDATE user SET  name="' . addslashes($this->name) . '",email="' . addslashes($this->email) . '",phone="' . addslashes($this->phone) . '",address="' . addslashes($this->address) . '",status="' . intval($this->status) . '",modified="' . $this->modified . '",modified_by="' . addslashes($this->modified_by) . '"  WHERE id="' . intval($this->id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function updatePassword() {
	        try {
	            $s_Query = 'UPDATE user SET  password="' . addslashes($this->password) . '"  WHERE id="' . intval($this->id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function insertData() {
	        try {
	            $s_Query = 'INSERT INTO user( name, email, phone, address, password,status, created) VALUES ("' . addslashes($this->name) . '","' . addslashes($this->email) . '","' . addslashes($this->phone) . '","' . addslashes($this->address) . '","' . addslashes($this->password) . '", "' . intval($this->status) . '","' . $this->created . '")';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows ;
	    }
	}
?>