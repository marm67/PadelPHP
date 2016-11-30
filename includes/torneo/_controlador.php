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
	
	$sql = <<<FIN
	SELECT *
	FROM TORNEOS
	;
FIN;
	$registros = Conexion::query($sql);
//trace($registros);

	require('listado.php'); 
//trace($sql);
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