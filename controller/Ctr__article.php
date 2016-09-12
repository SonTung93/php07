<?php 
	class Ctr__article extends Template{
		public $currentcustomer = null;
		public $cart = null;
		public $pagination = null;
	    public $search = null;
	    public $limit = null;
	    public $page = null;
	    public $search_category = null;
	    public $result = null;
	    public $article = null;
	    public $category_data = null;
	    public $category = null;
		public function __construct(){
			$this->currentcustomer = new sys_currentcustomer();
			$this->cart = new sys_cart();
			$this->article = new Article();
			$this->category = new Category();
		}

		public function index(){
			$id = isset($_GET['id']) ? intval($_GET['id']) : '';

	        $article = new Article();

	        $the_article = $article->getArticleByID($id);

	        $cat_id = $the_article['category_id'];

	        $the_recent = array();

	        if ($cat_id != '0') {
	            $the_recent = $article->getRecentArticleByIDClient($id, $cat_id);
	        }

	        $this->result = array($the_article, $the_recent);

	        if ($the_article['id'] != '') {

	            $temp_breadcumbs = array();

	            array_push($temp_breadcumbs, '<a href="' . ROOT . '/"><i class="fa fa-home"></i>Trang chủ</a>');

	            if ($the_article['category_id'] > 0) {

	                $list_parent_cat = $this->category->getAllParentCategoryByIDClient($the_article['category_id']);

	                $list_parent_cat = array_reverse($list_parent_cat);

	                foreach ($list_parent_cat as $key => $value) {
	                    $cat_name = $this->getCategoryName($value);
	                    $url = url_generated::createNewsUrl($cat_name, $value, '-');
	                    array_push($temp_breadcumbs, '<a href="' . $url . '">' . $cat_name . '</a>');
	                }
	            }

	            array_push($temp_breadcumbs, '<span>' . $the_article['title'] . '</span>');

	            auto_loader::$breadcrumbs = $temp_breadcumbs;

	            $this->temp_title = $the_article['title'] ;

	            $this->show("article_detail");
	        } else {
	            $this->temp_title = '404 lỗi';
	            $this->show("error404");
	        }
		}

		public function category(){
			$id = isset($_GET['category']) ? intval($_GET['category']) : '';
	        $this->page = isset($_GET['page']) ? trim($_GET['page']) : 1;
	        $this->limit = isset($_GET['l']) ? trim($_GET['l']) : 6;
	        $cat_name = '';
	        $list_id = array();
	        $temp_breadcumbs = array();
	        array_push($temp_breadcumbs, '<a href="' . ROOT . '/"><i class="fa fa-home"></i>Trang chủ</a>');
	        if ($id != '') {
	            $list_id = $this->category->getAllCategoryChildByParent($id);
	            array_push($list_id, $id);
	            $this->category_data = $this->category->getCategoryByIDClient($id);
	            $cat_name = $this->category_data['name'];
	            $this->temp_title = $cat_name;
	            if(!empty($this->category_data)){
	            	array_push($temp_breadcumbs, '<a href="' . url_generated::createNewsUrl($cat_name, $id, '-') . '">' . $cat_name . '</a>');
	            }    
	            
        	}else{
        		array_push($temp_breadcumbs, '<span>Tin tức</span>');
        		$this->temp_title = 'Tin tức';
            	$cat_name = 'Tin tức';
        	}
        	auto_loader::$breadcrumbs = $temp_breadcumbs;
        	
        	if ($cat_name != '') {         	
            	$arr = array();

	            $arr = $this->article->client_getAllArticle($this->search, implode(',', $list_id), 'id', 'DESC', $this->page, $this->limit);

	            $this->result = $arr['data'];
	            $this->pagination = $arr['pager'];
	            
	        	$this->show("article");
        	}else{
        		$this->temp_title = '404 lỗi';
            	$this->show("error404");
        	}
        	
		}

		public function getCategoryName($id) {
        	return $this->category->getCategoryNameByID($id);
    	}
	}
?>