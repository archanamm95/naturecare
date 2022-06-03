jQuery(document).ready(function($){
    $('#custom-pagination-button').click(function(event) {
		event.preventDefault();
		var number = $("input[name='load-more-botton']").val();
		var category = $("input[name='more-botton-category']").val();
		var url = $("input[name='more-botton-urlcategory']").val();
		var path = $("input[name='more-botton-path']").val();
		var sort = $("input[name='more-botton-sort']").val();
		var filter = $("input[name='more-botton-filter']").val();
		var order = $("input[name='more-botton-order']").val();
		var step = $("input[name='more-botton-step']").val();
		var total = $("input[name='more-botton-totalproducts']").val();
		var display = localStorage.getItem('display');
		var cols = $('#column-right, #column-left').length;
		var variable = $("#number-products").text();
        var active = $("ul.pagination li.active span").text();
        var page = +step+1;
		$.ajax({
			type: "POST",
			url: url,
			data: {
    			number : number,
    			category : category,
    			path : path,
    			sort : sort,
            	filter : filter,
            	order : order,
            	step : step,
            	display : display,
            	cols : cols
    		},
    		beforeSend: function() {
    			$('.load-pagination').css('display', 'none');
    		},
    		success: function (response) {
            $('.load-pagination').css('display', 'block');
            if(response != '' && response != null && response !== "undefined")
            {
            	$('#load-format-pagination').append(response);
            	$('#more-step').attr('value', (+step +1));
            	if(+total*1 > (+number*1 +variable*1))
            	{
            		$('#number-products').html((+number*1 +variable*1));
            	}
            	else
            	{
            		$('#number-products').html(total);
                    $('#custom-pagination-button .title-button').css('display', 'none');
					 $('#custom-pagination-button span').css('display', 'none');
            	}
                $("ul.pagination li.active").removeClass("active");
                $("ul.pagination li a:contains("+ page +")").parent().addClass("active");            	
                $("ul.pagination li a:contains("+ page +")").click(function(event){
                  event.preventDefault();
                });           
            }
            else
            {
            	$('#custom-pagination-button .title-button').css('display', 'none');
            } 
	        }
		});

	});
});