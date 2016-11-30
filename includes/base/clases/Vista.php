<?php if ( !defined('BASEPATH')) exit('Acceso no permitido');	

class Vista
{

	private static $path;

	// --------------------------------------------------------------------

	public static function setPath( $path )
	{
		// --------------------------------------------------------------------
		// Se define en init.php
		//    Vista::setPath(BASEPATH.'/includes/base/clases/layout/');
		//----------------------------------------------------------------------------------	
		self::$path = $path;
	}

	// --------------------------------------------------------------------

	public static function layout( $vista, $params = '' )
	{
		$fichero_vista = self::get_fichero_vista( $vista ) ;
		
		include($fichero_vista);
	}

	// --------------------------------------------------------------------

	private static function get_fichero_vista( $vista )
	{
		global $app;
		
		// Si existe una carpeta con el nombre del controlador y el archivo de layout utilizar ese 
		// Si no el fichero comun a todos loso controladores
		$file_controlador = self::$path.$app['controlador'].'/'.$vista;
		$file_comun = self::$path.$vista;
		
		if( is_file($file_controlador) ) 
		{
			return $file_controlador;
		}	
		elseif( is_file($file_comun) ) 
		{
			return $file_comun;
		}
			
	}

	// --------------------------------------------------------------------

} //Fin de la clase
