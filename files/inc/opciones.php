<?php 
$mod = isset($_GET['mod']) ? str_replace('.', '', $_GET['mod']) : '';


if($mod) {
	$dir = "pages/{$mod}.php";
	
	if($dir) {	
			include($dir);
		
	} else {
		echo('The module does not exist');
	}
	
} else {
	echo '
Select an option from the menu.';
} 

//$swphp_contenido = ob_get_clean();                                                                                                                         