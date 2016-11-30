<?php

$html = <<<EOT
	<table id="{$dataTable}" class="display" border="0" cellspacing="0" cellpadding="0" width="100%">
		<thead><tr>
			<th nowrap="nowrap">LU_NAME</th>
			<th nowrap="nowrap">CICS</th>
			<th nowrap="nowrap">TRANSACION</th>
			<th nowrap="nowrap">TRAN.TYPE</th>
			<th nowrap="nowrap">PROGRAMA</th>
			<th nowrap="nowrap">ABEND</th>
			<th nowrap="nowrap">USER</th>
			<th nowrap="nowrap">T.RESP</th>
			<th nowrap="nowrap">T.CPU</th>
			<th nowrap="nowrap">T.DISPATCH</th>
			<th nowrap="nowrap">SUSPENDS</th>
			<th nowrap="nowrap">START</th>
			<th nowrap="nowrap">STOP</th>
		</tr></thead>
		<tbody>
EOT;
		echo $html;
  foreach( $registros as $row )
  {
$html = <<<EOT
		<tr>
			<td>{$row['LU_NAME']}&nbsp;</td>
			<td><b>{$row['CICS_SYSTEM_ID']}</b></td>
			<td>{$row['TRANSACTION_ID']}</td>
			<td>{$row['TRANSACTION_TYPE']}</td>
			<td>{$row['PROGRAM_NAME']}</td>
			<td>{$row['ABEND_CODE_CURRENT']}&nbsp;</td>
			<td>{$row['USER_ID']}</td>
			<td>{$row['RESPONSE_SEC']}</td>
			<td>{$row['CPU_SEC']}</td>
			<td>{$row['DISPATCH_SEC']}</td>
			<td>{$row['SUSPENDS']}</td>
			<td>{$row['START_TIMESTAMP']}</td>
			<td>{$row['STOP_TIMESTAMP']}</td>
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

