jQuery(document).ready(function(){
    jQuery('.slider').slick({
		infinite: true,
		 speed: 500,
		  fade: true,
		  cssEase: 'linear',
		slidesToShow: 1,
		slidesToScroll: 1,
		 centerMode: true,
		focusOnSelect: true
    });
});