<?php

class youtube {

    public static function get_image_from_url($str = '', $size = 0) {
        if ($str != '') {
            $new_str = str_replace('watch?v=', 'embed/', $str);

            $temp_arr = explode('embed/', $new_str);

            $key_youtube = str_replace('?', '', $temp_arr[1]);

            if ($size != 0) {
                return 'http://img.youtube.com/vi/' . $key_youtube . '/' . $size . '.jpg';
            }
            return 'http://img.youtube.com/vi/' . $key_youtube . '/0.jpg';
        }

        return '';
    }

    public static function convert_link($str = '') {
        if ($str != '') {
            return str_replace("watch?v=", "embed/", $str);
        }

        return '';
    }

}
