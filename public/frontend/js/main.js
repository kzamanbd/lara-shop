(function($) {
	"use strict"
	
	$(window).on('load', function() {
		/*------------------
			Preloder
		--------------------*/
		$(".loader").fadeOut(); 
		$("#preloder").delay(400).fadeOut("slow");

	});

	// Mobile Nav toggle
	$('.menu-toggle > a').on('click', function (e) {
		e.preventDefault();
		$('#responsive-nav').toggleClass('active');
	})

	// Fix cart dropdown from closing
	$('.cart-dropdown').on('click', function (e) {
		e.stopPropagation();
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
	}]
  });

	// Product img zoom
	var zoomMainProduct = document.getElementById('product-main-img');
	if (zoomMainProduct) {
		$('#product-main-img .product-preview').zoom();
	}

	$(document).ready(function () {
		$('#search-input').keyup(function () {
			var search_input = $(this).val();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type:'POST',
				url:'/search/product',
				data:{search_input:search_input},
				success:function(data) {
					$('#search_result').html(data);
					$('body').click(function(){
						$('#search_result').text('');
					});
				}
			});
		});

		$('#search-input').blur(function(){

		});
	});

	/////////////////////////////////////////

})(jQuery);
