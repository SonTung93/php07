<?php

class url_generated {

    public static $unicode = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|A',
        'd' => 'đ|Đ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|E|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'i' => 'í|ì|ỉ|ĩ|ị|I|Í|Ì|Ỉ|Ĩ|Ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|O|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|U|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ|Y|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        '-' => '\&|\:|\;|\.|\.\.|\.\.\.|\=|\+|\_|\-\-|\-\-\-|\#|\,|\?|\)|\(|\/|\]|\[|\"|\'|\`|\“|\”|\–'
    );

    public static function createCategoryUrl($str = '', $id = 0, $char = '-') {
        foreach (url_generated::$unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(' ', $char, $str);

        $str = str_replace('---', $char, $str);

        $str = str_replace('--', $char, $str);

        $str = strtolower($str);

        return ROOT . '/category/' . $str . '_' . $id . '.html';
    }

    public static function createArticleUrl($str = '', $id = 0, $char = '-') {
        foreach (url_generated::$unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(' ', $char, $str);

        $str = str_replace('---', $char, $str);

        $str = str_replace('--', $char, $str);

        $str = strtolower($str);

        return ROOT . '/bai-viet/' . $str . '_' . $id . '.html';
    }

    public static function createNewsUrl($str = '', $id = 0, $char = '-') {
        foreach (url_generated::$unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(' ', $char, $str);

        $str = str_replace('---', $char, $str);

        $str = str_replace('--', $char, $str);

        $str = strtolower($str);

        return ROOT . '/tin-tuc/' . $str . '_' . $id . '.html';
    }
    
    public static function createProductUrl($str = '', $id = 0, $char = '-') {
        foreach (url_generated::$unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(' ', $char, $str);

        $str = str_replace('---', $char, $str);

        $str = str_replace('--', $char, $str);

        $str = strtolower($str);

        return ROOT . '/san-pham/' . $str . '_' . $id . '.html';
    }

}
