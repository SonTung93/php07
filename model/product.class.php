<?php 
	class E_Product {
	    public $id = null;
	    public $category_id = null;
	    public $name = null;
	    public $band_id = null;
	    public $price = null;
	    public $price_old = null;
	    public $description = null;
	    public $image = null;
	    public $promotion = null;
	    public $featured = null;
	    public $review = null;
	    public $created = null;
	    public $created_by = null;
	    public $modified = null;
	    public $modified_by = null;
	    public $status = null;
	}

	class Product extends E_Product{
		public $obj_DB = null;
   		private $arr_Rows = null;

   		public function __construct() {
	        $this->obj_DB = new sys_db();
	    }

		public function getCountProduct($search = '', $list_cat = '') {
	        try {
	            $s_Query = 'SELECT COUNT(id) FROM product WHERE 1';

	            $s_Query .= ($search != '') ? (' AND name like "%' . addslashes($search) . '%" OR description like "%' . addslashes($search) . '%" ') : '';

	            $s_Query .= ' AND status !="-1" ';

	            $s_Query .= $list_cat != '' ? ' AND category_id IN (' . $list_cat . ') ' : '';

	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows[0];
	    }

	    public function getAllProduct($search = '', $list_cat = '', $order = 'id', $order_type = 'DESC', $current = 0, $limit = 10) {

	        $total_result = $this->getCountProduct($search, $list_cat);

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
	            $s_Query = 'SELECT * FROM product WHERE 1';

	            $s_Query .= ' AND status != "-1" ';

	            $s_Query .= ($search != '') ? (' AND (name like "%' . addslashes($search) . '%" OR description like "%' . addslashes($search) . '%" )'): ' ';

	            $s_Query .= $list_cat != '' ? ' AND category_id IN (' . $list_cat . ') ' : ' ';

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
	            $s_Query = 'UPDATE product SET status="' . intval($status) . '" WHERE id in (' . $list_id . ')';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function updateFeatured() {
	        try {
	            $s_Query = 'UPDATE product SET featured="' . intval($this->featured) . '", modified_by="' . $this->modified_by . '", modified="' . addslashes($this->modified) . '" WHERE id="' . intval($this->id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function deleteData($id = 0) {
	        try {
	            $s_Query = 'UPDATE product SET status="-1" WHERE id = "' . intval($id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	    
	    public function getProductByID($id = 0) {
	        try {
	            $s_Query = 'SELECT * FROM product WHERE id="' . $id . '" AND status !="-1"';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }


	    public function getProductAttrByID($id = 0,$ap_id=0) {
	        try {
	            $s_Query = 'SELECT p.id,p.name,p.price,p.promotion,p.description,p.category_id,ap.price price_add,ap.image,ap.image_list,ap.id ap_id,ap.attribute_id,ap.name attr_name,ap.value FROM product as p , attribute_product as ap where ap.status ="1" and p.id=ap.product_id and p.id="'.$id.'"';
	            $s_Query .= $ap_id != 0 ? ' AND ap.id ="'.$ap_id.'" ' : ' ';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	    public function getProduct() {
	        try {
	            $s_Query = 'SELECT * FROM product WHERE status !="-1"';
	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function getTopID() {
	        try {
	            $s_Query = 'SELECT id FROM product ORDER BY id DESC LIMIT 1';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows[0];
	    }
	    public function getTopProduct($list_cat) {
	        try {
	            $s_Query = 'SELECT * FROM product WHERE category_id IN (' . $list_cat . ') AND featured="1" ORDER BY id DESC LIMIT 1';
	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function updateData() {
	        try {
	            $s_Query = 'UPDATE product SET  name="' . addslashes($this->name) . '",price="' . intval($this->price) . '",description="' . addslashes($this->description) . '",promotion="' . addslashes($this->promotion) . '",price_old="' . intval($this->price_old) . '",status="' . intval($this->status) . '",modified="' . $this->modified . '",modified_by="' . addslashes($this->modified_by) . '",image="' . addslashes($this->image) . '",featured="' . intval($this->featured) . '",category_id="' . intval($this->category_id) . '" WHERE id="' . intval($this->id) . '"';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function insertData() {
	        try {
	            $s_Query = 'INSERT INTO product( name, price, price_old, description, promotion,image, featured, created, created_by, category_id, status) VALUES ("' . addslashes($this->name) . '","' . intval($this->price) . '","' . intval($this->price_old) . '","' . addslashes($this->description) . '","' . addslashes($this->promotion) . '","' . addslashes($this->image) . '","' . intval($this->featured) . '","' . $this->created . '","' . addslashes($this->created_by) . '","' . intval($this->category_id) . '","' . intval($this->status) . '")';
	            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    /*     * ** Front-End *** */

	    public function getProductByCategoryIDTop($category, $top) {
	        try {
	            $s_Query = 'SELECT * FROM product WHERE 1';

	            $s_Query .= $category != '' ? (' AND category_id in (' . $category . ')') : '';

	            $s_Query .= ' AND status = "1" AND id IN (SELECT product_id FROM attribute_product WHERE status = "1" )';

	            $s_Query .= ' ORDER BY id DESC ';

	            $s_Query .= ' LIMIT 0, ' . $top;

	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function client_getCountProduct($list_cat = '') {
	        try {
	            $s_Query = 'SELECT COUNT(id) FROM product WHERE 1';

	            $s_Query .= ' AND status = "1" ';

	            $s_Query .= $list_cat != '' ? ' AND category_id IN (' . $list_cat . ') ' : '';

	            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows[0];
	    }
	    public function client_getAllProduct($list_cat = '', $order = 'id', $order_type = 'DESC', $current = 0, $limit = 10) {

	        $total_result = $this->client_getCountProduct($list_cat);

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
	            $s_Query = 'SELECT * FROM product WHERE 1';

	            $s_Query .= ' AND status = "1" AND id IN (SELECT product_id FROM attribute_product WHERE status = "1" )';

	            $s_Query .= $list_cat != '' ? ' AND category_id IN (' . $list_cat . ') ' : '';

	            $s_Query .= ' ORDER BY ' . $order . ' ' . $order_type . ' ';

	            $s_Query .= ' LIMIT ' . $show . ',' . $limit . ' ';

	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return array('data' => $this->arr_Rows, 'pager' => $total_page);
	    }

	    public function client_Search($search){
	    	try {
	            $s_Query = "SELECT name,id FROM product WHERE name LIKE '%" . addslashes($search) . "%' ";
	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }

	    public function getRecentProductByIDClient($id = '', $category_id = '') {
	        try {
	            $s_Query = 'SELECT * FROM product WHERE 1 AND category_id="' . intval($category_id) . '" AND status = "1" AND id != "' . intval($id) . '" ORDER BY id DESC LIMIT 0, 8 ';

	            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
	        } catch (Exception $ex) {
	            echo $ex;
	        }
	        return $this->arr_Rows;
	    }
	}
?>