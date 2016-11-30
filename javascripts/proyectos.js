/*
	"sLengthMenu": 'Display <select><option value="10">10</option><option value="20">20</option><option value="30">30</option><option value="40">40</option><option value="50">50</option><option value="-1">All</option></select> records'
*/	

var dataTable_oLanguage = {
	"sProcessing": "Procesando...",
	"sLengthMenu": "Mostrar _MENU_  registros",
	"sZeroRecords": "No se ha encontrado ninguna coincidencia",
	"sInfo": "Total _TOTAL_ registro(s)",
	"sInfoEmpty": "Mostrando 0 registros",
	"sInfoFiltered": " de un total de _MAX_ registros",
	"sInfoPostFix": "",
	"sSearch": "Filtro:",
	"sUrl": "",
	"oPaginate": {
		"sFirst":    "Primero",
		"sPrevious": "Anterior",
		"sNext":     "Siguiente",
		"sLast":     "Ultimo"
	}
};

/* Inicialización en español para la extensión 'UI date picker' para jQuery. */
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
		dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
		dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
		dayStatus: 'DD', dateStatus: 'D, M d',
		dateFormat: 'yyyy-mm-dd', 
		firstDay: 1,
		initStatus: '', isRTL: false,
        changeMonth: true,
        changeYear: true,
		maxDate: 0,
		showMonthAfterYear: false, yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['es']);
})(jQuery);

function trim(str) 
{
	var _ret = str.replace(/^\s+|\s+$/g, ''); 
	var trimmed = _ret.replace(/^(\&nbsp\;)+|(\&nbsp\;)+$/g, '');
	return trimmed;
}

/* 
	Funciones para ordenar columnas 
*/

/*-----------------------------------------------------------------------------------------------------------*/
/* Fechas con formato dd/mm/aaaa hh:mm:ss */
/*-----------------------------------------------------------------------------------------------------------*/
jQuery.fn.dataTableExt.oSort['fecha-hora-asc'] = function(a, b) {
	// Formato dd/mm/aaaa hh:mm:ss
	a = trim(a);
	if ( a != '' ) {
		var frDatea = a.split(' ');
		var frTimea = frDatea[1].split(':');
		var frDatea2 = frDatea[0].split('/');
		var x = (frDatea2[2] + frDatea2[1] + frDatea2[0] + frTimea[0] + frTimea[1] + frTimea[2]) * 1;
	} else {
		var x = 10000000000000; // = l'an 1000 ...
	}

	b = trim(b);
	if ( b != '') {
		var frDateb = b.split(' ');
		var frTimeb = frDateb[1].split(':');
		frDateb = frDateb[0].split('/');
		var y = (frDateb[2] + frDateb[1] + frDateb[0] + frTimeb[0] + frTimeb[1] + frTimeb[2]) * 1;		                
	} else {
		var y = 10000000000000;		                
	}

	var z = ((x < y) ? -1 : ((x > y) ? 1 : 0));
	return z;
};

jQuery.fn.dataTableExt.oSort['fecha-hora-desc'] = function(a, b) {
	// Formato dd/mm/aaaa hh:mm:ss
	if (trim(a) != '') {
		var frDatea = trim(a).split(' ');
		var frTimea = frDatea[1].split(':');
		var frDatea2 = frDatea[0].split('/');
		var x = (frDatea2[2] + frDatea2[1] + frDatea2[0] + frTimea[0] + frTimea[1] + frTimea[2]) * 1;		                
	} else {
		var x = 10000000000000;		                
	}

	if (trim(b) != '') {
		var frDateb = trim(b).split(' ');
		var frTimeb = frDateb[1].split(':');
		frDateb = frDateb[0].split('/');
		var y = (frDateb[2] + frDateb[1] + frDateb[0] + frTimeb[0] + frTimeb[1] + frTimeb[2]) * 1;		                
	} else {
		var y = 10000000000000;		                
	}		            
	var z = ((x < y) ? 1 : ((x > y) ? -1 : 0));		            
	return z;
}; 

/*-----------------------------------------------------------------------------------------------------------*/
/* Fechas con formato dd/mm/aaaa
/*-----------------------------------------------------------------------------------------------------------*/
jQuery.fn.dataTableExt.oSort['fecha-asc']  = function(a,b) {
	// Formato dd/mm/aaaa
	var ukDatea = a.split('/');
	var ukDateb = b.split('/');
	
	var x = (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
	var y = (ukDateb[2] + ukDateb[1] + ukDateb[0]) * 1;
	
	return ((x < y) ? -1 : ((x > y) ?  1 : 0));
};

jQuery.fn.dataTableExt.oSort['fecha-desc'] = function(a,b) {
	// Formato dd/mm/aaaa
	var ukDatea = a.split('/');
	var ukDateb = b.split('/');
	
	var x = (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
	var y = (ukDateb[2] + ukDateb[1] + ukDateb[0]) * 1;
	
	return ((x < y) ? 1 : ((x > y) ?  -1 : 0));
};

/*-----------------------------------------------------------------------------------------------------------*/
/* Tamaño de ficheros
/*-----------------------------------------------------------------------------------------------------------*/
jQuery.fn.dataTableExt.oSort['file-size-asc']  = function(a,b) {
		var da = trim(a).split(' ');
		var db = trim(b).split(' ');

		var x = da[0];
		var y = db[0];
       
    var x_unit = (da[1] == "KB" ? 1024 : (da[1] == "MB" ? 1048576 : 1));
    var y_unit = (db[1] == "KB" ? 1024 : (db[1] == "MB" ? 1048576 : 1));

x = parseInt( x * x_unit );
    y = parseInt( y * y_unit );
    
    return ((x < y) ? -1 : ((x > y) ?  1 : 0));
};

jQuery.fn.dataTableExt.oSort['file-size-desc'] = function(a,b) {
		var da = a.split(' ');
		var db = b.split(' ');

		var x = da[0];
		var y = db[0];
       
    var x_unit = (da[1] == "KB" ? 1024 : (da[1] == "MB" ? 1048576 : 1));
    var y_unit = (db[1] == "KB" ? 1024 : (db[1] == "MB" ? 1048576 : 1));

    x = parseInt( x * x_unit);
    y = parseInt( y * y_unit);

    return ((x < y) ?  1 : ((x > y) ? -1 : 0));
};

/*-----------------------------------------------------------------------------------------------------------*/
/* Porcentajes
/*-----------------------------------------------------------------------------------------------------------*/
jQuery.fn.dataTableExt.oSort['percent-asc']  = function(a,b) {
	var x = (a == "-") ? 0 : a.replace( /%/, "" );
	var y = (b == "-") ? 0 : b.replace( /%/, "" );
	x = parseFloat( x );
	y = parseFloat( y );
	return ((x < y) ? -1 : ((x > y) ?  1 : 0));
};

jQuery.fn.dataTableExt.oSort['percent-desc'] = function(a,b) {
	var x = (a == "-") ? 0 : a.replace( /%/, "" );
	var y = (b == "-") ? 0 : b.replace( /%/, "" );
	x = parseFloat( x );
	y = parseFloat( y );
	return ((x < y) ?  1 : ((x > y) ? -1 : 0));
};

var opciones_datepicker={
    changeMonth: true,
    duration: 'fast', 
    showOn: 'button', 
    buttonImage: 'stylesheets/images/otras/calendar_view_week.png',
    buttonText: 'Ver calendario', 
    buttonImageOnly: true 
};
$.datepicker.setDefaults($.datepicker.regional['es']);

function cargaTareas() {
	$.ajaxFileUpload({
			url:'tareas_carga.php?pro_id=<?=$pro_id?>',
			secureuri:false,
			fileElementId:'ficheroTareas',
			dataType: 'json',
			success: function (data, status)
			{
					if(typeof(data.error) != 'undefined')
					{
							if(data.error != '')
							{
									alert(data.error);
							}else
							{
									alert(data.msg);
							}
					}
			},
			error: function(data, status, e) {
				alert(e);
			}
	});
	
	return false;
}

function cambio_asignacion_tipo_id(tipo_id) {
	if( tipo_id == 20 || tipo_id == 30 )
	{
		$('table').find("tr.colapsable").removeClass('collapsed').fadeIn('slow');
	}
	else
	{
		$('table').find("tr.colapsable").addClass('collapsed').fadeOut('slow');
	}	
}

function AdjuntoUpload(proyecto_id, entidad, entidad_id)
{
	//starting setting some animation when the ajax starts and completes
	$("#loading")
	.ajaxStart(function(){
		$(this).show();
	})
	.ajaxComplete(function(){
		$(this).hide();
	});
	
	$.ajaxFileUpload
	(
		{
			url:'app.php?o=adjunto.upload&pid=' + proyecto_id + '&entidad=' + entidad + '&entidad_id=' + entidad_id, 
			secureuri:false,
			fileElementId:'fileToUpload',
			dataType: 'json',
			success: function (data, status)
			{
				if( typeof(data.error) != 'undefined')
				{
					if(data.error != '')
					{
						alert(data.error);
					}
					else
					{
						$.ajax({
							async: false,
							url: 'app.php?o=adjunto.listado&pid=' + proyecto_id + '&entidad=' + entidad + '&entidad_id=' + entidad_id ,
							success: function(html) {
								$('#contenedor_adjuntos').html(html);
								$('#div_mensaje').html( data.ok );
								$('#div_mensaje').show();
							}
						});
					}
				}
			},
			error: function (data, status, e)
			{
				alert(e);
			}
		}
	)
	
	return false;

}  

function AdjuntoDelete(proyecto_id, adjunto_id, entidad, entidad_id)
{
	var mensaje;
	
	if( confirm('Esta operacion borra el documento asociado.\nEsta seguro?') ) 
	{
		$.ajax({
			async: false,
			url: 'app.php?o=adjunto.delete&pid=' + proyecto_id + '&adjunto_id=' + adjunto_id ,
			success: function(data) {
				mensaje = data;
			}
		});
	
		$.ajax({
			async: false,
			url: 'app.php?o=adjunto.listado&pid=' + proyecto_id + '&adjunto_id=' + adjunto_id + '&entidad=' + entidad + '&entidad_id=' + entidad_id ,
			success: function(data) {
				$('#contenedor_adjuntos').html(data);
				$('#div_mensaje').html( mensaje );
				$('#div_mensaje').show();
			}
		});

	};

	return false;
}