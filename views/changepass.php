<div class="container">
    <ul class="breadcrumb">
        <li><a href="index_8.htm"><i class="fa fa-home"></i></a>
        </li>
        <li><a href="user">Account</a>
        </li>
    </ul>
    <div class="row">

        <section id="sidebar-main" class="col-md-9">
            <div id="content">
                <div class="row">
                    <div class="col-sm-12">
                    <div class="panel panel-success">                       
                            <div class="panel-heading">Đổi mật khẩu</div>
                            <div class="panel-body">
                                <form action="" method="post" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Tên thành viên :</label>
                                        <div class="col-sm-9">
                                            <span class="form-control"><?php echo $this->currentcustomer->getUsername(); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Email :</label>
                                        <div class="col-sm-9">
                                            <span class="form-control"><?php echo $this->currentcustomer->getEmail(); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Old Password :</label>
                                        <div class="col-sm-9">
                                            <input type="password" value="" name="oldpassword" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">New Password :</label>
                                        <div class="col-sm-9">
                                            <input type="password" value="" name="newpassword" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Re-Password :</label>
                                        <div class="col-sm-9">
                                            <input type="password" value="" name="re-password" class="form-control" required>
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