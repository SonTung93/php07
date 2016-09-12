<div class="container">
    <div class="row">
        <div class="col-lg-5 col-md-4">
            <div class="welcome pull-left">
                <?php 
                if(!$this->currentcustomer->isLogin()):
                ?>
                <a href="#" data-toggle="modal" data-target="#myModal">Đăng ký</a> or <a href="#" data-toggle="modal" data-target="#myModal">Đăng nhập</a> 
                <?php else: ?>
                    <a href="#"><?php echo $this->currentcustomer->getUsername() ?></a> | <a href="<?php echo ROOT ?>/login/logout">Đăng xuất</a>
                <?php endif; ?>
            </div>
            <div class="show-mobile hidden-lg hidden-md pull-left">
                <div class="quick-access">
                    <div class="quickaccess-toggle"> <i class="fa fa-list"></i> </div>
                    <div class="inner-toggle">
                        <ul class="links pull-left">
                            <?php auto_loader::loadMenu(0,0); ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end mobile-->
        </div>
        <div class="col-lg-7 col-md-8 ">
            <div id="cart" class="clearfix pull-right">
                <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class=" heading btn btn-inverse dropdown-toggle">
                    <span class="icon-cart"><i class="fa fa-shopping-cart"></i></span>
                    
                    <?php    
                        if (count($this->cart->cart_list())<=0): ?>
                            <span id="cart-total">0 sản phẩm - 0.00 ₫</span>
                </button>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <p class="text-center">Giỏ hàng đang trống!</p>
                    <?php else: ?>
                         <span id="cart-total"><?php echo $this->cart->cart_number() ?> item(s) - <?php echo number_format($this->cart->cart_total()) ?> ₫</span>
                 </button>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <table class="table table-striped">
                                    <?php 
                                        foreach ($this->cart->cart_list() as $key => $value): 
                                            $url = url_generated::createProductUrl($value['name'], $value['id'], '-');
                                    ?>
                                        <tr>
                                          <td class="text-center"><a href="<?php echo $url ?>"><img src="<?php echo ROOT ?>/upload/Images/Attribute_Product/<?php echo $value['image'] ?>" class="img-thumbnail" /></a></td>
                                          <td class="text-left"><a href="<?php echo $url ?>"><?php echo $value['name'] ?></a>(<?php echo $value['attr_name'] ?>)</td>
                                          <td class="text-right">x <?php echo $value['number'] ?></td>
                                          <td class="text-right"><?php echo number_format($value['price']*$value['number']) ?> ₫</td>
                                          <td class="text-center"><button type="button" onclick="cart.remove(<?php echo $value['ap_id'] ?>);" title="Remove" class="btn btn-default btn-xs detele-cart" data-href="<?php echo ROOT ?>/cart/delete"><i class="fa fa-times" ></i></button></td>
                                        </tr>
                                    <?php endforeach ?>
                                </table>
                                <div class="col-md-10 pull-right">
                            <table class="table table-bordered ">
                                <tr>
                                <td class="text-right"><strong>Tổng</strong></td>
                                <td class="text-right"><?php echo number_format($this->cart->cart_total()) ?> ₫ </td>
                              </tr>
                          </table>
                            <p class="text-right">
                              <a href="cart.html"><strong class="button btn btn-default"><i class="fa fa-shopping-cart"></i> Đặt hàng </strong></a>
                            </p>
                          </div>
                    <?php endif; ?>    
                    </li>
                </ul>
            </div>
            <ul class="links pull-right hidden-sm hidden-xs">
                <?php auto_loader::loadMenu(0,0); ?>
            </ul>
        </div>
    </div>
    <!-- end -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <ul class="nav nav-tabs">
                <li class="active">
                     <a data-toggle="tab" href="#login" >Đăng nhập tài khoản</a>
                </li>
                <li >
                     <a data-toggle="tab" href="#create" >Đăng ký tài khoản</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                  <div id="login" class="tab-pane fade in active ">
                      <form id="loginform" method="post" action=""  class="form-horizontal">
                        <p><input class="form-control" type="text" placeholder="Email của bạn" name="email"></p>
                        <p><input class="form-control" type="password" placeholder="Nhập mật khẩu" name="password"></p>
                        <div class="message" style="color:red"></div>
                        <p class="text-center">
                          <input class="btn btn-success" type="submit" value="Đăng nhập">
                          <a href="user/forgot/pass" >Quên mật khẩu</a>
                        </p>  
                      </form>
                  </div>
                  <div id="create" class="tab-pane fade">
                      <form id="created" method="post" action="user/created" class="form-horizontal">
                        <p><input  class="form-control" type="text" placeholder="Name của bạn" name="name" required></p>
                        <p><input  class="form-control" type="text" placeholder="Email của bạn" name="email" id="email" required></p>
                        <p><input  class="form-control" type="password" placeholder="Nhập mật khẩu" name="password" required></p>
                        <p><input  class="form-control" type="password" placeholder="Nhập lại mật khẩu" name="repassword" required></p>
                        <p><input  class="form-control" type="text" placeholder="Phone" name="phone" id="phone" required></p>
                        <p><input  class="form-control" type="text" placeholder="Address" name="address" required></p>
                        <div id="error" style="color:red"></div>
                        <p><input class="form-control btn btn-primary" type="submit" value="Đăng ký"></p>
                      </form>
                  </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
</div>
<!-- end container -->