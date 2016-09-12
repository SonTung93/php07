<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
    <div id="pavcarousel7" class="box carousel slide pavcarousel hidden-xs">
        <div class="box-heading hidden"> <span>Top Brand</span> </div>
        <div class="carousel-inner">
            <?php $logo = auto_loader::loadBanner(2); ?>
            <div class="item active">
                <?php 
                    foreach ($logo as $key => $value) : 
                    $image =  ROOT . '/kich-co-hinh-anh.html?src=' . ROOT . '/upload/Images/Banner/' . $value['image']. '&w=140&h=58&q=100&zc=1';
                ?>
                <div style="width:25%; float: left">
                    <div class="item-inner">
                        <a href="pav_digital_store.html#"><img src="<?php echo $image; ?>" alt="logo" /> </a>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
            <div class="item ">
                <div style="width:25%; float: left">
                    <div class="item-inner">
                        <a href="pav_digital_store.html#"><img src="<?php echo ROOT; ?>/assets/image/cache/catalog/demo/manufacturer/partner-08-140x58.png" alt="logo" /> </a>
                    </div>
                </div>
                <div style="width:25%; float: left">
                    <div class="item-inner">
                        <a href="pav_digital_store.html#"><img src="<?php echo ROOT; ?>/assets/image/cache/catalog/demo/manufacturer/partner-08-140x58.png" alt="logo" /> </a>
                    </div>
                </div>
                <div style="width:25%; float: left">
                    <div class="item-inner">
                        <a href="pav_digital_store.html#"><img src="<?php echo ROOT; ?>/assets/image/cache/catalog/demo/manufacturer/partner-08-140x58.png" alt="logo" /> </a>
                    </div>
                </div>
                <div style="width:25%; float: left">
                    <div class="item-inner">
                        <a href="pav_digital_store.html#"><img src="<?php echo ROOT; ?>/assets/image/cache/catalog/demo/manufacturer/partner-08-140x58.png" alt="logo" /> </a>
                    </div>
                </div>
            </div>
        </div> <a class="carousel-control left" href="pav_digital_store.html#pavcarousel7" data-slide="prev">&lsaquo;</a> <a class="carousel-control right" href="pav_digital_store.html#pavcarousel7" data-slide="next">&rsaquo;</a> </div>
    <script type="text/javascript">
        <!--
        $('#pavcarousel7').carousel({
            autoPlay: 3000,
        });
        -->
    </script>
</div>
