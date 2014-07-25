(function($){
	

	$(document).on('#sms-editor', 'keyup', function(e) {
		console.log('smoking');
	});

	$('.done-button').on('click', function(e){
		e.preventDefault();

		var done_button = $(this);

		if ( $(done_button).hasClass('disabled') )
			return false;

		var request = $.ajax({
			url: embee_task_ajax.ajaxurl,
			type: 'POST',
			data: { 
				action: 'add_done_button',
				post_id: $(done_button).data('post-id')
			},
			dataType: 'json'
		});

		request.done(function( response ) {

			if ( response.success ) {
				
				$(done_button).addClass('disabled');
				$(done_button).find('span').text( response.button_label );
				$(done_button).find('i').removeClass('fa-thumbs-o-up').addClass('fa-check-circle-o');

			} else {
				console.log( response.message )
			}

		});

	});

})(jQuery);