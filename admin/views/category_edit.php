<div class="page-content" style="margin-top:20px;">
    <div class="container-fluid">
        <div id="panel-advancedoptions">
            <div class="row">
                <div class="col-md-12 bs-grid">
                    <div class="panel panel-default panel-btn-focused demo-new-members">
                        <div class="panel-heading">
                            <h2>Form sửa category</h2>
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
                                            <label class="control-label col-md-2">Tên category   :</label>
                                            <div class="col-md-10">
                                                <input type="text" value="<?php echo $this->result['name']; ?>" name="name" class="form-control" required>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-2">Category cha:</label>
                                            <div class="col-md-10">
                                                <select class="form-control selectpicker" data-live-search="true"  data-style="btn-info" name="parent_id">
                                                   <option value="0">Không có danh mục cha</option>
                                                    <?php $this->loadSelect(0, $this->result['id'], $this->result['parent_id']); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Hình ảnh :</label>
                                            <div class="col-md-10">
                                                <input type="file" name="image_upload" class="form-control mb-sm">    
                                                <?php if ($this->result['image'] != '') : ?>
                                                    <img src="<?php echo ROOT . '/upload/Images/Category/' . $this->result['image']; ?>" width="100" />
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Description:</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control ckeditor" rows="3" id="description" name="description"><?php echo $this->result['description']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Featured:</label>
                                            <div class="col-md-10">
                                                    <?php foreach ($this->common->listFeaturedCategory as $key => $value) : ?>
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
                                                    <?php foreach ($this->common->listCategoryStatus as $key => $value) : ?>
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
                                            <a href="<?php echo ROOT . '/admin/category'; ?>" class="btn btn-default"><i class="fa fa-sign-out"></i> Quay lại</a>
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