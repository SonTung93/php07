<?php 
    Abstract Class Template{
        protected $registry;
        public $_viewdir = '';
        public $tempf_content = 'content.php';
        public $tempf_default = 'default.php';
        public $temp_title = '';

        public $tplContent = '';

        function __construct($registry){
            $this->registry = $registry;
        }

        abstract function index();

        private $vars = array();

        public function __set($index,$value){
            $this->vars[$index]= $value;
        }

        function show($tplname){
            //$str_patchview = __SITE_PATH.'/views/';
            if($GLOBALS['_viewdir'] != '')
                $str_patchview = $GLOBALS['_viewdir'];
            $temp = $str_patchview.'templates/'.$this->tempf_default;
            $path = $str_patchview.$tplname.'.php';

            if(file_exists($temp) == false){
                throw new Exception('Template default not found in '.$temp);
                return false;
            }
            //check view
            if(file_exists($path) == false){
                throw new Exception('Template not found in '.$temp);
                return false;
            }
            // Load variables
            foreach ($this->vars as $key => $value) {
                $$key = $value;
            }
            //template content
            if ($this->tplContent == '') {
                ob_start();
                include($path);
                $this->tplContent = ob_get_contents();
                ob_end_clean();
            }
            
            include ($temp);
        }
    }
?>