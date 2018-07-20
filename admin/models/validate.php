<?php
	require('models/config.php');
	require('models/class/App.class.php');
	require('models/class/Connect.class.php');
	require('models/class/Manager.class.php');

	// instaciando a aplicação
	new App($GLOBALS['path'], $GLOBALS['index']);
	
	switch( App::route(1) ) {
		case 'painel-de-controle':
			$dependency['file'] = "dashboard";
			$dependency['title'] = "Painel Administrativo";
			$dependency['window_title'] = "Painel Administrativo - Lojinha";
		break;

		case 'produtos':
			$dependency['file'] = "products";
			$dependency['title'] = "Produtos";
			$dependency['window_title'] = "Produtos - Lojinha";
			$dependency['products'] = manager::select('tb_products',null,null,null);
			$dependency['categories'] = manager::select('tb_categories',null,null,null);
		break;

		case 'categorias':
			$dependency['file'] = "Categories";
			$dependency['title'] = "Categorias";
			$dependency['window_title'] = "Categorias - Lojinha";
			$dependency['categories'] = manager::select('tb_categories',null,null,null);
		break;

		case 'vendas':
			if( App::route(2) == "gerenciar" ){
				$dependency['file'] = "sales";
				$dependency['title'] = "Vendas Realizadas";
				$dependency['window_title'] = "Vendas Realizadas - Lojinha";

				$tb["tb_sales"] = [];
				$tb["tb_products"] = [];
				$tb["tb_productsales"] = [];
				$tb["tb_freights"] = [];
				$tb["tb_clients"] = [];
				$rel["tb_sales.id_sale"] = "tb_productsales.sale_id";
				$rel["tb_productsales.product_id"] = "tb_products.id_product";
				$rel["tb_sales.client_id"] = "tb_clients.id_client";
				$rel["tb_sales.freight_id"] = "tb_freights.id_freight";
				$dependency['sales'] = manager::select_join($tb,$rel,null,null);
			}elseif( App::route(2) == "detalhes-da-venda" ){
				$dependency['file'] = "detail-sale";
				$dependency['title'] = "Detalhes da Venda";
				$dependency['window_title'] = "Detalhes da Venda - Lojinha";

				$tb["tb_sales"] = [];
				$tb["tb_freights"] = [];
				$tb["tb_clients"] = [];
				$rel["tb_sales.client_id"] = "tb_clients.id_client";
				$rel["tb_sales.freight_id"] = "tb_freights.id_freight";
				$fil["id_sale"] = App::route(3);
				$dependency['sale'] = manager::select_join($tb,$rel,null,null);

				if(!$dependency['sale']){
					App::error404();
				}
			}
		break;

		case "404":
			$dependency['file'] = "404";
			$dependency['window_title'] = "Error 404 - Lojinha";
			$dependency['title'] = "<i class='fa fa-close'></i> Pagina não encontrada";
		break;

		default:
			$dependency['file'] = "404";
			$dependency['window_title'] = "Error 404 - Lojinha";
			$dependency['title'] = "<i class='fa fa-close'></i> Pagina não encontrada";
		break;
	}
?>