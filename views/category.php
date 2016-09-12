<div class="container">
    <?php $list_breadcoumbs=auto_loader::$breadcrumbs; if(count($list_breadcoumbs)>0): ?>
    <ul class="breadcrumb">
        <?php foreach ($list_breadcoumbs as $key=> $value): ?>
        <li>
            <?php echo $value ?>
        </li>
        <?php endforeach ?>
    </ul>
    <?php endif; ?>
    <div class="row">
        <aside id="sidebar-left" class="col-md-3">
            <column id="column-left" class="hidden-xs sidebar">
                <div class="box category">
                    <div class="box-heading"><span>Danh mục</span>
                    </div>
                    <div class="box-content">
                        <ul id="accordion" class="box-category list list-group accordion">
                            <?php auto_loader::loadMenuCategory( '1'); ?>
                        </ul>
                    </div>
                </div>
            </column>
        </aside>
        <section id="sidebar-main" class="col-md-9">
            <div class="product-filter clearfix">
                <div class="inner clearfix">
                    <div class="display">
                        <span>Hiện thị:</span>

                        <button type="button" id="list-view" class="btn btn-switch fa fa-th-list" data-toggle="tooltip" title="List"></button>
                        <button type="button" id="grid-view" class="btn btn-switch fa fa-th-large" data-toggle="tooltip" title="Grid"></button>

                    </div>
                    <div class="filter-right">
                        <div class="sort pull-right">
                            <span for="input-sort">Sắp xếp:</span>
                            <select id="input-sort" class="form-control" onchange="location = window.location.pathname+this.value;">
                                <option value="" selected="selected">Mặc định</option>
                                <option value="?order=price&type=ASC">Giá (Thấp &gt; Cao)</option>
                                <option value="?order=price&type=DESC">Giá (Cao &gt; Thấp)</option>
                                <option value="">Rating (Highest)</option>
                                <option value="">Rating (Lowest)</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>


            <div id="products" class="box product-grid">
                <div class="box-content">
                    <div class="products-block">
                        <?php if(count($this->result)>0): ?>
                        <div class="row products-row">
                            <?php   
                                foreach (array_slice($this->result,0,3) as $key => $value):
                                $url = url_generated::createProductUrl($value['name'], $value['id'], '-');
                                $image = ROOT.'/upload/Images/Product/'.$value['image'];
                            ?>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 product-col">
                                <div class="product-block">

                                    <div class="image">
                                        <a class="img" href="<?php echo $url ?>"><img src="<?php echo $image; ?>" /></a>
                                        <a class="pav-colorbox iframe-link hidden-sm hidden-xs" href="<?php echo ROOT ?>/detail_<?php echo $value['id'] ?>" title="Quick View">
                                            <span class='fa fa-eye'></span>Xem nhanh</a>
                                    </div>

                                    <div class="product-meta text-center">
                                        <h4 class="name"><a href="<?php echo $url ?>"><?php echo $value['name'] ?></a></h4>

                                        <div class="price" >
                                            <span class="special-price"><?php echo number_format($value['price']) ?> </span>
                                        </div>

                                        <div class="rating">
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                        </div>

                                        <div class="cart ">

                                            <input type="button" value="Thêm vào giỏ hàng" onclick="cart.addcart(<?php echo $value['id'] ?>,1);" class="button add-to-cart" data-href="<?php echo ROOT ?>/cart/add" />
                                        </div>
                                    </div>
                                </div>                           
                            </div>
                            <?php endforeach ?>
                        </div>  
                        <?php if (count($this->result)>3): ?>
                        <div class="row products-row">
                            <?php 
                                foreach (array_slice($this->result,3) as $key => $value):
                                $url = url_generated::createProductUrl($value['name'], $value['id'], '-') ;
                                $image = ROOT.'/upload/Images/Product/'.$value['image'];
                            ?>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 product-col">
                                <div class="product-block">

                                    <div class="image">
                                        <a class="img" href="<?php echo $url ?>"><img src="<?php echo $image; ?>" /></a>
                                        <a class="pav-colorbox iframe-link hidden-sm hidden-xs" href="<?php echo ROOT ?>/detail_<?php echo $value['id'] ?>" title="Quick View">
                                            <span class='fa fa-eye'></span>Xem nhanh</a>
                                    </div>

                                    <div class="product-meta text-center">
                                        <h4 class="name"><a href="<?php echo url_generated::createProductUrl($value['name'], $value['id'], '-') ?>"><?php echo $value['name'] ?></a></h4>

                                        <div class="price" >
                                            <span class="special-price"><?php echo number_format($value['price']) ?> </span>
                                        </div>

                                        <div class="rating">
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                        </div>

                                        <div class="cart ">

                                            <input type="button" value="Thêm vào giỏ hàng" onclick="cart.addcart(<?php echo $value['id'] ?>,1);" class="button add-to-cart" data-href="<?php echo ROOT ?>/cart/add" />
                                        </div>
                                    </div>
                                </div>                           
                            </div>
                            <?php endforeach ?>
                        </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="text-center">Danh mục không tồn tại sản phẩm</p>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="paging clearfix">
                <div class="pull-left"></div>
                <div class="pull-right">
                    <?php if ($this->pagination >= 1) : ?>
                    <ul class="pagination">

                        <?php
                        $pager = pagination_calculater::pager(3, $this->page, $this->pagination);
                        $min = $pager['min'];
                        $max = $pager['max'];
                        ?>

                        <?php for ($i = $min; $i <= $max; $i++): ?>

                            <?php if ($i == $this->page) : ?>
                                <li class="active"><span ><?php echo $i; ?></span></li>
                            <?php else : ?>
                                <li><a href="<?php echo url_generated::createCategoryUrl($this->data_cate['name'],$this->data_cate['id']) ?>?page=<?php echo $i ?>"><?php echo $i; ?></a></li>
                            <?php endif; ?>

                        <?php endfor; ?>

                    </ul>
                <?php endif; ?>
                </div>
            </div>




        </section>
    </div>
</div>