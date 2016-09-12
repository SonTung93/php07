<div class="footer-top">
    <div class="container">
        <div class="inner">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="social">
                        <ul>
                           <?php auto_loader::loadMenu(0,2); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $data_footer = auto_loader::loadFooter(); ?>
<div class="footer-center">
    <div class="container">
        <div class="inner">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 column">
                       <!-- <?php echo $data_footer['contact_map'] ?> -->
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 column">
                    <div class="box contact-us">
                        <div class="box-heading"><span>Liên hệ</span> </div>
                        <p><?php echo $data_footer['contact_content'] ?></p>
                        <ul>
                            <li><span class="fa fa-map-marker">&nbsp;</span><?php echo $data_footer['contact_address'] ?></li>
                            <li><span class="fa fa-mobile-phone">&nbsp;</span>Phone:<?php echo $data_footer['contact_phone'] ?></li>
                            <li><span class="fa fa-envelope">&nbsp;</span>Email:<?php echo $data_footer['contact_email'] ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 column">
                    <div id="fb-root"></div>
                    <?php echo $data_footer['contact_facebook'] ?>
                </div>
            </div>
        </div>
    </div>
</div>