<div class="page-content" style="margin-top:20px;">
    <div class="container-fluid">
        <div id="panel-advancedoptions">
            <div class="row">
                <div class="col-md-12 bs-grid">
                    <div class="panel panel-default panel-btn-focused ">
                        <div class="panel-heading">
                            <h2>Form thuộc tính sản phẩm</h2>
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
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#home">Thuộc tính sản phẩm</a></li>
                                <li><a data-toggle="tab" href="#menu1">Thêm thuộc tính sản phầm</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                  <form action="" method="post" class="form-horizontal"  enctype="multipart/form-data" name="form-menu" id="">
                                        <div class="form-group">
                                                <h3><label class="control-label col-md-2">Tên sản phẩm:</label></h3>
                                                <div class="col-md-4">
                                                    <input type="text" value="<?php echo $this->data_product['name'] ?>" name="" class="form-control" readonly>
                                                </div>  
                                        </div>
                                        <div class="form-group">
                                                <div class="col-md-12">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="vam">
                                                                <div class="checkbox icheck ">
                                                                    <input type="checkbox" class="checkbox_all">
                                                                </div>
                                                            </th>
                                                            <th>ID</th>
                                                            <th>Thuộc tính</th>
                                                            <th>Name</th>
                                                            <th>Hình ảnh</th>
                                                            <th>Price</th>
                                                            <th>Tùy chọn</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (count($this->data_attribute) > 0) : ?>
                                                        <?php foreach ($this->data_attribute as $key => $value): ?>
                                                            <tr>
                                                                <td >
                                                                    <div class="checkbox icheck"><input type="checkbox" name="checkbox_item[]" class="checkbox_item" value="<?php echo $value['id'] ?>" /></div>
                                                                </td>
                                                                <td><?php echo $value['id'] ?></td>
                                                                <td><?php echo $this->attribute->getAttributeNameByID($value['attribute_id']) ?></td>
                                                                <td><a href="<?php echo ROOT . '/admin/attribute/'.$value['product_id'].'/edit_attribute/' . $value['id']; ?>"><?php echo $value['name']; ?></a></td>
                                                                <td>
                                                                    <?php if($value['image'] != ''): ?>
                                                                    <a href="<?php echo ROOT . '/admin/product_attribute/edit/' . $value['id']; ?>">
                                                                        <img src="<?php echo ROOT; ?>/upload/Images/Attribute_Product/<?php echo $value['image']; ?>" alt="<?php echo $value['name']; ?>" width="150" class="img-responsive" />
                                                                    </a>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td><?php echo number_format($value['price']) ?>₫</td>
                                                                <td class="td-btn">
                                                                    <a class=" btn btn-xs btn-default" href="<?php echo ROOT . '/admin/attribute/'.$value['product_id'].'/edit_attribute/' . $value['id']; ?>"><i class="fa fa-info-circle"></i> Sửa</a>
                                                                    <a class=" btn btn-xs btn-default  btn-delete-data" data-id="<?php echo $value['id']; ?>" href="<?php echo ROOT . '/admin/attribute/'.$value['product_id'].'/delete_attribute/' . $value['id']; ?>"><i class="fa fa-times-circle"></i> Xóa</a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach ?>
                                                        <?php else : ?>
                                                            <tr>
                                                                <td colspan="100">
                                                                    <strong>Không có dữ liệu ...</strong>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>                                                      
                                                    </tbody>
                                                </table>
                                                </div>
                                        </div>
                                  </form>
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                    <form action="" method="post" class="form-horizontal"  enctype="multipart/form-data"> 
                                        <div class="form-group">
                                            <h3><label class="control-label col-md-2">Thuộc tính:</label></h3>
                                            <div class="col-md-4">
                                                <select class="form-control" name="attribute" id="attribute">
                                                    <?php foreach ($this->result as $key => $value): ?>
                                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>}
                                                    <?php endforeach ?>
                                                </select>
                                            </div>  
                                            <div class="col-md-6">
                                                <button class="btn btn-info btn-add-attribute">+</button>
                                            </div>
                                        </div>
                       
                                        <div class="attribute">
                                           
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
    </div>
</div>
<!-- #page-content -->