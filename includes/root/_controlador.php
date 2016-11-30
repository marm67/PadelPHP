<?php if ( !defined('BASEPATH')) muere('Acceso no permitido');

//----------------------------------------------------------------------------------	
function inicio_controlador( $accion = 'listado' )
{ 
	Vista::layout('cabecera.php' );
	call_user_func( $accion, $params );
}
//----------------------------------------------------------------------------------	
function fin_controlador() 
{
	Vista::layout('pie.php');
}
//----------------------------------------------------------------------------------	
function prueba() 
{
	$sql = <<<FIN
		SELECT *                                                
		FROM categorias                               
FIN;
	$registros = Conexion::query($sql);
trace($registros);
}
//----------------------------------------------------------------------------------	
function importar_torneos() 
{
	Conexion::execute('TRUNCATE TABLE Torneos'); 

	require_once(BASEPATH.'/libs/php-selector/selector.inc');

	$url = BASEPATH.'/descargas/torneos.html';
	$url = "http://www.padelfederacion.es/Paginas/padelmadrid/pruebas.asp";

	$ano = "2016";
	$tipo = "MENORES";
	$modalidad = "PAREJAS";
	$postdata = http_build_query(
	    array(
	        'ano' => $ano,
	        'tipo' => $tipo,
	        'modalidad' => $modalidad
	    )
	);
	$opts = array('http' =>
	    array(
	        'method'  => 'POST',
	        'header'  => 'Content-type: application/x-www-form-urlencoded',
	        'content' => $postdata
	    )
	);
	$context  = stream_context_create($opts);
	$html = file_get_contents($url, false, $context);


	$meses = array('ENE' => '01' ,'FEB' => '02' ,'MAR' => '03' ,'ABR' => '04' ,'MAY' => '05' ,'JUN' => '06' ,'JUL' => '07' ,'AGO' => '08' ,'SEP' => '09' ,'OCT' => '10' ,'NOV' => '11' ,'DIC' => '12');
//	select_elements('table tbody tr', $html);
	$dom = new SelectorDom($html);
	$filas = $dom->select('table tbody tr');
	echo "--> Recuperados " .count($filas) . " torneos" . "<br />";
//	trace($filas[0]);
	foreach($filas as $fila) {
//		echo $fila . "<br>" ;
		$columnas = $fila['children'];
		// trace($columnas[0]);
//		echo "--> " .count($columnas) . " columnas" . "<br />";
		$del = $columnas[0]['text'];
		list($dia, $mmm) = explode(" ", $del);
		$fecha_inicio = $ano . '-' . $meses[$mmm] . '-' . $dia ; 

		$al = $columnas[1]['text'];
		list($dia, $mmm) = explode(" ", $al);
		$fecha_fin = $ano . '-' . $meses[$mmm] . '-' . $dia ; 

		$torneo = $columnas[2]['text'];
		$href = $columnas[2]['children'][0]['attributes']['href'];
		list($kk, $id) = explode('=', $href);

		$categoria = $columnas[3]['text'];
		$genero = $columnas[4]['text'];
		$lugar = $columnas[5]['text'];
		$sede = $columnas[6]['text'];
		$tipo = 'A';

		$sql = <<<FIN
		insert into Torneos (id, fecha_inicio, fecha_fin, torneo, categoria, tipo, lugar, sede)                                              
		values (
			'$id',
			'$fecha_inicio',
			'$fecha_fin',
			'$torneo',
			'$categoria',
			'$tipo',
			'$lugar',
			'$sede'
		)                           
FIN;
		trace($sql);
		Conexion::execute($sql); 
		$id =mysql_insert_id();
	}
}
?>
