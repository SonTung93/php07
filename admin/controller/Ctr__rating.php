<?php
	Class Ctr__rating Extends Template {
	    public $common = null;
	    public $currentUser = null;
	    public $result = null;
	    public $pagination = null;
	    public $search = null;
	    public $limit = null;
	    public $page = null;
	    public $product = null;
	    public $search_product= null;
	    public $category = null;
	    public $data_product = null;
	    public $rating = null;

	    public function __construct() {
	    	$this->category = new Category();
	        $this->common = new sys_common();
	        $this->product = new Product();
	        $this->rating = new Rating();
	        $this->currentUser = new sys_currentuser();
    	}

    	public function index(){
    		$this->temp_title = "Quản lý đánh giá sản phẩm";
    		$this->data_product = $this->product->getProduct();
	        $this->search_product= isset($_GET['p_id']) ? $_GET['p_id'] : '';
	        $this->search = isset($_GET['search']) ? $_GET['search'] : '';
	        $this->page = isset($_GET['page']) ? $_GET['page'] : 1;
	        $this->limit = isset($_GET['size']) ? $_GET['size'] : 6;

	        $arr = array();

	        $arr = $this->rating->getAllRating($this->search,$this->search_product, 'id', 'DESC', $this->page, $this->limit);

	        $this->result = $arr['data'];
	        $this->pagination = $arr['pager'];

	        $this->show("rating");
    	}

    	public function change_status() {
	        $status = isset($_POST['status']) ? $_POST['status'] : 0;
	        $list_id = isset($_POST['list_id']) ? $_POST['list_id'] : 0;
	        $rs = $this->rating->updateMultiStatus($status, $list_id);
	        if ($rs > 0) {
	            flashmessage::setMessage('Cập nhật thành công!');
	        } else {
	            flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	        }
	    }
	    
	    public function delete() {
	        $id = isset($_POST['id']) ? $_POST['id'] : '';

	        $rs = $this->rating->deleteData($id);

	        echo $rs;

	        if ($rs > 0) {
	            flashmessage::setMessage('Cập nhật thành công !');
	        } else {
	            flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	        }
	    }


    }
?>