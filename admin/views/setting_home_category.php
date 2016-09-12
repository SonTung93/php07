<div class="page-content">
    <div class="page-heading">
    </div>
    <div class="container-fluid">
        <div id="panel-advancedoptions">
            <div class="row">
                <div class="col-md-12 bs-grid">
                    <div class="panel panel-default panel-btn-focused demo-new-members">
                        <div class="panel-heading">
                            <h2>Category home</h2>
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
                                <form action="" method="post" class="form-horizontal"  enctype="multipart/form-data" name="form-menu" id="form-edit-article">

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Category box 1:</label>
                                            <div class="col-md-6">
                                                <select class="form-control selectpicker" data-live-search="true"  data-style="btn-info" name="category_box1">
                                                   <option value="0" selected="selected">Tất cả category</option>
                                                    <?php $this->loadSelect(0, $this->result['category_box1']);?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label class="control-label col-md-2">Category box 2:</label>
                                            <div class="col-md-6">
                                                <select class="form-control selectpicker" data-live-search="true"  data-style="btn-info" name="category_box2">
                                                   <option value="0" selected="selected">Tất cả category</option>
                                                    <?php $this->loadSelect(0, $this->result['category_box2']);?>
                                                </select>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="control-label col-md-2">Category box 3:</label>
                                            <div class="col-md-6">
                                                <select class="form-control selectpicker" data-live-search="true"  data-style="btn-info" name="category_box3">
                                                   <option value="0" selected="selected">Tất cả category</option>
                                                    <?php $this->loadSelect(0, $this->result['category_box3']);?>
                                                </select>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="control-label col-md-2">Category box 4:</label>
                                            <div class="col-md-6">
                                                <select class="form-control selectpicker" data-live-search="true"  data-style="btn-info" name="category_box4">
                                                   <option value="0" selected="selected">Tất cả category</option>
                                                    <?php $this->loadSelect(0, $this->result['category_box4']);?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-2">
                                            <button type="submit" class="btn btn-success" name="save"><i class="fa fa-check"></i> Xác nhận</button>
                                            <a href="<?php echo ROOT . '/admin/setting/home'; ?>" class="btn btn-default"><i class="fa fa-sign-out"></i> Quay lại</a>
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
    <!-- .container-fluid -->
</div>
<!-- #page-content -->