<?php

$html = <<<EOT
	<table id="{$dataTable}" class="display" border="0" cellspacing="0" cellpadding="0" width="100%">
		<thead><tr>
			<th nowrap="nowrap">FECHA</th>
			<th nowrap="nowrap">CPU</th>
			<th nowrap="nowrap">CICS</th>
			<th nowrap="nowrap">TRANSACCION</th>
			<th nowrap="nowrap">EJECUCIONES</th>
			<th nowrap="nowrap">ABENDS</th>
			<th nowrap="nowrap">TPC.ABENDS</th>
			<th nowrap="nowrap">T.RESP MEDIO</th>
			<th nowrap="nowrap">T.RESP MAXIMO</th>
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
			<td>{$enlace_ejecuciones_h}</td>
			<td>{$row['MVS_SYSTEM_ID']}</td>
			<td><b>{$cics}</b></td>
			<td>{$row['TRANSACTION_ID']}</td>
			<td>{$records}</td>
			<td>{$enlace_abends}</td>
			<td>{$tpc_abends}</td>
			<td>{$row['RESPONSE_AVG']}</td>
			<td>{$row['RESPONSE_MAX_SEC']}</td>
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

