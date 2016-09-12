<?php

class string_excerpt {

    public static function excerpt($str = '', $length = 40) {
        if (strlen($str) > $length)
            return mb_substr($str, 0,mb_strripos(mb_substr($str,0,$length),' '), 'UTF-8') . ' ...';
        return $str;
    }

}

