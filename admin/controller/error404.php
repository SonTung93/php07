<?php

Class Ctr__error404 Extends Template {

    public function index() {
        $this->temp_title = "Lỗi 404";
        $this->blog_heading = 'Lỗi 404';
        $this->show('error404');
    }

}

?>
