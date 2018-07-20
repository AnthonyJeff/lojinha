<div class="row">
	<div class="col-md-4"></div><!-- ./ col-md-4 -->
	<div class="col-md-8">
		<table class="table bordered">
			<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>Produto</th>
					<th>Valor(R$)</th>
					<th>Quantidade</th>
					<th>V.Parcial(R$)</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$tb["tb_products"] = [];
					$tb["tb_productsales"] = [];
					$rel["tb_productsales.product_id"] = "tb_products.id_product";
					$fil["id_sale"] = App::route(3);
					$dependency['products_sales'] = manager::select_join($tb, $rel, $fil, null);

					$counter = 0;
					foreach($dependency['products_sales'] as $p):
						$counter++;
						$counter = ($counter < 10) ? '0'.$counter : $counter;

						// valor parcial
						$partialvalue = ($p['productsale_quantity'] * $p['productsale_value']);
 				?>
				<tr>
					<td><b><?=$counter; ?></b></td>
					<td><?=$p['product_name']; ?></td>
					<td>R$ <?=App::formatMoney($p['productsale_value'], 'out'); ?></td>
					<td><?=$p['productsale_quantity']; ?></td>
					<td>R$ <?=App::formatMoney($partialvalue, 'out'); ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div><!-- ./ col-md-8 -->
</div><!-- ./ row -->