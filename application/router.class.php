<?php 
	class Router{
		private $registry;
		private $path;
		public $file;
		public $controller;
		public $action;
		public function __construct($registry){
			$this->registry= $registry;
		}

		public function setPath($path){
			if(is_dir($path)==false){
				throw new Exception('Invalid controller path:'.$path);
			}
			$this->path = $path;
		}

		public function getController(){
			$router = (empty($_GET['rt'])) ? '' : $_GET['rt'];

			if(empty($router)){
				$router='index';
			}else{
				$parts = explode("/", $router);
				$this->controller = $parts[0];
				if(isset($parts[1]))
					$this->action = $parts[1];
			}

			if(empty($this->controller))
				$this->controller = 'index';
			if(empty($this->action))
				$this->action = 'index';

			$this->file = $this->path .'/'.'Ctr__'.$this->controller.'.php';
		}

		public function loader(){
			$this->getController();
			$this->controller; 
			if (is_readable($this->file) == false) {
	            $this->file = $this->path . '/error404.php';
	            $this->controller = 'error404';
        	}
			include $this->file;
			//echo $this->file;
			$control_name = str_replace('-','',$this->controller);
        	$class = 'Ctr__'.$control_name ;
			$controller= new $class($this->registry);
			if (is_callable(array($controller, $this->action)) == false) {
            	$action = 'index';
       		} else {
            	$action = $this->action;
        	}

			$controller->$action();
		}
	}
?>