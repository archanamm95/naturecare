/*! Customized Jquery from Punit Korat.  punit@templatetrip.com  : www.templatetrip.com
Authors & copyright (c) 2016: TemplateTrip - Webzeel Services(addonScript). */
/*! NOTE: This Javascript is licensed under two options: a commercial license, a commercial OEM license and Copyright by Webzeel Services - For use Only with TemplateTrip Themes for our Customers*/

$(document).ready(function() {
	
	/* ----------- Start Templatetrip Left-col ----------- */
	
	$('.leftbar').click(function(event) {
		$(".product-category").removeClass("nav-left-open");
		$('.leftbar').removeClass('active');
	});

	$('.filter_left_button').click(function(event) { 
		$('.leftbar').toggleClass('active');
		$(".product-category").toggleClass("nav-left-open");
		$(".product-category").removeClass("nav-right-open");
		$('.rightbar').removeClass('active');
		event.stopPropagation();
	}); 
	
	/* ----------- End Templatetrip Left-col ----------- */
			
	/* ----------- Start Templatetrip right-col ----------- */

	$('.rightbar').click(function(event) {
		$(".product-category").removeClass("nav-right-open");
		$('.rightbar').removeClass('active');
	});

	$('.filter_right_button').click(function(event) { 
		$('.rightbar').toggleClass('active');
		$(".product-category").toggleClass("nav-right-open");
		$(".product-category").removeClass("nav-left-open");
		$('.leftbar').removeClass('active');
		event.stopPropagation();
	}); 
	
	/* ----------- End Templatetrip right-col ----------- */
	
	if ($( ".product-category" ).hasClass( "column_7" )){
		$("body .product-category.container" ).removeClass( "container" ).addClass( "container-fluid" );
	}
	else if ($( ".product-category" ).hasClass( "column_8" )){
			$("body .product-category.container" ).removeClass( "container" ).addClass( "container-fluid" );
	}
	else if ($( ".product-category" ).hasClass( "column_6" )){
			$("body .product-category.container" ).removeClass( "container" ).addClass( "container-fluid" );
	}

$(".filter_toggle .category-filter, .off-canvas_right_filter .category-filter,.off-canvas_left_filter .category-filter").prepend("<div class='filter-toggle col-md-1'> Filter </div>");
$(".off-canvas_right_filter .option-filter,.off-canvas_left_filter .option-filter").prepend("<span class='close-filter'><i class='material-icons icon-close'>clear</i></div>");
});		

// Documnet.ready() over....

//filter toggle js
function filter_toggle1(status) {
	if ($( ".product-category" ).hasClass( "filter_toggle" )){
		if ($(document).width() <= 991) {
			$( ".option-filter" ).insertBefore( ".category-filter" );
			$('.option-filter .option-filter-box').appendTo('.row #content .category-description');
		} 
		else {
			$( ".option-filter" ).insertAfter( ".category-filter" );
			$('.option-filter-box').appendTo('.row #content .option-filter');
		}
	}
	}
	$(document).ready(function() {
		filter_toggle1();
	});
	$(window).resize(function() {
		filter_toggle1();
	});

function filter_toggle2(status) {
	if (($( ".product-category" ).hasClass( "off-canvas_right_filter" )) || ($( ".product-category" ).hasClass( "off-canvas_left_filter" ))) {
		if ($(document).width() <= 991) {
			$( ".option-filter" ).insertBefore( ".category-filter" );
			$('.option-filter .option-filter-box').appendTo('.row #content .category-description');
		} 
		else {
			$( ".option-filter" ).insertAfter( "#content" );
			$('.option-filter-box').appendTo('.row .option-filter');
		}
	}
	}
	$(document).ready(function() {
		filter_toggle2();
	});
	$(window).resize(function() {
		filter_toggle2();
	});

	
function filter_toggle() {
	if ($( ".product-category" ).hasClass( "filter_toggle" )){
		$(".filter-toggle").click(function(){
		  $(".option-filter").slideToggle();
		});
	}	
	
	
	if ($( ".product-category" ).hasClass( "off-canvas_right_filter" )){
		$(".filter-toggle").click(function(){
		  $("body").toggleClass("off-canvas");
		});
	}
	if ($( ".product-category" ).hasClass( "off-canvas_right_filter" )){
		$(".close-filter").click(function(){
		  $("body").removeClass("off-canvas");
		});
	}
	if ($( ".product-category" ).hasClass( "off-canvas_left_filter" )){
		$(".filter-toggle").click(function(){
		  $("body").toggleClass("off-canvas");
		});
	}
	if ($( ".product-category" ).hasClass( "off-canvas_left_filter" )){
		$(".close-filter").click(function(){
		  $("body").removeClass("off-canvas");
		});
	}
}
$(document).ready(function() {
    filter_toggle();
});

function stickyleft() {
	if ($( "#product-category" ).hasClass( "column_3" )){
	if ($(document).width() <= 1199) {
		jQuery('#content, #column-left, #column-right').theiaStickySidebar({
  additionalMarginBottom: 30,
  additionalMarginTop: 30
});
	} else if ($(document).width() >= 1200) {
		jQuery('#content, #column-left, #column-right').theiaStickySidebar({
  additionalMarginBottom: 30,
  additionalMarginTop: 130
});
	}
}
	}
$(document).ready(function() {
	stickyleft();
});
$(window).resize(function() {
	stickyleft();
});