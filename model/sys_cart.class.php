<?php 
	class sys_cart{
        private $sessionname ='cart';

		public function __construct(){
			
		}

		public function add($id,$quantity,$userdata){   
            if(!isset($_SESSION[$this->sessionname]))
                 $_SESSION[$this->sessionname]=array();
			if(isset($_SESSION[$this->sessionname][$id])){
       	 		$_SESSION[$this->sessionname][$id]['number'] +=$quantity;
			}else{
				$_SESSION[$this->sessionname][$id] = $userdata;
			}

    	}

    	public function update($id,$number){
			if($number==0){
		        unset($_SESSION[$this->sessionname][$id]);
		    } else {
		        $_SESSION[$this->sessionname][$id]['number'] = $number;
		    }
    	}

    	public function cart_total(){
    		$total = 0;
    		foreach ($_SESSION[$this->sessionname] as $key => $value) {
    			$total += $value['price']*$value['number'];
    		}
    		return $total;
    	}

    	public function cart_number(){
    		$number = 0;
    		foreach ($_SESSION[$this->sessionname] as $key => $value) {
    			$number += $value['number'];
    		}
    		return $number;
    	}

    	public function delete($id){
    		unset($_SESSION[$this->sessionname][$id]);
    	}

    	public function cart_destroy(){
		    $_SESSION[$this->sessionname] = array();
		}

        public function cart_list(){
            return (isset($_SESSION[$this->sessionname])) ? $_SESSION[$this->sessionname] : array();
        }
	}
?>