<?php $slider_list = auto_loader::loadBanner(0); ?>
<?php if (count($slider_list) > 0) : ?>
<div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-9  ">
            <div class="box layerslider-wrapper hidden-xs" style="max-width:873px;">
                <div class="bannercontainer banner-boxed" style="padding: 0;margin: 0;">
                    <div id="sliderlayer1204477695" class="rev_slider boxedbanner" style="width:100%;height:420px; ">
                        <ul>
                            <?php foreach ($slider_list as $key => $value) : ?>
                            <li data-masterspeed="700" data-transition="random" data-slotamount="7" data-thumb="<?php echo ROOT; ?>/upload/Images/Banner/slideshow-100x50a.png"> <img src="<?php echo ROOT; ?>/upload/Images/Banner/slideshow-873x420a.png" alt="" />
                                <!-- THE MAIN IMAGE IN THE SLIDE -->
                                <div class="caption  sfl easeInOutQuad easeInOutQuad" data-x="62" data-y="26" data-speed="300" data-start="365" data-easing="easeOutExpo"> <img src="<?php echo ROOT; ?>/upload/Images/Banner/<?php echo $value['image'] ?>" alt="" /> </div>

                                <!-- THE MAIN IMAGE IN THE SLIDE -->
                                <!-- <div class="caption large_text lft easeOutExpo  easeOutExpo " data-x="475" data-y="66" data-speed="300" data-start="1528" data-easing="easeOutExpo"> Biturei </div> -->

                                <!-- THE MAIN IMAGE IN THE SLIDE -->
                                <!-- <div class="caption small_text lfr easeOutExpo easeOutExpo " data-x="474" data-y="162" data-speed="300" data-start="2174" data-easing="easeOutExpo"> Velit in leo tempus velit in leo fermentum <br /> congue odio ac nunc sollicitudin </div> -->

                                <!-- THE MAIN IMAGE IN THE SLIDE -->
                                <!-- <div class="caption red_text bold_text lfb easeOutExpo  easeOutExpo" data-x="478" data-y="229" data-speed="300" data-start="2400" data-easing="easeOutExpo"> $2600 </div> -->

                                <!-- THE MAIN IMAGE IN THE SLIDE -->
                                <!-- <div class="caption medium_text red_text lfr easeOutExpo  easeOutExpo " data-x="475" data-y="116" data-speed="300" data-start="2400" data-easing="easeOutExpo"> Cras purus </div> -->
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!--
			##############################
			 - ACTIVATE THE BANNER HERE -
			##############################
			-->
            <script type="text/javascript">
                var tpj = jQuery;
                if (tpj.fn.cssOriginal != undefined) tpj.fn.css = tpj.fn.cssOriginal;
                tpj('#sliderlayer1204477695').revolution({
                    delay: 9000,
                    startheight: 420,
                    startwidth: 873,
                    hideThumbs: 0,
                    thumbWidth: 100,
                    thumbHeight: 50,
                    thumbAmount: 5,
                    navigationType: "bullet",
                    navigationArrows: "verticalcentered",
                    navigationStyle: "round",
                    navOffsetHorizontal: 0,
                    navOffsetVertical: 0,
                    touchenabled: "on",
                    onHoverStop: "off",
                    shuffle: "off",
                    stopAtSlide: -1,
                    stopAfterLoops: -1,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    hideSliderAtLimit: 0,
                    fullWidth: "off",
                    shadow: 0
                });
            </script>
        </div>
        <div class="col-lg-3 col-md-3  ">
            <div id="carousel1" class="box-banner box hidden-sm hidden-xs">
                <ul class="slides">
                    <?php $qc = auto_loader::loadBanner(1); ?>
                    <?php 
                        foreach ($qc as $key => $value) : 
                        $image =  ROOT . '/kich-co-hinh-anh.html?src=' . ROOT . '/upload/Images/Banner/' . $value['image']. '&w=279&h=420&q=100&zc=1';
                    ?>
                    <li><a href=""><img src="<?php echo $image ?>" alt="banner" class="img-responsive" /></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">
        <!--
        $('#carousel1').carousel({
            autoPlay: 3000,
        });
        -->
    </script>
<?php endif; ?>
