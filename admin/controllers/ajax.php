<?php
	require(dirname(__DIR__).'/models/config.php');
	require(dirname(__DIR__).'/models/class/App.class.php');
	require(dirname(__DIR__).'/models/class/Connect.class.php');
	require(dirname(__DIR__).'/models/class/Manager.class.php');

	new App($GLOBALS['path'], $GLOBALS['index']);

	$action = ( isset($_POST['action']) ) ? $_POST['action'] : $_GET['action'];

	switch ($action) {
		case 'dashboard-charts':
			// array de retorno
			$return = [];

			// vendas da semana
			$sales_weeek_array = [];
			for( $days = -3 ; $days <= 3 ; $days++ ){
				
				if( $days == 1 or $days == -1 ){
					$date = date('Y-m-d', strtotime($days.' day'));
				}elseif( $days == 0 ){
					$date = date('Y-m-d');
				}else{
					$date = date('Y-m-d', strtotime($days.' days'));
				}

				$search = manager::select("tb_sales",null,null," WHERE sale_timestamp LIKE '%".$date."%'");
				if( $search ){
				}
			}
			
			// buffer de saida json
			//echo json_encode($return);
		break;
	}

?>