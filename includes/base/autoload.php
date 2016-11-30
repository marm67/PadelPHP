<?php

  if (!defined('BASEPATH')) exit('Script no ejecutable');

  $clases = array(
      //----------------------------------------------------------------------------------	
      // Clases Base
      //----------------------------------------------------------------------------------	
      'Conexion' => BASEPATH . '/includes/base/clases/Conexion.php',
      'Vista'    => BASEPATH . '/includes/base/clases/Vista.php',
  );

  function __autoload($clase) {
      global $clases;

      if (isset($clases[$clase]))
      {
          require $clases[$clase];
      } else
      {
          var_dump($clase);
      }
  }

?>