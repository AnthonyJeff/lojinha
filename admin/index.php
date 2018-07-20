<?php
	session_start();
	require('models/config.php');
	require('models/validate.php');
	
	if ( isset($_SESSION['user']) ) {

		require('views/application.php');
	}else{
		require('views/login.php');
	}
?>