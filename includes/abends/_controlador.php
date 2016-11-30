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
	
	$sql = <<<FIN
	SELECT  DATE
		, HOUR
		, MVS_SYSTEM_ID
		, CICS_SYSTEM_ID
		, TRANSACTION_ID
		, PROGRAM_NAME
		, ABEND_CODE_CURRENT
		, DEC(NUM_ABENDS) AS NUM_ABENDS
	FROM DRLP.CICS_ABENDS_H
	WHERE DATE='$fecha' 
		AND TRANSACTION_ID = '$tx' 
		AND CICS_SYSTEM_ID = '$cics'
	ORDER BY HOUR
	WITH UR;
FIN;
trace($sql);	
	$registros = Conexion::query($sql);
//trace($registros);	

	require('listado.php'); 
}
//----------------------------------------------------------------------------------	
function listado11() 
{
	$tx = $_REQUEST['tx'];
	$fecha = $_REQUEST['fecha'];
	
	$sql = <<<FIN
	SELECT DATE
		, MVS_SYSTEM_ID
		, CICS_SYSTEM_ID
		, TRANSACTION_ID
		, DEC(SUM(NUM_ABENDS)) AS ABENDS
	FROM DRLP.CICS_ABENDS_H
	WHERE DATE='$fecha' AND TRANSACTION_ID = '$tx'
	GROUP BY DATE, MVS_SYSTEM_ID, CICS_SYSTEM_ID, TRANSACTION_ID
	ORDER BY CICS_SYSTEM_ID
	WITH UR;
FIN;
	$registros = Conexion::query($sql);

	require('listado.php'); 
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
			, DEC(SUM(NUM_ABENDS)) AS ABENDS
		FROM DRLP.CICS_ABENDS_H
		WHERE DATE='$fecha' AND TRANSACTION_ID = '$tx'
		ORDER BY CICS_SYSTEM_ID
		WITH UR;
FIN;
	$registros = Conexion::query($sql);
	
	require('listado.php'); 
}
//----------------------------------------------------------------------------------	
?>