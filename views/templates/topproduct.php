<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="box carousel slide pavcarousel hidden-xs">
                <div class="products-block">
                    <div class="products-row"> 
                    <h3 class="text-center">Top sản phẩm bán chạy nhất</h3>
                    <?php  
                        $the_product = auto_loader::loadTopProductOrder(); 
                        foreach ($the_product as $key => $value):
                            $url = url_generated::createProductUrl($value['name'], $value['id'], '-');
                            // $image =  ROOT . '/kich-co-hinh-anh.html?src=' . ROOT . '/upload/Images/Product/' . $value['image']. '&w=230&h=230&q=100&zc=1';
                            $image = ROOT . '/upload/Images/Product/' . $value['image'];
                    ?>                  
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 product-col">
                        <div class="p-label icons best-seller-label"><?php echo $key+1 ?></div>
                        <div class="product-block" >
                            <div class="image">
                                <a class="img" href="<?php echo $url ?>"><img src="<?php echo $image ?>" /> </a>
                                <div class="promotion">
                                    <a href="<?php echo $url ?>"><?php echo $value['promotion'] ?></a>
                                </div>    
                            </div>
                        </div>
                        <div class="product-meta text-center">
                            <h4 class="name"><a href="<?php echo $url ?>"><?php echo $value['name'] ?></a></h4>
                            <div class="price"> <span><?php echo number_format($value['price']) ?>₫</span> 
                            </div>
                            <div class="rating"> 
                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>     
                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> 
                            </div>
                            <div class="cart pull-center">    
                                <input type="button" value="Thêm vào giỏ hàng" onclick="cart.addcart(<?php echo $value['id'] ?>,1);" class="button" />
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>