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
                        <div class="panel panel-primary">                       
                            <div class="panel-heading">Thông tin</div>
                            <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td class="text-center">Tên thành viên:</td>
                                    <td><span ><?php echo $this->currentcustomer->getUsername(); ?></span></td>
                                </tr>
                                <tr>
                                    <td class="text-center">Địa chỉ:</td>
                                    <td><span ><?php echo $this->currentcustomer->getAddress(); ?></span></td>
                                </tr>
                                <tr>
                                    <td class="text-center">Phone:</td>
                                    <td><span><?php echo $this->currentcustomer->getPhone(); ?></span></td>
                                </tr>
                                <tr>
                                    <td class="text-center">Email:</td>
                                    <td><span ><?php echo $this->currentcustomer->getEmail(); ?></span></td>
                                </tr>
                                <tr>
                                    <td class="text-center">Ngày gia nhập:</td>
                                    <td><span ><?php echo $this->currentcustomer->getCreated(); ?></span></td>
                                </tr>
                            </table>
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