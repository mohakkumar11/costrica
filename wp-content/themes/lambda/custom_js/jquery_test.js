(function($) {
	$(document).ready(function() {
		$('.slidein-overlay  .global_slidein_container').addClass('si-open');
		
		$('.cp-submit').removeAttr('data-animation');

		setTimeout(function() {
			console.log('functions')
            $('.cp-animate-container .smile-animated').removeClass('cp-hide-slide');
            $('.cp-toggle-container .cp-btn-flat .slidein-center-right ').removeClass('cp-slide-hide-btn');
            $('.cp-animate-container .smile-animated').addClass('smile-slideInRight');
        }, 5000); // 2000 is in mil sec eq to 2 sec.
	})
})(jQuery);

