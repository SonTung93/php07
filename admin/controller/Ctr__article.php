<?php

Class Ctr__article Extends Template {

    public $article = null;
    public $category = null;
    public $fmessage = null;
    public $common = null;
    public $currentUser = null;
    public $result = null;
    public $pagination = null;
    public $search = null;
    public $limit = null;
    public $page = null;
    public $search_category = null;

    public function __construct() {
        $this->article = new Article();
        $this->category = new Category();
        $this->fmessage = new flashmessage();
        $this->common = new sys_common();
        $this->currentUser = new sys_currentuser();
    }

    public function index() {
        $this->temp_title = "Quản trị bài viết";

        $this->search_category = isset($_GET['category']) ? $_GET['category'] : '';
        $this->search = isset($_GET['search']) ? $_GET['search'] : '';
        $this->page = isset($_GET['page']) ? $_GET['page'] : 1;
        $this->limit = isset($_GET['size']) ? $_GET['size'] : 6;

        $list_id = array();

        if ($this->search_category != '') {
            $list_id = $this->category->getAllCategoryChildByParent($this->search_category);

            array_push($list_id, $this->search_category);
        }
        $arr = array();

        $arr = $this->article->getAllArticle($this->search, implode(',', $list_id), 'id', 'DESC', $this->page, $this->limit);

        $this->result = $arr['data'];
        $this->pagination = $arr['pager'];

        $this->show("article");
    }

    public function change_featured() {
        $featured_temp = isset($_POST['featured']) ? $_POST['featured'] : '0';

        if ($featured_temp == '0') {
            $this->article->featured = '1';
        } else {
            $this->article->featured = '0';
        }

        $this->article->id = isset($_POST['eid']) ? $_POST['eid'] : '';
        $this->article->modified = date('Y/m/d H:i:s', time());
        $this->article->modified_by = $this->currentUser->getUsername();
        $rs = $this->article->updateFeatured();
        if ($rs > 0) {
            flashmessage::setMessage('Cập nhật thành công !');
        } else {
            flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
        }

        $page = isset($_GET['page']) ? $_GET['page'] : '1';

        $this->common->redirectUrl(ROOT . '/admin/article?page=' . $page, 1, 1);
    }

    public function create() {
        $this->temp_title = "Thêm mới bài viết";

        if (isset($_POST['save'])) {

            $file_attachment = isset($_FILES['attachment']) ? $_FILES['attachment'] : '';

            $this->article->attachment = '';

            $temp_name_files = array();

            if ($file_attachment != '') {
                if ($file_attachment['name'][0] != '') {
                    $file_attachment_convert = $this->common->convertListImagesToImage($file_attachment);
                    foreach ($file_attachment_convert as $key => $value) {
                        $name_file_uploaded = $this->common->upload_file_attachment($value, 'Article');

                        array_push($temp_name_files, $name_file_uploaded);
                    }

                    $this->article->attachment = implode('###', $temp_name_files);
                }
            } else {
                $this->article->attachment = isset($_POST['attachment']) ? $_POST['attachment'] : '';
            }

            $this->article->title = isset($_POST['title']) ? $_POST['title'] : '';


            $file = isset($_FILES['image_upload']) ? $_FILES['image_upload'] : '';

            if ($file['name'] != '') {
                if ($this->common->isTrueTypeImage($file) != '') {
                    if ($this->common->isTrueSizeImage($file) != '') {
                        $this->article->image = $this->common->move_file($file, 'Article');
                    } else {
                        flashmessage::setMessageError('Ảnh có dung lượng quá lớn');
                        if ($this->article->id != '') {
                            $this->common->redirectUrl('admin/article/edit/' . $this->article->id);
                        } else {
                            $this->common->redirectUrl('admin/article/create');
                        }
                    }
                } else {
                    flashmessage::setMessageError('Tập tin không đúng định dạng ảnh');
                    if ($this->article->id != '') {
                        $this->common->redirectUrl('admin/article/edit/' . $this->article->id);
                    } else {
                        $this->common->redirectUrl('admin/article/create');
                    }
                }
            } else {
                $this->article->image = isset($_POST['image']) ? $_POST['image'] : '';
            }

            $this->article->description = isset($_POST['description']) ? $_POST['description'] : '';
            $this->article->content = isset($_POST['content']) ? $_POST['content'] : '';
            $this->article->created = date('Y/m/d H:i:s', time());
            $this->article->created_by = $this->currentUser->getUsername();
            $this->article->status = isset($_POST['status']) ? $_POST['status'] : '';

            $this->article->category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
            $this->article->featured = isset($_POST['featured']) ? $_POST['featured'] : '';;

            $rs = $this->article->insertData();

            if ($rs > 0) {
                $id = $this->article->getTopID();
                flashmessage::setMessage('Thêm mới thành công !');
                $this->common->redirectUrl('admin/article/edit/' . $id);
            } else {
                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
                $this->common->redirectUrl('admin/article/create');
            }
        } else {
            $this->show("article_create");
        }
    }

    public function edit() {
        $this->temp_title = "Chỉnh sửa bài viết";

        if (isset($_POST['save'])) {

            $really_file = array();

            if (isset($_POST['attachment'])) {
                $really_file = $_POST['attachment'] != '' ? explode('###', $_POST['attachment']) : array();
            }

            $file_removed = isset($_POST['file_remove']) ? $_POST['file_remove'] : array();

            if (count($file_removed) > 0) {
                foreach ($file_removed as $key => $value) {
                    if (in_array($value, $really_file)) {
                        $really_key = array_search($value, $really_file);
                        unset($really_file[$really_key]);
                        unlink('../upload/Files/Article/'.$value);
                    }
                }
            }

            $this->article->id = isset($_POST['eid']) ? $_POST['eid'] : '';
            $this->article->title = isset($_POST['title']) ? $_POST['title'] : '';

            $file_attachment = isset($_FILES['attachment']) ? $_FILES['attachment'] : '';
            $this->article->attachment = '';

            $temp_name_files = array();

            foreach ($really_file as $key => $value) {
                array_push($temp_name_files, $value);
            }
            if ($file_attachment != '') {
                if ($file_attachment['name'][0] != '') {
                    $file_attachment_convert = $this->common->convertListImagesToImage($file_attachment);

                    foreach ($file_attachment_convert as $key => $value) {
                        $name_file_uploaded = $this->common->upload_file_attachment($value, 'Article');

                        array_push($temp_name_files, $name_file_uploaded);
                    }

                    $this->article->attachment = implode('###', $temp_name_files);
                }else{
                    $this->article->attachment = implode('###', $temp_name_files);
                }
            } else {
                $this->article->attachment = implode('###', $temp_name_files);
            }
            
            $this->article->title = isset($_POST['title']) ? $_POST['title'] : '';

            $file = isset($_FILES['image_upload']) ? $_FILES['image_upload'] : '';
           
            if ($file['name'] != '') {
                if ($this->common->isTrueTypeImage($file) != '') {
                    if ($this->common->isTrueSizeImage($file) != '') {
                        $this->article->image = $this->common->move_file($file, 'Article');
                    } else {
                        flashmessage::setMessageError('Ảnh có dung lượng quá lớn');
                        $this->common->redirectUrl('admin/article/edit/' . $this->article->id);
                    }
                } else {
                    flashmessage::setMessageError('Tập tin không đúng định dạng ảnh');
                    $this->common->redirectUrl('admin/article/edit/' . $this->article->id);
                }
            } else {
                $this->article->image = isset($_POST['image']) ? $_POST['image'] : '';
            }

            $this->article->description = isset($_POST['description']) ? $_POST['description'] : '';
            $this->article->content = isset($_POST['content']) ? $_POST['content'] : '';
            $this->article->modified = date('Y/m/d H:i:s', time());
            $this->article->modified_by = $this->currentUser->getUsername();
            $this->article->status = isset($_POST['status']) ? $_POST['status'] : '';

            $this->article->category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
            $this->article->featured = isset($_POST['featured']) ? $_POST['featured'] : '';

            $rs = $this->article->updateData();

            if ($rs > 0) {
                flashmessage::setMessage('Cập nhật thành công !');
            } else {
                flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
            }
            $this->common->redirectUrl('admin/article/edit/' . $this->article->id);
        } else {
            $id = isset($_GET['id']) ? $_GET['id'] : '';

            $this->result = $this->article->getArticleByID($id);

            if ($this->result == '') {
                flashmessage::setMessageError('Không tìm thấy dữ liệu !');
                $this->common->redirectUrl('admin/article');
            } else {
                $this->show("article_edit");
            }
        }
    }

    public function delete() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';

        $rs = $this->article->deleteData($id);

        echo $rs;

        if ($rs > 0) {
            flashmessage::setMessage('Cập nhật thành công !');
        } else {
            flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
        }
    }

    public function change_status() {
        $status = isset($_POST['status']) ? $_POST['status'] : 0;
        $list_id = isset($_POST['list_id']) ? $_POST['list_id'] : 0;
        $rs = $this->article->updateMultiStatus($status, $list_id);
        if ($rs > 0) {
            flashmessage::setMessage('Cập nhật thành công!');
        } else {
            flashmessage::setMessageError('Có lỗi xảy ra, vui lòng thử lại sau !');
        }
    }


    public function uploader() {
        $file = isset($_FILES['upload']) ? $_FILES['upload'] : '';

        if ($file != '') {

            $image_name = '';
            $url = '';

            if ($this->common->isTrueTypeImage($file) != '') {
                if ($this->common->isTrueSizeImage($file) != '') {
                    $image_name = $this->common->move_file($file, 'Article');
                    $url = ROOT . '/upload/Images/Article/' . $image_name;
                    $callback = isset($_GET['CKEditorFuncNum']) ? $_GET['CKEditorFuncNum'] : 1;
                    echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction(' . $callback . ',"' . $url . '");</script>';
                } else {
                    flashmessage::setMessageError('Ảnh có dung lượng quá lớn');
                }
            } else {
                flashmessage::setMessageError('Tập tin không đúng định dạng ảnh');
            }
        }
    }

    public function loadSelect($parent_id = 0, $current = 0) {
        $list_category = $this->category->getCategoryByParentID($parent_id);

        if (count($list_category) > 0) {
            foreach ($list_category as $key => $value) {
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

                $selector = ($value['id'] == $current) ? 'selected = "selected"' : '';


                echo '<option value = "' . $value['id'] . '" ' . $selector . '>';
                echo $char_space . $first_char . $value['name'];
                echo '</option>';

                $this->loadSelect($value['id'], $current);
            }
        }
    }

}

?>
