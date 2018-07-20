<?php
	require(dirname(__DIR__).'/models/config.php');
	require(dirname(__DIR__).'/models/class/Connect.class.php');
	require(dirname(__DIR__).'/models/class/Manager.class.php');

	$action = ( isset($_POST['action']) ) ? $_POST['action'] : $_GET['action'];

	switch ($action) {
		case 'new':
			manager::insert('tb_categories',$_POST, null);
			header('location: '.$GLOBALS['index'].'/categorias/gerenciar/cadastrado');
		break;

		case 'delete':
			manager::delete('tb_categories',array('id_category' => $_POST['id_category']), null);
			header('location: '.$GLOBALS['index'].'/categorias/gerenciar/deletado');
		default:
			# code...
			break;
	}
?>