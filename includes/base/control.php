<?php if ( !defined('BASEPATH')) muere('Acceso no permitido');
//----------------------------------------------------------------------------------	
function control_url()
{
	global $app;
		
	if( isset($_REQUEST['o']) )
	{
		list($controlador, $accion) = split( '\.', $_REQUEST['o'] );
		if( !is_file( BASEPATH.'/includes/'.$controlador.'/_controlador.php') )
		{
			muere('Acceso no permitido 1');
		}
		if( empty($accion) ) $accion='listado';
		
		//----------------------------------------------------------------------------------	
		// Los controladores que empiecen con _ no son accesibles desde la web
		//----------------------------------------------------------------------------------	
		if( 0 == strncmp($accion, '_', 1) ) muere('Acceso no permitido');
		
		$app['controlador']= $controlador;
		$app['accion']= $accion;
	}
	else
	{
		muere('Acceso no permitido 2');
	}	
	
}
//----------------------------------------------------------------------------------	
function get_controlador()
{
	global $app;
	
	return $app['controlador'];
}
//----------------------------------------------------------------------------------	
function get_accion()
{
	global $app;
	
	return $app['accion'];
}
//----------------------------------------------------------------------------------	
function redireccion($url, $frame='self')
{
	$tmp=split('/', $_SERVER['PHP_SELF']);
	$app=$tmp[1];
	echo '<script>window.'.$frame.'.location.href="http://'.$_SERVER['HTTP_HOST'].'/'.$app.'/'.$url.'"</script>';    
	exit;
}
//----------------------------------------------------------------------------------	
function muere($mensaje = '')
{
	exit($mensaje);
}
//----------------------------------------------------------------------------------	
?>