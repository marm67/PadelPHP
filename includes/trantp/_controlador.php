<?php if ( !defined('BASEPATH')) muere('Acceso no permitido');

//----------------------------------------------------------------------------------	
function inicio_controlador( $accion = 'listado' )
{ 
	Vista::layout('_cabecera_dataTable.php' );
	call_user_func( $accion, $params );
}
//----------------------------------------------------------------------------------	
function fin_controlador() 
{
	Vista::layout('pie.php');
}
//----------------------------------------------------------------------------------	
function listado() 
{
	$tx = $_REQUEST['tx'];
	$fecha = $_REQUEST['fecha'];
	$cics = $_REQUEST['cics'];
	$hora = $_REQUEST['hora'];
	
	$hora = str_replace(":", ".", $hora);
	$ts1 = $fecha . "-" . $hora . ".000000";
	$hh = substr($hora,0,2) + 1; 
	if (strlen($hh) == 1 )
		$hh = "0" . $hh;
		
	$ts2 = $fecha . "-" . $hh . "." . substr($hora,3) . ".000000";
/*
	  AND START_TIMESTAMP > '2015-02-22-06.00.00.000000'          
	  AND START_TIMESTAMP < '2015-02-22-08.00.00.000000'          
*/	
	$sql = <<<FIN
	SELECT MVS_SYSTEM_ID
		, CICS_SYSTEM_ID
		, TRANSACTION_ID
		, PROGRAM_NAME
		, START_TIMESTAMP
		, STOP_TIMESTAMP
		, ABEND_CODE_CURRENT
		, TERMINAL_ID
		, USER_ID
		, LU_NAME
		, UNIT_OF_WORK_ID
		, UOW_PERIOD_COUNT
		, DEC(RESPONSE_SEC,12,3) AS RESPONSE_SEC
		, DEC(CPU_SEC,12,3) AS CPU_SEC
		, DEC(DISPATCH_SEC,12,3) AS DISPATCH_SEC
		, DEC(SUSPENDS) AS SUSPENDS
	FROM DRLP.CICS_T_TRAN_TP                                      
	WHERE CICS_SYSTEM_ID = '$cics'                             
	  AND TRANSACTION_ID = '$tx'                                 
	  AND START_TIMESTAMP > '$ts1'          
	  AND START_TIMESTAMP < '$ts2'          
	ORDER BY START_TIMESTAMP                                      
	WITH UR;
FIN;
trace($sql);
	$registros = Conexion::query($sql);
//trace($registros);

	require('listado.php'); 
/*
	[MVS_SYSTEM_ID] => DMA0
	[CICS_SYSTEM_ID] => CICSEATB
	[START_TIMESTAMP] => 2015-02-22 06:07:22.037168
	[TRANSACTION_ID] => A3A4
	[TERMINAL_ID] => 
	[USER_ID] => WEBATPA 
	[TRANSACTION_TYPE] => SD  
	[STOP_TIMESTAMP] => 2015-02-22 06:07:22.338360
	[TRANSACTION_PRIO] => 0
	[LU_NAME] => 
	[PROGRAM_NAME] => A3A400CO
	[NET_NAME] => MADRID2.CICSEATB
	[UNIT_OF_WORK_ID] => 8B68B76C7F32
	[UOW_PERIOD_COUNT] => 1
	[TASK_FLAG] => ����
	[ABEND_CODE_ORIGIN] => 
	[ABEND_CODE_CURRENT] => 
	[RESPONSE_SEC] => 3,011920E-01
	[CPU_SEC] => 2,456179E-02
	[DISPATCH_SEC] => 3,825756E-02
	[SUSPENDS] => 1085
	[TC_IO_WAIT_SEC] => 0,000000E+00
	[FC_IO_WAIT_SEC] => 0,000000E+00
	[FC_GET_REQUESTS] => 0
	[FC_PUT_REQUESTS] => 0
	[FC_BROWSE_REQUESTS] => 0
	[FC_ADD_REQUESTS] => 0
	[FC_DELETE_REQUESTS] => 0
	[JC_IO_WAIT_SEC] => 0,000000E+00
	[MSGS_INPUT_PRIME] => 0
	[MSGS_OUTPUT_PRIME] => 0
	[CHARS_INPUT_PRIME] => 0
	[CHARS_OUTPUT_PRIME] => 0
	[CHARS_INPUT_ALT] => 0
	[CHARS_OUTPUT_ALT] => 0
	[MSGS_INPUT_ALT] => 0
	[STORAGE_UDSA_MAX] => 8208
	[STORAGE_EUDSA_MAX] => 73664
	[STORAGE_CDSA_MAX] => 688
	[STORAGE_ECDSA_MAX] => 0
	[STORAGE_PGM_TOTAL] => 37608
	[TRANSACTION_NUM] => 63975
	[GVUPWAIT_COUNT] => 0,00000000000000E+000
	[TS_IO_WAIT_SEC] => 0,000000E+00
*/

}
//----------------------------------------------------------------------------------	
function listado1() 
{
	$tx = $_REQUEST['tx'];
	$fecha = $_REQUEST['fecha'];
	
	$sql = <<<FIN
	SELECT DATE
		, MVS_SYSTEM_ID
		, CICS_SYSTEM_ID
		, TRANSACTION_ID
		, DEC(RECORDS) AS RECORDS 
		, DEC((RESPONSE_SUM_SEC/RECORDS),6,3)  AS RESPONSE_AVG
		, DEC(RESPONSE_MAX_SEC,9,3) AS RESPONSE_MAX_SEC
	FROM DRLP.CICS_TRANSACTION_D
	WHERE DATE='$fecha' AND TRANSACTION_ID = '$tx'
	WITH UR;
FIN;
	$registros = Conexion::query($sql);
//trace($registros);

	require('listado.php'); 
}
?>