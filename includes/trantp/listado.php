<?php 
	$titulo = "$tx | $fecha. Ejecuciones por día.";
?>
<h6 style="background-color:#FFFFFF;"><?= $titulo ?></h6>

<?php 
	$dataTable = 'dtTranTP';
	require('listado_tabla.php'); 
?>
<script>
$(document).ready(function() {
	$('#dtTranTP').dataTable( {
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
			{ },
			{ },
			{ },
			{ },
			{ },
			{ },
			{ },
			{ },
			{ }
		],
		"aaSorting": [[ 2, 'asc' ]], 
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


