<?php 
	class E_Rating {
	    public $id = null;
	    public $product_id = null;
	    public $user_id = null;
	    public $user_name = null;
	    public $comment = null;
	    public $rating = null;
	    public $created = null;
	    public $status = null;

	}

	class Rating Extends E_Rating {
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

	    public function insertData() {
	        try {
	            $s_Query = 'INSERT INTO rating( product_id, user_id, user_name, comment, rating, created, status) VALUES ("' . intval($this->product_id) . '","' . intval($this->user_id) . '","' . addslashes($this->user_name) . '","' . addslashes($this->comment) . '","' . intval($this->rating) . '","' . $this->created . '","' . intval($this->status) . '")';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function updateMultiStatus($status = 0, $arr = array()) {
	        $list_id = is_array($arr) ? implode(',', $arr) : '0';
	        try {
	            $s_Query = 'UPDATE rating SET status="' . intval($status) . '" WHERE id in (' . $list_id . ')';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	    
	    public function deleteData($id = 0) {
	        try {
	            $s_Query = 'UPDATE rating SET status="-1" WHERE id = "' . intval($id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function getAllRatingByProductID($p_id = '') {
	        try {
	            $s_Query = 'SELECT * FROM rating WHERE status="1" AND product_id = "' . intval($p_id) . '" ORDER BY id DESC';
	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function getCountRating($search = '') {
	        try {
	            $s_Query = 'SELECT COUNT(id) FROM rating WHERE 1';

	            $s_Query .= ($search != '') ? (' AND comment like "%' . addslashes($search) . '%" ') : '';

	            $s_Query .= ' AND status !="-1" ';

	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows[0];
	    }

	    public function getAllRating($search = '', $p_id = '', $order = 'id', $order_type = 'DESC', $current = 0, $limit = 10) {

	        $total_result = $this->getCountRating($search);

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
	            $s_Query = 'SELECT * FROM rating WHERE 1';

	            $s_Query .= ' AND status != "-1" ';

	            $s_Query .= ($search != '') ? (' AND (comment like "%' . addslashes($search) . '%" )'): ' ';

	            $s_Query .= $p_id != '' ? ' AND product_id = "' . intval($p_id) . '" ' : ' ';

	            $s_Query .= ' ORDER BY ' . $order . ' ' . $order_type . ' ';

	            $s_Query .= ' LIMIT ' . $show . ',' . $limit . ' ';

	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return array('data' => $this->arr_Rows, 'pager' => $total_page);
	    }
	}
?>