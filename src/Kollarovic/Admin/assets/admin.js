$(document).ready(function () {
	$('input.datetimepicker').datetimepicker({
		duration: '',
		changeMonth: true,
		changeYear: true,
		//dateFormat: 'mm/dd/yy',
		dateFormat: 'dd.mm.yy',
		stepMinute: 5
	});


	jQuery('.login-form').show();
	jQuery('.forget-form').hide();

	jQuery('#forget-password').click(function () {
		jQuery('.login-form').hide();
		jQuery('.forget-form').show();
	});

	jQuery('#back-btn').click(function () {
		jQuery('.login-form').show();
		jQuery('.forget-form').hide();
	});

});	