<!DOCTYPE html>
<html lang="en">
	<?php
    $bool = 'false';

    $currentuser = new sys_currentuser();

    if ($currentuser->isLogin() > 0) {
        $bool = 'true';
    }

    if ($bool == 'false') {
        echo '<script>window.location.href = "' . ROOT . '/admin/";</script>';
    }
    ?>
<head>
    <meta charset="utf-8">
    <title><?php echo $this->temp_title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">

    <!-- <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,700' rel='stylesheet' type='text/css'> -->

    <link href="<?php echo ROOT; ?>/admin/assets/fonts/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link href="<?php echo ROOT; ?>/admin/assets/css/styles.css" type="text/css" rel="stylesheet">
    <link href="<?php echo ROOT; ?>/admin/assets/plugins/bootstrap-select/bootstrap-select.css" rel="stylesheet">
    <link href="<?php echo ROOT; ?>/admin/assets/plugins/jstree/dist/themes/avalon/style.min.css" type="text/css" rel="stylesheet">
    <link href="<?php echo ROOT; ?>/admin/assets/plugins/iCheck/skins/minimal/blue.css" type="text/css" rel="stylesheet">

</head>

<body class="infobar-offcanvas">

    <header id="topnav" class="navbar navbar-inverse navbar-fixed-top clearfix" role="banner">
        <?php include_once ( 'header.php'); ?>
    </header>

    <div id="wrapper">
        <div id="layout-static">
            <div class="static-sidebar-wrapper sidebar-default">
                <?php include_once ( 'sidebar.php'); ?>
            </div>
            <div class="static-content-wrapper">
                <div class="static-content">
                    <?php flashmessage::displayMessageError(); ?>
                    <?php flashmessage::displayMessage(); ?>
                    <?php include_once( 'content.php') ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Switcher -->
    <div class="demo-options">
        <?php include_once( 'option.php') ?>
    </div>

    <script>
        var rootpath = '<?php echo ROOT; ?>';
    </script>
    <script src="<?php echo ROOT ?>/admin/assets/js/jquery-1.10.2.min.js"></script>                          <!-- Load jQuery -->
    <script src="<?php echo ROOT ?>/admin/assets/js/jqueryui-1.9.2.min.js"></script>                             <!-- Load jQueryUI -->
    <script src="<?php echo ROOT ?>/admin/assets/js/bootstrap.min.js"></script>                              <!-- Load Bootstrap -->

    <script src="<?php echo ROOT ?>/admin/assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>   <!-- Slimscroll for custom scrolls -->
    <script src="<?php echo ROOT ?>/admin/assets/plugins/sparklines/jquery.sparklines.min.js"></script>          <!-- Sparkline -->
    <script src="<?php echo ROOT ?>/admin/assets/plugins/jstree/dist/jstree.min.js"></script>                <!-- jsTree -->

    <script src="<?php echo ROOT ?>/admin/assets/plugins/codeprettifier/prettify.js"></script>               <!-- Code Prettifier  -->
    <script src="<?php echo ROOT ?>/admin/assets/plugins/bootstrap-switch/bootstrap-switch.js"></script>         <!-- Swith/Toggle Button -->

    <script src="<?php echo ROOT ?>/admin/assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>  <!-- Bootstrap Tabdrop -->
    <script src="<?php echo ROOT; ?>/admin/assets/plugins/bootstrap-select/bootstrap-select.js"></script> <!-- Bootstrap Select -->
    <script src="<?php echo ROOT ?>/admin/assets/plugins/iCheck/icheck.min.js"></script>                         <!-- iCheck -->

    <script src="<?php echo ROOT ?>/admin/assets/js/enquire.min.js"></script>                                        <!-- Enquire for Responsiveness -->

    <script src="<?php echo ROOT ?>/admin/assets/plugins/bootbox/bootbox.js"></script>                   <!-- BOOTBOX -->

    <script src="<?php echo ROOT ?>/admin/assets/js/application.js"></script>
    
    <script src="<?php echo ROOT ?>/admin/assets/js/demo-switcher.js"></script>

    <script src="<?php echo ROOT ?>/admin/assets/plugins/powerwidgets/js/powerwidgets.js"></script>              <!-- PowerWidgets -->
    <script src="<?php echo ROOT ?>/admin/assets/plugins/switchery/switchery.js"></script>                       <!-- Switchery -->
    
    <script src="<?php echo ROOT; ?>/admin/assets/plugins/ckeditor/ckeditor.js"></script>
    <script src="<?php echo ROOT ?>/admin/assets/js/demo-index.js"></script>                                  

</body>

</html>