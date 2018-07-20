<?php
	$root = "/admin";
	$protocol = "http://";
	$GLOBALS['path'] = $_SERVER['DOCUMENT_ROOT'].$root;
	$GLOBALS['index'] = $protocol.$_SERVER['SERVER_NAME'].$root;

	$db['host'] = "localhost";
	$db['user'] = "a4devcom_store";
	$db['pass'] = "click.123";
	$db['db'] = "a4devcom_store";
?>