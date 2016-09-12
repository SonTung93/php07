<div class="page-content">
    <div class="page-heading">
        <div class="col-md-4">
        </div>
        <div class="col-md-8 pull-right">
            <div class="pull-right">
                <a href="<?php echo ROOT . '/admin/banner/change/status'; ?>" data-status="0" class="btn btn-danger m-l-5 change_status">
                    Ẩn <i class="fa fa-eye-slash"></i>
                </a>
                <a href="<?php echo ROOT . '/admin/banner/change/status'; ?>" data-status="1" class="btn btn-success m-l-5 change_status">
                    Hiện <i class="fa fa-eye"></i>
                </a>
                <a href="<?php echo ROOT . '/admin/banner/create'; ?>" class="btn btn-primary m-l-5">
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
                            <h2>Banner</h2>
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
                                <table class="table table-hover" id="list-table">
                                    <thead >
                                        <tr>
                                            <th class="vam">
                                                <div class="checkbox icheck ">
                                                    <input type="checkbox" class="checkbox_all">
                                                </div>
                                            </th>
                                            <th >ID</th>
                                            <th >Name</th>
                                            <th >Image</th>
                                            <th >Position</th>
                                            <th >Trạng thái</th>
                                            <th >Tùy chọn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($this->result) > 0) : ?>

                                            <?php foreach ($this->result as $key => $value) : ?>
                                                <tr>
                                                    <td >
                                                        <div class="checkbox icheck"><input type="checkbox" name="checkbox_item[]" class="checkbox_item" value="<?php echo $value['id'] ?>" /></div>
                                                    </td>

                                                    <td>
                                                        <?php echo $value['id']; ?>
                                                    </td>

                                                    <td>
                                                        <a href="<?php echo ROOT . '/admin/banner/edit/' . $value['id']; ?>"><?php echo $value['name']; ?></a>
                                                    </td>

                                                    <td >
                                                        <a href="<?php echo ROOT . '/admin/banner/edit/' . $value['id']; ?>">
                                                            <img src="<?php echo ROOT; ?>/upload/Images/Banner/<?php echo $value['image']; ?>" alt="<?php echo $value['name']; ?>" width="150" class="img-responsive" />
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <?php echo $this->common->getBannerPosition($value['position']);  ?>
                                                    </td>
    
                                                    <td >
                                                        <?php if ($value['status'] == 0) : ?>
                                                            <span class = "label label-danger w-300"><?php echo $this->common->getBannerStatus($value['status']); ?></span>
                                                        <?php else : ?>
                                                            <span class = "label label-success w-300"><?php echo $this->common->getBannerStatus($value['status']); ?></span>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td class="td-btn">
                                                        <a class=" btn btn-xs btn-default" href="<?php echo ROOT . '/admin/banner/edit/' . $value['id']; ?>"><i class="fa fa-info-circle"></i> Sửa</a>
                                                        <a class=" btn btn-xs btn-default  btn-delete-data" data-id="<?php echo $value['id']; ?>" href="<?php echo ROOT . '/admin/banner/delete/' . $value['id']; ?>"><i class="fa fa-times-circle"></i> Xóa</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>

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
                            <div class="panel-footer p10 m0">
                                
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