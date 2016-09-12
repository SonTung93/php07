<?php 
	class Ctr__transaction extends Template{
		public $common = null;
        public $currentUser = null;
        public $result = null;
        public $transaction = null;
        public $pagination = null;
	    public $limit = null;
	    public $page = null;
	    public $search = null;
	    public $product = null;
	    public $order = null;
		public function __construct(){
        	$this->common = new sys_common();
        	$this->currentUser = new sys_currentuser();
        	$this->transaction = new Transaction();
        	$this->order = new Order();
        	$this->product = new Product();
        }		

        public function index(){
        	$this->temp_title = 'Quản lý Transaction';
        	$this->search = isset($_GET['search']) ? $_GET['search'] : '';
	        $this->page = isset($_GET['page']) ? $_GET['page'] : 1;
	        $this->limit = isset($_GET['size']) ? $_GET['size'] : 5;

	        $arr = array();

	        $arr = $this->transaction->getAllTransaction($this->search, 'id', 'DESC', $this->page, $this->limit);

	        $this->result = $arr['data'];
	        $this->pagination = $arr['pager'];


        	$this->show('transaction');
        }

        public function change_status() {
	        $status = isset($_POST['status']) ? $_POST['status'] : 0;
	        $list_id = isset($_POST['list_id']) ? $_POST['list_id'] : 0;
	        $rs = $this->transaction->updateMultiStatus($status, $list_id);
	        if ($rs > 0) {
	            flashmessage::setMessage('Cập nhật thành công!');
	        } else {
	            flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	        }
	    }

	    public function delete() {
            $id = isset($_POST['id']) ? $_POST['id'] : '';

            $rs = $this->transaction->deleteData($id);

            echo $rs;

            if ($rs > 0) {
                flashmessage::setMessage('Cập nhật thành công !');
            } else {
                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
            }
        }

        public function view(){
        	$this->temp_title = 'Sửa Transaction';
        	if(isset($_POST['save'])){
        		$this->transaction->id = isset($_POST['eid']) ? $_POST['eid'] : '';
	            $this->transaction->user_name = isset($_POST['name']) ? $_POST['name'] : '';
	            $this->transaction->user_phone = isset($_POST['phone']) ? $_POST['phone'] : '';
	            $this->transaction->user_email = isset($_POST['email']) ? $_POST['email'] : '';
	            $this->transaction->payment = isset($_POST['payment']) ? $_POST['payment'] : '';
	            $this->transaction->amount = isset($_POST['amount']) ? $_POST['amount'] : '';
	            $this->transaction->message = isset($_POST['message']) ? $_POST['message'] : '';
	            $this->transaction->status = isset($_POST['status']) ? $_POST['status'] : '';
	            $rs = $this->transaction->updateData();

	            if ($rs > 0) {
	                flashmessage::setMessage('Cập nhật thành công !');
	            } else {
	                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
	            }
	            $this->common->redirectUrl('admin/transaction/edit/' . $this->transaction->id);
        	}else{
        		$id = isset($_GET['id']) ? $_GET['id'] : '';

                $this->result = $this->transaction->getTransactionByID($id);
                if ($this->result == '') {
                    flashmessage::setMessageError('Không tìm thấy dữ liệu !');
                    $this->common->redirectUrl('admin/transaction');
                } else {
                    $this->show("transaction_view");
                }
        	}
        }
	}
?>