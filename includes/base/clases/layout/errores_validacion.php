<?php
	echo '<div id="div_errores" class="ui-state-error ui-corner-all" style="margin-bottom:3px;" >';
		echo '<span style="float:left; margin-right:0.3em;" class="ui-icon ui-icon-alert"/></span>';
		echo '<div style="padding:.5em 2em;">';
		echo '  <div class="error-title">Se han detectado errores en los siguientes campos.</div>';
		foreach ($params as $campo => $error) 
		{
			echo '<div style="clear:both;">';
				echo '<div class="error-label">'.$campo.'</div>';
				echo '<div class="error-desc">'.$error.'</div>';
			echo '</div>';
		}
		echo '</div>';
	echo '</div>';
?>
