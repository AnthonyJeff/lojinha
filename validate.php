<?php
	session_start();
	// arquivos
	require('config.php');
	require('admin/models/class/App.class.php');
	require('admin/models/class/Connect.class.php');
	require('admin/models/class/Manager.class.php');

	// especificações de site
	if( !isset($_SESSION['cart']) ){
		$cart['ip'] = $_SERVER['REMOTE_ADDR'];
		$cart['browser'] = $_SESSION['HTTP_USER_AGENT'];
		$cart['timestamp'] = date('Y-m-d H:i:s');
		$cart['products'] = [];
		$_SESSION['cart'] = $cart;
	}

	new App( $route['path'].'/admin', $route['index'].'/admin' );

	// produtoa
	$tbproducts['tb_products'] = [];
	$tbproducts['tb_categories'] = [];
	$relproducts['tb_products.category_id'] = "tb_categories.id_category";

	if( isset($_GET['category']) ) $filterproducts['id_category'] = $_GET['category'];
	if( isset($_GET['product']) ) $filterproducts['id_product'] = $_GET['product'];
	if( !isset($_GET['product']) and !isset($_GET['category']) ) $filterproducts = null;

	$products = manager::select_join($tbproducts, $relproducts, $filterproducts, " ORDER BY id_product DESC");

	// categorias
	$categories = manager::select('tb_categories', null, null, null);

	// produtos em destaque
	$products_featured = manager::select('tb_products',null, null, " LIMIT 20");

	//session_destroy();
?>