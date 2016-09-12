<?php

	class Ctr__image extends Template {

    public function index() {
        include_once 'helpers/ImageResizer.php';
    }

    public function captcha() {
        capcha::phpcaptcha('#162453','#fff',120,40,10,25);
    }
}

?>
