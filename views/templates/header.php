<div class="container">
    <div class="header-wrap">
        <div class="pull-left inner">
            <div id="logo-theme" class="logo-store">
                <a href="<?php echo ROOT ?>/"> <span>Your Store</span> </a>
            </div>
        </div>
        <!-- menu -->
        <div id="pav-mainnav" class="pull-right inner ">
            <div class="mainnav-wrap">
                <button data-toggle="offcanvas" class="btn button canvas-menu hidden-lg hidden-md" type="button"><span class="fa fa-bars"></span> Menu</button>
                <div class="pav-megamenu">
                    <div class="navbar">
                        <div id="mainmenutop" class="megamenu" role="navigation">
                            <div class="navbar-header">
                                <a href="javascript:;" data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
                                <div class="collapse navbar-collapse navbar-ex1-collapse">
                                    <ul class="nav navbar-nav megamenu">
                                        <?php auto_loader::loadMainMenu('0', '1'); ?>                          
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden-sm hidden-xs search" id="search">
                <div class="input-group">
                    <input type="text" name="search" id="search" placeholder="Tìm kiếm" value="" class="input-search form-control" />
                    <button class="button-search" type="button"></button>
                </div>
            </div>
        </div>
    </div>
</div>