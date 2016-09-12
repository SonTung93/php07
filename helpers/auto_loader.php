<?php

    class auto_loader {

        public static $menu = null;
        public static $article = null;
        public static $category = null;
        public static $banner = null;
        public static $breadcrumbs = array();
        public function __construct(){
        	
        }
        public static function loadBanner($position='0') {
            $banner = new Banner();

            return $banner->client_getAllBanner($position);
        }

        public static function getSettingCategoryBox($box) {
            $setting = new Setting();

            return $setting->getSettingCategoryBox($box);
        }

        public static function loadProduct($category_box) {
            $product = new Product();
            $category = new Category();
            $list_id = array();
            if ($category_box != '') {
                $list_id = $category->getAllCategoryChildByParent($category_box);
                array_push($list_id, $category_box);
            }
            return $product->getProductByCategoryIDTop(implode(',', $list_id), 8);
        }

        public static function loadMainMenu($parent_id = '0', $position = '0') {
            auto_loader::$menu = new Menu();
            $category = new Category();
            $article = new Article();
            $menu_arr = auto_loader::$menu->getAllMenuByParentID($parent_id, $position);
            if (count($menu_arr) > 0) {
                foreach ($menu_arr as $key => $value) {

                    $check = auto_loader::$menu->getCountSubMenu($value['id'], $position);
                    $first = '';
                    
                    $last = '</li>';
                    if ($check >= 1) {
                        if ($parent_id == '0')
                            $first = '<li class="pav-parrent aligned-left parent dropdown ">';
                    } else {
                        $first = '<li>';
                    }
                    if ($value['type'] == '0') {
                        $url = url_generated::createCategoryUrl($category->getCategoryNameByID($value['target_id']), $value['target_id'], '-');
                    } else if ($value['type'] == '1') {
                        $url = url_generated::createArticleUrl($article->getTitleArticleByID($value['target_id']), $value['target_id'], '-');
                    } else if ($value['type'] == '3') {
                        $url = url_generated::createNewsUrl($category->getCategoryNameByID($value['target_id']), $value['target_id'], '-');
                    }else {
                        $url = ROOT . $value['url'];
                    }

                    echo $first;

                    echo '<a href="'.$url.'" class="dropdown-toggle" data-toggle="dropdown"><span class="menu-title">' . $value['name'] . ' </span><b class="caret"></b></a>';

                    if ($check > 0 && $value['type']==0) {
                        echo '<div class="dropdown-menu" style="width:500px;">';
                        echo '<div class="dropdown-menu-inner">';
                        echo '<div class="row">';
                        auto_loader::loadMenuProduct($value['id'],$position);
                        auto_loader::loadHotProduct($value['target_id']);
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }elseif ($check > 0 ) {
                        echo '<div class="dropdown-menu level1">';
                        echo '<div class="dropdown-menu-inner">';
                        echo '<div class="row">';
                        auto_loader::loadMenuNews($value['id'],$position);
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    echo $last;
                }
            }
        }
        public static function loadMenuNews($parent_id = '0', $position = '0'){
             auto_loader::$menu = new Menu();
            $category = new Category();
            $article = new Article();
            $html ='<div class="mega-col col-xs-12 col-sm-12 col-md-12" data-type="menu">';
            $html .='   <div class="mega-col-inner">';
            $html .='        <ul>';
                    $menu_arr = auto_loader::$menu->getAllMenuByParentID($parent_id, $position);
                    if (count($menu_arr) > 0) {
                        foreach ($menu_arr as $key => $value) {
                            if ($value['type'] == '0') {
                                $url = url_generated::createCategoryUrl($category->getCategoryNameByID($value['target_id']), $value['target_id'], '-');
                            } else if ($value['type'] == '1') {
                                $url = url_generated::createArticleUrl($article->getTitleArticleByID($value['target_id']), $value['target_id'], '-');
                            } else if ($value['type'] == '3') {
                                $url = url_generated::createNewsUrl($category->getCategoryNameByID($value['target_id']), $value['target_id'], '-');
                            }else {
                                $url = ROOT . $value['url'];
                            }


                            $html .= '<li>';

                            $html .='<a href="'.$url.'"><span class="menu-title">' . $value['name'] . ' </span></b></a>';

                            $html .= '</li>';
                        }
                    }
            $html .='      </ul>';
            $html .='   </div>';
            $html .='</div>';
            echo $html;
        }
        public static function loadMenuProduct($parent_id = '0', $position = '0'){
             auto_loader::$menu = new Menu();
            $html ='<div class="mega-col col-xs-12 col-sm-12 col-md-4">';
            $html .='   <div class="mega-col-inner">';
            $html .='        <div class="pavo-widget" >';
            $html .='            <div class="pavo-widget" >';
            $html .='                <div class="widget-heading box-heading">Loại sản phẩm</div>';
            $html .='                <ul>';
                    $menu_arr = auto_loader::$menu->getAllMenuByParentID($parent_id, $position);
                    if (count($menu_arr) > 0) {
                        foreach ($menu_arr as $key => $value) {
                            $url = ROOT.$value['url'].'.html';

                            $html .= '<li class="pav-parrent aligned-left parent">';

                            $html .='<a href="'.$url.'"><span class="menu-title">' . $value['name'] . ' </span></b></a>';

                            $html .= '</li>';
                        }
                    }
            $html .='                </ul>';
            $html .='           </div>';
            $html .='        </div>';
            $html .='   </div>';
            $html .='</div>';
            echo $html;
        }
        public static function loadHotProduct($cate_id = '0',$id='0'){
            $product = new Product();
            $category = new Category();
            $list_cat = $category->getAllCategoryChildByParent($cate_id );
            array_push($list_cat, $cate_id);
            $hot_product = $product->getTopProduct(implode(',', $list_cat ));
            $url = url_generated::createProductUrl($hot_product['name'], $hot_product['id'], '-');
            $image = $image =  ROOT . '/kich-co-hinh-anh.html?src=' . ROOT . '/upload/Images/Product/' . $hot_product['image']. '&w=230&h=230';
            $html ='<div class="mega-col col-xs-12 col-sm-12 col-md-6 col-md-offset-1">';
            $html .='    <div class="mega-col-inner">';
            $html .='        <div class="pavo-widget">';
            $html .='            <div class="pavo-widget" >';
            $html .='                <div class="widget-heading box-heading">Sản phẩm hot</div>';
            $html .='                <div class="widget-product ">';
            $html .='                    <div class="widget-inner">';
            $html .='                        <div class="product-block">';
            $html .='                            <div class="image"><span class="product-label-special label">Hot</span>';
            $html .='                                <a class="img" href="'.$url.'"><img src="'.$image.'"/> </a>';
            $html .='                            </div>';
            $html .='                            <div class="product-meta text-center">';
            $html .='                                <h4 class="name"><a href="'.$url.'">'.$hot_product['name'].'</a></h4>';
            $html .='                                <div class="price"> ';
            $html .='                                    <span class="price-new">'.number_format($hot_product['price']).' ₫</span>';
            $html .='                                </div>';
            $html .='                                <div class="cart">';
            $html .='                                    <input type="button" value="Thêm vào giỏ hàng" onclick="cart.addcart('.$hot_product['id'].',1);" data-href="'.ROOT.'/cart/add"  class="button add-to-cart" /> </div>';
            $html .='                            </div>';
            $html .='                        </div>';
            $html .='                    </div>';
            $html .='                </div>';
            $html .='            </div>';
            $html .='        </div>';
            $html .='    </div>';
            $html .='</div>';
            echo $html;
        }
        public static function loadMenuCategory($parent_id = 0) {
            $category = new Category();
            $list_category = $category->getCategoryByParentID($parent_id);
            if (count($list_category) > 0) {
                foreach ($list_category as $key => $value) {

                    $check = $category->getCountSubCate($value['id']) ."<br/>";
                    $first = '';
                    $last = '</li>';
                    $url = '';
                    $link_class = '';
                    
                    if ($value['parent_id'] == '0'){
                        $first = '<li class="list-group-item accordion-group">';
                    }else{
                        $first = '<li>';
                    }
                    $url = url_generated::createCategoryUrl($value['name'], $value['id'], '-');
                    echo $first;

                    echo '<a href="' . $url . '">' . $value['name'] . '</a>';

                    if ($check > 0) {
                        echo '<span data-toggle="collapse" data-parent="#accordion" data-target="#'.$value['id'].'" class="badge df pull-right ">+</span>';
                        echo '<ul id="'.$value['id'].'" class="collapse accordion-body off">';

                        auto_loader::loadMenuCategory($value['id']);

                        echo '</ul>';
                    }

                    echo $last;
                }
            }
        }
        public static function loadNewsCategory($parent_id = 0) {
            $category = new Category();
            $list_category = $category->getCategoryByParentID($parent_id);
            if (count($list_category) > 0) {
                foreach ($list_category as $key => $value) {

                    $check = $category->getCountSubCate($value['id']) ."<br/>";
                    $first = '';
                    $last = '</li>';
                    $url = '';
                    $link_class = '';
                    
                    if ($value['parent_id'] == '0'){
                        $first = '<li class="level1">';
                    }else{
                        $first = '<li>';
                    }
                    $url = url_generated::createNewsUrl($value['name'], $value['id'], '-');
                    echo $first;

                    echo '<a href="' . $url . '">' . $value['name'] . '</a>';

                    if ($check > 0) {
                        echo '<span class="head"><a style="float:right;" href="">+</a></span>';
                        echo '<ul class="level2 ">';

                        auto_loader::loadNewsCategory($value['id']);

                        echo '</ul>';
                    }

                    echo $last;
                }
            }
        }
        public static function loadMenu($parent_id = '0',$position = '0'){
            auto_loader::$menu = new Menu();
            $category = new Category();
            $article = new Article();
            $currentcustomer = new sys_currentcustomer();
            $menu_arr = auto_loader::$menu->getAllMenuByParentID($parent_id, $position);
            if (count($menu_arr) > 0) {
                foreach ($menu_arr as $key => $value) {
                    $first = '<li>';
                    $last = '</li>';
                    if ($value['type'] == '0') {
                        $url = url_generated::createCategoryUrl($category->getCategoryNameByID($value['target_id']), $value['target_id'], '-');
                    } else if ($value['type'] == '1') {
                        $url = url_generated::createArticleUrl($article->getTitleArticleByID($value['target_id']), $value['target_id'], '-');
                    } else if ($value['type'] == '3') {
                        $url = url_generated::createNewsUrl($category->getCategoryNameByID($value['target_id']), $value['target_id'], '-');
                    }else {
                        $url = ROOT . $value['url'];
                    }

                    echo $first;
                    if($position==0){                
                        if($value['url'] == '/user' && !$currentcustomer->isLogin()){
                            echo '<a href="#" data-toggle="modal" data-target="#myModal"><span class="'.$value['icon'].'">&nbsp;</span>' . $value['name'] . ' </a>';
                        }else{
                        echo '<a href="'.$url.'"><span class="'.$value['icon'].'">&nbsp;</span>' . $value['name'] . ' </a>';
                        }
                    }else if($position==2){
                        echo '<a href="'.$url.'" class="pavcol-sm-5 col-md-4 col-sm-4 col-xs-6" target="_blank"><i class="'.$value['icon'].'">&nbsp;</i>' . $value['name'] . '</a>';
                    } 
                    echo $last;
                }
            }
        }
        public static function loadFooter() {
            $setting = new Setting();
            return $setting->getSettingDataByID(2);
        }

        public static function loadTopProductOrder(){
            $order = new Order();
            return $order->getListProductIdTopOrder();
        }
    }

?>
