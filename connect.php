<?php 
	$connection = new mysqli('localhost', 'root','','dbjaranillaf3');
	
	if (!$connection){
		die (mysqli_error($mysqli));
	}
		
?>