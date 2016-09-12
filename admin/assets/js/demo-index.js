jQuery(document).ready(function() {
    /****  CKE Editor  ****/
    if ($('.cke-editor').length && $.fn.ckeditor) {
        $('.cke-editor').each(function () {
            $(this).ckeditor();
        });
    }

    //Create an expression that excludes execution if parent matches certain class
    jQuery.expr[':'].noparents = function(a,i,m){
      return jQuery(a).parents(m[3]).length < 1;
    };

      //Exclude tab-right and tab-left from having tabdrop option,
      //But include in all others.
     $('.nav-tabs').filter(':noparents(.tab-right, .tab-left)').tabdrop();

    prettyPrint(); //Apply Code Prettifier

    $('.popovers').popover({container: 'body', trigger: 'hover', placement: 'top'}); //bootstrap's popover
    $('.tooltips').tooltip(); //bootstrap's tooltip
    $(".bootstrap-switch").bootstrapSwitch();

    // Custom Checkboxes
    $('.icheck input').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });


      $('ul.scrollthis').slimscroll({height: '280px'}); // Add slimscroll to topnav messeges and notifications


      //Demo JSTree

      $('#jstree-demo').jstree({
          "types" : {
              "default" : {
                  "icon" : "fa fa-folder icon-state-warning icon-lg"
              },
              "file" : {
                  "icon" : "fa fa-file icon-state-warning icon-lg"
              }
          },
          "plugins": ["types"]
      });

    $('#jstree-demo').jstree();

      //Project Switcher Demo
      $('.project-switcher-dropdown>li>a').click(function() {
        $('.project-switcher>a.btn>span').text($(this).text());
      });

      //Sparklines

      $("#currentbalance").sparkline([12700,8573,10145,21077,15380,14399,19158,17002,19201,10042], {
        type: 'bar',
        barColor: getBrandColor('inverse'),
        barSpacing: 2,
        height: '20',
        barWidth: 3
      });

      $("#salesvolume").sparkline([162700,82573,120145,91077,215380,204399,119158,140121,111312,121310], {
        type: 'bar',
        barColor: getBrandColor('inverse'),
        barSpacing: 2,
        height: '20',
        barWidth: 3
      });

      $("#infobar-revenuestats").sparkline([15700,4573,12145,11077,25380,24399,29158,17002,11201,13042], {
        type: 'bar',
        barColor: getBrandColor('inverse'),
        barSpacing: 2,
        height: '20',
        barWidth: 3
      });

      $("#infobar-unitssold").sparkline([1532,3573,2141,6077,4280,5399,6158,3002,2201,1151], {
        type: 'bar',
        barColor: getBrandColor('inverse'),
        barSpacing: 2,
        height: '20',
        barWidth: 3
      });

      $("#infobar-orders").sparkline([704,579,144,442,383,399,555,805,401,943], {
        type: 'bar',
        barColor: getBrandColor('inverse'),
        barSpacing: 2,
        height: '20',
        barWidth: 3
      });

    //Demo Background Pattern

    $(".demo-blocks").click(function(){
      $('.layout-boxed').css('background',$(this).css('background'));
      return false;
    });

  /* Does your browser support geolocation? */
  if ("geolocation" in navigator) {
    $('.js-geolocation').show(); 
  } else {
    $('.js-geolocation').hide();
  }

  /* Where in the world are you? */
  $('.js-geolocation').on('click', function() {
    navigator.geolocation.getCurrentPosition(function(position) {
      loadWeather(position.coords.latitude+','+position.coords.longitude); //load weather using your lat/lng coordinates
    });
  });
    $('#panel-advancedoptions').panels({
        localStorage: false, 
        sortable: true,
        toggleColors: true
    });

    $("#sortable-tasks, #completed-tasks").sortable({
      connectWith: ".connectedSortable",
      receive: function (event, ui) {
        $(ui.item[0]).find('.iCheck-helper')[0].dropped = true;
        $(ui.item[0]).find('.iCheck-helper').click()
      }
    }).disableSelection();

    if ($('form[name="search-form-menu"]').length > 0) {
      if ($('select[name="position"]').length > 0) {
          if ($('select[name="position"]').hasClass('table-load')) {
              $('select[name="position"]').change(function (e) {
                  window.location.href = rootpath + "/admin/menu?position=" + $(this).val();
              });
          }
      }
    }

    if ($('form[name="form-menu"]').length > 0) {
      if ($('select[name="position"]').hasClass('form-load')) {
          $('select[name="position"]').change(function (e) {
              var target = '#tags-position-' + $(this).val();

              $('.tags-position').removeClass('active');

              $(target).addClass('active');
          });
      }

      if ($('.tags').length > 0) {
          $('input.tags').on('ifChanged', function(event){
              var target = $(this).data('target');
              $('.tags-content').removeClass('active');
              $(target).addClass('active');
          });
      }
    }

    $(function () {
      var checkAll = $('input.checkbox_all');
      var checkboxes = $('input.checkbox_item');
      checkAll.on('ifChecked ifUnchecked', function(event) {        
        if (event.type == 'ifChecked') {
            checkboxes.iCheck('check');
        } else {
            checkboxes.iCheck('uncheck');
        }
      });

      checkboxes.on('ifChanged', function(event){
        if(checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
        } else {
            checkAll.removeProp('checked');
        }
        checkAll.iCheck('update');
      });
    });

    if ($('.change_status').length > 0) {
      $('.change_status').unbind('click');
      $('.change_status').click(function (event) {
          event.preventDefault();
          var status = $(this).data('status');
          var url = $(this).attr('href');
          if ($('.checkbox_item:checked').length > 0) {
              var list_id = [];
              $('.checkbox_item:checked').each(function (i, j) {
                  list_id[i] = $(this).val();
              });
              //console.log(list_id);
              var data = {'status': status, 'list_id': list_id};

              $.post(url, data, function (respon) {
                  window.location.reload();
              });
          } else {
              alert('Bạn cần chọn ít nhất 1 dòng dữ liệu !');
          }
      });
    }

    if ($('.btn-delete-data').length > 0) {
      $('.btn-delete-data').unbind('click');
      $('.btn-delete-data').click(function (event) {
          event.preventDefault();
          var check = confirm('Bạn có chắc muốn xóa ?');
          if (check == true) {
              $.post($(this).attr('href'), {id: $(this).data('id')}, function (data) {
                  if (data > 0) {
                      window.location.reload();
                  } else {
                      alert('Lỗi ! không xóa được');
                  }
              });
          }
      });
    }

    function linkUploader(ctrl) {
      if ($('textarea').length > 0) {

          if ($('textarea').hasClass('ckeditor')) {
              $().ready(function () {
                  CKEDITOR.replace('Description', {filebrowserImageUploadUrl: rootpath + '/admin/' + ctrl + '/upload_images'});
              });
          }
      }
    }

    if ($('#form-edit-article').length > 0) {
        linkUploader('article');
    }

    if ($('.file_item').length > 0) {
      $('.file_item a.remove-file').click(function (e) {

          var item_remove = $(this).data('item');

          $(this).closest('.form-group').append('<input name="file_remove[]" type="hidden" value="' + item_remove + '" />');
          
          $(this).closest('.file_item').remove();
          
          e.preventDefault();

      });
    }

    if ($('.img-preview').length > 0) {
      $('.img-preview a.remove-file').click(function (e) {
          
          var item_remove = $(this).data('item');

          $(this).closest('.form-group').append('<input name="file_remove[]" type="hidden" value="' + item_remove + '" />');
          
          $(this).closest('.img-preview').remove();
          
          e.preventDefault();

      });
    }
    if ($('select[name="category_product"]').length > 0) {
      $('select[name="category_product"]').change(function (e) {
          if ($(this).val() == '') {
              window.location.href = rootpath + "/admin/product";
          } else {
              window.location.href = rootpath + "/admin/product?category=" + $(this).val();
          }
      });
    }

    if ($('select[name="product_id"]').length > 0) {
      $('select[name="product_id"]').change(function (e) {
          if ($(this).val() == '') {
              window.location.href = rootpath + "/admin/rating";
          } else {
              window.location.href = rootpath + "/admin/rating?p_id=" + $(this).val();
          }
      });
    }
    
    $('.btn-add-attribute').click(function(event) {
      event.preventDefault();
      var html = '<div class="panel panel-default col-md-12">';
      html += '<div class="panel-heading">Attribute value</div>';
      html += ' <div class="panel-body">';
      // html += '<form action="" method="post" class="form-horizontal"  enctype="multipart/form-data" >';       
      html += '<div class="form-group">';
      html += '<label class="control-label col-md-2">Tên:</label>';
      html += '<div class="col-md-8">';
      html += '<input type="text" value="" name="name" class="form-control" required>';
      html += '</div>';
      html += '</div>';
      html += '<div class="form-group">';
      html += '<label class="control-label col-md-2">Giá trị:</label>';
      html += '<div class="col-md-8">';
      if($('select#attribute option:selected').val() ==1 ){
        html += '<input type="color" name="value" value="" ">';
      }else{
        html += '<input type="text" name="value" value="" class="form-control" >';
      }
      html += '</div>';
      html += '</div>';
      html += '<div class="form-group">';
      html += '<label class="control-label col-md-2">Ảnh chính:</label>';
      html += '<div class="col-md-8">';
      html += '<input type="file" name="image_upload" class="form-control">';
      html += '</div>';
      html += '</div>';
      html += '<div class="form-group">';
      html += '<label class="control-label col-md-2">Ảnh giới thiêu:</label>';
      html += '<div class="col-md-8">';
      html += '<input type="file" name="image_list[]" class="form-control" multiple="">';
      html += '</div>';
      html += '</div>';
      html += '<div class="form-group">';
      html += '<label class="control-label col-md-2">Price:</label>';
      html += '<div class="col-md-8">';
      html += '<input type="text" name="price" class="form-control" >';
      html += '</div>';
      html += '</div>';
      html += '<div class="form-group">';
      html += '<label class="control-label col-md-2">Status:</label>';
      html += '<div class="col-md-8">';
      html += '<div class="icheck radio col-md-2">';
      html += '<input type="radio" name="status" id="an" value="0" checked>';
      html += '<label for="an">Ẩn</label>';
      html += '</div>';
      html += '<div class="icheck radio col-md-2">';     
      html += '<input type="radio" name="status" id="hien" value="1">';
      html += '<label for="hien">Hiện</label>';
      html += '</div>';
      html += '</div>';
      html += '</div>';
      html += '<div class="form-group">';
      html += '<label class="control-label col-md-2"></label>';
      html += '<div class="col-md-8">';
      html += '<button type="submit" class="btn btn-success" name="save"><i class="fa fa-check"></i> Xác nhận</button>';
      html += '<a href="" class="btn btn-default"><i class="fa fa-sign-out"></i> Xóa</a>';
      html += '</div>';
      html += '</div>';
      // html += '</form>';
      html += '</div>';
      html += '</div>';
      
      $('.attribute').append(html); 
    });
   
    // if ($('select[name="attribute"]').length > 0) {
    //   $('select[name="attribute"]').change(function (e) {
    //       //var attribute_id = $('select#attribute option:selected').val();
    //       var attribute_id = $(this).val();
    //       $.ajax({
    //         url: '/product/load_attribute_product',
    //         type: 'post',
    //         dataType: 'text',
    //         data: {'attribute_id':attribute_id},
    //         success: function(data){
    //             //console.log(data);
    //         }
    //       });
    //   });
    // }
});          