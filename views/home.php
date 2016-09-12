<div class="slideshow " id="pavo-slideshow">
    <?php include_once 'templates/banner.php'; ?>
</div>
<div class="showcase " id="pavo-showcase">
    <?php include_once 'templates/topproduct.php'; ?>
</div>
<div id="pavo-promotion">
    <?php include_once 'templates/promotion.php'; ?>
</div>
<div class="container">
    <div class="row">
        <section id="sidebar-main" class="col-md-12">
            <div id="content">
                <div class="box pav-categoryproducts no-boxshadown">
                    <div class="box-content">
                        <div class="tab-nav">
                            <ul class="h-tabs" id="producttabs">
                                <?php 
                                    $category_box1 = auto_loader::getSettingCategoryBox(1);
                                    $cate1 = $this->getCategory($category_box1);
                                    $image =  ROOT . '/kich-co-hinh-anh.html?src=' . ROOT . '/upload/Images/Category/' . $cate1['image']. '&w=90&h=53&q=100&zc=1';
                                ?>
                                <li style="width:25%">
                                    <a href="#tab-<?php echo  $cate1['id'] ?>" data-toggle="tab"> <img class="hidden-sm hidden-xs pull-left" src="<?php echo $image ?>" alt="" /> <?php echo  $cate1['name'] ?> </a>
                                </li>
                                <?php 
                                    $category_box2 = auto_loader::getSettingCategoryBox(2);
                                    $cate2= $this->getCategory($category_box2);
                                    $image =  ROOT . '/kich-co-hinh-anh.html?src=' . ROOT . '/upload/Images/Category/' . $cate2['image']. '&w=90&h=53&q=100&zc=1';
                                ?>
                                <li style="width:25%">
                                    <a href="#tab-<?php echo  $cate2['id'] ?>" data-toggle="tab"> <img class="hidden-sm hidden-xs pull-left" src="<?php echo $image ?>" alt="" /> <?php echo  $cate2['name'] ?></a>
                                </li>
                                <?php 
                                    $category_box3 = auto_loader::getSettingCategoryBox(3);
                                    $cate3= $this->getCategory($category_box3);
                                    $image =  ROOT . '/kich-co-hinh-anh.html?src=' . ROOT . '/upload/Images/Category/' . $cate3['image']. '&w=90&h=53&q=100&zc=1';
                                ?>
                                <li style="width:25%">
                                    <a href="#tab-<?php echo  $cate3['id'] ?>" data-toggle="tab"> <img class="hidden-sm hidden-xs pull-left" src="<?php echo $image ?>" alt="" /> <?php echo  $cate3['name'] ?> </a>
                                </li>
                                <?php 
                                    $category_box4 = auto_loader::getSettingCategoryBox(4);
                                    $cate4= $this->getCategory($category_box4);
                                    $image =  ROOT . '/kich-co-hinh-anh.html?src=' . ROOT . '/upload/Images/Category/' . $cate4['image']. '&w=90&h=53&q=100&zc=1';
                                ?>
                                <li style="width:25%">
                                    <a href="#tab-<?php echo  $cate4['id'] ?>" data-toggle="tab"> <img class="hidden-sm hidden-xs pull-left" src="<?php echo $image ?>" alt="" /> <?php echo  $cate4['name'] ?> </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <?php 
                               $data = auto_loader::loadProduct($category_box1);
                               if(count($data)>0):
                            ?>
                            <div class="tab-pane cat-products-block  clearfix" id="tab-<?php echo  $cate1['id'] ?>"><a class="carousel-control left" href="#box-<?php echo $cate1['id']; ?>" data-slide="prev">&lsaquo;</a> <a class="carousel-control right" href="#box<?php echo $cate1['id']; ?>" data-slide="next">&rsaquo;</a>
                                <div class="box-products   slide" id="box-<?php echo $cate1['id']; ?>">
                                    <div class="carousel-inner ">  
                                        <div class="item active products-block">
                                            <div class="row products-row"> 
                                            <?php foreach (array_slice($data,0,4) as $key => $value):?>
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 product-col">
                                                    <div class="product-block" >
                                                        <?php 
                                                            $url = url_generated::createProductUrl($value['name'], $value['id'], '-');
                                                            $image =  ROOT . '/kich-co-hinh-anh.html?src=' . ROOT . '/upload/Images/Product/' . $value['image']. '&w=230&h=230&q=100&zc=1';
                                                         ?>
                                                        <div class="image">
                                                            <a class="img" href="<?php echo $url ?>"><img src="<?php echo $image ?>"/> </a>
                                                            <div class="promotion">
                                                                <a href="<?php echo $url  ?>"><?php echo $value['promotion'] ?></a>
                                                            </div>   
                                                        </div>
                                                        <div class="product-meta text-center">
                                                            <h4 class="name"><a href="<?php echo $url ?>"><?php echo $value['name'] ?></a></h4>
                                                            <div class="price"> 
                                                                <span class="price-new"><?php echo number_format($value['price']) ?>₫</span> 
                                                                <span class="price-old">
                                                                    <?php echo ($value['price_old']!=0)?number_format($value['price_old']).'₫':'' ?> 
                                                                </span>
                                                            </div>
                                                            <div class="rating"> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>              <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                            </div>
                                                            <div class="cart pull-center">    
                                                                <input type="button" value="Thêm vào giỏ hàng" onclick="cart.addcart(<?php echo $value['id'] ?>,1);" class="button" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <?php if (count($data)>4): ?>
                                        <div class="item products-block">
                                            <div class="row products-row"> 
                                            <?php foreach (array_slice($data,4) as $key => $value):?>
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 product-col">
                                                    <div class="product-block" >
                                                        <?php 
                                                            $url = url_generated::createProductUrl($value['name'], $value['id'], '-');
                                                            $image =  ROOT . '/kich-co-hinh-anh.html?src=' . ROOT . '/upload/Images/Product/' . $value['image']. '&w=230&h=230&q=100&zc=1';
                                                         ?>
                                                        <div class="image">
                                                            <a class="img" href="<?php echo $url ?>"><img src="<?php echo $image ?>" /> </a>
                                                            <div class="promotion">
                                                                <a href="<?php echo $url ?>"><?php echo $value['promotion'] ?></a>
                                                            </div>    
                                                        </div>
                                                        <div class="product-meta text-center">
                                                            <h4 class="name"><a href="<?php echo $url ?>"><?php echo $value['name'] ?></a></h4>
                                                            <div class="price" > 
                                                                <span class="price-new"><?php echo number_format($value['price']) ?>₫</span>
                                                                <span class="price-old">
                                                                    <?php echo ($value['price_old']!=0)?number_format($value['price_old']).'₫':'' ?> 
                                                                </span>
                                                            </div>
                                                            <div class="rating"> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>              <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                            </div>
                                                            <div class="cart pull-center">    
                                                                <input type="button" value="Thêm vào giỏ hàng" onclick="cart.addcart(<?php echo $value['id'] ?>,1);" class="button" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div> 
                                        <?php endif; ?>     
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php 
                           $data = auto_loader::loadProduct($category_box2);
                           if(count($data)>0):
                        ?>
                            <div class="tab-pane cat-products-block  clearfix" id="tab-<?php echo  $cate2['id'] ?>"> <a class="carousel-control left" href="#box-<?php echo $cate2['id'] ?>" data-slide="prev">&lsaquo;</a> <a class="carousel-control right" href="#box-<?php echo $cate2['id'] ?>" data-slide="next">&rsaquo;</a>
                                <div class="box-products   slide" id="box-<?php echo $cate2['id'] ?>">
                                    <div class="carousel-inner ">
                                        <div class="item active products-block">
                                            <div class="row products-row">
                                            <?php foreach (array_slice($data,0,4) as $key => $value):?>
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 product-col">
                                                    <div class="product-block">
                                                        <?php 
                                                            $url = url_generated::createProductUrl($value['name'], $value['id'], '-');
                                                            $image =  ROOT . '/kich-co-hinh-anh.html?src=' . ROOT . '/upload/Images/Product/' . $value['image']. '&w=230&h=230&q=100&zc=1';
                                                         ?>
                                                        <div class="image">
                                                            <a class="img" href="<?php echo $url ?>"><img src="<?php echo $image ?>" /> </a>
                                                            <div class="promotion">
                                                                <a href="<?php echo $url ?>"><?php echo $value['promotion'] ?></a>
                                                            </div> 
                                                        </div>
                                                        <div class="product-meta text-center">
                                                            <h4 class="name"><a href="<?php echo $url ?>"><?php echo $value['name'] ?></a></h4>
                                                            <div class="price" > 
                                                                <span class="price-new"><?php echo number_format($value['price']) ?>₫</span> 
                                                                <span class="price-old">
                                                                    <?php echo ($value['price_old']!=0)?number_format($value['price_old']).'₫':'' ?> 
                                                                </span>
                                                            </div>
                                                            <div class="rating"> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>              <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                            </div>
                                                            <div class="cart pull-center">    
                                                                <input type="button" value="Thêm vào giỏ hàng" onclick="cart.addcart(<?php echo $value['id'] ?>,1);" class="button" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                              
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <?php if (count($data)>4): ?>
                                        <div class="item  products-block">
                                            <div class="row products-row">
                                                <?php foreach (array_slice($data,4) as $key => $value):?>
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 product-col">
                                                    <div class="product-block" >
                                                        <?php 
                                                            $url = url_generated::createProductUrl($value['name'], $value['id'], '-');
                                                            $image =  ROOT . '/kich-co-hinh-anh.html?src=' . ROOT . '/upload/Images/Product/' . $value['image']. '&w=230&h=230&q=100&zc=1';
                                                         ?>
                                                        <div class="image">
                                                            <a class="img" href="<?php echo $url ?>"><img src="<?php echo $image ?>" /> </a>
                                                           <div class="promotion">
                                                                <a href="<?php echo $url ?>"><?php echo $value['promotion'] ?></a>
                                                            </div>   
                                                        </div>
                                                        <div class="product-meta text-center">
                                                            <h4 class="name"><a href="<?php echo $url ?>"><?php echo $value['name'] ?></a></h4>
                                                            <div class="price"> 
                                                                <span class="price-new"><?php echo number_format($value['price']) ?>₫</span>
                                                                <span class="price-old">
                                                                    <?php echo ($value['price_old']!=0)?number_format($value['price_old']).'₫':'' ?> 
                                                                </span>
                                                            </div>
                                                            <div class="rating"> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>              <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                            </div>
                                                            <div class="cart pull-center">    
                                                                <input type="button" value="Thêm vào giỏ hàng" onclick="cart.addcart(<?php echo $value['id'] ?>,1);" class="button" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php 
                           $data = auto_loader::loadProduct($category_box3);
                           if(count($data)>0):
                        ?>
                            <div class="tab-pane cat-products-block  clearfix" id="tab-<?php echo  $cate3['id'] ?>"> <a class="carousel-control left" href="#box-<?php echo $cate3['id'] ?>" data-slide="prev">&lsaquo;</a> <a class="carousel-control right" href="#box-<?php echo $cate3['id'] ?>" data-slide="next">&rsaquo;</a>
                                <div class="box-products   slide" id="box-<?php echo $cate3['id'] ?>">
                                    <div class="carousel-inner ">
                                        <div class="item active products-block">
                                            <div class="row products-row">
                                            <?php foreach (array_slice($data,0,4) as $key => $value):?>
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 product-col">
                                                    <div class="product-block">
                                                        <?php 
                                                            $url = url_generated::createProductUrl($value['name'], $value['id'], '-');
                                                            $image =  ROOT . '/kich-co-hinh-anh.html?src=' . ROOT . '/upload/Images/Product/' . $value['image']. '&w=230&h=230&q=100&zc=1';
                                                         ?>
                                                        <div class="image">
                                                            <a class="img" href="<?php echo $url ?>"><img src="<?php echo $image ?>" /> </a>
                                                           <div class="promotion">
                                                                <a href="<?php echo $url ?>"><?php echo $value['promotion'] ?></a>
                                                            </div>   
                                                        </div>
                                                        <div class="product-meta text-center">
                                                            <h4 class="name"><a href="<?php echo $url ?>"><?php echo $value['name'] ?></a></h4>
                                                            <div class="price"> 
                                                                <span class="price-new"><?php echo number_format($value['price']) ?>₫</span> 
                                                                <span class="price-old">
                                                                    <?php echo ($value['price_old']!=0)?number_format($value['price_old']).'₫':'' ?> 
                                                                </span>
                                                            </div>
                                                            <div class="rating"> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>              <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                            </div>
                                                            <div class="cart pull-center">    
                                                                <input type="button" value="Thêm vào giỏ hàng" onclick="cart.addcart(<?php echo $value['id'] ?>,1);" class="button" />
                                                            </div>
                                                        </div>
                                                        
                                                    </div>

                                                </div>
                                            <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <?php if (count($data)>4): ?>
                                        <div class="item  products-block">
                                            <div class="row products-row">
                                                <?php foreach (array_slice($data,4) as $key => $value):?>
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 product-col">
                                                    <div class="product-block">
                                                        <?php 
                                                            $url = url_generated::createProductUrl($value['name'], $value['id'], '-');
                                                            $image =  ROOT . '/kich-co-hinh-anh.html?src=' . ROOT . '/upload/Images/Product/' . $value['image']. '&w=230&h=230&q=100&zc=1';
                                                         ?>
                                                        <div class="image">
                                                            <a class="img" href="<?php echo $url ?>"><img src="<?php echo $image ?>" /> </a>
                                                            <div class="promotion">
                                                                <a href="<?php echo $url ?>"><?php echo $value['promotion'] ?></a>
                                                            </div>  
                                                        </div>
                                                        <div class="product-meta text-center">
                                                            <h4 class="name"><a href="<?php echo $url ?>"><?php echo $value['name'] ?></a></h4>
                                                            <div class="price"> 
                                                                <span class="price-new"><?php echo number_format($value['price']) ?>₫</span> 
                                                                <span class="price-old">
                                                                    <?php echo ($value['price_old']!=0)?number_format($value['price_old']).'₫':'' ?> 
                                                                </span>
                                                            </div>
                                                            <div class="rating"> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>              <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                            </div>
                                                            <div class="cart pull-center">    
                                                                <input type="button" value="Thêm vào giỏ hàng" onclick="cart.addcart(<?php echo $value['id'] ?>,1);" class="button" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php 
                           $data = auto_loader::loadProduct($category_box4);
                           if(count($data)>0):
                        ?>
                            <div class="tab-pane cat-products-block  clearfix" id="tab-<?php echo  $cate4['id'] ?>"><a class="carousel-control left" href="#box-<?php echo $cate4['id'] ?>" data-slide="prev">&lsaquo;</a> <a class="carousel-control right" href="#box-<?php echo $cate4['id'] ?>" data-slide="next">&rsaquo;</a>
                                <div class="box-products   slide" id="box-<?php echo $cate4['id'] ?>">
                                    <div class="carousel-inner ">
                                        <div class="item active products-block">
                                            <div class="row products-row">
                                            <?php foreach (array_slice($data,0,4) as $key => $value):?>
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 product-col">
                                                    <div class="product-block">
                                                        <?php 
                                                            $url = url_generated::createProductUrl($value['name'], $value['id'], '-');
                                                            $image =  ROOT . '/kich-co-hinh-anh.html?src=' . ROOT . '/upload/Images/Product/' . $value['image']. '&w=230&h=230&q=100&zc=1';
                                                         ?>
                                                        <div class="image">
                                                            <a class="img" href="<?php echo $url ?>"><img src="<?php echo $image ?>" /> </a>
                                                            <div class="promotion">
                                                                <a href="<?php echo $url ?>"><?php echo $value['promotion'] ?></a>
                                                            </div>  
                                                        </div>
                                                        <div class="product-meta text-center">
                                                            <h4 class="name"><a href="<?php echo $url ?>"><?php echo $value['name'] ?></a></h4>
                                                            <div class="price" > 
                                                                <span class="price-new"><?php echo number_format($value['price']) ?>₫</span> 
                                                                <span class="price-old">
                                                                    <?php echo ($value['price_old']!=0)?number_format($value['price_old']).'₫':'' ?> 
                                                                </span>
                                                            </div>
                                                            <div class="rating"> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>              <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                            </div>
                                                            <div class="cart pull-center">    
                                                                <input type="button" value="Thêm vào giỏ hàng" onclick="cart.addcart(<?php echo $value['id'] ?>,1);" class="button" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <?php if (count($data)>4): ?>
                                        <div class="item  products-block">
                                            <div class="row products-row">
                                                <?php foreach (array_slice($data,4) as $key => $value):?>
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 product-col">
                                                    <div class="product-block">
                                                        <?php 
                                                            $url = url_generated::createProductUrl($value['name'], $value['id'], '-');
                                                            $image =  ROOT . '/kich-co-hinh-anh.html?src=' . ROOT . '/upload/Images/Product/' . $value['image']. '&w=230&h=230&q=100&zc=1';
                                                         ?>
                                                        <div class="image">
                                                            <a class="img" href="<?php echo $url ?>"><img src="<?php echo $image ?>" /> </a>
                                                            <div class="promotion">
                                                                <a href="<?php echo $url ?>"><?php echo $value['promotion'] ?></a>
                                                            </div>    
                                                        </div>
                                                        <div class="product-meta text-center">
                                                            <h4 class="name"><a href="<?php echo $url ?>"><?php echo $value['name'] ?></a></h4>
                                                            <div class="price"> 
                                                                <span class="price-new"><?php echo number_format($value['price']) ?>₫</span> 
                                                                <span class="price-old">
                                                                    <?php echo ($value['price_old']!=0)?number_format($value['price_old']).'₫':'' ?> 
                                                                </span>
                                                            </div>
                                                            <div class="rating"> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>              <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                                            </div>
                                                            <div class="cart pull-center">    
                                                                <input type="button" value="Thêm vào giỏ hàng" onclick="cart.addcart(<?php echo $value['id'] ?>,1);" class="button" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function() {
                        $('.box-products ').carousel({
                            interval: 5000,
                            auto: true,
                            pause: 'hover'
                        });
                        $('#producttabs a:first').tab('show');
                    });
                </script>
            </div>
        </section>
    </div>
</div>
<div class="mass-bottom " id="pavo-mass-bottom">
    <div class="container">
        <div class="row">
            <?php include_once 'templates/mass-bottom.php'; ?>
        </div>
    </div>
</div>