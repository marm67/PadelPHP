<?php
    if( !defined('BASEPATH') )
        exit('Acceso no valido');

    class Conexion
    {
        public static $trace = FALSE;

        public static $conn = NULL;

        public static $host = 'localhost';
        public static $database = 'padel';
        public static $username = 'padel';
        public static $password = 'padel';
        public static $charset = 'latin1';
        public static $collate = 'latin1_spanish_ci';

        //----------------------------------------------------------------------------------
        public static function getConn()
        {
            if( NULL == self::$conn )
            {
                if( self::$conn = mysql_connect(self::$host, self::$username, self::$password) )
                {
                    mysql_select_db(self::$database, self::$conn);
                    $charset = self::$charset;
                    $collate = self::$collate;
                    mysql_query("SET NAMES '{$charset}' COLLATE '{$collate}'", self::$conn);
                }
                else
                {
                    echo 'Error:' . mysql_error();
                }
            }

            return self::$conn;
        }

        //----------------------------------------------------------------------------------
        public static function getAll($tabla)
        {
            return self::query("SELECT * FROM $tabla");
        }

        //----------------------------------------------------------------------------------
        public static function getRows($sql)
        {
            return self::query($sql);
        }

        //----------------------------------------------------------------------------------
        public static function getRow($sql)
        {
            return array_shift(self::query($sql));
        }

        //----------------------------------------------------------------------------------
        public static function getCell($sql)
        {
            return array_shift(self::getRow($sql));
        }

        //----------------------------------------------------------------------------------
        public static function query($sql)
        {
            if( self::$trace )
                self::trace($sql);

            $rs = mysql_query($sql, self::getConn()) or self::muere();
            $rows = array();
            while( $row = mysql_fetch_assoc($rs) )
                $rows[] = $row;
            mysql_free_result($rs);
            return $rows;
        }

        //----------------------------------------------------------------------------------
        public static function query_one($sql)
        {
            return self::getRow($sql);
        }

        //----------------------------------------------------------------------------------
        public static function valor_unico($sql)
        {
            return self::getCell($sql);
        }

        //----------------------------------------------------------------------------------
        public static function valor($sql)
        {
            return self::getCell($sql);
        }

        //----------------------------------------------------------------------------------
        public static function execute($sql)
        {
            if( self::$trace )
                self::trace($sql);
            mysql_query($sql, self::getConn()) or self::muere();
            return mysql_affected_rows();
        }

        //----------------------------------------------------------------------------------
        public static function execute_one($sql)
        {
            if( self::$trace )
                self::trace($sql);

            $null = mysql_query("START TRANSACTION", self::$conn);
            $rs = mysql_query($sql, self::$conn);
            $mysql_affected_rows = mysql_affected_rows();
            if( 1 == $mysql_affected_rows )
            {
                mysql_query("COMMIT", self::$conn);
            }
            else
            {
                mysql_query("ROLLBACK", self::$conn);
                die('Error execute_one <b>' . $sql . '</b> - mysql_affected_rows()=' . $mysql_affected_rows);
            }
        }

        //----------------------------------------------------------------------------------
        /**
         * Devuelve last insert id para la conexion actual
         */
        public static function getLastInsertId()
        {
            return mysql_insert_id();
        }

        //----------------------------------------------------------------------------------
        /**
         * Proteccion contra sql injections
         *
         */
        public static function quote_smart($valor)
        {
            if( get_magic_quotes_gpc() )
            {
                $valor = stripslashes($valor);
            }

            $valor = "'" . mysql_real_escape_string($valor, self::getConn()) . "'";

            return $valor;
        }

        //----------------------------------------------------------------------------------
        public static function close()
        {
            if( mysql_ping(self::getConn()) )
            {
                mysql_close(self::getConn());
            }
            self::$conn = NULL;
        }

        //----------------------------------------------------------------------------------
        public static function trace($txt)
        {
            echo '<pre>';
            print_r($txt);
            echo '</pre>';
        }

        //----------------------------------------------------------------------------------
        public static function registro($datos)
        {
            global $app;

            $usuario = $app['usuario'];
            if( empty($usuario) )
            {
                $matricula = 'SISTEMA';
            }
            else
            {
                $matricula = $usuario -> matricula;
            }

            $evento_id = empty($app['evento_id']) ? 'NULL' : $app['evento_id'];

            $ts = date("Y-m-d H:i:s");

            $sql = " INSERT INTO aes_log ( evento_id, usuario, operacion, entidad, entidad_id, ts ) VALUES ( ";
            $sql .= $evento_id . ", ";
            $sql .= " '" . $matricula . "', ";
            $sql .= " UPPER('" . $datos['operacion'] . "'), ";
            $sql .= " UPPER('" . $datos['entidad'] . "'), ";
            $sql .= " UPPER('" . $datos['entidad_id'] . "'), ";
            $sql .= " '" . $ts . "' );";

            self::execute($sql);
        }

        //----------------------------------------------------------------------------------
        private static function muere($msg = '')
        {

            if( $msg == '' )
                $msg = mysql_error();

            //Grabar en el log o hacer algo antes de die
            $kk['MENSAJE'] = $msg;
            $kk['$_SERVER'] = $_SERVER;
            $kk['$_GET'] = $_GET;
            $kk['$_POST'] = $_POST;
            ob_start();
            print_r($kk);
            $json = ob_get_contents();
            ob_end_clean();
            /*
             $this->registro( array('operacion'=>'ERROR APLICACION',
             'entidad'=>'APLICACION',
             'entidad_id'=>$_SERVER['HTTP_REFERER'],
             'json'=>$json ));
             */
            die($msg);
        }

        //----------------------------------------------------------------------------------
        public static function get_databases()
        {
            $sql = 'SHOW DATABASES;';
            return self::aplana(self::query_row($sql));
        }

        //----------------------------------------------------------------------------------
        public static function get_tables($bbdd)
        {
            $sql = 'SHOW TABLES FROM ' . $bbdd;
            return self::aplana(self::query_row($sql));
        }

        //----------------------------------------------------------------------------------
        public static function get_fields($bbdd, $tabla)
        {
            $sql = 'SHOW FIELDS FROM ' . $bbdd . '.' . $tabla;
            return self::aplana(self::query_row($sql));
        }

        //----------------------------------------------------------------------------------
        private static function aplana($rows)
        {
            foreach( $rows as $row )
                $tmp[] = $row[0];
            return $tmp;
        }

        //----------------------------------------------------------------------------------
    } //Fin de la clase
