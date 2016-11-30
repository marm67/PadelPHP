<?php

class Modelo {

	public $entidad;
	public $tabla;
	public $clave;
	public $datos;
	public $errores_validacion;
	
	public $campos;
	public $fields_data;
	public $fields_type;
	
	public $asociaciones;

	// --------------------------------------------------------------------

	public function __construct()
	{
		$this->errores_validacion=array();
	} 

	// --------------------------------------------------------------------

	public function campos_tabla()
	{
		$sql='SHOW FULL COLUMNS FROM '.$this->tabla;
		 return Conexion::query($sql);
	}

	// --------------------------------------------------------------------

	public function setFiltro($campo, $valor) 
	{
		$this->filtros[$campo]=$valor;
	}

	// --------------------------------------------------------------------

	public function get_where() 
	{
		foreach( $this->filtros as $campo => $valor ) {
			if( !($valor === '%') && !empty($valor) )	
			{
				$condiciones[] = $campo." = '".$valor."'";
			}
		}
		if( count($condiciones) > 0 ) 
		{
			$condicion  = ' WHERE ';
			$condicion .= join(' AND ', $condiciones); 
		}	
		return $condicion;
	}	

	// --------------------------------------------------------------------

	public function findAll() 
	{
		$sql = 'SELECT * FROM '.$this->tabla;
		return Conexion::query($sql);
	}

	// --------------------------------------------------------------------

	public function find($valor_clave) 
	{
		$sql = 'SELECT * FROM '.$this->tabla.' WHERE '.$this->clave.' = "'.$valor_clave.'"';
		$this->datos = Conexion::query_one($sql);
		if( empty($this->datos) ) muere('find. Registro no encontrado');		
		$this->adaptarDatosVista();
	}

	// --------------------------------------------------------------------

	public function get($campo, $valor) 
	{
		$sql = 'SELECT * FROM '.$this->tabla.' WHERE '.$campo.' = "'.$valor.'"';
		$this->datos = Conexion::query_one($sql);
		$this->adaptarDatosVista();
	}

	// --------------------------------------------------------------------

	public function dump() 
	{
		trace( $this->datos );
	}

	// --------------------------------------------------------------------

	public function datos_POST()
	{
		#trace($_POST);
		foreach( $this->campos as $campo => $propiedades ) {
			if ( !empty($_POST[$campo]) )
				$this->datos[$campo]=$_POST[$campo];
		}	
		#trace($this->datos);
	}

	// --------------------------------------------------------------------

	public function save()
	{
		if ( empty( $this->datos[$this->clave] )) 
		{ // CREATE 
			$rc = $this->validacion() && $this->validacionCreate() ;
			if( $rc )
			{
				return $this->create();
			}
		}
		else 
		{ // UPDATE 
			$rc = $this->validacion() && $this->validacionUpdate() ;
			if( $rc )
			{
				$this->update();
			}	
		}
		
		return $rc;	
	}

	// --------------------------------------------------------------------

	public function to_bbdd()
	{
		/* Esta funcion no efectua ni las validaciones ni ejecuta los triggers */
		if ( empty( $this->datos[$this->clave] )) 
		{ // CREATE 
			$datos = $this->adaptarDatosBBDD();
			$this->mysql_insert($datos);
			$this->datos[$this->clave]=mysql_insert_id();
		}
		else 
		{ // UPDATE 
			$datos = $this->adaptarDatosBBDD();
			$this->mysql_update($datos);
		}
		
		return $rc;	
	}

	// --------------------------------------------------------------------

	public function delete($valor_clave = '' )
	{
		$clave = empty($valor_clave) ? $this->datos[$this->clave] : $valor_clave ;
		$this->erase($clave);
	}

	// --------------------------------------------------------------------

	public function create()
	{
		// BEFORE CREATE
		$this->beforeCreateOrUpdate();
		$this->beforeCreate();

		// CREATE
		$datos = $this->adaptarDatosBBDD();
		$last_insert_id = $this->mysql_insert($datos);
		$this->datos[$this->clave]=mysql_insert_id();
  	Conexion::registro( array( 
			'operacion' => 'ALTA DE '.strtoupper($this->entidad),
			'entidad' => $this->entidad, 
			'entidad_id' => $this->datos[$this->clave], 
			'json' => mysql_real_escape_string( serialize($datos), Conexion::getConn())
		));

		// AFTER CREATE
		$this->afterCreate();
		$this->afterCreateOrUpdate();
		
		return $last_insert_id;
		
	}

	// --------------------------------------------------------------------

	public function update() 
	{
		// BEFORE UPDATE
		$this->beforeCreateOrUpdate();
		$this->beforeUpdate();

		// UPDATE
		$datos = $this->adaptarDatosBBDD();
/*
	When using UPDATE, MySQL will not update columns where the new value is the same as the old value.
	This creates the possibility that mysql_affected_rows() may not actually equal the number of rows matched,
	only the number of rows that were literally affected by the query. 
*/
		$mysql_affected_rows = $this->mysql_update($datos);
		if( 1 == $mysql_affected_rows )
		{
			Conexion::registro( array( 
				'operacion' => 'ACTUALIZACION DE '.$this->entidad,
				'entidad' => $this->entidad, 
				'entidad_id' => $this->datos[$this->clave], 
				'json' => mysql_real_escape_string( serialize($datos), Conexion::getConn())
			));
		}

		// AFTER UPDATE
		$this->afterUpdate();
		$this->afterCreateOrUpdate();
		
	}

	// --------------------------------------------------------------------

	public function replace() 
	{
		// REPLACE
		$datos = $this->adaptarDatosBBDD();
		$this->mysql_replace($datos);
  	Conexion::registro( array( 
			'operacion' => 'ALTA-ACTUALIZACION DE '.$this->entidad,
			'entidad' => $this->entidad, 
			'entidad_id' => $this->datos[$this->clave], 
			'json' => mysql_real_escape_string( serialize($datos), Conexion::getConn())
		));
	}

	// --------------------------------------------------------------------

	public function erase($valor_clave) 
	{
		$this->find($valor_clave);
		
		// BEFORE DELETE
		$this->beforeDelete();
		
		// DELETE
  	Conexion::registro( array( 
			'operacion' => 'BORRADO DE '.$this->entidad,
			'entidad' => $this->entidad, 
			'entidad_id' => $this->datos[$this->clave],
			'json' => mysql_real_escape_string( serialize($this->datos), Conexion::getConn())
		));
		$sql = 'DELETE FROM '.$this->tabla.' WHERE '.$this->clave.' = "'.$valor_clave.'"';
		Conexion::execute_one($sql); 
		
		// AFTER DELETE
		$this->afterDelete();
		
	}

	// --------------------------------------------------------------------

	public function mysql_insert($datos)
	{
		$datos=$this->limpia_datos($datos);
		foreach( $datos as $campo => $valor)
		{
			if( $campo != $this->clave )
			{
				$campos[] = $campo;
				$valores[] = ( 'NULL' == $valor ) ? $valor : "'".$valor."'";
			}	
		}
		$sql = 'INSERT INTO '.$this->tabla.' ('. join($campos, ',') .') VALUES ('. join($valores, ',') .')';
		Conexion::execute($sql); 
		return mysql_insert_id();
	}

	// --------------------------------------------------------------------

	public function mysql_update($datos)
	{
		$datos=$this->limpia_datos($datos);
		$where = ' WHERE '.$this->clave.' = "'.$datos[$this->clave].'"' ;
		foreach( $datos as $campo => $valor)
		{
			$valor = ( 'NULL' == $valor ) ? $valor : "'".$valor."'";
			if( $campo != $this->clave ) $tmp[] = $campo." = ".$valor;
		}
		$sql  = ' UPDATE '.$this->tabla.' SET '.( join(', ', $tmp) ).$where.' LIMIT 1;';
		return Conexion::execute($sql);
	}

	// --------------------------------------------------------------------

	public function mysql_replace($datos)
	{
		$datos=$this->limpia_datos($datos);
		$campos = implode(array_keys($datos), ',');
		$valores = "'".implode( array_values($datos), "','" )."'"; 
		$sql = 'REPLACE INTO '.$this->tabla.' ('.$campos.') VALUES ('.$valores.')';
		Conexion::execute_one($sql); 
	}

	// --------------------------------------------------------------------

	public function limpia_datos($datos)
	{
		/* Elimina del array $datos aquellas entradas que no sean campos de la tabla */
		$tmp=array();
		foreach( $datos as $clave => $valor )
			if( in_array($clave, $this->campos) ) $tmp[$clave] = $valor;
		return $tmp;
	}

	// --------------------------------------------------------------------

	protected function adaptarDatosBBDD() 
	{
		return $this->datos;
	}

	// --------------------------------------------------------------------

	protected function adaptarDatosVista() 
	{
	}

	// --------------------------------------------------------------------

	protected function adaptarDatosFechaVista() 
	{
		
		$campos_date = $this->fields_type['date'];
		if( !empty($campos_date) )
		{ 
			foreach( $campos_date as $campo )
			{
				$this->datos[$campo] = date_normal( $this->datos[$campo] );
				if( '00/00/0000' == $this->datos[$campo] )  $this->datos[$campo] = '' ;
			}
		}		
		
	}

	// --------------------------------------------------------------------

	protected function validacion() 
	{
		return true;
	}

	// --------------------------------------------------------------------

	protected function validacionCreate() 
	{
		return true;
	}

	// --------------------------------------------------------------------

	protected function validacionUpdate() 
	{
		return true;
	}

	// --------------------------------------------------------------------

	protected function beforeCreateOrUpdate() 
	{
	}

	// --------------------------------------------------------------------

	protected function beforeCreate() 
	{
	}

	// --------------------------------------------------------------------

	protected function beforeUpdate() 
	{
	}

	// --------------------------------------------------------------------

	protected function beforeDelete() 
	{
	}

	// --------------------------------------------------------------------

	protected function afterCreateOrUpdate() 
	{
	}

	// --------------------------------------------------------------------

	protected function afterCreate() 
	{
	}

	// --------------------------------------------------------------------

	protected function afterUpdate() 
	{
	}

	// --------------------------------------------------------------------

	protected function afterDelete() 
	{
	}

	// --------------------------------------------------------------------

	public function __call($metodo, $atributos) 
	{
		if( array_key_exists($metodo, $this->asociaciones) ) 
		{
			$clase_entidad = $this->asociaciones[$metodo];
			return $this->asociacion( $clase_entidad );
		}
			
		echo "El metodo $metodo no exister en la clase";
	}

	// --------------------------------------------------------------------

	public function __set($attr,$valor)
	{
		$this->datos[$attr] = $valor;
	}

	// --------------------------------------------------------------------

	public function __get($attr)
	{
		return $this->datos[$attr];
	}

	// --------------------------------------------------------------------

	public function __isset($attr)
	{
		return isset($this->datos[$attr]);
	}

	// --------------------------------------------------------------------

	public function asociacion( $clase_entidad ) 
	{
//trace($clase_entidad);		
		$entidad = crear_objeto($clase_entidad);
		$entidad_tabla = $entidad->tabla;
		$entidad_clave = $entidad->clave;
		
		$this_clave = $this->clave;
		$this_valor_clave = $this->datos[$this->clave];
		
		$sql = "SELECT $entidad_clave AS clave_id FROM $entidad_tabla WHERE $this_clave = '$this_valor_clave'";	
		$registros = Conexion::query($sql);
		foreach( $registros as $row )
		{
			$entidad = crear_objeto($clase_entidad);
			$entidad->find( $row['clave_id'] );
			$entidades[] = $entidad;
		}
		
		return $entidades;
	}

	// --------------------------------------------------------------------

} //Fin de la clase

?>