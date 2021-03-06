$(document).ready(function () {
	$('input.datetimepicker').datetimepicker({
		duration: '',
		changeMonth: true,
		changeYear: true,
		//dateFormat: 'mm/dd/yy',
		dateFormat: 'dd.mm.yy',
		stepMinute: 5
	});

	$('input.datepicker, input[data-provide="datepicker"]').datepicker({
		duration: '',
		changeMonth: true,
		changeYear: true,
		//dateFormat: 'mm/dd/yy',
		dateFormat: 'dd.mm.yy'
	});
	
	
	// Javascript to enable link to tab
	var hash = document.location.hash;
	var prefix = "tab_";
	if (hash) {		
		$('.nav-tabs a[href="'+hash.replace(prefix,"")+'"]').tab('show');
	} 

	//-------------------------
	// Change hash for page-reload
	$('.nav-tabs a').on('shown', function (e) {
		window.location.hash = e.target.hash.replace("#", "#" + prefix);
	});
	
	
	$('a[data-toggle="tab"]').click(function() {
		var title = $(this).text();
		$('#tab-caption').text(title);
	});
	//-------------------------


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