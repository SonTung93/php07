<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" class="ltr" lang="en">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $this->temp_title?></title>
<base href="" />

<link href="<?php echo ROOT; ?>/assets/image/catalog/cart.png" rel="icon" />
<link href="<?php echo ROOT; ?>/assets/theme/stylesheet/bootstrap.css" rel="stylesheet" />
<link href="<?php echo ROOT; ?>/assets/theme/stylesheet/stylesheet.css" rel="stylesheet" />
<link href="<?php echo ROOT; ?>/assets/theme/stylesheet/font.css" rel="stylesheet" />
<link href="<?php echo ROOT; ?>/assets/theme/stylesheet/paneltool.css" rel="stylesheet" />
<link href="<?php echo ROOT; ?>/assets/js/jquery/colorpicker/css/font-awesome.min.css" rel="stylesheet" />
<link href="<?php echo ROOT; ?>/assets/js/jquery/magnific/magnific-popup.css" rel="stylesheet" />
<link href="<?php echo ROOT; ?>/assets/theme/stylesheet/pavnewsletter.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ROOT; ?>/assets/js/jquery/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo ROOT; ?>/assets/js/jquery/magnific/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="<?php echo ROOT; ?>/assets/js/bootstrap/js/bootstrap.min.js"></script>

</head>
<body class="themecontrol-product-35 page-themecontrol-product layout-fullwidth">

<style type="text/css">
	#footer,#powered,#top, #page > header,#topbar,.products-related,.product-box-bottom{
		display: none;
	}
	.product-info {
	    box-shadow:none;
	   -webkit-box-shadow:none;
	    margin-bottom: 0;
	}
</style>


<section id="sidebar-main" class="col-md-12">
            <?php $rating = $this->result['rating'] ; ?>
            <div id="content">
                <div class="product-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 image-container">
                            <div id="img-detail" class="image">                        
                                <a href="<?php echo ROOT; ?>/upload/Images/Product/<?php echo $this->result['image'] ?>" title="Donec tellus purus" class="imagezoom">
                                    <img itemprop="image" src="<?php echo ROOT; ?>/upload/Images/Product/<?php echo $this->result['image'] ?>" title="Donec tellus purus" alt="Donec tellus purus" id="image" data-zoom-image="<?php echo ROOT; ?>/upload/Images/Product/<?php echo $this->result['image'] ?>" class="product-image-zoom img-responsive" />
                                </a>

                            </div>

                        </div>



                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                            <h1 class="title-product"><?php echo $this->result['name'] ?></h1>
                            
                            <div class="price">
                                <ul class="list-unstyled">
                                    <li><span><?php echo number_format($this->result['price']) ?></span> </li>
                                </ul>
                            </div>
                            

                            
                            <div class="rating">
                                <p>
                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                    <a href="" class="popup-with-form" ><?php echo count($rating); ?> đánh giá</a> / <a href="#review-form" class="popup-with-form" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Viết đánh giá</a>
                                </p>
                            </div>

                            <div id="product" class="product-extra">
                                <h3>Khuyến mãi</h3>
                                <div class="form-group ">
                                    <?php echo $this->result['promotion'] ?>
                                </div>
                                <h3>Thông tin</h3>
                                <div class="form-group ">
                                    <?php echo $this->result['description'] ?>
                                </div>

                                <div class="quantity-adder pull-left">
                                    Số lượng
                                    <input class="form-control" type="text" name="quantity" size="2" value="1">
                                    <span class="add-up add-action">+</span>
                                    <span class="add-down add-action">-</span>
                                </div>
                                <div class="product-action product-block">
                                    <input type="hidden" name="product_id" value="35"> &nbsp;
                                    <div class="cart pull-left">
                                        <input type="button" value="Thêm vào giỏ hàng" onclick="cart.addcart(<?php echo $this->result['id'] ?>);" class="button add-to-cart" data-href="<?php echo ROOT ?>/cart/add"/>
                                    </div>
                                </div>

                            </div>

                            <div class=" clearfix">

                            </div>

                        </div>
                    </div>

                </div>
                <div class="clearfix product-box-bottom tabs-group">
                    <ul class="nav nav-tabs border">
                        <li class="active"><a href="pav_digital_store.html#tab-description" data-toggle="tab">Description</a>
                        </li>
                        <li><a href="pav_digital_store.html#tab-review" data-toggle="tab">Reviews (0)</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-description">
                            <div>
                                <?php echo $this->result['description'] ?>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab-review">

                            <div id="review"></div>
                            <p> <a href="pav_digital_store.html#review-form" class="popup-with-form button" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Write a review</a>
                            </p>

                            <div class="hide">
                                <div id="review-form" class="panel review-form-width">
                                    <div class="panel-body">
                                        <form class="form-horizontal ">

                                            <h2>Write a review</h2>
                                            <div class="form-group required">
                                                <div class="col-sm-12">
                                                    <label class="control-label" for="input-name">Your Name</label>
                                                    <input type="text" name="name" value="" id="input-name" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <div class="col-sm-12">
                                                    <label class="control-label" for="input-review">Your Review</label>
                                                    <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                                                    <div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <div class="col-sm-12">
                                                    <label class="control-label">Rating</label>
                                                    &nbsp;&nbsp;&nbsp; Bad&nbsp;
                                                    <input type="radio" name="rating" value="1" /> &nbsp;
                                                    <input type="radio" name="rating" value="2" /> &nbsp;
                                                    <input type="radio" name="rating" value="3" /> &nbsp;
                                                    <input type="radio" name="rating" value="4" /> &nbsp;
                                                    <input type="radio" name="rating" value="5" /> &nbsp;Good
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <div class="g-recaptcha" data-sitekey="6LcTyAYTAAAAAD3hKJNuJVIZbRjJRo33MbF4qF7n"></div>
                                                </div>
                                            </div>
                                            <div class="buttons clearfix">
                                                <div class="pull-right">
                                                    <button type="button" id="button-review" data-loading-text="Loading..." class="button">Continue</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
        </section> 
<script type="text/javascript"><!--
$(document).ready(function() { 
	$('.image a').click(
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
//--></script> 
<script type="text/javascript" src="<?php echo ROOT; ?>/assets/js/jquery/elevatezoom/elevatezoom-min.js"></script>
<script type="text/javascript">
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
</body></html>