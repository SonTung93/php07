<div class="container">
    <ul class="breadcrumb">
        <li><a href="<?php echo ROOT ?>/"><i class="fa fa-home"></i></a>
        </li>
        <li><a href="user/forgot/pass">Tìm lại mật khẩu</a>
        </li>
    </ul>
    <div class="row">
        
        <section id="sidebar-main" class="col-md-12">
            <div id="content">
                <div class="row">
                    <div class="col-sm-12">
                    <div class="panel panel-success">                       
                            <div class="panel-heading">Tìm lại mật khẩu</div>
                            <div class="panel-body">
                                <form action="" method="post" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Email:</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="" name="email" class="form-control" required placeholder="Nhập email">
                                        </div>
                                    </div>                                
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Captcha:</label>
                                        <div class="col-sm-9">                                        
                                            <?php 
                                                capcha::setCapcha();
                                             ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3"></label>
                                        <div class="col-sm-6 ">
                                            <input id="capcha" name="capcha" type="text" class="form-control" placeholder="Nhập captcha">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-sm btn-success" name="save"><i class="fa fa-check"></i> Xác nhận</button>
                                            <input type="reset" name="reset" value="Reset" class="btn btn-sm btn-danger">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>            
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>