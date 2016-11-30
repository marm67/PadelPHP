<?php

$html = <<<EOT
	<table id="{$dataTable}" class="display" border="0" cellspacing="0" cellpadding="0" width="100%">
		<thead><tr>
			<th nowrap="nowrap">FECHA</th>
			<th nowrap="nowrap">HORA</th>
			<th nowrap="nowrap">CPU</th>
			<th nowrap="nowrap">CICS</th>
			<th nowrap="nowrap">TRANSACCION</th>
			<th nowrap="nowrap">PRIMER PROGRAMA</th>
			<th nowrap="nowrap">CODIGO DE ABEND</th>
			<th nowrap="nowrap">NUMERO DE ABENDS</th>
		</tr></thead>
		<tbody>
EOT;
		echo $html;

  foreach( $registros as $row )
  {
$html = <<<EOT
		<tr>
			<td>{$row['DATE']}&nbsp;</td>
			<td>{$row['HOUR']}&nbsp;</td>
			<td>{$row['MVS_SYSTEM_ID']}&nbsp;</td>
			<td>{$row['CICS_SYSTEM_ID']}&nbsp;</td>
			<td>{$row['TRANSACTION_ID']}&nbsp;</td>
			<td>{$row['PROGRAM_NAME']}&nbsp;</td>
			<td>{$row['ABEND_CODE_CURRENT']}&nbsp;</td>
			<td>{$row['NUM_ABENDS']}&nbsp;</td>
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

