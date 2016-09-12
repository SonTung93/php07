<div class="container">
    <ul class="breadcrumb">
        <li><a href="<?php ROOT ?>/"><i class="fa fa-home"></i></a>
        </li>
        <li><a href="user/history">History</a>
        </li>
    </ul>
    <div class="row">
        <section id="sidebar-main" class="col-md-9">
            <div id="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">                       
                            <div class="panel-heading">Lịch sử giao dịch</div>
                            <div class="panel-body table-responsive ">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Ngày</th>
                                        <th>Số tiền</th>
                                        <th>Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>                    
                                    <?php 
                                        $stt = 0;
                                        foreach ($this->result as $value){ 
                                            $stt++;
                                    ?>
                                    <tr>
                                        <td><?php echo $stt ?></td>
                                        <td><?php echo date_format(date_create($value['created']), 'd/m/Y H:i'); ?></td>
                                        <td><?php echo number_format($value['amount']); ?>₫</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-xs"  data-toggle="modal" data-target="#history-<?php echo $value['id'] ?>">Hiện thị</button>
                                        </td>
                                    </tr>
                                    <?php } ?>   
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php foreach ($this->result as $value){  ?>
            <div class="modal fade" id="history-<?php echo $value['id'] ?>" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Giao dich ngày : <?php echo date_format(date_create($value['created']), 'd/m/Y H:i'); ?></h4>
                    </div>
                    <div class="modal-body table-responsive">
                        <table class="table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Image</th>
                                        <th>Sản phẩm</th>
                                        <th>Màu sắc</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                    </tr>
                                </thead>
                                <tbody>                    
                                    <?php 
                                        $stt = 0;
                                        foreach ($this->order->getOrderByTransactionID($value['id']) as $rows){ 
                                            $stt++;
                                            $image = ROOT.'/upload/Images/Attribute_Product/'.$this->attribute_product->getAttributeProductByID($rows['attribute_product_id'])['image'];
                                    ?>
                                    <tr>
                                        <td><?php echo $stt ?></td>
                                        <td><img src="<?php echo $image ?>" style="width:150px" /></td>
                                        <td><?php echo $this->product->getProductByID($rows['product_id'])['name'] ?></td>
                                        <td><?php echo $this->attribute_product->getAttributeProductByID($rows['attribute_product_id'])['name'] ?></td>
                                        <td><?php echo $rows['quantity'] ?></td>
                                        <td><?php echo number_format($rows['amount']); ?>₫</td>
                                    </tr>
                                    <?php } ?>   
                                </tbody>
                            </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                  
                </div>
              </div>
            <?php } ?>  
        </section>
        <aside id="sidebar-right" class="col-md-3">
            <column id="column-right" class="hidden-xs sidebar">
                <div class="box box-normal theme account">
                    <div class="box-heading"><span>Tài khoản</span>
                    </div>
                    <div class="box-content">

                        <ul class="list-group list">

                            <li><a href="user" class="list-group-item">Tài khoản</a>
                            </li>
                            <li><a href="user/change/pass" class="list-group-item">Đổi mật khẩu</a>
                            </li>
                            <li><a href="user/forgot/pass" class="list-group-item">Quên mật khẩu</a>
                            </li>
                            <li><a href="user/history" class="list-group-item">Lịch sử giao dịch</a>
                            </li>
                            </li>
                        </ul>
                    </div>
                </div>

            </column>
        </aside>
    </div>
</div>