<div class="page-content" style="margin-top:20px;">
    <div class="container-fluid">
        <div id="panel-advancedoptions">
            <div class="row">
                <div class="col-md-12 bs-grid">
                    <div class="panel panel-default panel-btn-focused demo-new-members">
                        <div class="panel-heading">
                            <h2>Form sửa article</h2>
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
                                <form action="" method="post" class="form-horizontal"  enctype="multipart/form-data" name="form-menu" id="form-edit-article">

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Tên bài viết :</label>
                                            <div class="col-md-10">
                                                <input type="text" value="<?php echo htmlentities($this->result['title']); ?>" name="title" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Ảnh bài viết :</label>
                                            <div class="col-md-10">
                                                <input type="file" name="image_upload" class="form-control mb-sm">    
                                                <?php if ($this->result['image'] != '') : ?>
                                                    <img src="<?php echo ROOT . '/upload/Images/Article/' . $this->result['image']; ?>" width="200" />
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Category:</label>
                                            <div class="col-md-10">
                                                <select class="form-control selectpicker" data-live-search="true"  data-style="btn-info" name="category_id">
                                                   <option value="0" selected="selected">Tất cả category</option>
                                                    <?php echo $this->loadSelect(2, $this->result['category_id']); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Miêu tả:</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control " rows="3" name="description"><?php echo $this->result['description']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Nội dung :</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control ckeditor" rows="3" id="Description" name="content"><?php echo $this->result['content']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Đính kèm:</label>
                                            <div class="col-md-10">
                                                <input type="file" name="attachment[]" class="form-control" multiple="">
                                                <input type="hidden" name="attachment" value="<?php echo $this->result['attachment']; ?>" />
                                            </div>
                                            <div class="col-md-10 col-md-offset-2">
                                            <?php
                                                if ($this->result['attachment'] != '') {
                                                    $list_file_attachment = explode('###', $this->result['attachment']);
                                                } else {
                                                    $list_file_attachment = array();
                                                }
                                                ?>

                                                <?php if (count($list_file_attachment) > 0) : ?>
                                                    <br />

                                                    <?php foreach ($list_file_attachment as $key => $value) : ?>

                                                        <p class="file_item">
                                                            <a class="remove-file" data-item="<?php echo $value; ?>" onclick="return confirm('Bạn có chắc muốn xóa ?');" href="#">Xóa</a>
                                                            _____________

                                                            <?php $arr_file_name = explode('/', $value); ?>

                                                            <a href="<?php echo ROOT . '/upload/Files/Article/' . $value; ?>" target="_blank"><?php echo end($arr_file_name); ?></a>
                                                        </p>

                                                <?php endforeach; ?>

                                            <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Featured:</label>
                                            <div class="col-md-10">
                                                    <?php foreach ($this->common->listArticleFeatured as $key => $value) : ?>
                                                        <div class="icheck radio col-md-2">
                                                                <label for="<?php echo $value ?>"><?php echo $value ?></label>
                                                              <input type="radio" name="featured" id="<?php echo $value ?>" value="<?php echo $key; ?>" <?php echo $this->result['featured'] == $key ? 'checked' : ''; ?>>
                                                        </div>
                                                    <?php endforeach; ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Trạng thái:</label>
                                            <div class="col-md-10">
                                                    <?php foreach ($this->common->listArticleStatus as $key => $value) : ?>
                                                        <div class="icheck radio col-md-2">
                                                                <label for="<?php echo $value ?>"><?php echo $value ?></label>
                                                              <input type="radio" name="status" id="<?php echo $value ?>" value="<?php echo $key; ?>" <?php echo $this->result['status'] == $key ? 'checked' : ''; ?>>
                                                        </div>
                                                    <?php endforeach; ?>
                                            </div>
                                        </div>

                                        <input type="hidden" value="<?php echo $this->result['id']; ?>" name="eid">
                                        <input type="hidden" value="<?php echo $this->result['image']; ?>" name="image">
                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-2">
                                            <button type="submit" class="btn btn-success" name="save"><i class="fa fa-check"></i> Xác nhận</button>
                                            <a href="<?php echo ROOT . '/admin/article'; ?>" class="btn btn-default"><i class="fa fa-sign-out"></i> Quay lại</a>
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