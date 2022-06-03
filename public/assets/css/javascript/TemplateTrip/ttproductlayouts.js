/*! Customized Jquery from Punit Korat.  punit@templatetrip.com  : www.templatetrip.com
Authors & copyright (c) 2016: TemplateTrip - Webzeel Services(addonScript). */
/*! NOTE: This Javascript is licensed under two options: a commercial license, a commercial OEM license and Copyright by Webzeel Services - For use Only with TemplateTrip Themes for our Customers*/

$(document).ready(function() {

	
	  var productextended = $('.product_extended .product-product .additional-images').owlCarousel({
				items : 3, //1 items above 1000px browser width
				nav : true,
				dots : false,
				loop: true,
				center: true,
				autoplay:true,
				stopOnHover : true,
				rtl:false,
				responsive: {
					0:{
						items:1
					},
					481:{
						items:2,
						center: false,
					},
					768:{
						items:3
					},
					992:{
						items:3
					},
					1400:{
						items:3
					}
				}
			});


	if (!$( "body" ).is('.product_grid_images, .product_sticky_right, .product_compact')){
	$('.additional-images').owlCarousel({
		items: 3,
		itemsDesktop: [1199,2],
		itemsDesktopSmall: [991,2],
		itemsTablet: [767,3],
		itemsMobile: [480,2],
		autoPlay: false,
		navigation: true,
		pagination: false
	});
	// Custom Navigation Events
	$(".additional-next").click(function(){
		$(".additional-images").trigger('owl.next');
	})
	$(".additional-prev").click(function(){
		$(".additional-images").trigger('owl.prev');
	})
	$(".additional-images-container .customNavigation").addClass('owl-navigation');
	}
	
	if (($( "body" ).hasClass( "product_grid_images" )) || ($( "body" ).hasClass( "product_sticky_right" ))){
		$( ".product-details" ).wrapInner( "<div class='fixed-product-block'></div>");
	}
	
	
	$('.product_compact .product-product .additional-images').slick({
	  vertical: true,
	   slidesToShow: 3,
	   slidesToScroll: 1,
	   dots: false,
	   arrows: true,
	   prevArrow: '<button type="button" class="slick-prev"><i class="material-icons">keyboard_arrow_left</i></button>',
	   nextArrow: '<button type="button" class="slick-next"><i class="material-icons">keyboard_arrow_right</i></button>',
	   autoplay: false,
	   autoplaySpeed: 6000,
	   centerMode: true,
	   centerPadding: '0',
	   focusOnSelect: true
	 });
	
	
});		
// Documnet.ready() over....

		function fixed_productblock(){
			if( jQuery(window).width() < 768 ) return;
		
			if ( jQuery( '.fixed-product-block' ).height() > jQuery( '.product-images' ).height() ) return;
		
			jQuery('.fixed-product-block').each(function() {
				var el = jQuery(this),
				parent = el.parent(),
				heightOffsetEl = jQuery('.product-images'),
				parentHeight = heightOffsetEl.outerHeight(),
				firstImg = heightOffsetEl.find('img').first(),
				firstImgHeight = firstImg.outerHeight();
		
				jQuery(window).resize(function() {
					parentHeight = heightOffsetEl.outerHeight();
					firstImgHeight = firstImg.outerHeight();
					el.css({
						'maxWidth': parent.width(),
						'minHeight': firstImgHeight
					});
					parent.height(parentHeight);
				});
		
				jQuery(window).resize();
		
				jQuery(this).stick_in_parent({
					offset_top: 120
				});
				
		
			});
		}
		jQuery( window ).scroll(function() {  
			fixed_productblock();
		});
