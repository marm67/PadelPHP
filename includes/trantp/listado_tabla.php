<?php

$html = <<<EOT
	<table id="{$dataTable}" class="display" border="0" cellspacing="0" cellpadding="0" width="100%">
		<thead><tr>
			<th nowrap="nowrap">START</th>
			<th nowrap="nowrap">STOP</th>
			<th nowrap="nowrap">CPU</th>
			<th nowrap="nowrap">CICS</th>
			<th nowrap="nowrap">TRANSACION</th>
			<th nowrap="nowrap">PROGRAMA</th>
			<th nowrap="nowrap">ABEND</th>
			<th nowrap="nowrap">TERMINAL</th>
			<th nowrap="nowrap">USER</th>
			<th nowrap="nowrap">LU_NAME</th>
			<th nowrap="nowrap">UNIT</th>
			<th nowrap="nowrap">UOW_PC</th>
			<th nowrap="nowrap">T.RESP</th>
			<th nowrap="nowrap">T.CPU</th>
			<th nowrap="nowrap">T.DISPATCH</th>
			<th nowrap="nowrap">SUSPENDS</th>
		</tr></thead>
		<tbody>
EOT;
		echo $html;
  foreach( $registros as $row )
  {
		$uow = $row['UNIT_OF_WORK_ID'];
		$tstart = $row['START_TIMESTAMP'];
		$tstop = $row['STOP_TIMESTAMP'];
		$tresp = $row['RESPONSE_SEC'];
		$enlace_uow = <<<EOT
			<a target="_blank" href="app.php?o=uow.listado&uow={$uow}&tstart={$tstart}&tstop={$tstop}&tresp={$tresp}"  title="Detalle de la unidad de trabajo">{$uow}</a>
EOT;

$html = <<<EOT
		<tr>
			<td>{$row['START_TIMESTAMP']}</td>
			<td>{$row['STOP_TIMESTAMP']}</td>
			<td>{$row['MVS_SYSTEM_ID']}</td>
			<td><b>{$row['CICS_SYSTEM_ID']}</b></td>
			<td>{$row['TRANSACTION_ID']}</td>
			<td>{$row['PROGRAM_NAME']}</td>
			<td>{$row['ABEND_CODE_CURRENT']}</td>
			<td>{$row['TERMINAL_ID']}</td>
			<td>{$row['USER_ID']}</td>
			<td>{$row['LU_NAME']}</td>
			<td>{$enlace_uow}</td>
			<td>{$row['UOW_PERIOD_COUNT']}</td>
			<td>{$row['RESPONSE_SEC']}</td>
			<td>{$row['CPU_SEC']}</td>
			<td>{$row['DISPATCH_SEC']}</td>
			<td>{$row['SUSPENDS']}</td>
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

