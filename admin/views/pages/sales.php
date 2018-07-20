
<?php if( $dependency['sales'] ): ?>
<table class="table table-hover table-bordered datatable">
	<thead>
		<tr>
			<th><b>#</b></th>
			<th>Cliente</th>
			<th>Valor(R$)</th>
			<th>Protocolo</th>
			<th>Data</th>
			<th><i class="fa fa-gears"></i></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach( $dependency['sales'] as $sale ): 
		?>
		<tr>
			<td><b><?=$sale['id_sale']; ?></b></td>
			<td><?=$sale['client_name']; ?></td>
			<td>R$ <?=App::formatMoney($sale['sale_value'], 'out'); ?></td>
			<td><?=$sale['sale_protocol']; ?></td>
			<td><?=App::date($sale['sale_timestamp']); ?></td>
			<td>
				<a class="btn btn-primary" href="<?=$GLOBALS['index']; ?>/vendas/detalhes-da-venda/<?=$sale['id_sale']; ?>" title="Visualizar Compra"><i class="fa fa-shopping-cart"></i></a>
			</td>
		</tr>

		<?php endforeach; ?>
	</tbody>
</table>
<?php else: ?>
<div class="alert alert-warning" role="alert">
  <h4 class="alert-heading">Vazio</h4>
  <p>Não há histórico de vendas no sistema</p>
</div>
<?php endif; ?>