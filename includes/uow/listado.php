<?php 
	$titulo = "Detalle de la unidad de trabajo $uow";
?>
<h6 style="background-color:#FFFFFF;"><?= $titulo ?></h6>
<br />

<?php 
	$dataTable = 'dtUow';
	require('listado_tabla.php'); 
?>
<script>
$(document).ready(function() {
	$('#dtUow').dataTable( {
		"bStateSave": false,
		"bJQueryUI": true,
		"bPaginate": false,
		"bFilter": true,
		"bSort": false,
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
			{ }
		],
		"bSortClasses": false,
		"oLanguage": dataTable_oLanguage,
		"sDom": 't',
		"bAutoWidth": true
	});

	$('#dtUow').find("tbody > tr").find("td").mousedown(
		function(){
			$(this).parent().toggleClass("resalte");
		}
	);

});	
</script>


