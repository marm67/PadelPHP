<?php
//----------------------------------------------------------------------------------	
function signo($x) 
{
	if (empty($x) && '0' != $x)  return NULL;
	return $x ? ($x>0 ? 1 : -1) : 0;
}
//----------------------------------------------------------------------------------	
function join_array($t, $sep = " / ") 
{ 
	// Elimina las entrada vacias del array.
	return join( array_filter($t), $sep);
}
//----------------------------------------------------------------------------------	
function trace($v) 
{
	echo '<pre>';
	print_r($v);
	echo '</pre>';
}
//----------------------------------------------------------------------------------	
function trace_pila() 
{
	var_dump(debug_backtrace());
}
//----------------------------------------------------------------------------------	
function do_post_request($url, $data, $optional_headers = null) {
   $params = array('http' => array(
                'method' => 'POST',
                'content' => $data
             ));
   if ($optional_headers !== null) {
      $params['http']['header'] = $optional_headers;
   }
   $ctx = stream_context_create($params);
   $fp = @fopen($url, 'rb', false, $ctx);
   if (!$fp) {
      return "Error de conexion con $url, $php_errormsg";
   }
   $response = @stream_get_contents($fp);
   if ($response === false) {
      return "Error leyendo los datos desde $url, $php_errormsg";
   }
   return $response;
}
//----------------------------------------------------------------------------------	
function browser_info($agent=null) {
  // Declare known browsers to look for
  $known = array('msie', 'firefox', 'safari', 'webkit', 'opera', 'netscape',
    'konqueror', 'gecko');

  // Clean up agent and build regex that matches phrases for known browsers
  // (e.g. "Firefox/2.0" or "MSIE 6.0" (This only matches the major and minor
  // version numbers.  E.g. "2.0.0.6" is parsed as simply "2.0"
  $agent = strtolower($agent ? $agent : $_SERVER['HTTP_USER_AGENT']);
  $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9]+(?:\.[0-9]+)?)#';

  // Find all phrases (or return empty array if none found)
  if (!preg_match_all($pattern, $agent, $matches)) return array();

  // Since some UAs have more than one phrase (e.g Firefox has a Gecko phrase,
  // Opera 7,8 have a MSIE phrase), use the last one found (the right-most one
  // in the UA).  That's usually the most correct.
  $i = count($matches['browser'])-1;
//  return $matches['browser'][$i] . ' , ' . $matches['version'][$i]);
  return $matches['browser'][$i];
}
//----------------------------------------------------------------------------------	
?>