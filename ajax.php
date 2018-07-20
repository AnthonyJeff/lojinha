<?php
	require('vendor/autoload.php');
	require('admin/models/config.php');
	require('admin/models/class/App.class.php');
	require('admin/models/class/Connect.class.php');
	require('admin/models/class/Manager.class.php');

	use FlyingLuscas\Correios\Client;
	use FlyingLuscas\Correios\Service;

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;


	session_start();

	new App("path", "index");

	$method = (isset($_POST['method'])) ? $_POST['method'] : $_GET['method'];

	switch ($method) {
		case 'add-to-cart':
			unset($_POST['method']);

			// verificando se existe produto no carrinho
			$exist = false;
			foreach($_SESSION['cart']['products'] as $k => $v):
				if( $_POST['id_product'] == $v['id_product'] ):
					$exist = true;
					$key = $k;
				endif;
			endforeach;

			if( $exist == true ){
				$_SESSION['cart']['products'][$key]['product_quantity'] += 1;
				echo true;
			}else{
				if( array_unshift($_SESSION['cart']['products'], $_POST) ) {
					echo true;
				}else{
					echo false;
				}
			}
		break;

		case "endsale":

			// dados de frete
			$freight['freight_for'] = $_POST['freight_for'];
			$freight['freight_value'] = $_POST['freight_value'];
			$freight['freight_code'] = $_POST['freight_code'];
			$freight['freight_deadline'] = $_POST['freight_deadline'];
			$freight['freight_destiny'] = $_POST['freight_destiny'];
			$id_freight = manager::insert('tb_freights', $freight, null);

			// dados do cliente
			$client['client_name'] = $_POST['client_name'];
			$client['client_email'] = $_POST['client_email'];
			$client['client_cpf'] = $_POST['client_cpf'];

			$id_client = manager::insert('tb_clients', $client, null);

			// protocolo de venda
			$protocol = rand(1000,999).date('is');
			//$protocol = str_replace(".", "", $_SESSION['cart']['ip']);

			// dados da venda
			$quantity_sale = 0;
			foreach ($_SESSION['cart']['products'] as $key => $value) {
				$quantity_sale += ($value['product_quantity']);
			}

			$sale['sale_value'] = $_POST['sale_value'];
			$sale['sale_quantity'] = $quantity_sale;
			$sale['sale_protocol'] = $protocol;
			$sale['freight_id'] = $id_freight;
			$sale['client_id'] = $id_client;

			$id_sale = manager::insert('tb_sales',$sale, null);

			// dados dos produtos
			foreach ($_SESSION['cart']['products'] as $key => $value) {
				$productsale['sale_id'] = $id_sale;
				$productsale['product_id'] = $value['id_product'];
				$productsale['productsale_quantity'] = $value['product_quantity'];
				$productsale['productsale_percent'] = $value['product_percent'];
				$productsale['productsale_value'] = $value['product_value'];
				$productsale['productsale_valuewithpercent'] = $value['product_valuewithpercent'];
				manager::insert('tb_productsales', $productsale, null);
			}

			//arquivando sessão
			unset($_SESSION['cart']);


		
			// envio de email
			$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
			try {
			    //Server settings
			    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
			    $mail->isSMTP();                                      // Set mailer to use SMTP
			    $mail->Host = 'host.oficialserver.com';  // Specify main and backup SMTP servers
			    $mail->SMTPAuth = true;                               // Enable SMTP authentication
			    $mail->Username = 'contato@a4dev.com.br';                 // SMTP username
			    $mail->Password = base64_decode('Y2xpY2suMTIz');                           // SMTP password
			    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
			    $mail->Port = 465;                                    // TCP port to connect to

			    //Recipients
			    $mail->setFrom('eric@a4dev.com.br', 'Registro de Compras na Lojinha');
			    //$mail->addAddress('brunoviana@bleez.com.br', 'Bruno Viana');     // Add a recipient
			    $mail->addAddress('metal123eric@gmail.com', 'Eric Campos');

			    /*
			    $mail->addReplyTo('info@example.com', 'Information');
			    $mail->addCC('cc@example.com');
			    $mail->addBCC('bcc@example.com');
			    */

			    //Attachments
			    /*
			    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
				*/

			    //Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'Registro de Compra na Lojinha';
			    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
			    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			    $mail->send();
			    echo "enviado";
			    //header('location: '.$route['index'].'?protocol='.$protocol);
			} catch (Exception $e) {
			    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
			}

			//header('location: '.$route['index'].'?protocol='.$protocol);

		break;

		case "verify-cart":
			if( !empty($_SESSION['cart']['products']) ){
				$total_quantity = 0;
				foreach($_SESSION['cart']['products'] as $k => $v):
					$total_quantity += $v['product_quantity'];
				endforeach;
				echo $total_quantity;
			}else{
				echo 0;
			}
		break;

		case 'cal-freight':
			$freight = App::freightCalc( intval($_POST['type']) ,"20081902", $_POST['cep'], '1','15','22', '32', $_POST['value']);
			if($freight){
				$return['error'] = false;
				$return['data'] = $freight;
			}else{
				$return['error'] = true;
			}
			echo json_encode($return);
		break;

		case 'calculate-freight':
			
			$correios = new Client;

			$return = $correios->freight()
			    ->origin('20081-902') // CEP de origem padrão
			    ->destination($_POST['cep'])
			    ->services(Service::SEDEX, Service::PAC)
			    ->item(16, 16, 16, .3, 1) // largura, altura, comprimento, peso e quantidade, valores de teste
			    ->calculate();

			echo json_encode($return);
		break;
		
		default:
			# code...
			break;
	}
?>