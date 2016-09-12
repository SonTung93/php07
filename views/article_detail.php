<div class="container">
    <?php $list_breadcoumbs=auto_loader::$breadcrumbs; if(count($list_breadcoumbs)>0): ?>
        <ul class="breadcrumb">
            <?php foreach ($list_breadcoumbs as $key=> $value): ?>
                <li>
                    <?php echo $value ?>
                </li>
            <?php endforeach ?>
        </ul>
    <?php endif; ?>
    <?php
        $the_article = $this->result[0];
        $list_recent = $this->result[1];
    ?>
    <div class="row">        
        <section id="sidebar-main" class="col-md-9">
    		<div id="content" class="">		<!-- Start Div Content -->
        
    		<div class="pav-blog">    										
    			<div class="blog-meta">	
                    <h1><?php echo $the_article['title'] ?></h1>
    				<span class="fa fa-pencil">Đăng bởi : <?php echo $the_article['created_by'] ?>&nbsp;&nbsp;</span> 
    				<span class="fa fa-clock-o"><?php echo date_format(date_create($the_article['created']), 'd/m/Y H:i'); ?></span>
    			</div>
    				
    			<div class="blog-content clearfix">
    				<div class="content-wrap clearfix">
    				    <div class="itemFullText">
                            <?php echo $the_article['content']?>
                        </div>						
                    </div>
    		    </div>
    			<hr/>
                 <div class="blog-bottom clearfix">
    				<div class="pavcol2">
    					<h4>Bài viết liên quan</h4>
    						<ul style="list-style:square;margin-left:25px;">
                                <?php 
                                    foreach ($list_recent as $key => $value): 
                                    $url = url_generated::createArticleUrl($value['title'], $value['id'], '-');
                                ?>

                                    <li><a href="<?php echo $url ?>"><?php echo $value['title'] ?></a></li>
                                <?php endforeach ?>
    						</ul>
    				</div>
    			</div>
    				
    		</div>

    		<!-- End Div Content -->
    		</div>
    		<!-- End Div Row -->
        </section>
        <aside id="sidebar-right" class="col-md-3">
            <column id="column-right" class="hidden-xs sidebar">
                <div class="box">
                    <h3 class="box-heading"><span>Danh mục tin tức</span></h3>
                    <div class="box-content" id="pav-categorymenu" >

                         <ul class="level1  ">
                            <?php auto_loader::loadNewsCategory( '2'); ?>
                        </ul>         
                    </div>
                </div>
                <script>
                    $(document).ready(function(){
                        $("#pav-categorymenu ul").addClass("list");
                            $("#pav-categorymenu li.active span.head").addClass("selected");
                                $('#pav-categorymenu ul').Accordion({
                                    active: 'span.selected',
                                    header: 'span.head',
                                    alwaysOpen: false,
                                    animated: true,
                                    showSpeed: 400,
                                    hideSpeed: 800,
                                    event: 'click'
                                });
                    });
                </script>
            </column>        
        </aside>
    </div>
</div>