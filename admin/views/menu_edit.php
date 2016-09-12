<style>
    .tags-content, .tags-position {
        display:none;
    }
    .tags-content.active, .tags-position.active {
        display:block;
    }
</style>
<div class="page-content" style="margin-top:20px;">
    <div class="container-fluid">
        <div id="panel-advancedoptions">
            <div class="row">
                <div class="col-md-12 bs-grid">
                    <div class="panel panel-default panel-btn-focused demo-new-members">
                        <div class="panel-heading">
                            <h2>Form sửa menu</h2>
                        </div>
                        <div class="panel-colorbox" style="display: none">
                            <ul class="list-unstyled list-inline panel-color-list">
                                <li><span data-widget-setstyle="panel-default"></span>
                                </li>
                                <li><span data-widget-setstyle="panel-inverse"></span>
                                </li>
                                <li><span data-widget-setstyle="panel-primary"></span>
                                </li>
                                <li><span data-widget-setstyle="panel-success"></span>
                                </li>
                                <li><span data-widget-setstyle="panel-warning"></span>
                                </li>
                                <li><span data-widget-setstyle="panel-danger"></span>
                                </li>
                                <li><span data-widget-setstyle="panel-info"></span>
                                </li>
                                <li><span data-widget-setstyle="panel-brown"></span>
                                </li>
                                <li><span data-widget-setstyle="panel-indigo"></span>
                                </li>
                                <li><span data-widget-setstyle="panel-orange"></span>
                                </li>
                                <li><span data-widget-setstyle="panel-midnightblue"></span>
                                </li>
                                <li><span data-widget-setstyle="panel-sky"></span>
                                </li>
                                <li><span data-widget-setstyle="panel-magenta"></span>
                                </li>
                                <li><span data-widget-setstyle="panel-purple"></span>
                                </li>
                                <li><span data-widget-setstyle="panel-green"></span>
                                </li>
                                <li><span data-widget-setstyle="panel-grape"></span>
                                </li>
                            </ul>
                        </div>
                        <div class="panel-body ">
                            <div class="row">
                                <form action="" method="post" class="form-horizontal"  enctype="multipart/form-data" name="form-menu">

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Tên menu :</label>
                                            <div class="col-md-10">
                                                <input type="text" value="<?php echo $this->result['name']; ?>" name="name" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Icon menu :</label>
                                            <div class="col-md-10">
                                                <input type="text" value="<?php echo $this->result['icon']; ?>" name="icon" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Thứ tự hiển thị :</label>
                                            <div class="col-md-10">
                                                <input type="text" value="<?php echo $this->result['sort_menu']; ?>" name="sort_menu" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Vị trí hiển thị :</label>
                                            <div class="col-md-6">
                                                <select class="form-control form-load" name="position">
                                                    <?php foreach ($this->common->listMenuPosition as $key => $value) : ?>
                                                        <option value="<?php echo $key; ?>" <?php echo $key == $this->result['position'] ? 'selected="selected"' : ''; ?> ><?php echo $value; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Menu cha:</label>
                                            <div class="col-md-10">
                                                <?php foreach ($this->common->listMenuPosition as $key => $value) : ?>
                                                    <div class="tags-position <?php echo $key == $this->result['position'] ? 'active' : ''; ?>" id="tags-position-<?php echo $key; ?>">
                                                        <select class="form-control selectpicker" data-live-search="true"  data-style="btn-info" name="parent_id_p<?php echo $key; ?>">
                                                            <option value="" selected="selected">Không có menu cha</option>
                                                            <?php echo $this->loadSelectMenu(0, $key, $this->result['id'], $this->result['parent_id']); ?>
                                                        </select>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Loại menu :</label>
                                            <div class="col-md-10">
                                                <div class="icheck radio col-md-4">
                                                    <label for="cate">Category sản phẩm</label>
                                                    <input type="radio" value="0" name="type" class="tags" id='cate' <?php echo $this->result['type'] == 0 ? 'checked' : ''; ?> data-target="#category"> 
                                                </div>
                                                <div class="icheck radio col-md-4" >
                                                    <label for="bv">Bài viết</label>
                                                    <input type="radio" value="1" name="type" class="tags" id='bv' <?php echo $this->result['type'] == 1 ? 'checked' : ''; ?> data-target="#article"> 
                                                </div>
                                                <div class="icheck radio col-md-4">
                                                    <label for="3">Url</label>
                                                    <input type="radio" value="2" name="type" class="tags" id='3' <?php echo $this->result['type'] == 2 ? 'checked' : ''; ?> data-target="#url"> 
                                                </div>
                                                <div class="icheck radio col-md-4">
                                                    <label for="news">Category tin tức</label>
                                                    <input type="radio" value="3" name="type" class="tags" id='news' <?php echo $this->result['type'] == 3 ? 'checked' : ''; ?> data-target="#tintuc"> 
                                                </div>
                                                <div class="icheck radio col-md-4">
                                                    <label for="gt">Giới thiệu</label>
                                                    <input type="radio" value="4" name="type" class="tags" id='gt' <?php echo $this->result['type'] == 4 ? 'checked' : ''; ?> data-target="#about"> 
                                                </div>
                                                <div class="icheck radio col-md-4">
                                                    <label for="lh">Liên hệ</label>
                                                    <input type="radio" value="4" name="type" class="tags" id='lh' <?php echo $this->result['type'] == 5 ? 'checked' : ''; ?> data-target="#contact"> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Nội dung menu :</label>
                                            <div class="col-md-10">
                                                <div class="tags-content <?php echo $this->result['type'] == 0 ? 'active' : ''; ?>" id="category">
                                                    <select class="form-control selectpicker" name="target_id_category" data-live-search="true">
                                                        <option value="0">Không chọn category</option>
                                                        <?php $this->loadSelectCategory(1, '', $this->result['target_id']); ?>
                                                    </select>
                                                </div>
                                                <div class="tags-content <?php echo $this->result['type'] == 1 ? 'active' : ''; ?>" id="article">
                                                    <select class="form-control selectpicker" name="target_id_article" data-live-search="true">
                                                        <option value="0">Không chọn bài viết</option>
                                                        <?php $this->loadAllArticle($this->result['target_id']); ?>
                                                    </select>
                                                </div>
                                                <div class="tags-content <?php echo $this->result['type'] == 2 ? 'active' : ''; ?>" id="url">
                                                    <input type="text" value="<?php echo $this->result['url'] ?>" name="url" placeholder="Đường dẫn cho menu" class="form-control">
                                                </div>
                                                <div class="tags-content <?php echo $this->result['type'] == 3 ? 'active' : ''; ?>" id="tintuc">
                                                    <select class="form-control selectpicker" name="target_id_news" data-live-search="true">
                                                        <option value="0">Không chọn category</option>
                                                        <?php $this->loadSelectCategory(2, '', $this->result['target_id']); ?>
                                                    </select>
                                                </div>
                                                <div class="tags-content <?php echo $this->result['type'] == 4 ? 'active' : ''; ?>" id="about">
                                                    <input type="text" value="/about.html" name="about" placeholder="Đường dẫn cho menu" class="form-control" readonly>
                                                </div>
                                                <div class="tags-content <?php echo $this->result['type'] == 5 ? 'active' : ''; ?>" id="contact">
                                                    <input type="text" value="/contact.html" name="contact" placeholder="Đường dẫn cho menu" class="form-control" readonly>
                                                </div>
                                                </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Trạng thái:</label>
                                            <div class="col-md-10">
                                                    <?php foreach ($this->common->listMenuStatus as $key => $value) : ?>
                                                        <div class="icheck radio col-md-2">
                                                                <label for="<?php echo $key ?>"><?php echo $value ?></label>
                                                              <input type="radio" name="status" id="<?php echo $key ?>" value="<?php echo $key; ?>" <?php echo $this->result['status'] == $key ? 'checked' : ''; ?>>
                                                        </div>
                                                    <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <input type="hidden" value="<?php echo $this->result['id']; ?>" name="eid">
                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-2">
                                            <button type="submit" class="btn btn-success" name="save"><i class="fa fa-check"></i> Xác nhận</button>
                                            <a href="<?php echo ROOT . '/admin/menu'; ?>" class="btn btn-default"><i class="fa fa-sign-out"></i> Quay lại</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #page-content -->