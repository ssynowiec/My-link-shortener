<?php
	
	$mysqli = new mysqli('', '', '', '');

	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}

?>