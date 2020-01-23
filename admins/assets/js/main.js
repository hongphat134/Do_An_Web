$.noConflict();

jQuery(document).ready(function($) {

	"use strict";

	[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
		new SelectFx(el);
	} );

	jQuery('.selectpicker').selectpicker;


	$('#menuToggle').on('click', function(event) {
		$('body').toggleClass('open');
	});

	$('#search-bar').css({'display':'none'});
	$('.search-trigger').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('#search-bar').slideToggle();
		//$('.search-trigger').parent('.header-left').addClass('open');
	});

	$('.search-close').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').removeClass('open');
	});

	$(window).resize(function(){
		var width = window.innerWidth
        || document.documentElement.clientWidth
		|| document.body.clientWidth;
		console.log(width);
		 if(width <576){ 
			 $('body').removeClass('open');
			 $('.navbar-brand img').css({'width':'100px'},{'height':'50px'});
		}	
	});

});


function IsDeleteOrder(){
	var result = confirm('Bạn có thật sự muốn xoá đơn hàng này ko?');
	if(result == false){ 
		alert('Bạn đã từ chối');
		//Này chưa xog
	}
}