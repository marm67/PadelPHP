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
WITH EJECUCIONES_H AS (
	SELECT T.MVS_SYSTEM_ID
		, T.CICS_SYSTEM_ID
		, T.DATE
		, T.TIME
		, T.TRANSACTION_ID
		, T.RECORDS
		, A.NUM_ABENDS
		, T.RESPONSE_SUM_SEC
		, T.RESPONSE_MAX_SEC
	FROM DRLP.CICS_TRANSACTION_H AS T LEFT JOIN DRLP.CICS_ABENDS_H AS A 
		ON  (T.TRANSACTION_ID = A.TRANSACTION_ID) 
		AND (T.TIME = A.HOUR) 
		AND (T.DATE = A.DATE) 
		AND (T.CICS_SYSTEM_ID = A.CICS_SYSTEM_ID) 
		AND (T.MVS_SYSTEM_ID = A.MVS_SYSTEM_ID)
	WHERE T.DATE='$fecha' AND T.TRANSACTION_ID='$tx' AND T.CICS_SYSTEM_ID='$cics'
)
SELECT DATE
	, TIME
	, MVS_SYSTEM_ID
	, CICS_SYSTEM_ID
	, TRANSACTION_ID
	, DEC(RECORDS) AS RECORDS
	, DEC(NUM_ABENDS) AS ABENDS
	, DEC((RESPONSE_SUM_SEC/RECORDS),12,3)  AS RESPONSE_AVG
	, DEC(RESPONSE_MAX_SEC,12,3) AS RESPONSE_MAX_SEC
FROM EJECUCIONES_H
ORDER BY TIME
WITH UR;
FIN;
	$registros = Conexion::query($sql);
//trace($registros);

	require('listado.php'); 
trace($sql);
}
?>