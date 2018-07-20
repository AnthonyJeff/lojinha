<?php
	ini_set("display_errors",1);
	error_reporting(E_ALL);

	include('validate.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Entre na moda - Lojinha Virtual</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="shortcut icon" type="image/x-icon" href="https://domains.aplus.net/assets/images/online-store.png">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/elegant-font/html-css/style.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

<link rel="shortcut icon" type="image/x-icon" href="https://domains.aplus.net/assets/images/online-store.png">

</head>
<body class="animsition">

	<?php require('includes/header.php'); ?>

	<!-- Slide1 -->
	<section class="slide1">
		<div class="wrap-slick1">
			<div class="slick1">
				<div class="item-slick1 item1-slick1" style="background-image: url('http://pouptempo.com/upload/d41d8cd98f00b204e9800998ecf8427e-1433689460-lker-107007.jpg'); background-size: cover; background-position: top;">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="fadeInDown">
							Moda Masculina 2018
						</span>

						<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="fadeInUp">
							Conheça o novo
						</h2>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
							<!-- Button -->
							<a href="<?=$route['index']; ?>/produtos" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Conferir
							</a>
						</div>
					</div>
				</div>

				<div class="item-slick1 item2-slick1" style="background-image: url('https://s-media-cache-ak0.pinimg.com/originals/99/bb/10/99bb10e5b47370284480e6b91625fce3.jpg'); background-position: top; background-size: cover;">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rollIn">
							Coleção Moda Outono
						</span>

						<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="lightSpeedIn">
							Um mundo de possibilidades em design
						</h2>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
							<!-- Button -->
							<a href="product.html" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Conferir
							</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<?php if( $products_featured ): ?>
	<!-- produtos destaque -->
	<section class="newproduct bgwhite p-t-45 p-b-105">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					Em alta
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">

					<?php 
						foreach( $products_featured as $p ): 
							if( $p['product_percent'] != "" ){
								$percent = $p['product_percent']."%";
								$value = 'de <s>R$ '.App::formatMoney($p['product_value'], 'out').'</s> por R$ '.App::formatMoney($p['product_valuewithpercent'], 'out');
							}else{
								$percent = '<span class="badge badge-warning">Sem Desconto</span>';
								$value = 'R$ '.App::formatMoney($p['product_value'], 'out');
							}
					?>


					<div class="item-slick2 p-l-15 p-r-15">
						
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative">
								<img src="<?=$route['index']; ?>/admin/storage/<?=$p['product_image']; ?>" style="width: 100%; height: 300px;" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<!-- dados de produtos -->
									<form id="data-product">
										<input type="hidden" name="method" value="add-to-cart" />
										<input type="hidden" name="id_product" value="<?=$p['id_product']; ?>" />
										<input type="hidden" name="product_name" value="<?=$p['product_name']; ?>" />
										<input type="hidden" name="product_image" value="<?=$p['product_image']; ?>" />
										<input type="hidden" name="product_quantity" value="1" />
										<input type="hidden" name="product_value" value="<?=$p['product_value']; ?>" />
										<input type="hidden" name="product_percent" value="<?=$p['product_percent']; ?>" />
										<input type="hidden" name="product_valuewithpercent" value="<?=$p['product_valuewithpercent']; ?>" />
									</form>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Comprar
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="detalhes-produto?id=<?=$p['id_product']; ?>" class="block2-name dis-block s-text3 p-b-5">
									<?=$p['product_name']; ?>
								</a>

								<span class="block2-price m-text6 p-r-5">
									<?=$value; ?>
								</span>
							</div>
						</div>
						
					</div>
					<?php endforeach; ?>
					
				</div>
			</div>

		</div>
	</section>	
	<?php endif; ?>

	<!-- Banner2 -->
	<section class="banner2 bg5 p-t-55 p-b-55">
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-md-8 col-lg-6 m-l-r-auto p-t-15 p-b-15">
					<div class="hov-img-zoom pos-relative">
						<img src="https://i.pinimg.com/originals/a7/97/70/a79770f0a402c04e0027672e5b08c338.jpg" alt="IMG-BANNER">

						<div class="ab-t-l sizefull flex-col-c-m p-l-15 p-r-15">
							<span class="m-text9 p-t-45 fs-20-sm">
								The Suit Party's
							</span>

							<h3 class="l-text1 fs-35-sm">
								Descontos de até 30%
							</h3>

							<a href="#" class="s-text4 hov2 p-t-20 ">
								Conferir
							</a>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-8 col-lg-6 m-l-r-auto p-t-15 p-b-15">
					<div class="bgwhite hov-img-zoom pos-relative p-b-20per-ssm">
						<img src="http://miramarshopping.com.br/blog/wp-content/uploads/2015/01/Look-laranja.jpg" alt="IMG-BANNER">

						<div class="ab-t-l sizefull flex-col-c-b p-l-15 p-r-15 p-b-20">
							<div class="t-center">
								<a href="product-detail.html" class="dis-block s-text3 p-b-5">
									Use e Abuse
								</a>

								<span class="block2-oldprice m-text7 p-r-5">
									$99.90
								</span>

								<span class="block2-newprice m-text8">
									$59.90
								</span>
							</div>

							<div class="flex-c-m p-t-44 p-t-30-xl">
								<div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
									<span class="m-text10 p-b-1 days">
										30
									</span>

									<span class="s-text5">
										dias
									</span>
								</div>

								<div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
									<span class="m-text10 p-b-1 hours">
										04
									</span>

									<span class="s-text5">
										horas
									</span>
								</div>

								<div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
									<span class="m-text10 p-b-1 minutes">
										32
									</span>

									<span class="s-text5">
										minutos
									</span>
								</div>

								<div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
									<span class="m-text10 p-b-1 seconds">
										05
									</span>

									<span class="s-text5">
										segundos
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	
	<!-- Shipping -->
	<section class="shipping bgwhite p-t-62 p-b-46">
		<div class="flex-w p-l-15 p-r-15">
			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					Free Delivery Worldwide
				</h4>

				<a href="#" class="s-text11 t-center">
					Click here for more info
				</a>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2">
				<h4 class="m-text12 t-center">
					30 Days Return
				</h4>

				<span class="s-text11 t-center">
					Simply return it within 30 days for an exchange.
				</span>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					Store Opening
				</h4>

				<span class="s-text11 t-center">
					Shop open from Monday to Sunday
				</span>
			</div>
		</div>
	</section>


	<!-- Footer -->
	<?php require('includes/footer.php'); ?>



	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>



<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			// carregamento do carrinho
			function loadCart(){
				$.ajax({
					url: "ajax.php",
					type: "post",
					dataType: 'html',
					data: {
						method: "verify-cart"
					},
					success: function(quant){
						$(".header-icons-noti").html(quant);
						$(".header-cart").load("load/cart.php");
					}
				})
			}

			loadCart();
			
		

			$('.block2-btn-addcart').each(function(){
				var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
				var dataProduct = $(this).parent().find("#data-product").serialize();
				$(this).on('click', function(){
					$.ajax({
						url: "ajax.php",
						type: "post",
						dataType: "html",
						data: dataProduct,
						success: function(ret){
							if( ret == true ){
								loadCart();
								swal(nameProduct, "foi adicionado ao carrinho!", "success");
							}else{
								loadCart();
								swal(nameProduct, "não foi adicionado por falhas internas", "error");
							}
						}
					})
					
				});
			});

			$('.block2-btn-addwishlist').each(function(){
				var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
				$(this).on('click', function(){
					swal(nameProduct, "foi adicionado aos favoritos!", "success");
				});
			});

		})
	</script>

<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
