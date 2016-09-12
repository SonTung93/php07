<!DOCTYPE html>
<html lang="en" class="coming-soon">
<head>
    <meta charset="utf-8">
    <title><?php echo $this->temp_title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="author" content="The Red Team">

    <!-- <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet' type='text/css'> -->
    <link href="<?php echo ROOT; ?>/admin/assets/fonts/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link href="<?php echo ROOT; ?>/admin/assets/css/styles.css" type="text/css" rel="stylesheet">

</head>

<body class="focused-form">

    <div class="container" id="login-form">
        <a href="#"><img src="<?php echo ROOT; ?>/admin/assets/img/login-logo.png" class="login-logo">
        </a>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2><?php echo $this->temp_title; ?></h2>
                    </div>
                    <div class="panel-body">
                        <?php flashmessage::displayLoginMessageError(); ?>
                        <form  action="<?php echo ROOT; ?>/admin/login/submit" method="post"  class="form-horizontal">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
										<i class="fa fa-user"></i>
									</span>
                                        <input type="text" class="form-control" placeholder="Username" name="username">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
										<i class="fa fa-key"></i>
									    </span>
                                        <input type="password" class="form-control"  placeholder="Password" name="password">
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer text-center">
                                <div class="clearfix">
                                    <input type="submit" class="btn btn-success" value="&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp; ">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="<?php echo ROOT; ?>/admin/assets/js/jquery-1.10.2.min.js"></script>
    <!-- Load jQuery -->
    <script src="<?php echo ROOT; ?>/admin/assets/js/jqueryui-1.9.2.min.js"></script>
    <!-- Load jQueryUI -->
    <script src="<?php echo ROOT; ?>/admin/assets/js/bootstrap.min.js"></script>
    <!-- Load Bootstrap -->
</body>

</html>