<?php

class E_Article {

    public $id = null;
    public $title = null;
    public $image = null;
    public $description = null;
    public $content = null;
    public $created = null;
    public $modified = null;
    public $created_by = null;
    public $modified_by = null;
    public $status = null;
    public $category_id = null;
    public $featured = null;
    public $attachment = null;

}

class Article Extends E_Article {

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

    public function updateFeatured() {
        try {
            $s_Query = 'UPDATE article SET featured="' . intval($this->featured) . '",modified="' . $this->modified . '",modified_by="' . addslashes($this->modified_by) . '" WHERE id="' . intval($this->id) . '"';
            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows;
    }

    public function getTopArticleForPriority() {
        try {
            $s_Query = 'SELECT id FROM article WHERE status="1" ORDER BY id DESC LIMIT 0, 16 ';
            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows;
    }

    public function getAllArticleByStatus($status = '1') {
        try {
            $s_Query = 'SELECT * FROM article WHERE status="' . $status . '" ORDER BY id DESC';
            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows;
    }

    public function getArticleByID($id = 0) {
        try {
            $s_Query = 'SELECT * FROM article WHERE id="' . $id . '" AND status !="-1"';
            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows;
    }
    
    public function getTitleArticleByID($id = 0) {
        try {
            $s_Query = 'SELECT title FROM article WHERE id="' . $id . '" AND status !="-1"';
            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows[0];
    }

    public function getCountArticle($search = '', $list_cat = '') {
        try {
            $s_Query = 'SELECT COUNT(id) FROM article WHERE 1';

            $s_Query .= ($search != '') ? (' AND title like "%' . addslashes($search) . '%" OR description like "%' . addslashes($search) . '%" OR content like "%' . addslashes($search) . '%" ') : '';

            $s_Query .= ' AND status !="-1" ';

            $s_Query .= $list_cat != '' ? ' AND category_id IN (' . $list_cat . ') ' : '';

            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows[0];
    }

    public function getAllArticle($search = '', $list_cat = '', $order = 'id', $order_type = 'DESC', $current = 0, $limit = 10) {

        $total_result = $this->getCountArticle($search, $list_cat);

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
            $s_Query = 'SELECT * FROM article WHERE 1';

            $s_Query .= ' AND status != "-1" ';

            $s_Query .= ($search != '') ? (' AND (title like "%' . addslashes($search) . '%" OR description like "%' . addslashes($search) . '%" OR content like "%' . addslashes($search) . '%" ) ') : '';

            $s_Query .= $list_cat != '' ? ' AND category_id IN (' . $list_cat . ') ' : '';

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
            $s_Query = 'UPDATE article SET  title="' . addslashes($this->title) . '",image="' . addslashes($this->image) . '",description="' . addslashes($this->description) . '",content="' . addslashes($this->content) . '",status="' . intval($this->status) . '",modified="' . $this->modified . '",modified_by="' . addslashes($this->modified_by) . '",category_id="' . intval($this->category_id) . '",featured="' . intval($this->featured) . '", attachment="' . addslashes($this->attachment) . '" WHERE id="' . intval($this->id) . '"';
            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows;
    }

    public function insertData() {
        try {
            $s_Query = 'INSERT INTO article( title, image, description, content, status, created, modified, created_by, modified_by, category_id, featured, attachment) VALUES ("' . addslashes($this->title) . '","' . addslashes($this->image) . '","' . addslashes($this->description) . '","' . addslashes($this->content) . '","' . intval($this->status) . '","' . $this->created . '","' . addslashes($this->created_by) . '","' . intval($this->category_id) . '","' . intval($this->featured) . '", "' . addslashes($this->attachment) . '")';
            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows;
    }

    public function deleteData($id = 0) {
        try {
            $s_Query = 'UPDATE article SET status="-1" WHERE id = "' . intval($id) . '"';
            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows;
    }

    public function updateMultiStatus($status = 0, $arr = array()) {
        $list_id = is_array($arr) ? implode(',', $arr) : '0';
        try {
            $s_Query = 'UPDATE article SET status="' . intval($status) . '" WHERE id in (' . $list_id . ')';
            $this->arr_Rows = $this->obj_DB->ExecNonQuery($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows;
    }

    public function getTopID() {
        try {
            $s_Query = 'SELECT id FROM article ORDER BY id DESC LIMIT 1';
            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows[0];
    }

    /*     * ** Front-End *** */

    public function getArticleByListCategory($category = array()) {
        try {
            $s_Query = 'SELECT * FROM ' . TB_PREFIX . 'article WHERE 1';

            if (is_array($category)) {
                $convert = implode(',', $category);
                $s_Query .= (' AND category_id in (' . $convert . ') ');
            }
            $s_Query .= ' AND status = "1" ';

            $s_Query .= ' ORDER BY id DESC ';

            $s_Query .= ' LIMIT 0, 5 ';

            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows;
    }

    public function getNewsArticleByOrderID() {
        try {
            $s_Query = 'SELECT * FROM article WHERE 1';

            $s_Query .= ' AND status = "1" ';

            $s_Query .= ' ORDER BY id DESC ';

            $s_Query .= ' LIMIT 0, 10 ';

            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows;
    }

    public function getArticleByIDClient($id = '') {
        try {
            $s_Query = 'SELECT * FROM article WHERE 1 AND id="' . intval($id) . '" AND status = "1" ';

            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows;
    }

    public function getRecentArticleByIDClient($id = '', $category_id = '') {
        try {
            $s_Query = 'SELECT * FROM article WHERE 1 AND category_id="' . intval($category_id) . '" AND status = "1" AND id != "' . intval($id) . '" ORDER BY id DESC LIMIT 0, 4 ';

            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows;
    }

    public function getArticleByCategoryID($category) {
        try {
            $s_Query = 'SELECT * FROM article WHERE 1';

            $s_Query .= $category != '' ? (' AND category_id = ' . $category) : '';

            $s_Query .= ' AND status = "1" ';

            $s_Query .= ' ORDER BY id DESC ';

            $s_Query .= ' LIMIT 0, 20 ';

            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows;
    }

    public function getArticleByCategoryIDTop($category, $top) {
        try {
            $s_Query = 'SELECT * FROM ' . TB_PREFIX . 'article WHERE 1';

            $s_Query .= $category != '' ? (' AND category_id in (' . $category . ')') : '';

            $s_Query .= ' AND status = "1" ';

            $s_Query .= ' ORDER BY id DESC ';

            $s_Query .= ' LIMIT 0, ' . $top;

            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows;
    }

    public function getArticleFeaturedByCategoryIDTop($category, $top) {
        try {
            $s_Query = 'SELECT * FROM ' . TB_PREFIX . 'article WHERE 1';

            $s_Query .= $category != '' ? (' AND category_id in (' . $category . ')') : '';

            $s_Query .= ' AND status = "1" ';
            
//            $s_Query .= ' AND featured="1" ';

            $s_Query .= ' ORDER BY id DESC ';

            $s_Query .= ' LIMIT 0, ' . $top;

            $this->arr_Rows = $this->obj_DB->ExecQuery($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows;
    }

    public function client_getCountArticle($search = '', $list_cat = '') {
        try {
            $s_Query = 'SELECT COUNT(id) FROM article WHERE 1';

            $s_Query .= ' AND status = "1" ';

            $s_Query .= ($search != '') ? (' AND (title like "%' . addslashes($search) . '%" OR description like "%' . addslashes($search) . '%" OR content like "%' . addslashes($search) . '%" ) ') : '';

            $s_Query .= $list_cat != '' ? ' AND category_id IN (' . $list_cat . ') ' : '';

            $this->arr_Rows = $this->obj_DB->ExecScalar($s_Query);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $this->arr_Rows[0];
    }

    public function client_getAllArticle($search = '', $list_cat = '', $order = 'id', $order_type = 'DESC', $current = 0, $limit = 10) {

        $total_result = $this->client_getCountArticle($search, $list_cat);

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
            $s_Query = 'SELECT * FROM article WHERE 1';

            $s_Query .= ' AND status = "1" ';

            $s_Query .= ($search != '') ? (' AND (title like "%' . addslashes($search) . '%" OR description like "%' . addslashes($search) . '%" OR content like "%' . addslashes($search) . '%" ) ') : '';

            $s_Query .= $list_cat != '' ? ' AND category_id IN (' . $list_cat . ') ' : '';

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
