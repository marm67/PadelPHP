<html>
<head>
<title></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

<link href="javascripts/jquery/plugins/dataTables-1.6/media/css/demo_page.css" rel="stylesheet" type="text/css" />
<link href="javascripts/jquery/plugins/dataTables-1.6/media/css/demo_table_jui.css" rel="stylesheet" type="text/css" />
<link href="stylesheets/jquery-ui-1.7.1.custom.css" rel="stylesheet" type="text/css" />
<?php
	if( 'msie' ==  browser_info() ) 
		echo '<link href="stylesheets/estilo_msie.css" rel="stylesheet" type="text/css" />';
	else	
		echo '<link href="stylesheets/estilo.css" rel="stylesheet" type="text/css" />';
?>
<link href="javascripts/jquery/plugins/TableTools/media/css/TableTools.css" rel="stylesheet" type="text/css" />

<script src="javascripts/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="javascripts/jquery/jquery-ui-1.7.2.custom.min.js" type="text/javascript"></script>
<script type="text/javascript" src="javascripts/jquery/plugins/dataTables-1.6/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="javascripts/jquery/plugins/TableTools/media/js/TableTools.js"></script>
<script type="text/javascript" src="javascripts/jquery/plugins/TableTools/media/ZeroClipboard/ZeroClipboard.js"></script>
<script src="javascripts/proyectos.js" type="text/javascript"></script>

</head>

<body style="padding:.5em;">
<div id="div_contenedor_spinner" style="display:none;text-align:center">
  <div class="div_spinner">&nbsp;</div>
</div>
<div id="contenido">