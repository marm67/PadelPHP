<?php

$html = <<<EOT
	<table id="{$dataTable}" class="display" border="0" cellspacing="0" cellpadding="0" width="100%">
		<thead><tr>
			<th nowrap="nowrap">DEL</th>
			<th nowrap="nowrap">AL</th>
			<th nowrap="nowrap">TORNEO</th>
			<th nowrap="nowrap">CATEGORIA</th>
			<th nowrap="nowrap">LUGAR</th>
			<th nowrap="nowrap">SEDE</th>
		</tr></thead>
		<tbody>
EOT;
		echo $html;

  foreach( $registros as $row )
  {
	$records = $row['RECORDS'];
	$abends = $row['ABENDS'];
	
	if( $abends > 0 ) {
		$tpc_abends = ($abends/$records)*100;
		$tpc_abends = number_format($tpc_abends, 5, ',', '.') . " %";
//		$tpc_abends = ($abends/$records)*100;
	} else {
		$tpc_abends = "0 %";
	}
	
	$records = number_format($records, 0, ',', '.');
	$abends = number_format($abends, 0, ',', '.');
	
	$cics = $row['CICS_SYSTEM_ID'];
	$fecha = $row['DATE'];
	$enlace_ejecuciones_h = <<<EOT
		<a target="_blank" href="app.php?o=ejecuciones_h.listado&tx={$tx}&fecha={$fecha}&cics={$cics}" title="Distribución por horas de las ejecuciones">{$fecha}</a>
EOT;
	$enlace_abends = <<<EOT
		<a target="_blank" href="app.php?o=abends.listado&tx={$tx}&fecha={$fecha}&cics={$cics}">{$abends}</a>
EOT;
	
$html = <<<EOT
		<tr>
			<td>{$row['fecha_inicio']}</td>
			<td>{$row['fecha_fin']}</td>
			<td>{$row['torneo']}</td>
			<td>{$row['categoria']}</td>
			<td>{$row['lugar']}</td>
			<td>{$row['sede']}</td>
		</tr>
EOT;
			echo $html;
	}

$html = <<<EOT
		</tbody>
	</table>
EOT;
		echo $html;

?>

