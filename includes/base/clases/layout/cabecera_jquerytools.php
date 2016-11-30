<html>
<head>
<title></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

<?php
	if( 'msie' ==  browser_info() ) 
		echo '<link href="stylesheets/estilo_msie.css" rel="stylesheet" type="text/css" />';
	else	
		echo '<link href="stylesheets/estilo.css" rel="stylesheet" type="text/css" />';
?>

<script src="media/js/jquery.tools.min.js" type="text/javascript"></script>
<script src="javascripts/proyectos.js" type="text/javascript"></script>

</head>

<body style="padding:.5em;">
<div id="div_contenedor_spinner" style="display:none;text-align:center">
  <div class="div_spinner">&nbsp;</div>
</div>
<div id="contenido">