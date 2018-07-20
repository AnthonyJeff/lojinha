<?php
	session_start();
	include('../config.php');
	if( isset($_SESSION['cart']) ):

		// dados gerais de carrinho
		$main_quantity = 0;
		$total_value = 0;
		foreach($_SESSION['cart']['products'] as $p):
			// total de produtos
			$main_quantity += ($p['product_quantity']);

			//total em R$
			if($p['product_percent'] != ""){
				$product_value = $p['product_valuewithpercent'];
			}else{
				$product_value = $p['product_value'];
			}

			$total_value += ($p['product_quantity'] * $product_value);

		endforeach;
?>

	<ul class="header-cart-wrapitem">
		<?php
			$total_value = 0;
			foreach($_SESSION['cart']['products'] as $p): 
				$total_value += ($p['product_quantity'] * $p['product_value']);
		?>
		<li class="header-cart-item">
			<div class="header-cart-item-img">
				<img src="admin/storage/<?=$p['product_image']; ?>" alt="IMG">
			</div>

			<div class="header-cart-item-txt">
				<a href="#" class="header-cart-item-name">
					<?=$p['product_name']; ?>
				</a>

				<span class="header-cart-item-info">
					<?=$p['product_quantity']."x de R$ ".number_format($p['product_value'],2); ?>
				</span>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>

	<div class="header-cart-total">
		Total: R$ <?=number_format($total_value,2); ?>
	</div>

	<div class="header-cart-buttons">
		<div class="header-cart-wrapbtn">
			<!-- Button -->
			<a href="<?=$route['index']; ?>/carrinho" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
				Visualizar
			</a>
		</div>

		<div class="header-cart-wrapbtn">
			<!-- Button -->
			<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
				Esvaziar
			</a>
		</div>
	</div>
	<?php endif; ?>