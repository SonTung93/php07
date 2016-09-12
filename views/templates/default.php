<!DOCTYPE html>
<html dir="ltr" class="ltr" lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->temp_title?></title>
    <base href="http://localhost:8080/php07/" />
    <link href="<?php echo ROOT; ?>/assets/image/cart.png" rel="icon" />
    <link href="<?php echo ROOT; ?>/assets/theme/stylesheet/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo ROOT; ?>/assets/theme/stylesheet/stylesheet.css" rel="stylesheet" />
    <link href="<?php echo ROOT; ?>/assets/theme/stylesheet/paneltool.css" rel="stylesheet" />
    <link href="<?php echo ROOT; ?>/assets/js/jquery/colorpicker/css/colorpicker.css" rel="stylesheet" />
    <link href="<?php echo ROOT; ?>/assets/js/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo ROOT; ?>/assets/js/jquery/magnific/magnific-popup.css" rel="stylesheet" />
    <link href="<?php echo ROOT; ?>/assets/theme/stylesheet/pavproducts.css" rel="stylesheet" />
    <link href="<?php echo ROOT; ?>/assets/theme/stylesheet/pavcarousel.css" rel="stylesheet" />
    <link href="<?php echo ROOT; ?>/assets/theme/stylesheet/pavreassurance.css" rel="stylesheet" />
    <link href="<?php echo ROOT; ?>/assets/theme/stylesheet/sliderlayer/css/typo.css" rel="stylesheet" />
    <link href="<?php echo ROOT; ?>/assets/js/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" />
    <link href="<?php echo ROOT; ?>/assets/js/jquery/owl-carousel/owl.transitions.css" rel="stylesheet" />
    <link href="<?php echo ROOT; ?>/assets/theme/stylesheet/pavnewsletter.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/js/jquery/jquery-ui-1.11.4/jquery-ui.css">
    <script type="text/javascript" src="<?php echo ROOT; ?>/assets/js/jquery/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT; ?>/assets/js/jquery/magnific/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT; ?>/assets/js/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT; ?>/assets/js/jquery/jquery-ui-1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo ROOT; ?>/assets/theme/javascript/common.js"></script>
    <script type="text/javascript" src="<?php echo ROOT; ?>/assets/js/layerslider/jquery.themepunch.plugins.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT; ?>/assets/js/layerslider/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT; ?>/assets/js/jquery/owl-carousel/owl.carousel.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT; ?>/assets/js/jquery/elevatezoom/elevatezoom-min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT; ?>/assets/js/jquery/pavblog_script.js"></script>
</head>
    
<body class="common-home page-common-home layout-fullwidth">
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    var rootpath = '<?php echo ROOT; ?>';
    </script>
    <div class="row-offcanvas row-offcanvas-left">
        <div id="page">
            <!-- header -->
            <nav id="topbar"> <?php include_once('topbar.php'); ?>  </nav>
            <header id="header-main"> <?php include_once('header.php');  ?></header>
            <!-- /header -->
            <!-- sys-notification -->
            <div id="sys-notification">
                <div class="container">
                    <div id="notification">
                         <?php flashmessage::displayMessageMainClient() ?> 
                    </div>
                </div>
            </div>
            <!-- /sys-notification -->     
            <?php include_once('content.php'); ?> 
            <footer id="footer"><?php  include_once('footer.php');  ?></footer>
            <div id="powered">
                <div class="container">
                    <div class="inner clearfix">
                        <div class="copyright pull-left"> Powered By <a href="http://www.opencart.com">OpenCart</a>
                            <br /> Your Store &copy; 2016. Design By <a href="http://www.pavothemes.com" title="pavothemes - opencart themes clubs">PavoThemes</a> </div>
                        <div class="paypal pull-right"> <img alt="" src="<?php echo ROOT; ?>/assets/image/paypal.png"> </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar-offcanvas  visible-xs visible-sm">
            <div class="offcanvas-inner panel panel-offcanvas">
                <div class="offcanvas-heading panel-heading">
                    <button data-toggle="offcanvas" class="btn btn-theme-default" type="button"> <span class="fa fa-times"></span></button>
                </div>
                <div class="offcanvas-body panel-body">
                     <div class="box category">
        <div class="box-heading"><span>Categories</span></div>
        <div class="box-content">
            <ul id="accordion" class="box-category list list-group accordion">
                <?php auto_loader::loadMenuCategory( '1'); ?>
            </ul>
        </div>
        </div>
            </div>
            <div class="offcanvas-footer panel-footer">
                <div class="input-group" id="offcanvas-search">
                  <input type="text" class="form-control" placeholder="Search" value="" name="search">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                  </span>
                </div>
            </div>
         </div> 
        </div> 

    </div>
    <div class="scrol-to-top">
        <div class="scrollup">
            <i class="fa fa-angle-double-up"></i>
        </div>
    </div>
    <script type="text/javascript">
    //for menu-bg 
    $(window).on('scroll',function(){
        if($(window).scrollTop()>550){
            $('#menu').addClass('menu-bg');
        }else{
            $('#menu').removeClass('menu-bg');
        }
    });

    //for scrolltop
    $(window).scroll(function(){
        if($(this).scrollTop()>300){
            $('.scrollup').fadeIn();
        }else{
            $('.scrollup').fadeOut();
        }
    });
    $('.scrollup').click(function(){
        $("html,body").animate({
            scrollTop:0
        },600);
        return false;
    });
</script>
</body>

</html>