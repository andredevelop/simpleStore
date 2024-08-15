$(function(){
	
	const arrow = $('.upage-arrow');

	$('body,main').scroll(function(){
		var headerPosition = $('header').offset().top;
		if(arrow.is(':hidden')){
			arrow.fadeIn();
			arrow.click(function(){
				$('body,main').animate({'scrollTop':headerPosition},'fast');
			});
		}

		if($(window).scrollTop() == headerPosition){
			arrow.fadeOut();
		}
	})
	
})