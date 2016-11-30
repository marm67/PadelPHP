<?php
//----------------------------------------------------------------------------------
// Nivel de los mensajes
//----------------------------------------------------------------------------------
    error_reporting(E_ALL & ~(E_STRICT | E_NOTICE | E_DEPRECATED));

//----------------------------------------------------------------------------------
// Variables de la aplicacion
//----------------------------------------------------------------------------------	
	define('BASEPATH', realpath(dirname(__FILE__)));
	
	$app=array();
	
	require_once(BASEPATH.'/includes/base/app.inc.php');

//----------------------------------------------------------------------------------	
// Las url validas tendran en siguiente formato: 
//		app.php?o=controlador.accion&resto_de_parametros...
//----------------------------------------------------------------------------------	
	control_url();

//----------------------------------------------------------------------------------	
// Llamada al controlador
//----------------------------------------------------------------------------------	
	require_once( BASEPATH.'/includes/'.$app['controlador'].'/_controlador.php' );
	inicio_controlador($app['accion']);
	fin_controlador();

//----------------------------------------------------------------------------------	
// Mensajes Flash
// La variable $_SESSION['flash'] permite pasar mensajes entre una página y la siguiente.
// Una vez procesado los mensajes flash se borra la variable flash.
//----------------------------------------------------------------------------------	
	if( isset($_SESSION['flash']) ) 
	{
		unset($_SESSION['flash']);
	}	
?>