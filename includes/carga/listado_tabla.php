<?php

$html = <<<EOT
	<table id="{$dataTable}" class="display" border="0" cellspacing="0" cellpadding="0" width="100%">
		<thead><tr>
			<th nowrap="nowrap">CPU</th>
			<th nowrap="nowrap">CICS</th>
			<th nowrap="nowrap">TRANSACCION</th>
			<th nowrap="nowrap">ABENDS</th>
		</tr></thead>
		<tbody>
EOT;
		echo $html;

  foreach( $registros as $row )
  {
$html = <<<EOT
		<tr class='{$row['']}'>
			<td>{$row['MVS_SYSTEM_ID']}&nbsp;</td>
			<td>{$row['CICS_SYSTEM_ID']}&nbsp;</td>
			<td>{$row['TRANSACTION_ID']}&nbsp;</td>
			<td>{$row['ABENDS']}&nbsp;</td>
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

