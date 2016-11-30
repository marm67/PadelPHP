<?php

$html = <<<EOT
	<table id="{$dataTable}" class="display" border="0" cellspacing="0" cellpadding="0" width="100%">
		<thead><tr>
			<th nowrap="nowrap">UOW</th>
			<th nowrap="nowrap">LU_NAME</th>
			<th nowrap="nowrap">CPU</th>
			<th nowrap="nowrap">CICS</th>
			<th nowrap="nowrap">TRANSACION</th>
			<th nowrap="nowrap">TRAN.TYPE</th>
			<th nowrap="nowrap">PROGRAMA</th>
			<th nowrap="nowrap">AB.ORIGIN</th>
			<th nowrap="nowrap">AB.CURRENT</th>
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
			<td>{$row['UNIT_OF_WORK_ID']}&nbsp;</td>
			<td>{$row['LU_NAME']}&nbsp;</td>
			<td>{$row['MVS_SYSTEM_ID']}&nbsp;</td>
			<td>{$row['CICS_SYSTEM_ID']}&nbsp;</td>
			<td>{$row['TRANSACTION_ID']}&nbsp;</td>
			<td>{$row['TRANSACTION_TYPE']}&nbsp;</td>
			<td>{$row['PROGRAM_NAME']}&nbsp;</td>
			<td>{$row['ABEND_CODE_ORIGIN']}&nbsp;</td>
			<td>{$row['ABEND_CODE_CURRENT']}&nbsp;</td>
			<td>{$row['USER_ID']}&nbsp;</td>
			<td>{$row['RESPONSE_SEC']}&nbsp;</td>
			<td>{$row['CPU_SEC']}&nbsp;</td>
			<td>{$row['DISPATCH_SEC']}&nbsp;</td>
			<td>{$row['SUSPENDS']}&nbsp;</td>
			<td>{$row['START_TIMESTAMP']}&nbsp;</td>
			<td>{$row['STOP_TIMESTAMP']}&nbsp;</td>
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

