<div class="page-content" style="margin-top:20px;">
    <div class="container-fluid">
        <div id="panel-advancedoptions">
            <div class="row">
                <div class="col-md-12 bs-grid">
                    <div class="panel panel-default panel-btn-focused demo-new-members">
                        <div class="panel-heading">
                            <h2>Form sửa sản phẩm</h2>
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
                                <form action="" method="post" class="form-horizontal"  enctype="multipart/form-data" name="form-menu" id="">
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Product:</label>
                                            <div class="col-md-10">
                                                <select class="form-control selectpicker" data-live-search="true"  data-style="btn-info" name="product_id">
                                                <?php foreach ($this->data_product as $row): ?>
                                                    <option value="<?php echo $row['id'] ?>" <?php echo $row['id']==$this->result['product_id']?'selected':'' ?> > <?php echo $row['name'] ?></option>    
                                                <?php endforeach ?>                                                 
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Attribute:</label>
                                            <div class="col-md-10">
                                                <select class="form-control selectpicker" data-live-search="true"  data-style="btn-info" name="attribute">
                                                    <?php foreach ($this->data_attribute as $value): ?>
                                                    <option value="<?php echo $value['id'] ?>" <?php echo $value['id']==$this->result['attribute_id']?'selected':'' ?> > <?php echo $value['name'] ?></option>    
                                                <?php endforeach ?> 
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Tên :</label>
                                            <div class="col-md-10">
                                                <input type="text" value="<?php echo $this->result['name'] ?>" name="name" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Giá trị :</label>
                                            <div class="col-md-4">
                                                <?php if ($this->result['attribute_id']==1): ?>
                                                    <input type="color" value="<?php echo $this->result['value'] ?>" name="value" class="form-control" required>
                                                <?php else: ?>
                                                    <input type="text" value="<?php echo $this->result['value'] ?>" name="value" class="form-control" required>
                                                <?php endif ?>
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Ảnh sản phẩm chính :</label>
                                            <div class="col-md-10">
                                                <input type="file" name="image_upload" class="form-control">
                                                <?php if ($this->result['image'] != '') : ?>
                                                    <img src="<?php echo ROOT . '/upload/Images/Attribute_Product/' . $this->result['image']; ?>" width="200" />
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Ảnh giới thiệu sản phẩm :</label>
                                            <div class="col-md-10">
                                                <input type="file" name="image_list[]" class="form-control" multiple="">
                                                <input type="hidden" name="image_list" value="<?php echo $this->result['image_list']; ?>" />
                                                <div class="preview">
                                                <?php 
                                                    if ($this->result['image_list'] != '') {
                                                        $list_image = explode('###', $this->result['image_list']);
                                                    }
                                                    if(count($list_image)>0):
                                                        foreach ($list_image as $key => $value) :
                                                                                                               
                                                ?>
                                                <div class="img-preview">
                                                    <img src="<?php echo ROOT . '/upload/Files/Attribute_Product/' . $value; ?>" />
                                                    <a href="#" class="remove-file" data-item="<?php echo $value; ?>"><i class="fa fa-times"></i></a>
                                                </div>
                                                <?php 
                                                    endforeach;
                                                    endif; 
                                                ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Giá sản phẩm :</label>
                                            <div class="col-md-10">
                                                <input type="text" value="<?php echo $this->result['price'] ?>" name="price" class="form-control" required>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Trạng thái:</label>
                                            <div class="col-md-10">
                                                    <?php foreach ($this->common->listProductAttributeStatus as $key => $value) : ?>
                                                        <div class="icheck radio col-md-2">
                                                                <label for="<?php echo $value ?>"><?php echo $value ?></label>
                                                              <input type="radio" name="status" id="<?php echo $value ?>" value="<?php echo $key; ?>" <?php echo $this->result['status'] == $key ? 'checked' : ''; ?>>
                                                        </div>
                                                    <?php endforeach; ?>
                                            </div>
                                        </div>

                                        <input type="hidden" value="<?php echo $this->result['image']; ?>" name="image">
                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-2">
                                            <button type="submit" class="btn btn-success" name="save"><i class="fa fa-check"></i> Xác nhận</button>
                                            <a href="<?php echo ROOT . '/admin/attribute/add_attribute/'.$this->result['product_id']; ?>" class="btn btn-default"><i class="fa fa-sign-out"></i> Quay lại</a>
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