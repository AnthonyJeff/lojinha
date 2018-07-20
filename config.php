<?php
	// validações
	$project = ""; // diretorio onde o projeto se encontra
	$protocol = "http://"; // protocolo de rede
	
	$route['path'] = $_SERVER['DOCUMENT_ROOT'].$project;
	$route['index'] = $protocol.$_SERVER['SERVER_NAME'].$project;
?>