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
//trace($_REQUEST);

	$uow = $_REQUEST['uow'];
	$tstart = $_REQUEST['tstart'];
	$tstart = str_replace(":", ".", $tstart);
	$tstop = $_REQUEST['tstop'];
	$tstop = str_replace(":", ".", $tstop);
	$tresp = str_replace(",", ".", $_REQUEST['tresp']);
	
	$ts = strtotime(substr($tstart,0,19));
/*	$ts = $ts - $tresp - $margen; */
	$ts = $ts - 1;
	$tsFrom = date("Y-m-d H.i.s", $ts);
//trace($tsFrom);
/*	
	$ts = strtotime(substr($tstop,0,19));
	$ts = $ts + $margen;
	$tsTo = date("Y-m-d H.i.s", $ts);
//trace($tsTo);
*/
	/* solo miramos los siguientes 10 segundos */
	$ts = strtotime(substr($tstart,0,19));
	$ts = $ts + 10;
	$tsTo = date("Y-m-d H.i.s", $ts);
//trace($tsTo);

	$sql = <<<FIN
		SELECT *                                                
		FROM DRLP.CICS_T_TRAN_TP                                
		WHERE START_TIMESTAMP >= '$tsFrom.000000'    
		  AND START_TIMESTAMP <= '$tsTo.000000'    
		  AND UNIT_OF_WORK_ID = '$uow'                  
		ORDER BY START_TIMESTAMP                                
	WITH UR;
FIN;

	$sql = <<<FIN
SELECT LU_NAME
	, CICS_SYSTEM_ID
	, TRANSACTION_ID
	, TRANSACTION_TYPE
	, PROGRAM_NAME
	, USER_ID
	, ABEND_CODE_CURRENT
	, UNIT_OF_WORK_ID
	, DEC(CPU_SEC,10,5) AS CPU_SEC
	, DEC((STOP_TIMESTAMP - START_TIMESTAMP),10,5) AS RESPONSE_SEC
	, DEC(DISPATCH_SEC,10,5) AS DISPATCH_SEC
	, SUSPENDS
	, START_TIMESTAMP
	, STOP_TIMESTAMP
FROM DRLP.CICS_T_TRAN_TP   
WHERE START_TIMESTAMP >= '$tsFrom.000000'    
  AND START_TIMESTAMP <= '$tsTo.000000'    
  AND UNIT_OF_WORK_ID = '$uow'
ORDER BY START_TIMESTAMP
WITH UR;
FIN;

	$registros = Conexion::query($sql);
//trace($registros);

	require('listado.php'); 
trace($sql);

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