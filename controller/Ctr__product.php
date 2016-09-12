<?php 
	class Ctr__product extends Template{
		public $result = null;
        public $common = null;
    	public $product = null;
    	public $category = null;
    	public $pagination = null;
        public $cart = null;
        public $rating = null;
    	public $page = null;
    	public $limit = null;
        public $data_cate = null;
        public $currentcustomer = null;
        public $attribute_product = null;
        public $color =null;
        public $the_recent =null;

		public function __construct(){
			$this->common = new sys_common();
			$this->product = new Product();
			$this->category = new Category();
            $this->rating = new Rating();
            $this->attribute_product = new Attribute_Product();
            $this->cart = new sys_cart();
            $this->currentcustomer = new sys_currentcustomer();
		}
		public function index() {
			$id = isset($_GET['id']) ? intval($_GET['id']) : '';

			$this->result = $this->product->getProductAttrByID($id);
            $this->result['rating'] = $this->rating->getAllRatingByProductID($id);
			$cat_id = $this->result['category_id'];
            if ($cat_id != '0') {
                $this->the_recent = $this->product->getRecentProductByIDClient($id, $cat_id);
            }
            $this->color = $this->attribute_product->getAttributeColor($id);
	        if (!empty($this->result)) {
	        	$temp_breadcumbs = array();
	        	array_push($temp_breadcumbs, '<a href="' . ROOT . '/"><i class="fa fa-home"></i>Trang chủ</a>');
	        	if($this->result['category_id']>0){
	        		$list_parent_cat = $this->category->getAllParentCategoryByIDClient($cat_id);
	        		$list_parent_cat = array_reverse($list_parent_cat);
	        		foreach ($list_parent_cat as $key => $value) {
	                    $cat_name = $this->category->getCategoryNameByID($value);
	                    $url = url_generated::createCategoryUrl($cat_name, $value, '-');
	                    array_push($temp_breadcumbs, '<a href="' . $url . '">' . $cat_name . '</a>');
	                }	               
	        	}		        	
                array_push($temp_breadcumbs, '<span>' . $this->result['name'] . '</span>');
                auto_loader::$breadcrumbs = $temp_breadcumbs;
                $this->temp_title = $this->result['name'];
                $this->show("product");
	        }else{
	        	$this->temp_title = '404 lỗi';
	        	$this->show("error404");
	        }

    	}

        public function rating() {
            $this->rating->product_id = isset($_POST['eid'])?$_POST['eid']:'';
            $this->rating->user_id = $this->currentcustomer->getID();
            $this->rating->user_name = isset($_POST['name'])?$_POST['name']:'';
            $this->rating->comment = isset($_POST['comment'])?$_POST['comment']:'';
            $this->rating->rating = isset($_POST['rating'])?$_POST['rating']:'';
            $this->rating->created = date('Y/m/d H:i:s', time());
            $this->rating->status =1;
            $capcha = isset($_POST['captcha'])?$_POST['captcha']:'';
            $url = isset($_POST['url'])?$_POST['url']:'';
            if($capcha == capcha::getCode()){
                $rs = $this->rating->insertData();
                if($rs>0){
                    flashmessage::setMessageMainClient('Đánh giá sản phẩm thành công !');
                    capcha::clearCapcha();
                    $this->common->redirectUrl($url,1,1);
                }
            }else{
                flashmessage::setMessageMainClient('Có lỗi xảy ra !');
                $this->common->redirectUrl($url,1,1);
            }
        }

        public function loadInfo() {
            $id = isset($_POST['id'])?$_POST['id']:'';
            $this->result = $this->attribute_product->getAttributeProductByID($id);
            $array = array('image'=>$this->result['image'],'image_list'=>$this->result['image_list'],'price'=>number_format($this->result['price']));
            die(json_encode($array));
        }
    	public function details() {
    		$this->tempf_default = 'empty.php';
    		$id = isset($_GET['id']) ? intval($_GET['id']) : '';

			$this->result = $this->product->getProductByID($id);
            $this->result['rating'] = $this->rating->getAllRatingByProductID($id);
	        $this->show("detail");
    	}
    	public function category() {
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
                $this->data_cate = $this->category->getCategoryByIDClient($id);
                if(!empty($this->data_cate)){
                    $list_parent_cat = $this->category->getAllParentCategoryByIDClient($id);
                    $list_parent_cat = array_reverse($list_parent_cat);   
                    foreach ($list_parent_cat as $key => $value) {
                    $name = $this->category->getCategoryNameByID($value);
                    $url = url_generated::createCategoryUrl($name, $value, '-');
                    array_push($temp_breadcumbs, '<a href="' . $url . '">' . $name . '</a>');
                    } 
                }
                $cat_name = $this->data_cate['name'];
                $this->temp_title = $cat_name;      		  	               
        	}else{      
                array_push($temp_breadcumbs, '<span>Danh mục sản phẩm</span>');		
        		$this->temp_title = 'Danh mục sản phẩm!';
        		$cat_name = 'Danh mục sản phẩm!';
        	}

            auto_loader::$breadcrumbs = $temp_breadcumbs;
            if ($cat_name == '') {
                $this->temp_title = '404 lỗi';
                $this->show("error404");     
            }else{
                $arr = array();
                $order = isset($_GET['order'])?$_GET['order']:"id";
                $type = isset($_GET['type'])?$_GET['type']:"DESC";

                $arr = $this->product->client_getAllProduct(implode(',', $list_id), $order,$type, $this->page, $this->limit);
                
                $this->result = $arr['data'];
                $this->pagination = $arr['pager'];
               
                $this->show("category");
            }
            
    	}
	}
?>