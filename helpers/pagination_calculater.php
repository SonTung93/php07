<?php

class pagination_calculater {

    public static function pager($view_scope = 3, $current_page = 0, $total_page = 0) {
        
        $page_min = ($current_page > $view_scope) ? ($current_page - $view_scope) : 1;
        $page_max = ($current_page < ($total_page - $view_scope)) ? ($view_scope + $current_page) : $total_page;
        
        return array('min' => $page_min, 'max' => $page_max);
    }

}

