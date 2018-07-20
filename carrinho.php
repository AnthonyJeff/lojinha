<?php require('validate.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Meu Carrinho de Compras - Lojinha</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="shortcut icon" type="image/x-icon" href="https://domains.aplus.net/assets/images/online-store.png"><!--===============================================================================================-->
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
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<style type="text/css">
		.tag {
			background: #fff;
			color: #333;
			padding: 8px;
			font-weight: bolder;
			border-left: 5px solid #333;
		}
	</style>
<!--===============================================================================================-->
</head>
<body class="animsition">

	<?php require('includes/header.php'); ?>

	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url('https://i.pinimg.com/originals/c6/28/a1/c628a10a3bba59ee2577aa1d0bd33fa9.jpg'); background-position: center; background-size: cover;">
		<h2 class="l-text2 t-center">
			Meu Carrinho de Compras
		</h2>
	</section>

	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<?php if(!empty($_SESSION['cart']['products'])): ?>
		<div class="container">
			<!-- Cart item -->
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2">Produto</th>
							<th class="column-3">Valor</th>
							<th class="column-4 p-l-70">Quantidade</th>
							<th class="column-5">Total</th>
						</tr>
						<?php
							$total_value = 0;
							foreach( $_SESSION['cart']['products'] as $p ):
								$total_value += ($p['product_quantity'] * $p['product_value']);
						?>
						<tr class="table-row">
							<td class="column-1">
								<div class="cart-img-product b-rad-4 o-f-hidden">
									<img src="admin/storage/<?=$p['product_image']; ?>" alt="IMG-PRODUCT">
								</div>
							</td>
							<td class="column-2"><?=$p['product_name']; ?></td>
							<td class="column-3"><?=App::formatMoney($p['product_value'], 'out'); ?></td>
							<td class="column-4">
								<div class="flex-w bo5 of-hidden w-size17">
									<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
										<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
									</button>

									<input class="size8 m-text18 t-center num-product" type="number" name="num-product1" value="<?=$p['product_quantity']; ?>">

									<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
										<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
									</button>
								</div>
							</td>
							<td class="column-5"><?=App::formatMoney(($p['product_quantity'] * $p['product_value']), 'out'); ?></td>
						</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>

			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<div class="flex-w flex-m w-full-sm">
					<div class="size11 bo4 m-r-10">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="coupon-code" placeholder="Cupom Desconto">
					</div>

					<div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
						<!-- Button -->
						<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
							Aplicar Cupom
						</button>
					</div>
				</div>

				<div class="size10 trans-0-4 m-t-10 m-b-10">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Update Cart
					</button>
				</div>
			</div>

			<div class="row">
				<div class="col-md-2">
					<br>
					<img src="http://saudehospitalar.com/wp-content/uploads/revslider/slider1/frete.png" style="width: 100%; height: auto;" />
				</div>
				<div class="col-md-4">

					<br>

					<div class="freight-default">
						<h1>E O FRETE, COMO FICA?</h1>
						<hr>
						Caso você prefira receber suas compras no conforto de casa, calcule o valor do seu frete ao lado para prosseguir com a compra.
					</div>

					<br>

					<div class="freight-defined">
						<h1>Valor: <span id="set-value"></span></h1>
						<hr>
						<h3>Prazo: <span id="set-time"></span></h3>
						<p>Via: <span id="set-type"></span></p>
						<br>
						<img style="width: 100%;" id="set-img" src="" />
						<hr>
						<div class="size14 trans-0-4 m-b-10">
							<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
								Confirmar
							</button>
						</div>

					</div>

					<br>

					<div class="jumbotron get-tag-percent" style="color: #fff; background-image: url('http://decorin.com.br/wp-content/uploads/2015/11/Compras-Online2-2.jpg'); background-size: cover;">
					  <h1 class="text-center" style="text-shadow: 2px 3px 4px #333;"><i class="fa fa-star"></i> Parabéns!</h1>
					  <p class="lead text-center text-white" style="text-shadow: 2px 3px 4px #333;">Você ganhou um cupom desconto para sua próxima compra</p>
					  
					  <hr class="my-4">
					  
					  <div class="tag display-4">
					  	<i class="fa fa-tag"></i> FH9980	
					  </div>
					</div>


				</div>
				<div class="col-md-6">
					<!-- Total -->
						<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
							<h5 class="m-text20 p-b-24">
								Total do carrinho
							</h5>

							<!--  -->
							<div class="flex-w flex-sb-m p-b-12">
								<span class="s-text18 w-size19 w-full-sm">
									Subtotal:
								</span>

								<span class="m-text21 w-size20 w-full-sm">
									<?='R$ '.App::formatMoney($total_value, 'out'); ?>
								</span>
							</div>

							<!--  -->
							<div class="flex-w flex-sb bo10 p-t-15 p-b-20">
								<span class="s-text18 w-size19 w-full-sm">
									Frete:
								</span>

								<input type="hidden" id="total-sale" value="<?=$total_value; ?>" />

								<div class="w-size20 w-full-sm">
									<p class="s-text8 p-b-23">
										Insira abaixo o numero referente ao CEP da sua rua ou do local onde você for receber o produto.
									</p>

									<span class="s-text19">
										SELECIONE O MODO DE ENTREGA
									</span>
									
									<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
										<select class="selection-2" id="type">
											<option value="1">PAC</option>
											<option value="0">SEDEX</option>
										</select>
									</div>
									<!--
									<div class="size13 bo4 m-b-12">
									<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="state" placeholder="State /  country">
									</div>
									-->
									<span class="s-text19">
										CEP
									</span>

									<div class="size13 bo4 m-b-22">
										<input class="sizefull s-text7 p-l-15 p-r-15" id="cep" type="text" name="postcode" placeholder="seu cep aqui">
									</div>

									<div class="size14 trans-0-4 m-b-10">
										<!-- Button -->
										<button id="cal-freight" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
											Calcular Frete
										</button>
									</div>
								</div>
							</div>

							<div class="flex-w flex-sb-m p-t-26 p-b-30">
								<span class="m-text22 w-size19 w-full-sm">
									Frete:
								</span>

								<span class="m-text21 w-size20 w-full-sm">
									<span class="value-freight"></span>
								</span>
							</div>

							<div class="flex-w flex-sb-m p-t-26 p-b-30">
								<span class="m-text22 w-size19 w-full-sm">
									Total:
								</span>

								<span class="m-text21 w-size20 w-full-sm">
									<span class="value-total"></span>
								</span>
							</div>

							<div class="size15 trans-0-4">
								<!-- Button -->
								<button type="button" data-toggle="modal" data-target="#end-sale-modal" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
									Finalizar Compra
								</button>
							</div>

							<div class="modal fade" id="end-sale-modal" tabindex="-1" role="dialog">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
								    <form action="<?=$route['index']; ?>/ajax.php?method=endsale" method="post">
								      <div class="modal-header">
								        <h5 class="modal-title"><i class="fa fa-check-square"></i> Finalizar Compra</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body" style="background: #333; color: #fff !important;">
								      	<!-- informações de compra -->
								      	<input type="hidden" name="sale_value" />
								      	<input type="hidden" name="freight_for" />
								      	<input type="hidden" name="freight_deadline" />
								      	<input type="hidden" name="freight_value" />
								      	<input type="hidden" name="freight_code" />
								      	<input type="hidden" name="freight_destiny" />

								      	<div class="form-group">
								     		<label>Nome do cliente</label>
								     		<input type="text" name="client_name" class="form-control" required />
								      	</div>

								      	<div class="form-group">
								     		<label>CPF do cliente</label>
								     		<input type="text" name="client_cpf" id="cpf" class="form-control" required />
								      	</div>

								      	<div class="form-group">
								     		<label>Email do cliente</label>
								     		<input type="email" name="client_email" class="form-control" required />
								      	</div>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
								        <button type="submit" class="btn btn-dark"><i class="fa fa-check-circle-o"></i> <b>Finalizar Compra</b></button>
								      </div>
								    </form>
							    </div>
							  </div>
							</div>
							<!-- end modal -->

						</div>
				</div>
			</div>

			
		</div>
		<?php else: ?>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<img src="http://www.pngall.com/wp-content/uploads/2016/06/Ecommerce-Download-PNG.png" width="100%">
				</div>
				<div class="col-md-8">
					<h1 class="display-4 text-center">Carrinho vazio!</h1>
					<br>
					<h2 class="text-center">Vamos as compras zo/ </h2>
					<hr>
					<p class="text-center"><a href="<?=$route['index']; ?>/produtos" class="btn btn-dark"><i class="fa fa-tags"></i> Conhecer Produtos</a></p>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</section>



	<!-- Footer -->
	<?php require('includes/footer.php'); ?>



	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>


<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});

		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect2')
		});
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<script type="text/javascript">
					$(document).ready(function() {

						$("#cep").mask('99999-999')
						$("#cpf").mask('999.999.999-99')

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

						$(".freight-defined").hide();

						$(".value-freight").html('R$ 0')
						$(".value-total").html('R$ ' + parseFloat($("#total-sale").val()).toFixed(2))
						$(".get-tag-percent").hide() // cupom desconto

						$("#cal-freight").click(function() {
							if( $("#cep").val() != "" ){
								$("#cal-freight").html('<i class="fa fa-spinner fa-spin"></i>').attr("disabled")
								$.ajax({
									url: "ajax.php",
									type: "post",
									dataType: "html",
									data: {
										method: "calculate-freight",
										cep: $("#cep").val(), 
										value: $("#total-sale").val()
									},
									success: function(ret){
										// conversao json -> object
										var freight = $.parseJSON(ret)
										var method_send = $("#type").val()

										if( method_send == 1 ){
											// calculo PAC
											if( freight[method_send].error == "" ){
												$(".freight-default").hide()
												$(".freight-defined").fadeIn()
												$("#set-time").html(freight[method_send].deadline + 'dias')
												$("#set-value").html('R$ ' + parseFloat(freight[method_send].price).toFixed(2))
												$("#set-img").attr("src", 'https://logodownload.org/wp-content/uploads/2017/03/pac-correios-logo.png')
												$("#set-type").html(freight[method_send].name)
												$("#cal-freight").html('Calcular Frete')
											}else{
												$("#cal-freight").html('Calcular Frete')
												swal('Falha', "no calculo do frete por PAC, estamos trabalhando nisso para corrigir o mais depressa possivel...", "error")
											}

										}else if( method_send == 0 ){
											// calculo SEDEX
											if( freight[method_send].error == "" ){
												$(".freight-default").hide()
												$(".freight-defined").fadeIn()
												$("#set-time").html(freight[method_send].deadline + ' dias')
												$("#set-value").html('R$ ' + parseFloat(freight[method_send].price).toFixed(2))
												$("#set-img").attr("src", 'https://logodownload.org/wp-content/uploads/2017/03/sedex-logo-1.png')
												$("#set-type").html(freight[method_send].name)
												$("#cal-freight").html('Calcular Frete')
											}else{
												$("#cal-freight").html('Calcular Frete')
												swal('Falha', "no calculo do frete por SEDEX, estamos trabalhando nisso para corrigir o mais depressa possivel...", "error")
											}
										}

										// finalizando compra e defindo valores

										// valor do frete
										$(".value-freight").html('R$ ' + 'R$ ' + parseFloat(freight[method_send].price).toFixed(2))
										$("input[name=freight_value]").val(freight[method_send].price)

										// codigo do frete
										$("input[name=freight_code]").val(freight[method_send].code)

										// quem vai enviar
										$("input[name=freight_for]").val(freight[method_send].name)

										// cep do destinatario
										$("input[name=freight_destiny]").val($("#cep").val())

										// prazo de entrega
										$("input[name=freight_deadline]").val(freight[method_send].deadline)

										// prazo de entrega
										$("input[name=sale_value]").val($("#total-sale").val())

										// valor total da compra
										$(".value-total").html('R$ ' + 'R$ ' + parseFloat( ( freight[method_send].price + parseFloat($("#total-sale").val() ) ) ).toFixed(2))
									},
									error: function() {
										swal('Falha', "inrterna no servidor dos correios", "error")
									}
								})
							}else{
								swal('CEP', "não pode ser vazio...", "error")
							}
						})

					})
				</script>

</body>
</html>
