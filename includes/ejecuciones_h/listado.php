<?php 
	$titulo = "$cics | $tx | $fecha. Distribución por horas.";
?>
<h6 style="background-color:#FFFFFF;"><?= $titulo ?></h6>

<?php 
	$dataTable = 'dtEjecucionesH';
	require('listado_tabla.php'); 
?>
<script>
$(document).ready(function() {
	$('#dtEjecucionesH').dataTable( {
		"bStateSave": true,
		"bJQueryUI": true,
		"bPaginate": false,
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"aoColumns": [
			{ },
			{ },
			{ },
			{ },
			{ },
			{ },
			{ },
			{ "sType": "numeric" },
			{ "sType": "numeric" },
			{ "sType": "numeric" }
		],
		/*"aaSorting": [[ 2, 'asc' ]],*/
		"bSortClasses": false,
		"oLanguage": dataTable_oLanguage,
		"sDom": '<"cabecera-datatable ui-helper-clearfix"fi>t<"pie-datatable ui-helper-clearfix"i>',
		"bAutoWidth": true
	});

	$('#dtProyectos').find("tbody > tr").find("td").mousedown(
		function(){
			$(this).parent().toggleClass("resalte");
		}
	);

});	
</script>


