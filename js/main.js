(function($) {
	"use strict"

	// Mobile Nav toggle
	$('.menu-toggle > a').on('click', function (e) {
		e.preventDefault();
		$('#responsive-nav').toggleClass('active');
	})

	// Fix cart dropdown from closing
	$('.cart-dropdown').on('click', function (e) {
		e.stopPropagation();
	});

	// Products Slick
	$('.products-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			infinite: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
			responsive: [{
	        breakpoint: 991,
	        settings: {
	          slidesToShow: 2,
	          slidesToScroll: 1,
	        }
	      },
	      {
	        breakpoint: 480,
	        settings: {
	          slidesToShow: 1,
	          slidesToScroll: 1,
	        }
	      },
	    ]
		});
	});

	// Products Widget Slick
	$('.products-widget-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			infinite: true,
			autoplay: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
		});
	});

	/////////////////////////////////////////

	// Product Main img Slick
	$('#product-main-img').slick({
    infinite: true,
    speed: 300,
    dots: false,
    arrows: true,
    fade: true,
    asNavFor: '#product-imgs',
  });

	// Product imgs Slick
  $('#product-imgs').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
		centerPadding: 0,
		vertical: true,
    asNavFor: '#product-main-img',
		responsive: [{
        breakpoint: 991,
        settings: {
					vertical: false,
					arrows: false,
					dots: true,
        }
      },
    ]
  });

	// Product img zoom
	var zoomMainProduct = document.getElementById('product-main-img');
	if (zoomMainProduct) {
		$('#product-main-img .product-preview').zoom();
	}

	/////////////////////////////////////////

	// Input number
	$('.input-number').each(function() {
		var $this = $(this),
		$input = $this.find('input[type="number"]'),
		up = $this.find('.qty-up'),
		down = $this.find('.qty-down');

		down.on('click', function () {
			var value = parseInt($input.val()) - 100;
			value = value < 0 ? 0 : value;
			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})

		up.on('click', function () {
			var value = parseInt($input.val()) + 100;
			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})
	});

	var priceInputMax = document.getElementById('price-max'),
		priceInputMin = document.getElementById('price-min');

	priceInputMax.addEventListener('change', function(){
		updatePriceSlider($(this).parent() , this.value)
	});

	priceInputMin.addEventListener('change', function(){
		updatePriceSlider($(this).parent() , this.value)
	});

	function updatePriceSlider(elem , value) {
		if ( elem.hasClass('price-min') ) {
			console.log('min')
			priceSlider.noUiSlider.set([value, null]);
		} else if ( elem.hasClass('price-max')) {
			console.log('max')
			priceSlider.noUiSlider.set([null, value]);
		}
	}

	// Price Slider
	var priceSlider = document.getElementById('price-slider');
	if (priceSlider) {
		noUiSlider.create(priceSlider, {
			start: [0, 50000],
			connect: true,
			step: 100,
			range: {
				'min': 0,
				'max': 50000
			}
		});

		priceSlider.noUiSlider.on('update', function( values, handle ) {
			var value = values[handle];
			handle ? priceInputMax.value = value : priceInputMin.value = value
		});
	}

})(jQuery);


function updatePriceSlider(elem , value) {
	var priceSlider = document.getElementById('price-slider');
	if ( elem.hasClass('price-min') ) {
		console.log('min')
		priceSlider.noUiSlider.set([value, null]);
	} else if ( elem.hasClass('price-max')) {
		console.log('max')
		priceSlider.noUiSlider.set([null, value]);
	}
}

$('#btn-clear').click(function(){
	// alert($('.input-checkbox'));
	var arr = $('.input-checkbox').children('input[type=checkbox]').removeAttr('checked');
	updatePriceSlider($('#price-min').parent(),0);
	updatePriceSlider($('#price-max').parent(),50000);
	for (var i = 0; i < arr.length; i++) {
		console.log(arr[i]);
	}
});

function number_format( number, decimals, dec_point, thousands_sep ) {
     var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
     var d = dec_point == undefined ? "," : dec_point;
     var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
     var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;

     return s + (j?i.substr(0,j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g,"$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2):"");
}

//Giỏ hàng = Jquery

// $('.add-to-cart-btn').each(function(index){
// 	$(this).click(function(){
// 		var id = $(this).parent().siblings('.product-body').children('.product-id').text();
// 		console.log(id);
// 		var img = $(this).parent().siblings('.product-img').children().attr('src');
// 		var name = $(this).parent().siblings('.product-body').children('.product-name').text();
// 		var price = $(this).parent().siblings('.product-body').children('.product-price').text();
// 		var quantity = 1;
// 		var total = 0;
		
// 		// alert($(this).parent().siblings('.product-img').children().attr('src'));
// 		// alert($(this).parent().siblings('.product-body').children('.product-name').text());
// 		// alert($(this).parent().siblings('.product-body').children('.product-price').text());
// 		$('div.product-widget.shopping-cart').each(function(index){
// 			//alert($(this).html());
// 			//alert($(this).children('div.product-id').text());
// 			 if($(this).children('div.product-id').text() == id){
// 				// alert('Có r');
// 			 	// alert($(this).children('div.product-body').children('h4.product-price').children('span.qty').html());				
// 				quantity = $(this).children('div.product-body').children('h4.product-price').children('span.qty').html();
// 				quantity = quantity.substring(0,quantity.length - 1);
// 				quantity++;
// 				$(this).children('div.product-body').children('h4.product-price').children('span.qty').text(quantity + 'x');
// 			 	//alert(quantity);
// 			 	//quantity++;
// 				return false;
// 			}
// 		});
// 		if(quantity == 1){
// 			$('.cart-list').append("<div class='product-widget shopping-cart'><div class='product-id' hidden>"+ id +"</div><div class='product-img'><img src='./"+ img +"' alt=''></div><div class='product-body'><h3 class='product-name'><a href='#''>"+ name +"</a></h3><h4 class='product-price'><span class='qty'>" + quantity + "x</span>"+ price +"</h4></div><button class='delete' type='button'><i class='fa fa-close'></i></button>");
// 			$('button.delete').each(function(index){
// 				$(this).click(function(){
// 					console.log('here');
// 					$(this).parent().remove();

// 					//Tính tổng tiền
// 					total = 0;
// 					$('div.product-widget.shopping-cart').each(function(index){	
// 						var str = $(this).children('div.product-body').children('h4.product-price').text();						
// 						arr = str.split('x');					
// 						quantity = arr[0];
// 						price = arr[1];
// 						do{
// 							price = price.replace(',','');
// 						}while(price.indexOf(',')!=-1);
// 						price = price.substring(0,price.length - 1);
// 						total +=  quantity * price;
// 					});
// 					var count_selectedItems = $('.cart-list').children().length;
// 					$('div.qty.cart').text(count_selectedItems);
// 					$('.cart-summary').html('<small>'+ count_selectedItems +' sản phẩm đã chọn</small><h5>tổng tiền: '+ number_format(total,0,'',',') +' đ</h5>');
// 				});
// 			});
// 		}
// 		//Tính tổng tiền
// 		$('div.product-widget.shopping-cart').each(function(index){
// 			// alert($(this).children('div.product-body').children('h4.product-price').text());
// 			var str = $(this).children('div.product-body').children('h4.product-price').text();
// 			// alert(str);
// 			arr = str.split('x');
// 			//alert(quantity);
// 			quantity = arr[0];
// 			price = arr[1];
// 			do{
// 				price = price.replace(',','');
// 			}while(price.indexOf(',')!=-1);
// 			price = price.substring(0,price.length - 1);
// 			total +=  quantity * price;
// 			// alert(quantity + ' - ' +price);

// 		});
// 		//Hiển thị số lượng sản phẩm và tổng tiền
// 		var count_selectedItems = $('.cart-list').children().length;
// 		//console.log(count_selectedItems);
// 		$('div.qty.cart').text(count_selectedItems);
// 		$('.cart-summary').html('<small>'+ count_selectedItems +' sản phẩm đã chọn</small><h5>tổng tiền: '+ number_format(total,0,'',',') +' đ</h5>');
// 	});
// });

// AJAX
function AddProductToCart(ma,ten,gia,hinh,loai,soluong = 1)
{
	if(soluong == 'y'){
		var a = $('#quantity').val();
		//Nếu a != UNDEFINED thì gán số lượng = a	
		if(a) soluong = a;
	}
	 $.ajax({
          url:'cart_ajax.php',
          data:'ma=' + ma + '&ten=' + ten + '&gia=' + gia + '&hinh=' + hinh + '&loai=' + loai + '&soluong=' + soluong + '&ac=insert',
          type:"GET",
          success:function(data)
          {
			  $('#shopping-cart').html(data);
            // alert('Đã thêm vào giỏ hàng');
          }
        });
}

function RemoveProductToCart(masp){
	$.ajax({
		url:'cart_ajax.php',
		data:'ma=' + masp + '&ac=remove',
		type:"GET",
		success:function(data)
		{
			$('#shopping-cart').html(data);
		  	alert('Đã xoá khỏi giỏ hàng');
		}
	  });
	  $.ajax({
		url:'cart_ajax_info.php',
		data:'ac=remove&type=cart',
		type:"GET",
		success:function(data)
		{
			$('#shopping-cart-detail').html(data);
		}
	  });
}
function UpdateProductToCart(masp,soluong){
	$.ajax({
		url:'cart_ajax.php',
		data:'ma=' + masp + '&soluong=' + soluong + '&ac=update',
		type:"GET",
		success:function(data)
		{
			$('#shopping-cart').html(data);
		  	//alert('Đã cập nhật giỏ hàng');
		}
	  });
	  $.ajax({
		url:'cart_ajax_info.php',
		data:'ac=update&type=cart',
		type:"GET",
		success:function(data)
		{
			 $('#shopping-cart-detail').html(data);
		}
	  });
}

function AddComment(masp){	
	var content = $("#comment-content").val();
	//var checkbox = document.getElementsByName("rating");
	var checkbox = $("input[name=rating]");
	var result = 0;
	for (var i = 0; i < checkbox.length; i++){
		if (checkbox[i].checked === true){
			result = checkbox[i].value;
		}
	}
	$.ajax({
		url:'comment_ajax.php',
		data:'content=' + content + '&rate=' + result + '&product_id=' + masp + '&ac=add',
		type:"GET",
		success:function(data)
		{			
			if(data){ 
				$('#reviews ul.reviews').append(data);
				//Load lại cái count comment đầu và đuôi				
				const val = parseInt($('#count-comment-first').html());
				$('#count-comment-first').html(val + 1);				
				$('#count-comment-last').html(val + 1);
			}
			else{ 
				$('#result').html("<div class='alert alert-warning' role='alert'>Xin vui lòng <a href='subpage/login.php' class='alert-link'>Đăng Nhập</a> để bình luận!					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");		
			}
		}
	  });
}	

function SwitchPageComment(page,masp){
	$('.reviews-pagination').each(function(index){
		$(this).children().removeClass();
	});
	$('#'+page).addClass('active');

	// alert(page + ' - ' + masp);
	$.ajax({
		url:'comment_ajax.php',
		data:'product_id=' + masp + '&page=' + page + '&ac=switch-page',
		type:"GET",
		success:function(data)
		{
			 $('#reviews').html(data);
		}
	  });
}

$('#btn-wishlist').on('click', function(event) {
		
});
function ShowWishList(){
	event.preventDefault();
	event.stopPropagation();
	$('#wishlist').slideToggle();
}

function AddProductToWishList(ma,ten,hinh)
{
	 $.ajax({
          url:'wishlist_ajax.php',
          data:'ma=' + ma + '&ten=' + ten + '&hinh=' + hinh + '&ac=insert',
          type:"GET",
          success:function(data)
          {
			  $('#wishlist').prepend(data);
            // alert('Đã thêm vào giỏ hàng');
          }
        });
}

//  Back To Top và Sticky Header
function SetDefault(){
  $(window).scroll(function(event) {
      var pos_body = $('html,body').scrollTop();
      // console.log(pos_body);
      if(pos_body > 100)
      {
      		$("#top-header").css({'padding':'0'});
      		$(".header-links li").css({'font-size':'10px'});
      		$("#header").css({'padding':'0'});
      		$(".header-logo").css({'transform':'scale(0.75)'});
      		$(".header-search").css({'padding':'0'});
      }
      else{
      		$("#top-header").css({'padding':'10px 0 10px 0'});
      		$(".header-links li").css({'font-size':'12px'});
      		$("#header").css({'padding':'15px 0 15px 0'});
      		$(".header-logo").css({'transform':'scale(1)'});
      		$(".header-search").css({'padding':'15px 0'});

      }
       if(pos_body>500){
         $('.back-to-top').addClass('hien-ra');
      }
      else{
         $('.back-to-top').removeClass('hien-ra');
      }      
   });
  $('.back-to-top').click(function(event) {
  	event.preventDefault();
  $('html,body').animate({scrollTop: 0},1400);
});
}

function flyToElement(flyer, flyingTo) {
    var $func = $(this);
        
    // Nhân bản đối tượng(hình ảnh) sẽ bay vào giỏ hàng
    var flyerClone = $(flyer).clone();
    
    // Thiết lập đối tượng nhân bản này trùng với đối tượng thực tế 
    $(flyerClone).css({
        position: 'absolute',
        top: $(flyer).offset().top + 35 + "px",
        left: $(flyer).offset().left + 35 + "px",
        opacity: 1,
        'z-index': 99999,
        width:'150px',
        height:'150px'
    }).appendTo($('body'));

    // Lấy về tọa độ của giỏ hàng
    var gotoX = $(flyingTo).offset().left;
    var gotoY = $(flyingTo).offset().top;

    // Hiệu ứng bay vào giỏ hàng
    $(flyerClone).animate({
        opacity: 0.4,
        left: gotoX,
        top: gotoY,
        width: $(flyingTo).width(),
        height: $(flyingTo).height()
    }, 700,
    function () {
         $(flyerClone).fadeOut('slow', function () {
              	 $(flyerClone).remove();
          });             
    });
}        

//Thêm sự kiện vào nút Add To Cart
$('.add-to-cart-btn').click(function(){
    var $_this = $(this);
    var itemImg = $(this).closest('.product').find('img').eq(0);
    flyToElement($(itemImg), $('#shopping-cart'));    
});
//Thêm sự kiện  vào nút WishList
$('.add-to-wishlist').click(function(){
    var $_this = $(this);
    var itemImg = $(this).closest('.product').find('img').eq(0);
    flyToElement($(itemImg), $('#shopping-cart'));    
});