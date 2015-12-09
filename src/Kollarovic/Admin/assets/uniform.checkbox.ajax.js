(function ($, undefined) {

	$.nette.ext('uniform', {
		complete: function () {
			
			if (!$().uniform) {
				return;
			}
			
			var test = $("input[type=checkbox]:not(.toggle, .md-check, .md-radiobtn, .make-switch, .icheck), input[type=radio]:not(.toggle, .md-check, .md-radiobtn, .star, .make-switch, .icheck)");
			if (test.size() > 0) {
				test.each(function () {
					if ($(this).parents(".checker").size() === 0) {
						$(this).show();
						$(this).uniform();
					}
				});
			}
		}
	});

})(jQuery);
