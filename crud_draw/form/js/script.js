$(document).ready(function() {
	var form = $('#form');
	var submit = $('#submit');	
	var alert = $('.alert');

	form.on('submit', function(e) {
		e.preventDefault();

		$.ajax({
			url: '',
			type: 'POST',
			dataType: 'html',
			data: form.serialize(),
			beforeSend: function() {
				alert.fadeOut();
				submit.html('Sending....');
			},
			success: function(e) {
				alert.html(e).fadeIn();
				form.trigger('reset'); // reset form
				submit.html('Send Email');
			},
			error: function(e) {
				console.log(e)
			}
		});
	});
});