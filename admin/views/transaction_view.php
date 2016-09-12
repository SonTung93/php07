<div class="page-content" style="margin-top:20px;">
    <div class="container-fluid">
        <div id="panel-advancedoptions">
            <div class="row">
                <div class="col-md-12 bs-grid">
                    <div class="panel panel-default panel-btn-focused demo-new-members">
                        <div class="panel-heading">
                            <h2>Form sửa Transaction</h2>
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
                                <form action="" method="post" class="form-horizontal"  enctype="multipart/form-data" name="form-menu" >

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Tên khách hàng :</label>
                                            <div class="col-md-6">
                                                <input type="text" value="<?php echo $this->result['user_name']; ?>" name="name" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Phone :</label>
                                            <div class="col-md-6">
                                                <input type="text" value="<?php echo $this->result['user_phone']; ?>" name="phone" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Email :</label>
                                            <div class="col-md-6">
                                                <input type="text" value="<?php echo $this->result['user_email']; ?>" name="email" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Order :</label>
                                                <div class="col-md-10">
                                                    <div class="preview">
                                                    <?php 
                                                        $order = $this->order->getOrderByTransactionID($this->result['id']);
                                                            foreach ($order as $key => $value) :
                                                                $image = ROOT.'/upload/Images/Product/'.$this->product->getProductByID($value['product_id'])['image'];
                                                                $name = $this->product->getProductByID($value['product_id'])['name'];
                                                                                                                   
                                                    ?>
                                                    <div class="img-preview text-center">
                                                        <img src="<?php echo $image ?>" title="<?php echo $name ?>"/>
                                                        <p><?php echo $name?></p>
                                                        <p>Quantity:<?php echo $value['quantity'] ?></p>
                                                        <p id="amount">Amount:<?php echo number_format($value['amount'])?>₫</p>
                                                    </div>
                                                    <?php 
                                                        endforeach;
                                                    ?>
                                                    </div>
                                                </div>
                                           
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Amount :</label>
                                            <div class="col-md-6">
                                                <input type="text" value="<?php echo $this->result['amount']; ?>" name="amount" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Payment :</label>
                                            <div class="col-md-6">
                                                <select name="payment" class="form-control">
                                                    <?php foreach ($this->common->listPayment as $key => $value): ?>
                                                        <option value="<?php echo $key ?>" <?php echo $key == $this->result['payment'] ? 'selected' : '' ?> ><?php echo $value ?></option>
                                                    <?php endforeach ?>                                     
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Message :</label>
                                            <div class="col-md-10">
                                                <textarea name="message" class="form-control"><?php echo $this->result['message'] ?></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Trạng thái:</label>
                                            <div class="col-md-10">
                                                    <?php foreach ($this->common->listTransactionStatus as $key => $value) : ?>
                                                        <div class="icheck radio col-md-2">
                                                                <label for="<?php echo $value ?>"><?php echo $value ?></label>
                                                              <input type="radio" name="status" id="<?php echo $value ?>" value="<?php echo $key; ?>" <?php echo $this->result['status'] == $key ? 'checked' : ''; ?>>
                                                        </div>
                                                    <?php endforeach; ?>
                                            </div>
                                        </div>

                                        <input type="hidden" value="<?php echo $this->result['id']; ?>" name="eid">
                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-2">
                                            <a href="<?php echo ROOT . '/admin/transaction'; ?>" class="btn btn-default"><i class="fa fa-sign-out"></i> Quay lại</a>
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