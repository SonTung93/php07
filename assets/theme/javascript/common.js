// offcanvas menu 
$(document).ready(function () {

// Adding the clear Fix
cols1 = $('#column-right, #column-left').length;
	
if (cols1 == 2) {
	$('#content .product-layout:nth-child(2n+2)').after('<div class="clearfix visible-md visible-sm"></div>');
} else if (cols1 == 1) {
	$('#content .product-layout:nth-child(3n+3)').after('<div class="clearfix visible-lg"></div>');
} else {
	$('#content .product-layout:nth-child(4n+4)').after('<div class="clearfix"></div>');
}

  $('[data-toggle="offcanvas"]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  });

  /* Search */
  $('#offcanvas-search input[name=\'search\']').parent().find('button').on('click', function() {
    url = $('base').attr('href') + 'index.php?route=product/search';

    var value = $('header input[name=\'search\']').val();

    if (value) {
      url += '&search=' + encodeURIComponent(value);
    }

    location = url;
  });

  $('#offcanvas-search input[name=\'search\']').on('keydown', function(e) {
    if (e.keyCode == 13) {
      $('header input[name=\'search\']').parent().find('button').trigger('click');
    }
  });
});

$(document).ready(function() {
    var active = $('.collapse.in').attr('id');
    $('span[data-target=#' + active + ']').html("-");

    $('.collapse').on('show.bs.collapse', function() {
        $('span[data-target=#' + $(this).attr('id') + ']').html("-");
    });
    $('.collapse').on('hide.bs.collapse', function() {
        $('span[data-target=#' + $(this).attr('id') + ']').html("+");
    });
});

$(document).ready(function() {
  $('.product-zoom').magnificPopup({
      type: 'image',
          closeOnContentClick: true,
 
          image: {
            verticalFit: true
          }
  });

    $('.iframe-link').magnificPopup({
      type:'iframe'
    });
});

$(document).ready(function(){

	/  Fix First Click Menu /
    $(document.body).on('click', '#pav-mainnav [data-toggle="dropdown"]' ,function(){
        if(!$(this).parent().hasClass('open') && this.href && this.href != '#'){
            window.location.href = this.href;
        }

    });

    $('.dropdown-menu input').click(function(e) {
        e.stopPropagation();
    });

    // grid list switcher
    $("button.btn-switch").bind("click", function(e){
        e.preventDefault();
        var theid = $(this).attr("id");
        var row = $("#products");

        if($(this).hasClass("active")) {
            return false;
        } else {
            if(theid == "list-view"){
                $('#list-view').addClass("active");
                $('#grid-view').removeClass("active");

                // remove class list
                row.removeClass('product-grid');
                // add class gird
                row.addClass('product-list');
                
            }else if(theid =="grid-view"){
                $('#grid-view').addClass("active");
                $('#list-view').removeClass("active");

                // remove class list
                row.removeClass('product-list');
                // add class gird
                row.addClass('product-grid');

            }
        }
    });


    $(".quantity-adder .add-action").click( function(){
        if( $(this).hasClass('add-up') ) {  
            $("[name=quantity]",'.quantity-adder').val( parseInt($("[name=quantity]",'.quantity-adder').val()) + 1 );
        }else {
            if( parseInt($("[name=quantity]",'.quantity-adder').val())  > 1 ) {
                $("input",'.quantity-adder').val( parseInt($("[name=quantity]",'.quantity-adder').val()) - 1 );
            }
        }
    } );


    /****/
    $(document).ready(function() {
        $('.popup-with-form').magnificPopup({
              type: 'inline',
              preloader: false,
              focus: '#input-name',

              // When elemened is focused, some mobile browsers in some cases zoom in
              // It looks not nice, so we disable it:
              callbacks: {
                beforeOpen: function() {
                  if($(window).width() < 700) {
                    this.st.focus = false;
                  } else {
                    this.st.focus = '#input-name';
                  }
                }
              }
        });
    });

    
});

// Cart add remove functions
var cart = {
  'addcart': function(product_id, quantity) {
    var ap_id = $('.pd-box-color.active span').data('id');
    $.ajax({
      url: $('.add-to-cart').data('href'),
      type: 'post',
      data: 'product_id=' + product_id +'&ap_id='+ ap_id+'&quantity=' + (typeof(quantity) != 'undefined' ? quantity : $('input:text[name=quantity]').val()),
      dataType : 'json',
      success : function (json){
        //console.log(json);
        $('#cart-total').html(json['cart_number'] +' sitem(s) - '+json['cart_total'] +' ₫');
        $('html, body').animate({ scrollTop: 0 }, 'slow');

        $('#cart > ul').load('cart/info');
      }
    });
  },
  'update': function(key, quantity) {
    $.ajax({
      url: $('.update-cart').data('href'),
      type: 'post',
      data: 'key=' + key + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : $('input:text[name=quantity-'+key+']').val()),
      dataType : 'json',
      success: function(json) {
         window.location.reload();
      }
    });
  },
  'remove': function(key) {
    $.ajax({
      url: $('.detele-cart').data('href'),
      type: 'post',
      data: 'key=' + key,
      dataType: 'json',
      success: function(json) {
        //console.log(json);
        $('#cart-total').html(json['cart_number'] +' sitem(s) - '+json['cart_total'] +' ₫');
        if(document.URL.indexOf('cart.html') == -1){           
            $('#cart > ul').load('cart/info');
        }else{
            window.location.reload();
        }
      }
    });
  }
}

$(document).ready(function() {
  $('#loginform').submit(function(e) {
    e.preventDefault();
      var email = $('input:text[name=email]').val();
      var password = $("input:password[name=password]").val();
      if($.trim(email).length>0 && $.trim(password).length>0){
           $.ajax({
             type: "POST",
             url: 'login/submit',
             data: $(this).serialize(),
             success: function(data)
             {
                //console.log(data);
                var result = $.trim(data);
                if (result === 'Login') {
                    window.location.reload();
                }else {
                  $('.message').text('Email hoặc mật khẩu không đúng !');
                }
             }
         });
      }else{
          $('.message').text('Hãy nhập email và mật khẩu');
      }
 });
  // function isEmail(email) {
  //   var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  //   return regex.test(email);
  // }
  // $('#email').keyup(function(event) {
  //     if(!isEmail($(this).val())){
  //       $('#error').text('Email không đúng định dạng !')
  //     }else{
  //       $('#error').text('');
  //     }
  // });
  // $('#created').submit(function(e) {
  //     e.preventDefault();
  //     var email = $('#email').val();
  //     var phone = $('$phone').val();
  //     if(!isEmail(email)){
  //       $('#error').text('Email không đúng định dạng !')
  //     }
  // });
});

$(document).ready(function(){  
    $( "input#search" ).autocomplete({
        source:'home/search',
        select: function( event, ui ) { 
            $("input#search").val("");
            $("input#search").val(ui.item.label);
            window.location.href = ui.item.value;
            return false;
        }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
      .append( "<a>" + item.label + "</a>" )      
      .appendTo( ul );
    };

});

$(document).ready(function(){  
  
  
  $('.pd-box-color').click(function(event) {
      event.preventDefault();
      $('.pd-box-color').removeClass('active');
      $(this).addClass('active');
      var id = $('.pd-box-color.active span').data('id');
      $.ajax({
             type: "POST",
             url: 'product/loadInfo',
             data: {'id':id},
             dataType: 'json',
             success: function(data)
             {
                //console.log(data);
                var src = rootpath+'/upload/Images/Attribute_Product/' +data['image'] ;  
                $('#image').data("zoom-image",src);
                $('#image').attr("src",src);
                $( zoomCollection ).elevateZoom({
                    lensShape : "basic",
                    lensSize    : 150,
                    easing:true,
                    gallery:'image-additional-carousel',
                    cursor: 'pointer',
                    galleryActiveClass: "active"
                });

                if(data['price'] != 0){
                  $('span.price-add').remove();
                  $('.price').append('<span class="price-add"> +'+data['price']+'₫</span>');
                }else{
                  $('span.price-add').remove();
                }

                if(data['image_list'] != ''){
                var list = data['image_list'].split('###');
                var html = '';
                $.each(list, function(index, val) {
                  var link = rootpath+'/upload/Files/Attribute_Product/' +val ;
                  $('.imagezoom:eq('+(index+1)+')').data("image",link);
                  $('.imagezoom:eq('+(index+1)+')').find('img').attr("src",link);
                  $('#image_list:eq('+(index+1)+')').data("zoom-image",link);
                });
              }
            }
      });
  });

  $('#table-cart > tbody > tr').each(function(index) {  
        abc(this);
        // $(this).click(function(event) {
        //   alert(index);
        // });
  });
});

function abc(obj) {

  if ($('#table-cart > tbody > tr').length > 0) {
    var list_id = [];
    $('.tab-color ul li.active span').each(function (i, j) {
        list_id[i] = {'id':$(this).data('id'),'ap_id':$(this).data('ap-id'),'quantity':$('input:text[name=quantity-'+$(this).data('ap-id')+']').val()};
    });
  $(obj).find('td .tab-color ul li').unbind('click');
  $(obj).find('td .tab-color ul li').on('click',function(event) {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');       
            $('.tab-color ul li.active span').each(function (i, j) {
                list_id[i]['ap_id'] = $(this).data('ap-id');
            });
            //console.log(list_id);
            $.ajax({
               type: "POST",
               url: 'cart/loadcart',
               data: {'list_id':list_id},
               dataType: 'text',
               success: function(data)
               {  
                  window.location.reload();
                  //console.log(data);
                  // $('#table-cart>tbody').html(data);
                  // $('.price-total').text($('input:hidden[name=price]').val());
               }
            }); 
            
        }); 
    }
}