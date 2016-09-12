<?php 
	class Ctr__home extends Template{
		public $result = null;
		public $cart = null;
		public $currentcustomer = null;
		public $product = null;
		public function __construct(){
			$this->cart = new sys_cart();
			$this->currentcustomer = new sys_currentcustomer();
			$this->product = new product();
		}
		public function index() {
			$this->temp_title = "Home";
	        $this->show("home");
    	}

    	public function getCategory($id) {
        	$category = new Category();
        	return $category->getCategoryByID($id);
    	}

    	public function search() {
        	if(isset($_GET['term'])){
        		$key = $_GET['term'];
        		$this->result = $this->product->client_Search($key);
        		foreach ($this->result as $key => $value) {
        			$url = url_generated::createProductUrl($value['name'], $value['id'], '-');
        			$data[] = array('label'=>$value['name'],'value'=>$url);
        		}
        		echo json_encode($data);
        	}
    	}
	}
?>