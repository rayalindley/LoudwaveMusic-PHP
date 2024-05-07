<?php 
	$connection = new mysqli('localhost', 'root','','dbloudwavemusic');
	
	if (!$connection){
		die (mysqli_error($mysqli));
	}
		
?>