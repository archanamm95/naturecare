/*! Customized Jquery from Punit Korat.  punit@templatetrip.com  : www.templatetrip.com
Authors & copyright (c) 2016: TemplateTrip - Webzeel Services(addonScript). */
/*! NOTE: This Javascript is licensed under two options: a commercial license, a commercial OEM license and Copyright by Webzeel Services - For use Only with TemplateTrip Themes for our Customers*/
/* ----------- Start Page-loader ----------- */
$(window).load(function() {
    $(".ttloading-bg").fadeOut("slow");
})
/* ----------- End Page-loader ----------- */
$(document).ready(function() {
		$(".ttsearch_button").click(function() {
			$(".header_style1.header_fixed_on #page").toggleClass("ttsearch-fixed")
			$('.ttsearchtoggle').parent().toggleClass('active');
			$('.ttsearchtoggle').toggle('fast', function() {
			});
			$('.ttsearchtoggle .input-lg').attr('autofocus', 'autofocus').focus();
			$(".account-link-toggle").slideUp("slow");
			$(".header-cart-toggle").slideUp("slow");
			$(".currency-toggle").slideUp("slow");
			$(".language-toggle").slideUp("slow");
			$("body").removeClass("user-open");
			$("body").removeClass("cart-open");
			$("body").toggleClass("search-open");
	 	});				   
			
		$(".user-info a.dropdown-toggle").click(function(){
			$( ".account-link-toggle" ).slideToggle( "fast" );
		   	$(".header-cart-toggle").slideUp("slow");
			$('.ttsearchtoggle').parent().removeClass("active");
       		$('.ttsearchtoggle').hide('fast');
			$("body").removeClass("search-open");
			$("body").removeClass("cart-open");
			$("body").toggleClass("user-open");
 	  	});
			
		$("#cart button.dropdown-toggle").click(function(){
			$( ".header-cart-toggle" ).slideToggle( "fast" );														 
		   	$(".account-link-toggle").slideUp("slow");
			$(".language-toggle").slideUp("slow");
			$(".currency-toggle").slideUp("slow");
			$("body").toggleClass("cart-open");
			$("body").removeClass("search-open");
			$("body").removeClass("user-open");
			$('.ttsearchtoggle').parent().removeClass("active");
			$('.ttsearchtoggle').hide('fast');
			$('.ttsearchtoggle').parent().removeClass("active");
       		$('.ttsearchtoggle').hide('fast');
   	    });
		
		$("#form-currency button.dropdown-toggle").click(function(){
			$( ".currency-toggle" ).slideToggle( "2000" );	
			$(".language-toggle").slideUp("slow");
			$(".account-link-toggle").slideUp("slow");
			$(".header-cart-toggle").slideUp("slow");
			$("body").removeClass("language-open");
			$("body").removeClass("user-open");
			$("body").toggleClass("currency-open");
			$("body").removeClass("search-open");

			$('.ttsearchtoggle').parent().removeClass("active");
			$('.ttsearchtoggle').hide('fast');
    	});
		
        $("#form-language button.dropdown-toggle").click(function(){
			$( ".language-toggle" ).slideToggle( "2000" );																  
			$(".currency-toggle").slideUp("fast");
			$(".account-link-toggle").slideUp("slow");
			$(".header-cart-toggle").slideUp("slow");
			$("body").removeClass("currency-open");
			$("body").removeClass("user-open");
			$("body").toggleClass("language-open");
			$("body").removeClass("search-open");

			$('.ttsearchtoggle').parent().removeClass("active");
			$('.ttsearchtoggle').hide('fast');
       	});
		
	$(".option-filter .list-group-items a").click(function() {
		$(this).toggleClass('collapsed').next('.list-group-item').slideToggle();
	});
	
	$( "#content" ).addClass( "left-column" );
	$( "body" ).addClass( "footer-toggle-menu" );


	$( "body" ).addClass( "footer-toggle-menu" );
	
	$("ul.breadcrumb li:nth-last-child(1) a").addClass('last-breadcrumb').removeAttr('href');

	$("#column-left .products-list .product-thumb, #column-right .products-list .product-thumb").unwrap();
	$("#column-left .list-products .product-thumb, #column-right .list-products .product-thumb").unwrap();

	$("#content > h1, .account-wishlist #content > h2, .account-address #content > h2, .account-download #content > h2").first().addClass("page-title");
	
	$("#content > .page-title").wrap("<div class='page-title-wrapper'><div class='container'><div class='breadcrub'></div></div></div>");
	$(".page-title-wrapper .container .breadcrub").append($("ul.breadcrumb"));
	$(".page-title-wrapper").prependTo($(".header-content-title"));

	$("#account-order #content > h2").wrap("<div class='page-title-wrapper'><div class='container'><div class='breadcrub'></div></div></div>");
	$("#account-address #content > h2").wrap("<div class='page-title-wrapper'><div class='container'><div class='breadcrub'></div></div></div>");
	$(".page-title-wrapper .container .breadcrub").append($("ul.breadcrumb"));
	$("#content > .page-title-wrapper").appendTo($("#page > .header-content-title"));
	
	$('#column-left .product-thumb .image, #column-right .product-thumb .image').attr('class', 'image col-xs-4 col-sm-4 col-md-4');
	$('#column-left .product-thumb .thumb-description, #column-right .product-thumb .thumb-description').attr('class', 'thumb-description col-xs-8 col-sm-8 col-md-8');

		$('#content .row > .product-list .product-thumb .image').attr('class', 'image col-xs-4 col-sm-4 col-md-4');
		$('#content .row > .product-list .product-thumb .thumb-description').attr('class', 'thumb-description col-xs-8 col-sm-8 col-md-8');
		$('#content .row > .product-grid .product-thumb .image').attr('class', 'image col-xs-12');
		$('#content .row > .product-grid .product-thumb .thumb-description').attr('class', 'thumb-description col-xs-12');

		$('select.form-control').wrap("<div class='select-wrapper'></div>");
		$('input[type="checkbox"]').wrap("<span class='checkbox-wrapper'></span>");
		$('input[type="checkbox"]').attr('class','checkboxid');
		// $('input[type="radio"]').wrap("<span class='radio-wrapper'></span>");
		// $('input[type="radio"]').attr('class','radioid');
		// var my = $('input[type="radio"]').value;
		 // console.log(my);

		
		$('#column-left .products-list .btn-cart').removeAttr('data-original-title');
		//$( "body.header_style2 .full-header .right-block" ).appendTo( "body.header_style2 .header-left-cms #header-left" );
		$( ".footer_style2 .follow-us" ).insertBefore( ".footer-bottom" );
		/*-------start go to top---------*/		
	$( "body" ).append( "<div class='backtotop-img'><div class='goToTop ttbox'></div></div>" );
	$( "body" ).append( "<div id='goToTop' title='Top' class='goToTop ttbox-img'></div>" );
	$("#goToTop").hide();	
/*-------end go to top---------*/		
/*---------------------- Inputtype Js Start -----------------------------*/
$('.checkboxid').change(function(){
if($(this).is(":checked")) {
$(this).addClass("chkactive");
$(this).parent().addClass('active');
} else {
$(this).removeClass("chkactive");
$(this).parent().removeClass('active');
}
});

$(function() {
var $radioButtons = $('input[type="radio"]');
$radioButtons.click(function() {
$radioButtons.each(function() {
$(this).parent().toggleClass('active', this.checked);
});
});
});
/*---------------------- Inputtype Js End -----------------------------*/

/*------------- Slider -Loader Js Strat ---------------*/
$(window).load(function() 
{ 
$(".ttloading-bg").fadeOut("slow");
})
/*------------- Slider -Loader Js End ---------------*/
/* Slider Load Spinner */
$(window).load(function() { 
	$(".slideshow-panel .ttloading-bg").removeClass("ttloader");
});

/* --------------- Start Sticky-header JS ---------------*/	
function menuClass() {
	if($( window ).width() > 1199) {
		$( ".left-main-menu" ).addClass( "left-menu" );
	}
	else {
		$( ".left-main-menu" ).removeClass( "left-menu" );
	}
}
$(document).ready(function(){menuClass();});
$(window).resize(function() {menuClass();});

	function header() {	
	 if (jQuery(window).width() > 1199){
		 if (jQuery(this).scrollTop() > 500)
			{    
				jQuery('.header_sticky_on .full-header').addClass("fixed");
				 
			}else{
			 jQuery('.header_sticky_on .full-header').removeClass("fixed");
			}
		} else {
		  jQuery('.header_sticky_on .full-header').removeClass("fixed");
		  }
	}
	 
	$(document).ready(function(){header();});
	jQuery(window).resize(function() {header();});
	jQuery(window).scroll(function() {header();});
	
/* --------------- End Sticky-header JS ---------------*/
/* --------------- Start Sticky-header JS ---------------*/
	function header() {	
	 if (jQuery(window).width() > 992){
		 if (jQuery(this).scrollTop() > 500)
			{    
				jQuery('.header_style1 .full-header').addClass("fixed");
				 
			}else{
			 jQuery('.header_style1 .full-header').removeClass("fixed");
			}
		} else {
		  jQuery('.header_style1 .full-header').removeClass("fixed");
		  }
	}
	
/* --------------- End Sticky-header JS ---------------*/
/* ----------- SmartBlog Js Start ----------- */
	if (!$( "#blog_latest_new_home" ).is('.blog_style1, .blog_style2, .blog_style3, .blog_style4')){
	 
	 var ttblog = $('#ttsmartblog-carousel').owlCarousel({
				items : 3, //1 items above 1000px browser width
				nav : false,
				dots : true,
				loop: false,
				autoplay:false,	
				rtl:false,
				responsive: {
					0:{
						items:1
					},
					481:{
						items:2
					},
					768:{
						items:2
					},
					992:{
						items:2
					},
					1250:{
						items:3
					}
				}
			});
		// Custom Navigation Events
      $(".ttblog_next").click(function(){
			ttblog.trigger('next.owl.carousel',[700]);
	  })
	  $(".ttblog_prev").click(function(){
		 	ttblog.trigger('prev.owl.carousel',[700]);
	  })
	}


	 var ttblog1 = $('.blog_style1 #ttsmartblog-carousel').owlCarousel({
				items : 3, //1 items above 1000px browser width
				nav : false,
				dots : true,
				loop: false,
				autoplay:false,	
				rtl:false,
				responsive: {
					0:{
						items:1
					},
					541:{
						items:2
					},
					768:{
						items:2
					},
					992:{
						items:3
					},
					1200:{
						items:3
					}
				}
			});

	// Custom Navigation Events

      $(".blog_style1 .ttblog_next").click(function(){
        ttblog1.trigger('owl.next');
      })
      $(".blog_style1 .ttblog_prev").click(function(){
        ttblog1.trigger('owl.prev');
      })

	  $(".blog_style1 .block_content .blog-content .blog-caption .date-comment").each(function() {
		$(this).prependTo($(this).parent().parent().parent().find(".blog-inner"));
	  });

	 var ttblog2 = $('.blog_style2 #ttsmartblog-carousel').owlCarousel({
				items : 3, //1 items above 1000px browser width
				nav : false,
				dots : true,
				loop: false,
				autoplay:false,	
				rtl:false,
				responsive: {
					0:{
						items:1
					},
					541:{
						items:2
					},
					768:{
						items:2
					},
					992:{
						items:2
					},
					1200:{
						items:2
					}
				}
	});


      // Custom Navigation Events

	$(".blog_style2 .ttblog_next").click(function(){
        ttblog2.trigger('owl.next');
      })
      $(".blog_style2 .ttblog_prev").click(function(){
        ttblog2.trigger('owl.prev');
      })

	 var ttblog3 = $('.blog_style3 #ttsmartblog-carousel').owlCarousel({
				items : 3, //1 items above 1000px browser width
				nav : false,
				dots : true,
				loop: false,
				autoplay:false,	
				rtl:false,
				responsive: {
					0:{
						items:1
					},
					608:{
						items:2
					},
					768:{
						items:2
					},
					992:{
						items:2
					},
					1200:{
						items:2
					}
				}
	});


      // Custom Navigation Events

      $(".blog_style3 .ttblog_next").click(function(){
        ttblog3.trigger('owl.next');
      })
      $(".blog_style3 .ttblog_prev").click(function(){
        ttblog3.trigger('owl.prev');
      })

/* ----------- SmartBlog Js End ----------- */	  
/*----------------- Testimonial Js Start ------------------------*/
		   	var tttestimonial = $('#tttestimonial-carousel').owlCarousel({
				items : 1, //1 items above 1000px browser width
				nav : false,
				dots : true,
				loop: false,
				autoplay:true,
				autoplaySpeed: 1000,
				smartSpeed:450,
				pagination:true,
				autoplayHoverPause:true,
				rtl:false,
				responsive: {
					0:{
						items:1
					},
					481:{
						items:1
					},
					768:{
						items:1
					},
					992:{
						items:1
					},
					1200:{
						items:1
					}
				}
			});
/*----------------- Testimonial Js End ------------------------*/

/* -----------Start carousel For Parallax ----------- */

		var ttparallax = $('.parallax-content').owlCarousel({
				items : 1, //1 items above 1000px browser width
				nav : false,
				dots : false,
				loop: false,
				autoplay:true,
				autoplaySpeed: 1000,
				smartSpeed:450,
				pagination:true,
				autoplayHoverPause:true,
				rtl:false,
				responsive: {
					0:{
						items:1
					},
					768:{
						items:1
					},
					992:{
						items:1
					},
					1200:{
						items:1
					}
				}
			});
		
				 // Custom Navigation Events
		 $(".ttparallax_prev").click(function(){
			ttparallax.trigger('prev.owl.carousel',[800]);
		  })
		  $(".ttparallax_next").click(function(){
			ttparallax.trigger('next.owl.carousel',[800]);
		  })
/*------------------- end carousel For Parallax ------------------*/
/* ----------- Start Carousel For Topcategories  ----------- */
	  var ttcategoryfeatured = $('.category-feature.tt-carousel').owlCarousel({
				items : 3, //1 items above 1000px browser width
				nav : true,
				dots : false,
				loop: true,
				autoplay: true,	
				autoplaySpeed: 700,
				autoplayHoverPause:true,
				smartSpeed:450,
				rtl:false,
				center:true,
				responsive: {
					0:{
						items:0
					},
					320:{
						items:2,
						center:false,
					},
					768:{
						items:2,
						center:false
					},
					992:{
						items:3
					},
					1200:{
						items:3
					}
				}
			});
		// Custom Navigation Events
      $(".ttcategoryfeatured_prev").click(function(){
			ttcategoryfeatured.trigger('prev.owl.carousel',[700]);
	  })
	  $(".ttcategoryfeatured_next").click(function(){
		 	ttcategoryfeatured.trigger('next.owl.carousel',[700]);
	  })
	
		$('#cat_feature .item .content .caption .cat-sub > ul').each(function(){	
			var subcat = $(this).find('li');	
			var mainul = $(this).parent().closest('.caption').find('.cat-title > h4 > a');
			var ahref = mainul.attr('href');
			var max_link = 5;	
			if ( subcat.length > max_link ) {
			$(this).append('<li class="more"><div class="tt_more-menu"><span class="categories"><a href="'+ahref+'">View All</a></span></div></li>');
			}
			subcat.each(function(j) {
			if ( j >= max_link ) { 
			$(this).css('display', 'none');
			$(this).addClass('disable');
			}
			});
		});
		
		$("#cat_feature .owl-item").hover(function(){
			$("#cat_feature .owl-item.center").addClass("changeStyle");
	  	});
		
		$( "#cat_feature .owl-item" ).mouseleave(function() {
			$( "#cat_feature .owl-item.center" ).removeClass("changeStyle");
		});

	/* ---------------- Start Carousel For Topcategories ----------------------*/	
/*-------------------------- Countdown js start ------------------------------ */
$('.tt-special-countdown .product-thumb').each(function(){
var $desc = jQuery(this).find('.thumb-description .progress');
var $qty = jQuery(this).find('#quantity');
var $pbar = jQuery(this).find('.progress-bar');
var $progress = $desc;
var $progressBar = $pbar;
var $quantity = $qty.html();
var currentWidth = parseInt($progressBar.css('width'));
var allowedWidth = parseInt($progress.css('width'));
var addedWidth = currentWidth + parseInt($quantity);
if (addedWidth > allowedWidth) {
addedWidth = allowedWidth;
}
var progress = (addedWidth / allowedWidth) * 100;
$progressBar.animate({width: progress + '%' }, 100);
});

$('#content .image-additional img').on('click',function(event) {
    var img_wrap = $(this).closest( ".product-thumb" );
    $(img_wrap).find('.special-image img').attr('src',$(event.target).data('image-large-src'));
    $('.selected').removeClass('selected');
    $(event.target).addClass('selected');
    $(img_wrap).find('.product-image img').prop('src', $(event.currentTarget).data('image-large-src'));
});

$('#content .tt-special-countdown .special-countdown.products-carousel').owlCarousel({
	items:1,
	itemsDesktop: [1200,1],
	itemsDesktopSmall: [991,1],
	itemsTablet: [767,1],
	itemsMobile: [480,1],
	navigation: true,
	autoPlay: false,
	pagination: false
});
$('#column-right .tt-special-countdown .special-countdown.products-carousel').owlCarousel({
	items:1,
	itemsDesktop: [1199,1],
	itemsDesktopSmall: [991,1],
	itemsTablet: [767,1],
	itemsMobile: [480,1],
	navigation: false,
	autoPlay: true,
	stopOnHover  : true,
	pagination: false
});
$('#column-left .tt-special-countdown .special-countdown.products-carousel').owlCarousel({
	items:1,
	itemsDesktop: [1199,1],
	itemsDesktopSmall: [991,1],
	itemsTablet: [767,1],
	itemsMobile: [480,1],
	navigation: false,
	autoPlay: true,
	stopOnHover  : true,
	pagination: false
});
$('#content .special-additional-images').owlCarousel({
	items: 2,
	itemsDesktop: [1200,2],
	itemsDesktopSmall: [991,2],
	itemsTablet: [767,3],
	itemsMobile: [480,2],
	autoPlay: true,
	stopOnHover  : true,
	navigation: false,
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
$("#column-left .tt-special-countdown .item-countdown, #column-right .tt-special-countdown .item-countdown").each(function() {
    $(this).insertAfter($(this).parent().parent().parent().find(".button-group"));
});
/*-------------------------- Countdown js End ------------------------------ */
 /*---------------- End category UP/Down JS  ---------------- */

// Carousel Counter
	colsCarousel = $('#column-right, #column-left').length;
	if (colsCarousel == 2) {
		ci=2;
	} else if (colsCarousel == 1) {
		ci=3;
	} else {
		ci=4;
}

if ($( "body" ).hasClass( "responsive_style2" )){
	$("#content .products-list .products-carousel").owlCarousel({
        items : ci, //1 items above 1000px browser width
		nav : false,
		dots : true,
		addClassActive: true,
		loop: false,
		autoplay:false,	
		autoplayHoverPause:true,
		responsive: {
			1200: {
				items: 4
			},
			992: {
				items: 3
			},
			680: {
				items: 3
			},
			320: {
				items: 2
			},
			0:   {
				items:1
			}
		}
    });
} 

// product Carousel

		initialize_owl($('#owl1'));
	
		$('a[href="#tab-featured-0"]').on('shown.bs.tab', function () {
			initialize_owl($('#owl1'));
		}).on('hide.bs.tab', function () {
			destroy_owl($('#owl1'));
		});

		initialize_owl($('#owl2'));

		$('a[href="#tab-latest-0"]').on('shown.bs.tab', function () {
			initialize_owl($('#owl2'));
		}).on('hide.bs.tab', function () {
			destroy_owl($('#owl2'));
		});

		initialize_owl($('#owl3'));
		
		$('a[href="#tab-bestseller-0"]').on('shown.bs.tab', function () {
			initialize_owl($('#owl3'));
		}).on('hide.bs.tab', function () {
			destroy_owl($('#owl3'));
		});

		initialize_owl($('#owl4'));

		$('a[href="#tab-special-0"]').on('shown.bs.tab', function () {
			initialize_owl($('#owl4'));
		}).on('hide.bs.tab', function () {
			destroy_owl($('#owl4'));
		});

/*-----------start menu toggle ------------*/
	$('.left-main-menu .TT-panel-heading').click(function() { 
		$('.left-main-menu .cat-menu').toggleClass('active'); 
		$('.left-main-menu .menu-category > ul.dropmenu').slideToggle("2000"); 
	});
/*-----------End menu toggle ------------*/
/* ------------ Start TemplateTrip Parallax JS ------------ */
	
	var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);
	if(!isMobile) {
		if($(".parallex").length){  $(".parallex").sitManParallex({  invert: false });};    
		}else{
		$(".parallex").sitManParallex({  invert: true });
	}	
	
/* ------------ End TemplateTrip Parallax JS ------------ */
	$(".ttpopupclose").click(function() {
        $("#dialog").removeClass("in");
        $("#dialog").css('display', 'none');
        $(".b-modal.__b-popup1__").remove();
        $(".newletter-popup").css('display', 'none');
    });

/* Go to Top JS START */
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 150) {
				$('.goToTop').fadeIn();
			} else {
				$('.goToTop').fadeOut();
			}
		});
	
		// scroll body to 0px on click
		$('.goToTop').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 1000);
			return false;
		});
	});
	/* Go to Top JS END */
	/* ----------- Start Templatetrip product-button js----------- */	
		if ($( "body" ).hasClass( "product_btn_style1" )){
			$(".image .ttproducthover .ttcart button").each(function() {
				$(this).insertBefore($(this).parent().parent().parent().parent().find(".image .ttproducthover .button-group .btn-wishlist"));
			});
		}	

		if ($( "body" ).hasClass( "product_btn_style2" )){
			$(".image .ttproducthover .ttcart").each(function() {
				$(this).insertAfter($(this).parent().parent().parent().parent().find(".image .ttproducthover .button-group .btn-wishlist"));
			});
			$("#content .button-group .btn-quickview").each(function() {
				$(this).appendTo($(this).parent().parent().parent().parent().find(".image .ttproducthover"));
			});
		}		

		if ($( "body" ).hasClass( "product_btn_style3" )){
			$("#content .button-group").each(function() {
				$(this).insertAfter($(this).parent().parent().parent().find(".image .ttproducthover"));
			});
			$("#content .image .button-group .btn-quickview").each(function() {
				$(this).insertAfter($(this).parent().parent().parent().find(".image .ttproducthover .ttcart"));
			});
		}	
	/* ----------- End Templatetrip product-button js----------- */	

	/* Active class in Product List Grid START */
	$('#list-view').click(function() {
		$('#grid-view').removeClass('active');
		$('#list-view').addClass('active');
		$('#content .row > .product-list .product-thumb .image').attr('class', 'image col-xs-4 col-sm-4 col-md-4');
		$('#content .row > .product-list .product-thumb .thumb-description').attr('class', 'thumb-description col-xs-8 col-sm-8 col-md-8');
		//$(".product-layout.product-list .product-thumb .button-group .btn-cart").removeAttr('data-original-title'); /* for remove tooltrip */
		$(".product_btn_style1 .product-list .product-thumb > .image > .ttproducthover").each(function() {
			$(this).appendTo($(this).parent().parent().find(".thumb-description .caption"));
		});
		$(".product_btn_style2 .product-list .product-thumb > .image > .ttproducthover > .button-group").each(function() {
			$(this).appendTo($(this).parent().parent().parent().find(".thumb-description .caption"));
		});
		$(".product_btn_style3 .product-list .product-thumb > .image > .ttproducthover").each(function() {
			$(this).appendTo($(this).parent().parent().find(".thumb-description .caption"));
		});
		$(".product_btn_style3 .product-list .product-thumb > .image > .button-group").each(function() {
			$(this).appendTo($(this).parent().parent().find(".thumb-description .caption .ttproducthover"));
		});
		$(".product_btn_style3 .product-list .product-thumb .ttproducthover .ttcart").each(function() {
			$(this).insertBefore($(this).parent().parent().parent().parent().find(".thumb-description .caption .button-group .btn-wishlist"));
		});
		$(".product_btn_style3 .product-list .product-thumb .ttproducthover .btn-quickview").each(function() {
			$(this).appendTo($(this).parent().parent().parent().parent().find(".thumb-description .caption .button-group"));
		});
		$(".product-list .product-thumb > .image > .product-countdown").each(function() {
			$(this).appendTo($(this).parent().parent().find(".thumb-description .caption .product-description"));
		});
	});
	$('#grid-view').click(function() {
		$('#list-view').removeClass('active');
		$('#grid-view').addClass('active');
		$('#content .row > .product-grid .product-thumb .image').attr('class', 'image col-xs-12');
		$('#content .row > .product-grid .product-thumb .thumb-description').attr('class', 'thumb-description col-xs-12');
		//$(".product-layout.product-grid .product-thumb .button-group .btn-cart").attr('data-original-title','Add to cart');/* for add tooltrip */
		$(".product_btn_style1 .product-grid .product-thumb > .image > .ttproducthover > .ttcart > .btn-cart ").each(function() {
			$(this).insertBefore($(this).parent().parent().parent().parent().find(".image .button-group .btn-wishlist"));
		});
		$(".product_btn_style1 .product-grid .product-thumb > .thumb-description > .caption > .ttproducthover").each(function() {
			$(this).appendTo($(this).parent().parent().parent().find(".image"));
		});
		$(".product_btn_style2 .product-grid .product-thumb > .thumb-description > .caption > .button-group").each(function() {
			$(this).appendTo($(this).parent().parent().parent().find(".image .ttproducthover"));
		});
		$(".product_btn_style3 .product-grid .product-thumb > .thumb-description > .caption > .ttproducthover").each(function() {
			$(this).appendTo($(this).parent().parent().parent().find(".image"));
		});
		$(".product_btn_style3 .product-grid .product-thumb > .image > .ttproducthover > .button-group").each(function() {
			$(this).appendTo($(this).parent().parent().parent().find(".image"));
		});
		$(".product_btn_style3 .product-grid .product-thumb > .image > .button-group > .ttcart").each(function() {
			$(this).appendTo($(this).parent().parent().parent().parent().find(".image .ttproducthover"));
		});
		$(".product_btn_style3 .product-grid .product-thumb > .image > .button-group > .btn-quickview").each(function() {
			$(this).appendTo($(this).parent().parent().parent().parent().find(".image .ttproducthover"));
		});
		$(".product-grid .product-thumb .thumb-description .caption .product-description .product-countdown").each(function() {
			$(this).appendTo($(this).parent().parent().parent().parent().find(".image"));
		});
	});
	$('#short-view').click(function() {
		$('#list-view').removeClass('active');
		$('#grid-view').removeClass('active');
		$('#short-view').addClass('active');
		$('#content .row > .product-sort .product-thumb .image').attr('class', 'image col-xs-3 col-sm-3 col-md-2');
		$('#content .row > .product-sort .product-thumb .thumb-description').attr('class', 'thumb-description col-xs-9 col-sm-9 col-md-10');
		//$(".product-layout.product-sort .product-thumb .button-group .btn-cart").attr('data-original-title','Add to cart');/* for add tooltrip */	
		$(".product_btn_style1 .product-sort .product-thumb > .image > .ttproducthover").each(function() {
			$(this).appendTo($(this).parent().parent().find(".thumb-description .caption"));
		});
		$(".product_btn_style1 .product-sort .product-thumb > .thumb-description > .caption > .ttproducthover > .ttcart").each(function() {
			$(this).insertBefore($(this).parent().parent().find(".button-group"));
		});
		$(".product_btn_style2 .product-sort .product-thumb > .image > .ttproducthover > .button-group").each(function() {
			$(this).appendTo($(this).parent().parent().parent().find(".thumb-description .caption"));
		});
		$(".product_btn_style3 .product-sort .product-thumb > .image > .ttproducthover").each(function() {
			$(this).appendTo($(this).parent().parent().parent().find(".thumb-description .caption"));
		});
		$(".product_btn_style3 .product-sort .product-thumb > .image > .button-group").each(function() {
			$(this).appendTo($(this).parent().parent().parent().find(".thumb-description .caption .ttproducthover"));
		});
		$(".product_btn_style3 .product-sort .product-thumb .thumb-description .caption .ttproducthover .btn-quickview").each(function() {
			$(this).appendTo($(this).parent().parent().parent().parent().find(".thumb-description .caption .ttproducthover .button-group"));
		});
		$(".product_btn_style3 .product-sort .product-thumb .thumb-description .caption .ttproducthover .ttcart").each(function() {
			$(this).insertBefore($(this).parent().parent().parent().parent().find(".thumb-description .caption .ttproducthover .button-group .btn-wishlist"));
		});
		$(".product-sort .product-thumb > .image > .product-countdown").each(function() {
			$(this).appendTo($(this).parent().parent().find(".thumb-description .caption .product-description"));
		});
	});

		 if (localStorage.getItem('display') == 'grid') {
			jQuery('#grid-view').trigger('click');
		  } else if (localStorage.getItem('display') == 'list'){
			jQuery('#list-view').trigger('click');
		  }
		  else if (localStorage.getItem('display') == 'sort'){
			jQuery('#short-view').trigger('click');
		  }
		  else{
			jQuery('#grid-view').trigger('click');
		  }  
	/* Active class in Product List Grid END */

});
// Documnet.ready() over....
function initialize_owl(el) {
    el.owlCarousel({
        items : ci, //1 items above 1000px browser width
		nav : false,
		dots : true,
		addClassActive: true,
		loop: false,
		autoplay:false,	
		autoplayHoverPause:true,
		responsive: {
			1200: {
				items: 4
			},
			992: {
				items: 3
			},
			680: {
				items: 3
			},
			481: {
				items: 2
			},
			0:   {
				items:1
			}
		}
    });


	// Custom Navigation Events

$(".customNavigation .next").click(function(){
	$(this).parent().parent().find(".products-carousel").trigger('next.owl.carousel',[700]);
})
$(".customNavigation .prev").click(function(){
	$(this).parent().parent().find(".products-carousel").trigger('prev.owl.carousel',[700]);
})
$(".products-list .customNavigation").addClass('owl-navigation');

}

function destroy_owl(el) {
    if(typeof el.data('owlCarousel') != 'undefined') {
		el.data('owlCarousel').destroy();
		el.removeClass('owl-carousel');
	}
}


/* ------ left-column  sticky js ---*/
function stickyleft() {
   if ($(document).width() <= 1199) {
			jQuery('#content, #column-left, #column-right').theiaStickySidebar({
	  additionalMarginBottom: 30,
	  additionalMarginTop: 60
	});
		} else if ($(document).width() >= 1200) {
			jQuery('#content, #column-left, #column-right').theiaStickySidebar({
	  additionalMarginBottom: 30,
	  additionalMarginTop: 160
	});
		}
	}
	$(document).ready(function() {
		stickyleft();
	});
	$(window).resize(function() {
		stickyleft();
	});
/* ---  end left-column stick js---*/

/*****************start animation script*******************/
function hb_animated_contents() {
	$(".hb-animate-element:in-viewport").each(function (i) {
	var $this = $(this);
	if (!$this.hasClass('hb-in-viewport')) {
	setTimeout(function () {
	$this.addClass('hb-in-viewport');
	}, 180 * i);
	}
	});
	}
	$(window).scroll(function () {
	hb_animated_contents();
	});
	$(window).load(function () {
	hb_animated_contents();
});
/*****************end animation script*******************/

/* FilterBox - Responsive Content*/
function optionFilter(){
	if ($(window).width() <= 991) {
		$('#column-left .option-filter-box').appendTo('.row #content .category-description');
		$('#column-right .option-filter-box').appendTo('.row #content .category-description');
	} else {
		$('.row #content .category-description .option-filter-box').appendTo('#column-left .option-filter');
		$('.row #content .category-description .option-filter-box').appendTo('#column-right .option-filter');
	}
}
$(document).ready(function(){ optionFilter(); });
$(window).resize(function(){ optionFilter(); });
/*category filter js*/

function footerToggle() {
	
	if($( window ).width() < 992) {
		$('.footer_default footer .bottom-footer .container .contact-us').appendTo('.footer_default footer .footer-container .container .footer-section');
		$('.footer_style2 footer .footer-container .container .footer-top .contact-us').appendTo('.footer_style2 footer .footer-container .container .content-footer');
		$("footer .footer-column h5").addClass( "toggle" );
		$(".footer_default footer .contact-us h5").addClass( "toggle" );
		$("footer .footer-column .list-unstyled").css( 'display', 'none' );
		$(".footer_default footer .contact-us .list-unstyled").css( 'display', 'none' );
		$("footer .footer-column.active .list-unstyled").css( 'display', 'block' );
		$(".footer_default footer .contact-us.active .list-unstyled").css( 'display', 'block' );
		$("footer .footer-column h5.toggle").unbind("click");
		$(".footer_default footer .contact-us h5.toggle").unbind("click");
		$("footer .footer-column h5.toggle").click(function() {
			$(this).parent().toggleClass('active').find('.list-unstyled').slideToggle( "fast" );
		});
		
		$("#column-left .panel-heading").addClass( "toggle" );
		$("#column-left .list-group").css( 'display', 'none' );
		$("#column-left .panel-default.active .list-group").css( 'display', 'block' );
		$("#column-left .panel-heading.toggle").unbind("click");
		$("#column-left .panel-heading.toggle").click(function() {
		$(this).parent().toggleClass('active').find('.list-group').slideToggle( "fast" );
		});
		
		$("#column-left .box-heading").addClass( "toggle" );
		$("#column-left .products-carousel").css( 'display', 'none' );
		$("#column-left .products-list.active .products-carousel").css( 'display', 'block' );
		$("#column-left .box-heading.toggle").unbind("click");
		$("#column-left .box-heading.toggle").click(function() {
		$(this).parent().toggleClass('active').find('.products-carousel').slideToggle( "fast" );
		});
		
		$("#column-right .panel-heading").addClass( "toggle" );
		$("#column-right .list-group").css( 'display', 'none' );
		$("#column-right .panel-default.active .list-group").css( 'display', 'block' );
		$("#column-right .panel-heading.toggle").unbind("click");
		$("#column-right .panel-heading.toggle").click(function() {
		$(this).parent().toggleClass('active').find('.list-group').slideToggle( "fast" );
		});
		
		$("#column-right .box-heading").addClass( "toggle" );
		$("#column-right .products-carousel").css( 'display', 'none' );
		$("#column-right .products-list.active .products-carousel").css( 'display', 'block' );
		$("#column-right .box-heading.toggle").unbind("click");
		$("#column-right .box-heading.toggle").click(function() {
		$(this).parent().toggleClass('active').find('.products-carousel').slideToggle( "fast" );
		});
		
	} else {
		$('.footer_default footer .footer-container .container .footer-section .contact-us').insertAfter('.footer_default footer .bottom-footer .container .block-social #ttcmsfooter');
		$('.footer_style2 footer .footer-container .container .content-footer .contact-us').appendTo('.footer_style2 footer .footer-container .container .footer-top');
		$("footer .footer-column h5.toggle").unbind("click");
		$(".footer_default footer .contact-us h5.toggle").unbind("click");
		$("footer .footer-column h5").removeClass('toggle');
		$(".footer_default footer .contact-us h5").removeClass('toggle');
		$("footer .footer-column .list-unstyled").css('display', 'block');
		$(".footer_default footer .contact-us ul.list-unstyled").css('display', 'block');
		
		$("#column-left .panel-heading").unbind("click");
		$("#column-left .panel-heading").removeClass( "toggle" );
		$("#column-left .list-group").css( 'display', 'block' );

		$("#column-left .box-heading").unbind("click");
		$("#column-left .box-heading").removeClass( "toggle" );
		$("#column-left .products-carousel").css( 'display', 'block' );
		
		$("#column-right .panel-heading").unbind("click");
		$("#column-right .panel-heading").removeClass( "toggle" );
		$("#column-right .list-group").css( 'display', 'block' );

		$("#column-right .box-heading").unbind("click");
		$("#column-right .box-heading").removeClass( "toggle" );
		$("#column-right .products-carousel").css( 'display', 'block' );
		
	}
}

$(document).ready(function() {footerToggle();});
$(window).resize(function() {footerToggle();});

/*----------- menu hover -------------------*/
$(document).ready(function(){ menuMore(); });
$(document).ready(function(){ menuMore2(); });
$(document).ready(function(){ menuMore1(); });
/*----------- menu hover -------------------*/

/* Category List - Tree View */
function categoryListTreeView() {
	$(".category-treeview li.category-li").find("ul").parent().prepend("<div class='list-tree'></div>").find("ul").css('display','none');

	$(".category-treeview li.category-li.category-active").find("ul").css('display','block');
	$(".category-treeview li.category-li.category-active").toggleClass('active');
}
$(document).ready(function() {categoryListTreeView();});


/* Category List - TreeView Toggle */
function categoryListTreeViewToggle() {
	$(".category-treeview li.category-li .list-tree").click(function() {
		$(this).parent().toggleClass('active').find('ul').slideToggle();
	});
}
$(document).ready(function() {categoryListTreeViewToggle();});
/*function menuToggle() {
	if($( window ).width() < 992) {
		$(".main-category-list .menu-category ul.dropmenu").css('display', 'none');
		
		$(".main-category-list ul.dropmenu li.dropdown > i").remove();
		$(".main-category-list ul.dropmenu .dropdown-menu ul li.dropdown-inner > i").remove();

		$(".main-category-list ul.dropmenu > li.dropdown > a").after("<i class='fa fa-angle-down'></i>");
		//$(".menu-category > li.dropdown .dropdown-inner ul > li.dropdown a.single-dropdown").after("<i class='fa fa-angle-down'></i>");
		
		$(".main-category-list ul.dropmenu > li.dropdown > span").after("<i class='fa fa-angle-down'></i>");
		
		$(".main-category-list .TT-panel-heading").unbind("click");
		$('.main-category-list .TT-panel-heading').click(function(){
			$(this).parent().toggleClass('TTactive').find('ul.dropmenu').slideToggle( "fast" );
		});
		
		$(".main-category-list ul.dropmenu > li.dropdown > i").unbind("click");
		$(".main-category-list ul.dropmenu > li.dropdown > i").click(function() {
			$(this).parent().toggleClass("active").find("ul").first().slideToggle();
		});
		
		$(".menu-category > li.dropdown .dropdown-inner ul > li.dropdown > i").unbind("click");
		$(".menu-category > li.dropdown .dropdown-inner ul > li.dropdown > i").click(function() {
			$(this).parent().toggleClass("active").find(".dropdown-menu").slideToggle();
		});
	}
	else {
		$(".menu-category > li.dropdown .dropdown-inner ul > li.dropdown > i").unbind("click");
		$(".menu-category > li.dropdown .dropdown-inner ul > li.dropdown > i").unbind("click");
		$(".main-category-list").removeClass('ttactive');
		$(".main-category-list .menu-category ul.dropmenu").css('display', 'block');
		$(".menu-category ul.dropmenu li.dropdown > i").remove();
		$(".menu-category > li.dropdown .dropdown-inner ul > li.dropdown > i").remove();
		$(".main-category-list ul.dropmenu > li.dropdown > i").remove();
	}
}
$(document).ready(function() {menuToggle();});
$( window ).resize(function(){menuToggle();});*/

/* Main Menu - MORE items */

/* Animate effect on Review Links - Product Page */
$(".product-total-review, .product-write-review").click(function() {
    $('html, body').animate({ scrollTop: $(".product-tabs").offset().top }, 1000);
});

function responsivecolumn(){
	if ($(window).width() <= 991)
	{
		$('#page > .container > .row > #column-left').appendTo('#page > .container > .row');
		$('#page > .container > .row > #column-right').appendTo('#page > .container > .row');
		
		$('#page > .container-fluid > .row > #column-left').appendTo('#page > .container-fluid > .row');
		$('#page > .container-fluid > .row > #column-right').appendTo('#page > .container-fluid > .row');
	}
	else if($(window).width() >= 992)
	{
		$('#page > .container > .row > #column-left').prependTo('#page > .container > .row');
		$('#page > .container > .row > #column-right').appendTo('#page > .container > .row');
		
		$('#page > .container-fluid > .row > #column-left').prependTo('#page > .container-fluid > .row');
		$('#page > .container-fluid > .row > #column-right').appendTo('#page > .container-fluid > .row');
	}
}
$(window).resize(function(){responsivecolumn();});
$(window).ready(function(){responsivecolumn();});
/*category filter js end*/
