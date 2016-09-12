<?php 
	class Ctr__cart extends Template{
		public $result = null;
		public $product = null;
		public $cart = null;
		public $common = null;
		public $currentcustomer = null;
		public $transaction = null;
		public $order = null;
		public $attribute_product = null;
		public function __construct(){
			$this->product = new Product();
			$this->transaction = new Transaction();
			$this->order = new Order();
			$this->cart = new sys_cart();
			$this->common = new sys_common();
			$this->currentcustomer = new sys_currentcustomer();
			$this->attribute_product = new Attribute_Product();
		}
		public function index(){
			$this->temp_title = 'Giỏ hàng';
	        $this->show("cart");
		}
		public function checkout(){
			 $this->temp_title = "Thanh toán";
			 if (isset($_POST['submit']) && count($this->cart->cart_list())>0) {
			 	$this->transaction->user_id = isset($_POST['id']) ? $_POST['id'] : '';
			 	$this->transaction->user_name = isset($_POST['name']) ? $_POST['name'] : '';
			 	$this->transaction->user_phone = isset($_POST['phone']) ? $_POST['phone'] : '';
			 	$this->transaction->user_email = isset($_POST['email']) ? $_POST['email'] : '';
			 	$this->transaction->user_address = isset($_POST['address']) ? $_POST['address'] : '';
			 	$this->transaction->message = isset($_POST['message']) ? $_POST['message'] : '';
			 	echo $this->transaction->payment = isset($_POST['payment']) ? $_POST['payment'] : '';
			 	$this->transaction->amount = $this->cart->cart_total();
			 	$this->transaction->status = 0;
			 	$this->transaction->created = date('Y/m/d H:i:s', time());
				$rs = $this->transaction->insertData();
				if($rs>0){
				 	$this->order->transaction_id = $this->transaction->getTopID();
				 	foreach ($this->cart->cart_list() as $key => $value) {
				 		$this->order->product_id = $value['id'];
				 		$this->order->attribute_product_id = $value['ap_id'];
				 		$this->order->quantity = $value['number'];
				 		$this->order->amount = $value['price']*$value['number']; 		
				 		$this->order->status = 0;
				 		$rs1 = $this->order->insertData(); 		
				 	}
		            if ($rs1 > 0) {
		                flashmessage::setMessageMainClient('Đặt hàng thành công !');
		                $this->cart->cart_destroy();
		                $this->common->redirectUrl();
		            } else {
		                flashmessage::setMessageMainClient('Có lỗi xảy ra, vui lòng thử lại sau !');
		                $this->common->redirectUrl('cart.html');
		            }
	       	    }
			}else{
				$this->color = $this->attribute_product->getAttributeColor($id);
				flashmessage::setMessageMainClient('Bạn chưa chọn sản phẩm !');
				$this->common->redirectUrl('cart.html');
			}
		}
		public function add(){
			$id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
			$ap_id =  isset($_POST['ap_id']) ? $_POST['ap_id'] : '';
			$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
			$this->result = $this->product->getProductAttrByID($id,$ap_id);
			
			$data =	array('id' => $id,'ap_id'=>$this->result['ap_id'],'attr_name'=>$this->result['attr_name'],'name' => $this->result['name'],'image' => $this->result['image'],'number' => $quantity,'price' => $this->result['price']+$this->result['price_add']);
			$this->cart->add($this->result['ap_id'],$quantity,$data);
			$number = $this->cart->cart_number();
			$total = number_format($this->cart->cart_total());
			$json = array('cart_total'=>$total,'cart_number'=>$number);
			die(json_encode($json));

		}
		public function update(){
			$id = isset($_POST['key']) ? $_POST['key'] : '';
			$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';

			$this->cart->update($id,$quantity);
			$number = $this->cart->cart_number();
			$total = number_format($this->cart->cart_total());
			$json = array('cart_total'=>$total,'cart_number'=>$number);
			die(json_encode($json));
		}
		public function delete(){
			$id = isset($_POST['key']) ? $_POST['key'] : '';
			$this->cart->delete($id);
			$number = $this->cart->cart_number();
			$total = number_format($this->cart->cart_total());
			$json = array('cart_total'=>$total,'cart_number'=>$number);
			die(json_encode($json));
		}
		public function delete_all(){
			$this->cart->cart_destroy();
			flashmessage::setMessageMainClient('Xóa thành công !');
			$this->common->redirectUrl('cart.html');
		}
		public function loadcart(){
			$list_id = isset($_POST['list_id'])?$_POST['list_id']:"";
			$this->cart->cart_destroy();
			foreach ($list_id as $key => $value) {
				$this->result = $this->product->getProductAttrByID($value['id'],$value['ap_id']);
				$data =	array('id' =>$value['id'],'ap_id'=>$this->result['ap_id'],'attr_name'=>$this->result['attr_name'],'name' => $this->result['name'],'image' => $this->result['image'],'number' => $value['quantity'],'price' => $this->result['price']+$this->result['price_add']);
				$this->cart->add($this->result['ap_id'],$value['quantity'],$data);
			}
			$html = '';
			foreach ($this->cart->cart_list() as $key => $value) {
				$html .= '<tr>';
				$html .= '<td class="text-center"> <a href=""><img src="'.ROOT.'/upload/Images/Attribute_Product/'.$value['image'].'" class="img-thumbnail" /></a></td>';
				$html .= '<td class="text-left"><a href="">'.$value['name'].'</a>
                                </td>';
                $html .= '<td class="text-center">';
                $html .= '<div class="tab-color">';
                $html .= '<ul>';                
                foreach ($this->attribute_product->getAttributeColor($value['id']) as $row) {
                	$html .= $row['name']==$value['attr_name']?'<li class="active">':'<li>';
                	$html .= '<span style="background:'.$row['value'].'" data-ap-id='.$value['ap_id'].' data-id="" tille="'.$row['id'].'"></span>';
                	$html .= '</li>';                        
                }
                $html .= '</ul>';                
                $html .= '</div>';
				$html .= '</td>';  
                $html .= '<td class="text-left">';
                $html .= '<div class="input-group btn-block" style="max-width: 200px;">';
                $html .= '<input type="text" name="quantity-'.$value['ap_id'].'" value="'.$value['number'].'" size="1" class="form-control" />';
                $html .= '<span class="input-group-btn">';
                $html .= '<button type="submit" data-toggle="tooltip" title="Update" class="btn btn-primary update-cart" data-href="'.ROOT.'/cart/update" onclick="cart.update('.$value['ap_id'].');"><i class="fa fa-refresh"></i></button>';
                $html .= '<button type="button" data-toggle="tooltip" title="Remove" class="btn btn-danger" onclick="cart.remove('.$value['ap_id'].');"><i class="fa fa-times-circle"></i></button>  ';
                $html .= '</span>';
                $html .= '</div>';
                $html .= '</td>';
                $html .= '<td class="text-right">'.number_format($value['price']).' ₫</td>';                
                $html .= '<td class="text-right">'.number_format($value['price']*$value['number']) .'₫</td>';
				$html .= '</tr>';
			}
			$html .= '<input type="hidden" name="price" value="'.number_format($this->cart->cart_total()).'" >';
			echo $html;
		}
		public function info(){		
			if (count($this->cart->cart_list())>0) {
			echo '<li>';
			echo '<table class="table table-striped">';
			foreach ($this->cart->cart_list() as $key => $value) {
				$url = url_generated::createProductUrl($value['name'], $value['id'], '-');
				echo '<tr>';
				echo '<td class="text-center"> <a href="'.$url.'"><img src="'.ROOT.'/upload/Images/Attribute_Product/'.$value['image'].'" class="img-thumbnail" /></a>';
				echo '<td class="text-left"><a href="'.$url.'">'.$value['name'].'</a>('.$value['attr_name'].')
	                        </td>';
	            echo '<td class="text-right"> x'.$value['number'].'</td>';
	            echo '<td class="text-right">'.number_format($value['number']*$value['price']).' ₫ </td>';
	            echo '<td class="text-center"><button type="button" onclick="cart.remove('.$value['ap_id'].')" title="Remove" class="btn btn-default btn-xs detele-cart" data-href="'.ROOT.'/cart/delete"><i class="fa fa-times" ></i></button></td>';
				echo "</tr>";
			}
			echo '</table>';	
			echo '<div>';
			echo '<table class="table table-bordered">';
			echo '<tr>';
			echo '<td class="text-right"><strong>Tổng</strong></td>';
			echo '<td class="text-right">'.number_format($this->cart->cart_total()).' ₫ </td>';
			echo '</tr>';
			echo '</table>';
			echo '<p class="text-right"><a href="cart.html"><strong class="button btn btn-default"><i class="fa fa-shopping-cart"></i> Đặt hàng</strong></a></p>';
			echo '<div>';
			echo '</li>';
			}else{
				echo '<p class="text-center">Giỏ hàng đang trống!</p>';
			}
		}

	}
?>