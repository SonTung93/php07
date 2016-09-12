<div class="static-sidebar">
    <div class="sidebar">
        <div class="widget stay-on-collapse">
            <div class="widget-body welcome-box tabular">
                <div class="tabular-row">
                    <div class="tabular-cell welcome-avatar">
                        <a href="#"><img src="<?php echo ROOT ?>/admin/assets/img/avatar.png" class="avatar">
                        </a>
                    </div>
                    <div class="tabular-cell welcome-options">
                        <span class="welcome-text">Welcome,</span>
                        <a href="#" class="name"><?php echo $currentuser->getUsername();?></a>
                    </div>
                </div>
            </div>
        </div>


        <div class="widget stay-on-collapse" id="widget-sidebar">
            <span class="widget-heading">Explore</span>
            <nav role="navigation" class="widget-body">
                <ul class="acc-menu">
                    <li><a href=""><i class="fa fa-home"></i><span>Trang chủ</span></a>
                    </li>
                    <li><a href="javascript:;"><i class="fa fa-columns"></i><span>Menu</span></a>
                        <ul class="acc-menu">
                            <li><a href="<?php echo ROOT ?>/admin/menu/create">Thêm mới</a>
                            </li>
                            <li><a href="<?php echo ROOT ?>/admin/menu">Quản lý menu</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:;"><i class="fa fa-tasks"></i><span>Category</span></a>
                        <ul class="acc-menu">
                            <li><a href="<?php echo ROOT ?>/admin/category/create">Thêm mới</a>
                            </li>
                            <li><a href="<?php echo ROOT ?>/admin/category">Quản lý category</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:;"><i class="fa fa-star"></i><span>Product</span></a>
                        <ul class="acc-menu">
                            <li><a href="<?php echo ROOT ?>/admin/product/create">Thêm mới</a>
                            </li>
                            <li><a href="<?php echo ROOT ?>/admin/product">Quản lý product</a>
                            </li>
                            <li><a href="<?php echo ROOT ?>/admin/rating">Quản lý đánh giá</a>
                            </li>
                            <li><a href="<?php echo ROOT ?>/admin/attribute/create">Thêm mới attribite</a>
                            <li><a href="<?php echo ROOT ?>/admin/attribute">Quản lý attribite</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:;"><i class="fa fa-pencil"></i><span>Article</span></a>
                        <ul class="acc-menu">
                            <li><a href="<?php echo ROOT ?>/admin/article/create">Thêm mới</a>
                            </li>
                            <li><a href="<?php echo ROOT ?>/admin/article">Quản lý bài viết</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:;"><i class="fa fa-picture-o"></i><span>Banner</span></a>
                        <ul class="acc-menu">
                            <li><a href="<?php echo ROOT ?>/admin/banner/create">Thêm mới</a>
                            </li>
                            <li><a href="<?php echo ROOT ?>/admin/banner">Quản lý Banner</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>


        <div class="widget stay-on-collapse">
            <div class="widget-heading">Functional Apps</div>
            <nav class="widget-body">
                <ul class="acc-menu">
                    <li><a href="javascript:;"><i class="fa fa-pencil-square-o"></i><span>Order</span></a>
                        <ul class="acc-menu">
                            <li><a href="<?php echo ROOT ?>/admin/order">Quản lý Order</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:;"><i class="fa fa-cc-paypal"></i><span>Transaction</span></a>
                        <ul class="acc-menu">
                            <li><a href="<?php echo ROOT ?>/admin/transaction">Quản lý Transaction</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="widget stay-on-collapse">
            <div class="widget-heading">Tài khoản</div>
            <nav class="widget-body">
                <ul class="acc-menu">
                    <li><a href="javascript:;"><i class="fa fa-user"></i><span>Thành viên</span></a>
                    <ul class="acc-menu">
                            <li><a href="<?php echo ROOT ?>/admin/user">Quản lý thành viên</a>
                            </li>
                    </ul>
                    <li><a href="javascript:;"><i class="fa fa-cog"></i><span>Setting</span></a>
                        <ul class="acc-menu">
                            <li><a href="<?php echo ROOT ?>/admin/setting/home">Category home</a>
                            </li>
                            <li><a href="<?php echo ROOT ?>/admin/setting/footer">Footer</a>
                            </li>    
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>