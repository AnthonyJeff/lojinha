<?php
	require(dirname(__DIR__).'/models/config.php');
	require(dirname(__DIR__).'/models/class/App.class.php');
	require(dirname(__DIR__).'/models/class/Connect.class.php');
	require(dirname(__DIR__).'/models/class/Manager.class.php');

	new App($GLOBALS['path'], $GLOBALS['index']);

	$action = ( isset($_POST['action']) ) ? $_POST['action'] : $_GET['action'];

	switch ($action) {
		case 'new':

			if( isset($_FILES) ){
				$_POST['product_image'] = App::upload($_FILES['product_image']);
			}else{
				$_POST['product_image'] = "";
			}

			$_POST['product_value'] = App::formatMoney( $_POST['product_value'], 'in');

			manager::insert('tb_products',$_POST, null);
			header('location: '.$GLOBALS['index'].'/produtos/gerenciar/cadastrado');
		break;

		case "percent":
			if(isset($_POST['remove-percent'])){
				manager::update('tb_products',array('product_percent' => "", 'product_valuewithpercent' => ""), array('id_product' => $_POST['id_product']),null);
				header('location: '.$GLOBALS['index'].'/produtos/gerenciar/desconto-removido');
			}else{
				manager::update('tb_products',array('product_percent' => $_POST['product_percent'], 'product_valuewithpercent' => $_POST['product_valuewithpercent']), array('id_product' => $_POST['id_product']),null);
				header('location: '.$GLOBALS['index'].'/produtos/gerenciar/desconto-feito');
			}
			
		break;

		case 'delete':
			manager::delete('tb_categories',array('id_category' => $_POST['id_category']), null);
			header('location: '.$GLOBALS['index'].'/categorias/gerenciar/deletado');
		default:
			# code...
			break;
	}
?>