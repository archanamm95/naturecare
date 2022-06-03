/*! Customized Jquery from Punit Korat.  punit@templatetrip.com  : www.templatetrip.com
Authors & copyright (c) 2016: TemplateTrip - Webzeel Services(addonScript). */
/*! NOTE: This Javascript is licensed under two options: a commercial license, a commercial OEM license and Copyright by Webzeel Services - For use Only with TemplateTrip Themes for our Customers*/

$(document).ready(function() {
						   
	/* start cart dropdown js*/
		 jQuery('body.header_style1,body.header_style2').on('click',function(e){
			jQuery('#cart').removeClass('open');
			jQuery(".header-cart-toggle").on('click',function(e){
				$(".header-cart-toggle").slideUp("slow"); 
				$("body").removeClass("cart-open");
			});
		});
		/* end cart dropdown js*/
						   
	/* start leftmenu js */
		$(".header_style1 .leftmenu").on("click" , function(){
			$(this).toggleClass("active");
			$("body").toggleClass("nav-open");
			$(".main-category-list").toggleClass("active");
		});
		$(".header_style1 .menu-close").on("click" , function(){
			$(this).removeClass("active");
			$("body").removeClass("nav-open");
			$(".main-category-list").removeClass("active");
		});	
		
		/* start Search js*/
		 jQuery('.header_style1.header_fixed_on').on('click',function(e){
			jQuery(".close-search").on('click',function(e){
				$(".ttsearchtoggle").slideUp("slow"); 
				jQuery('#search').removeClass('active');
				$("body").removeClass("search-open");
			});
		});
		 
		/* end Search js*/
		
		
		/*$(".leftmenu_header").click(function() {
			$(".tt-menu").toggle("slide");								 
		});	  */
	 /* end leftmenu js */
	 
	 /* start footer toggle js */
		$(".header_default .footer_toggle, .header_style1 .footer_toggle, .header_style2 .footer_toggle").on("click" , function(){
			$(this).toggleClass("active");
			$("body").toggleClass("footer-open");
			$(".tt-footer").toggleClass("active");
		});
		$(".header_default .footer-close, .header_style1 .footer-close, .header_style2 .footer-close").on("click" , function(){
			$(this).removeClass("active");
			$("body").removeClass("footer-open");
			$(".tt-footer").removeClass("active");
		});	
		
		if ($("#footer-layout").hasClass( "footer_style1" )){
			$("body").addClass("footer_toggle1");
		}

	  /* end footer toggle js */
	  
	  $('.header_style1 .full-header .header-right-cms').appendTo('.header_style1 .full-header .header-left-cms .main-category-list .tt-menu');
	  
	  $('.header_style1.header_fixed_on .full-header .header-left').insertBefore('.header_style1.header_fixed_on .full-header .header-left-cms');
	  
		

	/*function menuToggle1() {
		$(".header_style2 .main-category-list .horizontal-menu ul.ul-top-items").css('display', 'none');
		$(".header_style2 .main-category-list ul.ul-top-items li.mega-menu > i").remove();
		$(".header_style2 .main-category-list ul.ul-top-items li.more-menu > i").remove();
		
		$(".header_style2 .main-category-list .TT-panel-heading").unbind("click");
		$('.header_style2 .main-category-list .TT-panel-heading').click(function(){
			$(this).parent().toggleClass('TTactive').find('ul.ul-top-items').slideToggle( "fast" );
		});

		$(".header_style2 .main-category-list ul.ul-top-items > li.mega-menu > a").after("<span class='tt_menu_item'><i class='material-icons'></i></span>");
		$(".header_style2 .main-category-list ul.ul-top-items > li.more-menu > a").after("<span class='tt_menu_item'><i class='material-icons'></i></span>");
		
	}
			
$(document).ready(function() {menuToggle1();});
$( window ).resize(function(){menuToggle1();});
$( window ).scroll(function(){menuToggle1();});

*/

$(function() {
if($('body').hasClass('header_style2') )  {
  var Accordion = function(el, multiple) {
    this.el = el || {};
    this.multiple = multiple || false;
    // Variables privadas
    var links = this.el.find('li.li-top-item .tt_menu_item');
    // Evento
    links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
  }

  Accordion.prototype.dropdown = function(e) {
    var $el = e.data.el;
    $this = $(this),
      $next = $this.next();

    $next.slideToggle();
    $this.parent().toggleClass('open');

    if (!e.data.multiple) {
      $el.find('li.li-top-item .sub-menu-container').not($next).slideUp().parent().removeClass('open');
    };
  }	

  var accordion = new Accordion($('.ul-top-items'), false);
}
});

	/* --------------- Start Sticky-header JS ---------------*/	
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
	/* --------------- Start header_style1 Sticky-header JS ---------------*/	
	function header2() {	
	 if (jQuery(window).width() > 991){
		 if (jQuery(this).scrollTop() > 500)
			{    
				jQuery('.header_style1 .header_sticky_on .full-header').addClass("fixed");
				 
			}else{
			 jQuery('.header_style1 .header_sticky_on .full-header').removeClass("fixed");
			}
		} else {
		  jQuery('.header_style1 .header_sticky_on .full-header').removeClass("fixed");
		  }
	}
	 
	$(document).ready(function(){header2();});
	jQuery(window).resize(function() {header2();});
	jQuery(window).scroll(function() {header2();});
	
	/* --------------- End header_style1 Sticky-header JS ---------------*/
	
	/* --------------- start footer-toggle JS ---------------*/
	$(".footer_style1 footer .footer_toggle").appendTo("body #page header .full-header .right-block");

	/* --------------- End footer-toggle JS ---------------*/
	
});		