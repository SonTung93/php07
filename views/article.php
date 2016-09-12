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
    <div class="row">
        <section id="sidebar-main" class="col-md-9">
            <div id="content">
                <div class="pav-filter-blogs">
                    <div class="pav-blogs">
                        <div class="secondary clearfix">
                			<?php foreach ($this->result as $key => $value): 
                                $url = url_generated::createArticleUrl($value['title'], $value['id'], '-');
                            ?>  
                            <div class="pavcol1">
                                <div class="blog-item">      
                                    <div class="row">
                                        <div class="blog-meta col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                            <a href="<?php echo $url ?>"><img src="<?php echo ROOT; ?>/upload/Images/Article/<?php echo $value['image'] ?>" style="width:200px;height:120px;"/></a>
                                        </div>
                                        <div class="blog-body col-lg-9 col-md-9 col-sm-8 col-xs-12">

                                            <div class="blog-header clearfix">

                                                <h3 class="blog-title">	<a href="<?php echo $url ?>" ><?php echo $value['title'] ?></a></h3>
                                            </div>
                                            <div class="description">
                                                <p>
                                                    <?php echo $value['description'] ?>...<a href="<?php echo $url ?>" ><span style="color:red">Đọc tiếp</span></a>
                                                </p>
                                            </div>
                                            <div class="blog-readmore">
                                                <ul style="list-style:none;display:flex;">        
                                                    <li class="author">
                                                        <span class="fa fa-pencil"> <?php echo $value['created_by'] ?>&nbsp;&nbsp;</span> 
                                                    </li>
                                                    <li class="created">
                                                        <span class="fa fa-clock-o"> <?php echo date_format(date_create($value['created']), 'd/m/Y H:i'); ?></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix" style="margin-bottom:25px;"></div>
                			<?php endforeach ?>
                        </div>

                        <div class="pav-pagination pagination"></div>
                    </div>
                </div>
            </div>
            <div class="paging clearfix">
                <div class="pull-left"></div>
                <div class="pull-right">
                    <?php if ($this->pagination >= 1) : ?>
                    <ul class="pagination">

                        <?php
                        $pager = pagination_calculater::pager(3, $this->page, $this->pagination);
                        $min = $pager['min'];
                        $max = $pager['max'];
                        ?>

                        <?php for ($i = $min; $i <= $max; $i++): ?>

                            <?php if ($i == $this->page) : ?>
                                <li class="active"><span ><?php echo $i; ?></span></li>
                            <?php else : ?>
                                <?php if ($this->temp_title == 'Tin tức'): ?>
                                    <li><a href="tin-tuc.html?page=<?php echo $i ?>"><?php echo $i; ?></a></li>
                                <?php else: ?>
                                    <li><a href="<?php echo url_generated::createNewsUrl($this->category_data['name'],$this->category_data['id']) ?>?page=<?php echo $i ?>"><?php echo $i; ?></a></li>
                                <?php endif ?>    
                            <?php endif; ?>

                        <?php endfor; ?>

                    </ul>
                <?php endif; ?>
                </div>
            </div>
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
    <div class="box category">
        <div class="box-heading"><span>Danh mục sản phẩm</span>
        </div>
        <div class="box-content">
            <ul id="accordion" class="box-category list list-group accordion">
                <?php auto_loader::loadMenuCategory( '1'); ?>
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