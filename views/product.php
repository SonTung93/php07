<div class="container">
    <?php 
        $list_breadcoumbs = auto_loader::$breadcrumbs;
        if(count($list_breadcoumbs)>0):
    ?>
    <ul class="breadcrumb">
        <?php foreach ($list_breadcoumbs as $key => $value): ?>      
            <li><?php echo $value ?></li>
        <?php endforeach ?>
    </ul>
    <?php endif; ?>
    <div class="row">

        <section id="sidebar-main" class="col-md-12">
            <div id="content">
                <?php 
                    $rating = $this->result['rating'] ;
                ?>
                <div class="product-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 image-container">
                            <div id="img-detail" class="image">
                                <!-- <span class="product-label-special label">Sale</span> -->
                                <a href="" class="imagezoom">
                                    <img src="<?php echo ROOT; ?>/upload/Images/Attribute_Product/<?php echo $this->result['image'] ?>"  id="image" data-zoom-image="<?php echo ROOT; ?>/upload/Images/Attribute_Product/<?php echo $this->result['image'] ?>" class="product-image-zoom img-responsive" />
                                </a>

                            </div>

                            <div class="thumbs-preview">
                                <div class="image-additional slide carousel vertical" id="image-additional">
                                    <div id="image-additional-carousel" class="carousel-inner">
                                        <div class="item clearfix image_list">
                                            <?php
                                                if(!empty($this->result['image_list'])) :  
                                                $list_image = explode('###', $this->result['image_list']);
                                                foreach ($list_image as $key => $value):
                                            ?>
                                            <a href="#" class="imagezoom"  data-image="<?php echo ROOT; ?>/upload/Files/Attribute_Product/<?php echo $value ?>">
                                                <img src="<?php echo ROOT; ?>/upload/Files/Attribute_Product/<?php echo $value ?>" style="max-width:80px" data-zoom-image="<?php echo ROOT; ?>/upload/Images/Attribute_Product/<?php echo $value ?>" class="product-image-zoom img-responsive" id="image_list"/>
                                            </a>
                                        <?php 
                                            endforeach; 
                                            endif;
                                        ?>
                                        </div>

                                    </div>

                                    <!-- Controls -->
                                </div>
                                <script type="text/javascript">
                                    $('#image-additional .item:first').addClass('active');
                                    $('#image-additional').carousel({
                                        autoplay:false
                                    })

                                    $(document).ready(function() { 
                                        $('#img-detail a').click(
                                            function(){  
                                                $.magnificPopup.open({
                                                  items: {
                                                    src:  $('img',this).attr('src')
                                                  },
                                                  type: 'image'
                                                }); 
                                                return false;
                                            }
                                        );
                                    });
                                    var zoomCollection = '#image';
                                    $( zoomCollection ).elevateZoom({
                                                lensShape : "basic",
                                        lensSize    : 150,
                                        easing:true,
                                        gallery:'image-additional-carousel',
                                        cursor: 'pointer',
                                        galleryActiveClass: "active"
                                    });
                                </script>

                            </div>
                        </div>
                        <div class="detail-color">
                            <label> Chọn màu:  </label>
                            <?php foreach ($this->color as $value): ?>
                                <div class="pd-box-color <?php echo $value['name']==$this->result['attr_name']?
                                'active':'' ?>" title="<?php echo $value['name'] ?>">
                                <span style="background: <?php echo $value['value'] ?>;" data-id="<?php echo $value['id'] ?>"></span>
                            </div>
                            <?php endforeach ?>
                        </div>

                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                            <h1 class="title-product"><?php echo $this->result['name'] ?></h1>

                            <div class="price">
                                <span ><?php echo number_format($this->result['price']) ?>₫</span>
                            </div>
                            
                            <div class="rating">
                                <p>
                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                    
                                    <a href="" onclick="return false;" ><?php echo count($rating); ?> đánh giá</a> / 
                                    <?php if ($this->currentcustomer->isLogin()): ?>
                                        <a href="#review-form" class="popup-with-form" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Viết đánh giá</a>
                                    <?php else: ?>
                                        <a href="#" data-toggle="modal" data-target="#myModal">Viết đánh giá</a>
                                    <?php endif ?>
                                    
                                </p>
                            </div>

                            <div id="product" class="product-extra">
                                <h3>Khuyến mãi</h3>
                                <div class="form-group ">
                                    <?php echo $this->result['promotion'] ?>
                                </div>

                                <div class="quantity-adder pull-left">
                                    Số lượng
                                    <input class="form-control" type="text" name="quantity" size="2" value="1">
                                    <span class="add-up add-action">+</span>
                                    <span class="add-down add-action">-</span>
                                </div>
                                <div class="product-action product-block">
                                    <div class="cart">
                                        <input type="button" value="Thêm vào giỏ hàng" onclick="cart.addcart(<?php echo $this->result['id'] ?>);" class="button add-to-cart" data-href="<?php echo ROOT ?>/cart/add"/>
                                    </div>
                                </div>
                            </div>

                            <div class=" clearfix"></div>

                        </div>
                    </div>

                </div>
                <div class="clearfix product-box-bottom tabs-group">
                    <ul class="nav nav-tabs border">
                        <li class="active"><a href="#tab-description" data-toggle="tab">Thông tin</a>
                        </li>
                        <li><a href="#tab-review" data-toggle="tab">Đánh giá (<?php echo count($rating) ?>)</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-description">
                            <div>
                                <?php echo $this->result['description'] ?>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab-review">

                            <div id="review">

                                <?php foreach ($rating as $key => $rows): ?>
                                    <div class="comment">
                                        <div class="comment-left">
                                            <a href=""><img src="<?php echo ROOT ?>/assets/image/no-avatar.png" alt="" style="width:40px"></a>
                                        </div>
                                        <div class="comment-body">
                                            <h3 class="comment-heading"><?php echo $rows['user_name'] ?></h3>
                                            <?php echo str_repeat('<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>',$rows['rating']); ?>
                                            <span><?php echo $rows['comment'] ?></span>
                                            <span class="pull-right"><?php echo date_format(date_create($rows['created']), 'd/m/Y H:i'); ?></span>
                                        </div>  
                                    </div>
                                <?php endforeach ?>
                                
                            </div>

                            <div class="hide">
                                <div id="review-form" class="panel review-form-width">
                                    <div class="panel-body">
                                        <form class="form-horizontal" method="post" action="product/rating">
                                            <h2>Đánh giá sản phẩm</h2>
                                            <div class="form-group">
                                                <label class="control-label col-md-2" for="input-name">Tên :</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="name" value="<?php echo $this->currentcustomer->getUsername() ?>" required id="input-name" class="form-control"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2" for="input-review">Đánh giá:</label>
                                                <div class="col-md-10">
                                                    <textarea name="comment" rows="3" id="input-review" class="form-control"></textarea>  
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label col-md-2" for="input-name">Rating :</label>
                                                <div class="col-md-10">
                                                    &nbsp;&nbsp;&nbsp; Bad&nbsp;
                                                    <input type="radio" name="rating" value="1" required /> &nbsp;
                                                    <input type="radio" name="rating" value="2" /> &nbsp;
                                                    <input type="radio" name="rating" value="3" /> &nbsp;
                                                    <input type="radio" name="rating" value="4" /> &nbsp;
                                                    <input type="radio" name="rating" value="5" /> &nbsp;Good
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Captcha :</label>
                                                <div class="col-md-10">
                                                    <?php capcha::setCapcha(); ?>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="col-md-10 col-md-offset-2">
                                                    <input type="text" name="captcha" value="" placeholder="Nhập captcha" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-2">
                                                    <input type="hidden" name="eid" value="<?php echo $this->result['id']; ?>">
                                                    <input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                                    <input type="submit" name="save" value="Đánh giá" class="btn btn-default">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                    <?php if (count($this->the_recent)>0): ?>
                    <div class="box products-related">
                        <div class="box-heading">
                            <span>Sản phẩm liên quan</span>
                            <em class="line"></em>
                        </div>
                        <div class="box-content">
                            <div id="product-related" class="slide product-grid" data-interval="0">
                                <div class="carousel-controls">
                                    <a class="carousel-control left fa fa-angle-left" href="pav_digital_store.html#product-related" data-slide="prev"></a>
                                    <a class="carousel-control right fa fa-angle-right" href="pav_digital_store.html#product-related" data-slide="next"></a>
                                </div>
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <div class="products-block">
                                            <div class="row products-row">
                                            <?php foreach (array_slice($this->the_recent,0,4) as $key => $value):?>
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 product-col">
                                                    <div class="product-block" >
                                                        <div class="image">
                                                            <a class="img" href="<?php echo url_generated::createProductUrl($value['name'], $value['id'], '-') ?>"><img src="<?php echo ROOT; ?>/upload/Images/Product/<?php echo $value['image'] ?>" /></a>
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
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (count($this->the_recent)>4): ?>
                                    <div class="item ">
                                        <div class="products-block">
                                            <div class="row products-row">
                                                <?php foreach (array_slice($this->the_recent,4) as $key => $value):?>
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 product-col">
                                                    <div class="product-block">

                                                        <div class="image">
                                                            <a class="img" href="<?php echo url_generated::createProductUrl($value['name'], $value['id'], '-') ?>"><img src="<?php echo ROOT; ?>/upload/Images/Product/<?php echo $value['image'] ?>" /></a>
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
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?> 
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $('#products-related').carousel({
                                interval: true
                            });
                        </script>
                    </div>  
                    <?php endif ?>
                </div>
        </section>
    </div>
</div>

