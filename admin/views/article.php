<style>
    .btn-star {
        background: none;
        border: none;
    }
    .btn-star i {
        font-size: 15px;
        color: red;
    }
</style>
<div class="page-content">
    <div class="page-heading">
        <div class="col-md-6">
            <form name="search-form" method="GET" action="" class="form-horizontal">
                    <input type="search" class="form-control" placeholder="Tìm kiếm ..." name="search" value="<?php echo $this->search; ?>" style="width:60%;" />
            </form>
        </div>
        <div class="col-md-6 pull-right">
            <div class="pull-right">
                <a href="<?php echo ROOT . '/admin/article/change/status'; ?>" data-status="0" class="btn btn-danger m-l-5 change_status">
                    Ẩn <i class="fa fa-eye-slash"></i>
                </a>
                <a href="<?php echo ROOT . '/admin/article/change/status'; ?>" data-status="1" class="btn btn-success m-l-5 change_status">
                    Hiển thị <i class="fa fa-eye"></i>
                </a>
                <a href="<?php echo ROOT . '/admin/article/create'; ?>" class="btn btn-primary m-l-5">
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
                                <table class="table table-hover" id="list-table">
                                    <thead >
                                        <tr>
                                            <th class="vam">
                                                <div class="checkbox icheck ">
                                                    <input type="checkbox" class="checkbox_all">
                                                </div>
                                            </th>
                                            <th >ID</th>
                                            <th width="25%">Title</th>
                                            <th >Nổi bật</th>
                                            <th >Trạng thái</th>
                                            <th >Tùy chọn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($this->result) > 0) : ?>

                                            <?php foreach ($this->result as $key => $value) : ?>
                                                <tr>
                                                    <td class="vam">
                                                        <div class="checkbox icheck"><input type="checkbox" name="checkbox_item[]" class="checkbox_item" value="<?php echo $value['id'] ?>" /></div>
                                                    </td>

                                                    <td>
                                                        <?php echo $value['id']; ?>
                                                    </td>

                                                    <td>
                                                        <a href="<?php echo ROOT . '/admin/article/edit/' . $value['id']; ?>"><?php echo $value['title']; ?></a>
                                                    </td>

                                                    <td >
                                                        <form method="POST" action="<?php echo ROOT; ?>/admin/article/change_featured?page=<?php echo $this->page; ?>" enctype="multipart/form-data">
                                                            <input type="hidden" name="featured" value="<?php echo $value['featured']; ?>" />
                                                            <input type="hidden" name="eid" value="<?php echo $value['id']; ?>" />
                                                            <button type="submit" class="btn-star" title="<?php echo $this->common->getArticleFeatured($value['featured']); ?>">
                                                                <i class="fa <?php echo $value['featured'] == '0' ? 'fa-star-o' : 'fa-star'; ?>"></i>
                                                            </button>
                                                        </form>
                                                    </td>

                                                    <td>
                                                        <?php if ($value['status'] == 0) : ?>
                                                            <span class = "label label-danger w-300"><?php echo $this->common->getArticleStatus($value['status']); ?></span>
                                                        <?php else : ?>
                                                            <span class = "label label-success w-300"><?php echo $this->common->getArticleStatus($value['status']); ?></span>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td class="vam td-btn">
                                                        <a class=" btn btn-xs btn-default" href="<?php echo ROOT . '/admin/article/edit/' . $value['id']; ?>"><i class="fa fa-info-circle"></i> Sửa</a>
                                                        <a class=" btn btn-xs btn-default  btn-delete-data" data-id="<?php echo $value['id']; ?>" href="<?php echo ROOT . '/admin/article/delete/' . $value['id']; ?>"><i class="fa fa-times-circle"></i> Xóa</a>
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
                                <?php
                                    $page_url = '';
                                    $pager = pagination_calculater::pager(3, $this->page, $this->pagination);

                                    $min = $pager['min'];
                                    $max = $pager['max'];
                                ?>
                                <ul class="pagination pagination-sm m0 pull-right">
                                    <li class="<?php echo (($this->page - 1) > 0) ? '' : 'disabled'; ?>"><a href="<?php echo ROOT . '/admin/article?page=' . ($this->page - 1) . ($this->search != '' ? '&search=' . $this->search : ''); ?>"><i class="fa fa-angle-left"></i></a>
                                    </li>
                                    <?php for ($i = $min; $i <= $max; $i++) : ?>
                                        <li class="paginate_button <?php echo $this->page == $i ? 'active' : ''; ?>" aria-controls="products-table" tabindex="0">
                                            <a href="<?php echo ROOT . '/admin/article?page=' . $i . ($this->search != '' ? '&search=' . $this->search : ''); ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="<?php echo (($this->page + 1) > $this->pagination) ? 'disabled' : ''; ?>"><a href="<?php echo ROOT . '/admin/article?page=' . ($this->page + 1) . ($this->search != '' ? '&search=' . $this->search : ''); ?>"><i class="fa fa-angle-right"></i></a>
                                    </li>
                                </ul>
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