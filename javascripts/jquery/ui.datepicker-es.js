/* Inicializaci�n en espa�ol para la extensi�n 'UI date picker' para jQuery. */
/* Traducido por Vester (xvester@gmail.com). */
(function($) {
	$.datepicker.regional['es'] = {
		clearText: 'Limpiar', clearStatus: '',
		closeText: 'Cerrar', closeStatus: '',
		prevText: '&#x3c;Ant', prevStatus: '',
		prevBigText: '&#x3c;&#x3c;', prevBigStatus: '',
		nextText: 'Sig&#x3e;', nextStatus: '',
		nextBigText: '&#x3e;&#x3e;', nextBigStatus: '',
		currentText: 'Hoy', currentStatus: '',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
		'Jul','Ago','Sep','Oct','Nov','Dic'],
		monthStatus: '', yearStatus: '',
		weekHeader: 'Sm', weekStatus: '',
		dayNames: ['Domingo','Lunes','Martes','Mi�rcoles','Jueves','Viernes','S�bado'],
		dayNamesShort: ['Dom','Lun','Mar','Mi�','Juv','Vie','S�b'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S�'],
		dayStatus: 'DD', dateStatus: 'D, M d',
		dateFormat: 'dd/mm/yy', firstDay: 1,
		initStatus: '', isRTL: false,
		showMonthAfterYear: false, yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['es']);
})(jQuery);
