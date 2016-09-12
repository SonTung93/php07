<?php 
	class Ctr__menu extends Template{
		public $menu = null;
        public $common = null;
        public $currentUser = null;
        public $result = null;
        public $article = null;
        public $category = null;

        public function __construct(){
        	$this->menu = new Menu();
            $this->article = new Article();
            $this->category = new Category();
        	$this->common = new sys_common();
        	$this->currentUser = new sys_currentuser();
        }	

        public function index(){
        	$this->temp_title = 'Quản lý Menu';
        	$this->show('menu');
        }

        public function create(){
        	$this->temp_title = 'Thêm Menu';
        	if(isset($_POST['save'])){
                $this->menu->name = isset($_POST['name']) ? $_POST['name'] : '';
                $this->menu->icon = isset($_POST['icon']) ? $_POST['icon'] : '';
                $this->menu->position = isset($_POST['position']) ? $_POST['position'] : '';
                $this->menu->parent_id = isset($_POST['parent_id_p' . $this->menu->position]) ? $_POST['parent_id_p' . $this->menu->position] : '';

                $this->menu->type = isset($_POST['type']) ? $_POST['type'] : 0;

                $target_id_article = isset($_POST['target_id_article']) ? $_POST['target_id_article'] : 0;
                $target_id_category = isset($_POST['target_id_category']) ? $_POST['target_id_category'] : 0;
                $target_url = isset($_POST['url']) ? $_POST['url'] : 0;
                $target_id_news = isset($_POST['target_id_news']) ? $_POST['target_id_news'] : 0;
                $target_about = isset($_POST['about']) ? $_POST['about'] : '/gioi-thieu.html';
                $target_contact = isset($_POST['contact']) ? $_POST['contact'] : '/lien-he.html';

                switch ($this->menu->type) {
                    case '0':
                        $this->menu->target_id = $target_id_category;
                        if ($this->menu->target_id == 0) {
                            flashmessage::setMessageError('Bạn chưa chọn danh mục sản phẩm!');
                            $this->common->redirectUrl('admin/menu/create');
                            return;
                        }
                        $this->menu->url = $this->common->createTypeUrl($this->menu->type, $this->menu->name, $this->menu->target_id, '-');
                        break;
                    case '1':
                        $this->menu->target_id = $target_id_article;
                        if ($this->menu->target_id == 0) {
                            flashmessage::setMessageError('Bạn chưa chọn bài viết !');
                            $this->common->redirectUrl('admin/menu/create');
                            return;
                        }
                        $this->menu->url = $this->common->createTypeUrl($this->menu->type, $this->menu->name, $this->menu->target_id, '-');
                        break;
                    case '2':
                        $this->menu->target_id = '';
                        $this->menu->url = $target_url;
                        if ($this->menu->url == '') {
                            flashmessage::setMessageError('Bạn chưa nhập url !');
                            $this->common->redirectUrl('admin/menu/create');
                            return;
                        }
                        break;
                    case '3':
                        $this->menu->target_id = $target_id_news;
                        if ($this->menu->target_id == 0){
                            flashmessage::setMessageError('Bạn chưa chọn loại tin tức !');
                            $this->common->redirectUrl('admin/menu/edit/' . $this->menu->id);
                        }
                        $this->menu->url = $this->common->createTypeUrl($this->menu->type, $this->menu->name, $this->menu->target_id, '-');
                        break;
                    case '4':
                        $this->menu->target_id = '';
                        $this->menu->url = $target_about;
                        break;
                    case '5':
                        $this->menu->target_id = '';
                        $this->menu->url = $target_contact;
                        break;
                }

                $this->menu->sort_menu = isset($_POST['sort_menu']) ? $_POST['sort_menu'] : '';
                $this->menu->created = date('Y/m/d H:i:s', time());
                $this->menu->created_by = $this->currentUser->getUsername();
                $this->menu->status = isset($_POST['status']) ? $_POST['status'] : '';

                $rs = $this->menu->insertData();

                if ($rs > 0) {
                    $id = $this->menu->getTopID();
                    flashmessage::setMessage('Thêm mới thành công !');

                    $this->common->redirectUrl('admin/menu/edit/' . $id);
                } else {
                    flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
                }

        	}else{
        		$this->show("menu_create");
        	}
		}
        public function edit(){
            $this->temp_title = "Chỉnh sửa menu";

            if (isset($_POST['save'])) {
                $this->menu->id = isset($_POST['eid']) ? $_POST['eid'] : '';
                $this->menu->name = isset($_POST['name']) ? $_POST['name'] : '';
                $this->menu->icon = isset($_POST['icon']) ? $_POST['icon'] : '';
                $this->menu->position = isset($_POST['position']) ? $_POST['position'] : '';
                $this->menu->parent_id = isset($_POST['parent_id_p' . $this->menu->position]) ? $_POST['parent_id_p' . $this->menu->position] : '';

                $this->menu->type = isset($_POST['type']) ? $_POST['type'] : 0;

                $target_id_article = isset($_POST['target_id_article']) ? $_POST['target_id_article'] : 0;
                $target_id_category = isset($_POST['target_id_category']) ? $_POST['target_id_category'] : 0;
                $target_url = isset($_POST['url']) ? $_POST['url'] : 0;
                $target_id_news = isset($_POST['target_id_news']) ? $_POST['target_id_news'] : 0;
                $target_about = isset($_POST['about']) ? $_POST['about'] : '/about.html';
                $target_contact = isset($_POST['contact']) ? $_POST['contact'] : '/lien-he.html';
                switch ($this->menu->type) {
                    case '0':
                        $this->menu->target_id = $target_id_category;
                        if ($this->menu->target_id == 0) {
                            flashmessage::setMessageError('Bạn chưa chọn danh mục sản phẩm !');
                            $this->common->redirectUrl('admin/menu/edit/' . $this->menu->id);
                        }
                        $this->menu->url = $this->common->createTypeUrl($this->menu->type, $this->menu->name, $this->menu->target_id, '-');
                        break;
                    case '1':
                        $this->menu->target_id = $target_id_article;
                        if ($this->menu->target_id == 0){
                            flashmessage::setMessageError('Bạn chưa chọn bài viết !');
                            $this->common->redirectUrl('admin/menu/edit/' . $this->menu->id);
                        }
                        $this->menu->url = $this->common->createTypeUrl($this->menu->type, $this->menu->name, $this->menu->target_id, '-');
                        break;
                    case '2':
                        $this->menu->target_id = '';
                        $this->menu->url = $target_url;
                        if ($this->menu->url == '') {
                            flashmessage::setMessageError('Bạn chưa nhập url !');
                            $this->common->redirectUrl('admin/menu/edit/' . $this->menu->id);
                        }
                        break;
                    case '3':
                        $this->menu->target_id = $target_id_news;
                        if ($this->menu->target_id == 0){
                            flashmessage::setMessageError('Bạn chưa chọn loại tin tức !');
                            $this->common->redirectUrl('admin/menu/edit/' . $this->menu->id);
                        }
                        $this->menu->url = $this->common->createTypeUrl($this->menu->type, $this->menu->name, $this->menu->target_id, '-');
                        break;
                    case '4':
                        $this->menu->target_id = '';
                        $this->menu->url = $target_about;
                        if ($this->menu->url == '') {
                            flashmessage::setMessageError('Bạn chưa nhập đường dẫn fanpage !');
                            $this->common->redirectUrl('admin/menu/edit/' . $this->menu->id);
                        }
                        break;
                    case '5':
                        $this->menu->target_id = '';
                        $this->menu->url = $target_contact;
                        if ($this->menu->url == '') {
                            flashmessage::setMessageError('Bạn chưa nhập đường dẫn liên hệ !');
                            $this->common->redirectUrl('admin/menu/edit/' . $this->menu->id);
                        }
                        break;
                }
                $this->menu->sort_menu = isset($_POST['sort_menu']) ? $_POST['sort_menu'] : '';
                $this->menu->modified = date('Y/m/d H:i:s', time());
                $this->menu->modified_by = $this->currentUser->getUsername();
                $this->menu->status = isset($_POST['status']) ? $_POST['status'] : '';

                $rs = $this->menu->updateData();

                if ($rs > 0) {
                    flashmessage::setMessage('Cập nhật thành công !');

                    $this->common->redirectUrl('admin/menu');
                } else {
                    flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');

                    $this->common->redirectUrl('admin/menu/edit/' . $this->menu->id);
                }
            }else{
                $id = isset($_GET['id']) ? $_GET['id'] : '';

                $this->result = $this->menu->getMenuByID($id);
                if ($this->result == '') {
                    flashmessage::setMessageError('Không tìm thấy dữ liệu !');
                    $this->common->redirectUrl('admin/menu');
                } else {
                    $this->show("menu_edit");
                }
            }
        }

        public function change_status() {
            $status = isset($_POST['status']) ? $_POST['status']:0;
            $list_id = isset($_POST['list_id']) ? $_POST['list_id']:0;
            $this->menu->modified = date('Y/m/d H:i:s', time());
            $this->menu->modified_by = $this->currentUser->getUsername();
            $rs = $this->menu->updateMultiStatus($status, $list_id);
            if ($rs > 0) {
                flashmessage::setMessage('Cập nhật thành công!');
            } else {
                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
            }
        }

        public function delete() {
            $id = isset($_POST['id']) ? $_POST['id'] : '';

            $rs = $this->menu->deleteData($id);

            echo $rs;

            if ($rs > 0) {
                flashmessage::setMessage('Cập nhật thành công !');
            } else {
                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
            }
        }
        public function change_order() {
            $this->menu->id = isset($_POST['id']) ? $_POST['id'] : '';
            $this->menu->sort_menu = isset($_POST['order']) ? $_POST['order'] : '';
            $this->menu->modified = date('Y/m/d H:i:s', time());
            $this->menu->modified_by = $this->currentUser->getUsername();
            $rs = $this->menu->updateMenuOrder();
            if ($rs > 0) {
                flashmessage::setMessage('Cập nhật thành công!');
            } else {
                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
            }

            $this->common->redirectUrl('admin/menu');
        }
		public function LoadTable($parent_id = 0, $position = ''){
			$menu = $this->menu->getMenuByParentID($parent_id, $position);

            $first_char = '';
            $char_space = '';

            if (count($menu) > 0) {
                foreach ($menu as $key => $value) {
                    if ($value['parent_id'] == 0) {
                        $first_char = '';
                        $char_space = '';
                    } else {
                        $first_char = '<big>&boxur;&boxh;</big>';
                        $this->menu->ck_count = 0;
                        $char = $this->menu->getCountParent($value['parent_id']);

                        if ($char > 0) {
                            $char_space = str_repeat('<span style="padding-right:10px;">&cir;</span>', $char + 1);
                        } else {
                            $char_space = '<span style="padding-right:10px;">&cir;</span>';
                        }
                    }
                    echo '<tr>';
                    echo '<td class="vam"><div class="checkbox icheck"><input type="checkbox" name="checkbox_item[]" class="checkbox_item" value="' . $value['id'] . '" /></div></td>';
                    echo '<td>' . $value['id'] . '</td>';
                    echo '<td>' . $char_space . $first_char . '<a href="' . ROOT . '/admin/menu/edit/' . $value['id'] . '">' . $value['name'] . '</a></td>';
                    echo '<td >';
                    echo '<form class="form-menu-order" method="POST"  action="' . ROOT . '/admin/menu/change/order">';
                    echo '<input type="text" class="menu-order" value="' . $value['sort_menu'] . '" name="order" />';
                    echo '<input type="hidden" value="' . $value['id'] . '" name="id" />';
                    echo '<input type="submit" class="menu-save-order" name="save" value="" />';
                    echo '</form>';
                    echo '</td>';
                    echo '<td>';
                    if ($value['status'] == 0) {
                        echo '<span class = "label label-danger ">Ẩn</span>';
                    } elseif ($value['status'] == 1) {
                        echo '<span class = "label label-success ">Hiển thị</span>';
                    }
                    echo '</td>';
                    echo '<td class="vam td-btn">';
                    echo '<a href = "' . ROOT . '/admin/menu/edit/' . $value['id'] . '" class = "btn btn-xs btn-default "><i class = "fa fa-info-circle"></i> Sửa</a>&nbsp;&nbsp;';
                    echo '<a href = "' . ROOT . '/admin/menu/delete/' . $value['id'] . '" class = "btn btn-xs btn-default btn-delete-data" data-id="' . $value['id'] . '"><i class = "fa fa-times-circle"></i> Xóa</a>';
                    echo '</td>';
                    echo '</tr>';

                    $this->loadTable($value['id'], $position);
            	}
            }
		}

        public function loadSelectMenu($parent_id = 0, $position = '', $current = 0, $active = 0) {

            $menu_data = $this->menu->getMenuByParentID($parent_id, $position . '');

            if (count($menu_data) > 0) {
                foreach ($menu_data as $key => $value) {
                    if ($value['id'] != $current) {
                        if ($value['parent_id'] == 0) {
                            $first_char = '';
                            $char_space = '';
                        } else {
                            $first_char = '&boxur;&boxh; ';
                            $this->menu->ck_count = 0;
                            $char = $this->menu->getCountParent($value['parent_id']);
                            if ($char > 0) {
                                $char_space = str_repeat('&cir;&nbsp;&nbsp;', $char + 1);
                            } else {
                                $char_space = '&cir;&nbsp;&nbsp;';
                            }
                        }

                        $selector = '';
                        if ($value['parent_id'] != 0) {
                            $selector = ($value['id'] == $active) ? 'selected = "selected"' : '';
                        }

                        if ($value['id'] == $active) {
                            $selector = ($value['id'] == $active) ? 'selected = "selected"' : '';
                        }

                        echo '<option value = "' . $value['id'] . '" ' . $selector . '>';
                        echo $char_space . $first_char . $value['name'];
                        echo '</option>';

                        $this->loadSelectMenu($value['id'], $position, $current, $active);
                    }
                }
            }
        }

        public function loadAllArticle($active = 0) {
            $article_list = $this->article->getAllArticleByStatus(1);
            if (count($article_list) > 0) {
                foreach ($article_list as $key => $value) {
                    echo '<option value="' . $value['id'] . '" ' . ($value['id'] == $active ? 'selected="selected"' : '') . ' >';
                    echo $value['title'];
                    echo '</option>';
                }
            }
        }

        public function loadSelectCategory($parent_id = 0, $current = 0, $active = 0) {
            $list_category = $this->category->getCategoryByParentID($parent_id);

            if (count($list_category) > 0) {
                foreach ($list_category as $key => $value) {
                    if ($value['id'] != $current) {
                        if ($value['parent_id'] == 0) {
                            $first_char = '';
                            $char_space = '';
                        } else {
                            $first_char = '&boxur;&boxh; ';
                            $this->category->ck_count = 0;
                            $char = $this->category->getCountParent($value['parent_id']);
                            if ($char > 0) {
                                $char_space = str_repeat('&cir;&nbsp;&nbsp;', $char + 1);
                            } else {
                                $char_space = '&cir;&nbsp;&nbsp;';
                            }
                        }

                        $selector = '';
                        if ($value['parent_id'] != 0) {
                            $selector = ($value['id'] == $active) ? 'selected = "selected"' : '';
                        }

                        if ($value['id'] == $active) {
                            $selector = ($value['id'] == $active) ? 'selected = "selected"' : '';
                        }

                        echo '<option value = "' . $value['id'] . '" ' . $selector . '>';
                        echo $char_space . $first_char . $value['name'];
                        echo '</option>';

                        $this->loadSelectCategory($value['id'], $current, $active);
                    }
                }
            }
        }
	}
?>