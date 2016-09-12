<div class="container">
    <ul class="breadcrumb">
        <li><a href="<?php echo ROOT ?>/"><i class="fa fa-home"></i>Trang chủ</a>
        </li>
        <li><a href="<?php echo ROOT ?>/cart.html">Shopping Cart</a>
        </li>
    </ul>
    <div class="row">

        <section id="sidebar-main" class="col-md-12">
            <div id="content">
                <h1>Shopping Cart</h1>
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-cart">
                        <thead>
                            <tr>
                                <td class="text-center">Hình ảnh</td>
                                <td class="text-left">Tên sản phẩm</td>
                                <td class="text-center">Màu sắc</td>
                                <td class="text-left">Số lượng</td>
                                <td class="text-right">Giá</td>
                                <td class="text-right">Tổng</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($this->cart->cart_list())>0):
                                    foreach ($this->cart->cart_list()as $key => $value): 
                                    $url = url_generated::createProductUrl($value['name'], $value['id'], '-');
                            ?>
                            <tr>
                                <td class="text-center"> <a href="<?php echo $url ?>"><img src="<?php echo ROOT ?>/upload/Images/Attribute_Product/<?php echo $value['image'] ?>" class="img-thumbnail" /></a>
                                </td>
                                <td class="text-left"><a href="<?php echo $url ?>"><?php echo $value['name'] ?></a>
                                </td>
                                <td class="text-center">
                                    <div class="tab-color">
                                        <ul>
                                    <?php foreach ($this->attribute_product->getAttributeColor($value['id']) as $row): ?>
                                        <li class="<?php echo $row['name']==$value['attr_name']?
                                        'active':'' ?>">
                                        <span style="background: <?php echo $row['value'] ?>;" data-ap-id="<?php echo $row['id'] ?>" data-id="<?php echo $value['id'] ?>" tille="<?php echo $row['name'] ?>"></span>
                                        </li>
                                    <?php endforeach ?>
                                        </ul>
                                    </div>
                                </td>
                                <td class="text-left">
                                    <div class="input-group btn-block" style="max-width: 200px;">
                                        <input type="text" name="quantity-<?php echo $value['ap_id'] ?>" value="<?php echo $value['number'] ?>" size="1" class="form-control" />
                                        <span class="input-group-btn">
                                            <button type="submit" data-toggle="tooltip" title="Update" class="btn btn-primary update-cart" data-href="<?php echo ROOT ?>/cart/update" onclick="cart.update(<?php echo $value['ap_id'] ?>);"><i class="fa fa-refresh"></i></button>
                                            <button type="button" data-toggle="tooltip" title="Remove" class="btn btn-danger" onclick="cart.remove(<?php echo $value['ap_id'] ?>);"><i class="fa fa-times-circle"></i></button>                 
                                        </span>
                                    </div>
                                </td>
                                <td class="text-right"><?php echo number_format($value['price']) ?> ₫</td>
                                <td class="text-right"><?php echo number_format($value['price']*$value['number']) ?> ₫</td>
                            </tr>
                                <?php endforeach ?>
                            <?php else: ?>
                                <td colspan="6">Bạn chưa chọn sản phẩm !</td>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <br />
                <div class="row">
                <div class="col-sm-4 col-sm-offset-8">
                        <table class="table table-bordered">
                            <tr>
                                <td class="text-right"><strong>Total:</strong>
                                </td>
                                <td class="text-right price-total" style="color:red"><?php echo (count($this->cart->cart_list())>0)? number_format($this->cart->cart_total()):0 ?> ₫</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br/>
                <form action="<?php echo ROOT ?>/cart/checkout" method="post" class="form-horizontal"  enctype="multipart/form-data" name="form-menu" id="form-edit-article">
                <h2>Đăng ký thông tin khách hàng !</h2>
                <p>Bạn nên đăng ký thành viên của web để có thể mua hàng nhanh hơn . </p>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="pav_digital_store.html#collapse-voucher" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Thông tin <i class="fa fa-caret-down"></i></a></h4>
                    </div>
                    <div id="collapse-voucher" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Họ và tên :</label>
                                <div class="col-md-10">
                                    <input type="text" value="<?php echo $this->currentcustomer->getUsername() ?>" name="name" class="form-control" required placeholder="Họ và tên">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Số điện thoại :</label>
                                <div class="col-md-10">
                                    <input type="text" value="<?php echo $this->currentcustomer->getPhone() ?>" name="phone" class="form-control" required placeholder="Số điện thoại">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Email :</label>
                                <div class="col-md-10">
                                    <input type="text" value="<?php echo $this->currentcustomer->getEmail() ?>" name="email" class="form-control" required placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Địa chỉ:</label>
                                <div class="col-md-10">
                                    <input type="text" value="<?php echo $this->currentcustomer->getAddress() ?>" name="address" class="form-control" required placeholder="Địa chỉ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Kiểu thanh toán :</label>
                                <div class="col-md-10">
                                    <select name="payment" class="form-control" required>
                                        <option value>---Chọn kiểu thanh toán---</option>
                                        <?php foreach ($this->common->listPayment as $key => $value): ?>
                                            <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                        <?php endforeach ?>                                     
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Ghi chú :</label>
                                <div class="col-md-10">
                                    <textarea name="message" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $this->currentcustomer->getID() ?>">
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <div class="pull-left">
                        <a href="<?php echo ROOT ?>/" class="btn btn-primary">Continue Shopping</a>
                    </div>
                    <div class="pull-right ">
                        <a href="<?php echo ROOT ?>/cart/delete_all" class="btn btn-danger">Xóa giỏ hàng</a>
                        <input type="submit" name="submit" value="Đặt hàng" class="btn btn-success">
                    </div>
                </div>
                </form>
            </div>
        </section>
    </div>
</div>