<?php

$html = <<<EOT
	<table id="{$dataTable}" class="display" border="0" cellspacing="0" cellpadding="0" width="100%">
		<thead><tr>
			<th nowrap="nowrap">FECHA</th>
			<th nowrap="nowrap">HORA</th>
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
  }
  
  foreach( $registros as $row )
  {
	$records = number_format($row['RECORDS'], 0, ',', '.');
	$abends = number_format($row['ABENDS'], 0, ',', '.');
	
	if( $abends > 0 ) {
		$tpc_abends = ($abends/$records)*100;
		$tpc_abends = number_format($tpc_abends, 0, ',', '.') . " %";
		$enlace_abends = <<<EOT
			<a target="_blank" href="app.php?o=abends.listado&tx={$tx}&fecha={$fecha}&cics={$cics}">{$abends}</a>
EOT;
	} else {
		$tpc_abends = "0 %";
		$enlace_abends =  "-";
	}
	
	$hora = $row['TIME'];
	$cics = $row['CICS_SYSTEM_ID'];
	$enlace_hora = <<<EOT
		<a target="_blank" href="app.php?o=trantp.listado&tx={$tx}&fecha={$fecha}&cics={$cics}&hora={$hora}"  title="Detalle de las ejecuciones">{$hora}</a>
EOT;

$html = <<<EOT
		<tr>
			<td>{$row['DATE']}&nbsp;</td>
			<td>{$enlace_hora}&nbsp;</td>
			<td>{$row['MVS_SYSTEM_ID']}&nbsp;</td>
			<td>{$row['CICS_SYSTEM_ID']}&nbsp;</td>
			<td>{$row['TRANSACTION_ID']}&nbsp;</td>
			<td>{$records}&nbsp;</td>
			<td>{$enlace_abends}&nbsp;</td>
			<td>{$tpc_abends}&nbsp;</td>
			<td>{$row['RESPONSE_AVG']}&nbsp;</td>
			<td>{$row['RESPONSE_MAX_SEC']}&nbsp;</td>
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

