<?php 
	class Ctr__order extends Template{
		public $common = null;
        public $currentUser = null;
        public $result = null;
        public $order = null;
        public $pagination = null;
	    public $limit = null;
	    public $page = null;
	    public $product = null;
	    public $attribute_product = null;
		public function __construct(){
        	$this->common = new sys_common();
        	$this->currentUser = new sys_currentuser();
        	$this->order = new Order();
        	$this->product = new Product();
        	$this->attribute_product = new Attribute_Product();
        }		

        public function index(){
        	$this->temp_title = 'Quản lý Order';
	        $this->page = isset($_GET['page']) ? $_GET['page'] : 1;
	        $this->limit = isset($_GET['size']) ? $_GET['size'] : 5;

	        $arr = array();

	        $arr = $this->order->getAllOrder('id', 'DESC', $this->page, $this->limit);

	        $this->result = $arr['data'];
	        $this->pagination = $arr['pager'];


        	$this->show('order');
        }

        public function change_status() {
	        $status = isset($_POST['status']) ? $_POST['status'] : 0;
	        $list_id = isset($_POST['list_id']) ? $_POST['list_id'] : 0;
	        echo $rs = $this->order->updateMultiStatus($status, $list_id);
	        if ($rs > 0) {
	            flashmessage::setMessage('Cập nhật thành công!');
	        } else {
	            flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	        }
	    }
	    
	    public function delete() {
            $id = isset($_POST['id']) ? $_POST['id'] : '';

            $rs = $this->order->deleteData($id);

            echo $rs;

            if ($rs > 0) {
                flashmessage::setMessage('Cập nhật thành công !');
            } else {
                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
            }
        }
	}
?>