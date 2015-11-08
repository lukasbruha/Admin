(function ($, undefined) {

	$.nette.ext('dateinput', {
		complete: function () {

			$('input.datetimepicker').datetimepicker({
				duration: '',
				changeMonth: true,
				changeYear: true,
				//dateFormat: 'mm/dd/yy',
				dateFormat: 'dd.mm.yy',
				stepMinute: 5
			});


		}
	});

})(jQuery);
