<?php
	session_start();
	require(dirname(__DIR__).'/models/config.php');
	require(dirname(__DIR__).'/models/class/Connect.class.php');
	require(dirname(__DIR__).'/models/class/Manager.class.php');

	if( $_GET['method'] == "in" ){
		// testando email
		$log = manager::select('tb_users',null,array('user_email' => $_POST['user_email']), " LIMIT 1");
		if( $log ){
			// testando senha
			if( $log[0]['user_password'] == md5($_POST['user_password']) ){
				// criando acesso
				$_SESSION['user'] = $log[0];
				header('location: '.$GLOBALS['index'].'/painel-de-controle');
			}else{
				header('location: '.$GLOBALS['index'].'/?error=senha incorreta');
			}
		}else{
			header('location: '.$GLOBALS['index'].'/?error=email incorreto');
		}
	}elseif( $_GET['method'] == "out" ){
		session_destroy();
		header('location: '.$GLOBALS['index'].'/?success=Volte Sempre');
	}
?>