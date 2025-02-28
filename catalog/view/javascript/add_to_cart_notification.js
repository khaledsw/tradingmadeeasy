function add_to_cart_notification(html) {
	$('body').prepend('<div id="cart-main-overlay" style="display:none;"></div>');
	$('body').prepend(html);
	
	center_cart();

	$('#cart-main-overlay').fadeIn('slow');
	$('#cart-overlay').fadeIn('slow');
}

$(document).on('click', '#cart-overlay-continue, #cart-main-overlay', function() {
	$('#cart-main-overlay').remove();
	$('#cart-overlay').remove();
});

$(window).scroll(function(){
	if ($('#cart-overlay').length) {
		center_cart();
	}
})

function center_cart() {
	$('#cart-main-overlay').height($('body').height());
	$('#cart-overlay').css('top', Math.max(0, (($(window).height() - $('#cart-overlay').outerHeight()) / 2) + $(window).scrollTop()) + 'px');
    $('#cart-overlay').css('left', Math.max(0, (($(window).width() - $('#cart-overlay').outerWidth()) / 2) + $(window).scrollLeft()) + 'px');
}