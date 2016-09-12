<div class="page-content">
    <div class="page-heading">
        <div class="col-md-3">
            
        </div>
        <div class="col-md-9 pull-right">
            <div class="pull-right">
                <a href="<?php echo ROOT . '/admin/category/change/status'; ?>" data-status="0" class="btn btn-danger m-l-5 change_status">
                    Ẩn <i class="fa fa-eye-slash"></i>
                </a>
                <a href="<?php echo ROOT . '/admin/category/change/status'; ?>" data-status="1" class="btn btn-success m-l-5 change_status">
                    Hiển thị <i class="fa fa-eye"></i>
                </a>
                <a href="<?php echo ROOT . '/admin/category/create'; ?>" class="btn btn-primary m-l-5">
                    Thêm mới <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div id="panel-advancedoptions">
            <div class="row">
                <div class="col-md-12 bs-grid">
                    <div class="panel panel-default panel-btn-focused demo-new-members">
                        <div class="panel-heading">
                            <h2>Category</h2>
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
                        <div class="panel-body panel-no-padding">
                            <div class="table-responsive">
                                <table class="table table-hover " id="list-table">
                                    <thead >
                                        <tr>
                                            <th class="vam">
                                                <div class="checkbox icheck ">
                                                    <input type="checkbox" class="checkbox_all">
                                                </div>
                                            </th>
                                            <th >ID</th>
                                            <th >Tên category</th>
                                            <th >Nổi bật</th>
                                            <th >Trạng thái</th>
                                            <th >Tùy chọn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $this->loadTable(0); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .container-fluid -->
</div>
<!-- #page-content -->