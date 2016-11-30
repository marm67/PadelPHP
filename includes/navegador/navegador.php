<?php if ( !defined('BASEPATH')) muere('Acceso no permitido');?>
<style>
body {
    background-color: #FAFAFA;
    border-right: 1px solid #CCCCCC;
    margin: 0;
    padding: 0;
		overflow: auto !important;
}
#tabla_navegador td.grupo {
    background-color: #EEEEEE;
    color: #2E6E9E;
    font-weight: bold;
    padding: 0.5em 5px 5px;
    border-top: 1px solid #FAFAFA;
    border-bottom: 1px solid #FAFAFA;
}
#tabla_navegador td.fin_grupo {
 	border-bottom: 1px solid #CCCCCC;
}
#tabla_navegador td.primero_post_grupo {
 	border-top: 1px solid #CCCCCC;
}
a:link {
    color:  #0066CC;
    text-decoration: none;
}
a:visited {
    color: #0066CC;
    text-decoration: none;
}
a:active {
    color: #0066CC;
    text-decoration: none;
}
a:hover {
    color: #006600;
    text-decoration: none;
}</style>	
<table width="100%" cellspacing="0" cellpadding="0" align="left" id="tabla_navegador">

  <tbody>
	
  <tr><td class="grupo">Tablas</td></tr>
  <tr>
	<td class="primero_post_grupo"><a id="ejecuciones_d" href="#" onclick="return formulario(this);" target="mainFrame">Ejecuciones por día</a></td>
  </tr>
  <tr>
	<td><a id="abends" href="#" onclick="return formulario(this);" target="mainFrame">Probabilidad de Abends</a></td>
  </tr>

  <tr><td>&nbsp;</td></tr>
  <tr>
	<td><a href="app.php?o=carga.listado" target="mainFrame">Carga de las tablas</a></td>
  </tr>
  <tr><td class="fin_grupo">&nbsp;</td></tr>
  
  <tr><td class="grupo">Filtros</td></tr>
  <tr><td class="primero_post_grupo">&nbsp;</td></tr>
  <tr><td>
	<form id="formulario" target="mainFrame">
		<p>TRANSACCION: <input type="text" id="tx"></p>
		<div id="datepicker"></div>
	</form>
  </td></tr>

  </tbody>
</table>

<script>

var enlaces = {
	"ejecuciones_d": "app.php?o=ejecuciones_d.listado",
	"abends": "app.php?o=abends.listado",
};

function formulario(enlace)
{
// alert(indicador);
	var tx = $('#tx').val().toUpperCase();
	if( tx == '' ) {
		alert('Falta TX');
		return false;
	}	

	var id =  $(enlace).attr("id");
	$('#tx').val(tx);
	
	var date = $("#datepicker").datepicker("getDate");
	var aaaa = date.getFullYear();
	var mm = ("0" + (date.getMonth() + 1)).slice(-2);
	var dd = ("0" + date.getDate()).slice(-2);
	var fecha = aaaa + '-' + mm + '-' + dd;
	
	var url = enlaces[id];
	url += "&tx=" + tx;
	url += "&fecha=" + fecha;
	
//	alert(url);
	$(enlace).attr("href", url);
	
	return true;
}


$(document).ready(function() {
	$('#tabla_navegador').find("a[target='mainFrame']").click(function() {
		$('#tabla_navegador').find("a[target='mainFrame']").parent().removeClass("selected");
		$(this).parent().toggleClass("selected");
	});
	
	$( "#datepicker" ).datepicker();
});	
</script>
