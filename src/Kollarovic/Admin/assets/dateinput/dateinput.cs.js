/* Czech translation for the jQuery Timepicker Addon */
/* Written by Ondřej Vodáček */
(function($) {
	$.timepicker.regional['cs'] = {
		timeOnlyTitle: 'Vyberte čas',
		timeText: 'Čas',
		hourText: 'Hodiny',
		minuteText: 'Minuty',
		secondText: 'Vteřiny',
		millisecText: 'Milisekundy',
		microsecText: 'Mikrosekundy',
		timezoneText: 'Časové pásmo',
		currentText: 'Nyní',
		closeText: 'Zavřít',
        prevText: 'Dříve',
        nextText: 'Později',
		monthNames: ['leden', 'únor', 'březen', 'duben', 'květen', 'červen', 'červenec', 'srpen','září', 'říjen', 'listopad', 'prosinec'],
        monthNamesShort: ['led', 'úno', 'bře', 'dub', 'kvě', 'čer', 'čvc', 'srp', 'zář', 'říj', 'lis', 'pro'],
        dayNames: ['neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota'],
        dayNamesShort: ['ne', 'po', 'út', 'st', 'čt', 'pá', 'so'],
        dayNamesMin: ['ne', 'po', 'út', 'st', 'čt', 'pá', 'so'],
		timeFormat: 'HH:mm',
		timeSuffix: '',		
		amNames: ['dop.', 'AM', 'A'],
		pmNames: ['odp.', 'PM', 'P'],
		isRTL: false
	};
	$.timepicker.setDefaults($.timepicker.regional['cs']);

})(jQuery);
/* Czech translation for the jQuery Timepicker Addon */
/* Written by Ondřej Vodáček */
(function($) {

	$.datepicker.regional['cs'] = {
		closeText: "Zavřít",
		prevText: "&#x3C;Dříve",
		nextText: "Později&#x3E;",
		currentText: "Nyní",
		monthNames: [ "leden","únor","březen","duben","květen","červen",
			"červenec","srpen","září","říjen","listopad","prosinec" ],
		monthNamesShort: [ "led","úno","bře","dub","kvě","čer",
			"čvc","srp","zář","říj","lis","pro" ],
		dayNames: [ "neděle", "pondělí", "úterý", "středa", "čtvrtek", "pátek", "sobota" ],
		dayNamesShort: [ "ne", "po", "út", "st", "čt", "pá", "so" ],
		dayNamesMin: [ "ne","po","út","st","čt","pá","so" ],
		weekHeader: "Týd",
		dateFormat: "dd.mm.yy",
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ""
	};
	$.datepicker.setDefaults($.timepicker.regional['cs']);

})(jQuery);