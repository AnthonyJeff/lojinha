<div class="pull-right">
	<button class="btn btn-success" data-toggle="modal" data-target="#new-product"><i class="fa fa-plus"></i> <b>Novo Produto</b></button>
</div>

<div class="modal fade" id="new-product" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="<?=$GLOBALS['index']; ?>/controllers/product.php?action=new" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Novo Produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       	<div class="form-group">
       		<label>Produto</label>
       		<input type="text" name="product_name" class="form-control" required />
       	</div>
       	<div class="form-group">
       		<label>Valor(R$)</label>
       		<input type="text" name="product_value" class="form-control money" required />
       	</div>

       	<div class="form-group">
       		<label>Quantidade(estoque)</label>
       		<input type="number" name="product_quantity" class="form-control" required />
       	</div>

       	<?php 
       		if( $dependency['categories'] ): 
       			$submit = "";
       	?>
       	<div class="form-group">
       	<label>Categoria</label>
       	<select class="form-control" name="category_id">
       		<?php foreach( $dependency['categories'] as $category ): ?>
       		<option value="<?=$category['id_category']; ?>"><?=$category['category_name']; ?></option>
       		<?php endforeach; ?>
       	</select>
       	</div>	
       	<?php 
       		else: 
       			$submit = "disabled";
       	?>
       	<h3>Não há categorias cadastradas...</h3>
       	<?php endif; ?>

       	<div class="form-group">
       		<label>Foto do Produto</label>
	       	<div class="custom-file">
			  <input type="file" name="product_image" class="custom-file-input" id="customFile">
			  <label class="custom-file-label" for="customFile">Selecione um arquivo</label>
			</div>
       	</div>

       	<div class="form-group">
       		<label>Descrição</label>
       		<textarea name="product_describe" rows="3" class="form-control"></textarea>
       	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary" <?=$submit; ?>><i class="fa fa-check-circle-o"></i> <b>Cadastrar Categoria</b></button>
      </div>
    </form>
    </div>
  </div>
</div>


<br><br>
<?php if( $dependency['products'] ): ?>
<table class="table table-hover table-bordered datatable">
	<thead>
		<tr>
			<th><b>#</b></th>
			<th>Produto</th>
			<th>Valor(R$)</th>
			<th>Desconto(% / R$)</th>
			<th><i class="fa fa-gears"></i></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach( $dependency['products'] as $products ): 
				if( $products['product_percent'] != "" ){
					$percent = $products['product_percent']."%";
					$value = 'de <s>R$ '.App::formatMoney($products['product_value'], 'out').'</s> por R$ '.App::formatMoney($products['product_value'], 'out');
				}else{
					$percent = '<span class="badge badge-warning">Sem Desconto</span>';
					$value = 'R$ '.App::formatMoney($products['product_value'], 'out');
				}
		?>
		<tr>
			<td><b><?=$products['id_product']; ?></b></td>
			<td><?=$products['product_name']; ?></td>
			<td><?=$value; ?></td>
			<td><?=$percent; ?></td>
			<td>
				<button class="btn btn-info" data-toggle="modal" data-target="#percent-<?=$products['id_product']; ?>" title="Aplicar Desconto"><i class="fa fa-percent"></i></button>

				<button class="btn btn-dark" data-toggle="modal" data-target="#view-<?=$products['id_product']; ?>" title="Visualizar"><i class="fa fa-eye"></i></button>
				<button class="btn btn-primary" data-toggle="modal" data-target="#edit-<?=$products['id_product']; ?>" title="Editar"><i class="fa fa-edit"></i></button>
				<button class="btn btn-danger" data-toggle="modal" data-target="#delete-<?=$products['id_product']; ?>" title="Deletar"><i class="fa fa-trash"></i></button>
			</td>
		</tr>

		<div class="modal fade" id="delete-<?=$products['id_product']; ?>" tabindex="-1" role="dialog">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		    <form action="<?=$GLOBALS['index']; ?>/controllers/product.php?action=delete" method="post">
		      <div class="modal-header">
		        <h5 class="modal-title">Deletar Categoria</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<input type="hidden" name="id_category" value="<?=$category['id_category']; ?>" />
		       	<h3>Você tem certeza que deseja deletar esta categoria?</h3>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> <b>Deletar</b></button>
		      </div>
		    </form>
		    </div>
		  </div>
		</div>


		<div class="modal fade" id="percent-<?=$products['id_product']; ?>" tabindex="-1" role="dialog">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		    <form action="<?=$GLOBALS['index']; ?>/controllers/product.php?action=percent" method="post">
		      <div class="modal-header">
		        <h5 class="modal-title">Aplicar Desconto</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">

		      	<input type="hidden" name="id_product" value="<?=$products['id_product']; ?>" />
		      	<input type="hidden" name="product_percent" />
		      	<input type="hidden" name="product_valuewithpercent"  />

		       	
		       	<div class="row">
		       		<div class="col-md-4">
		       			<div class="form-group">
		       			<label>Alíquota</label>
		       			<input type="number" id="product-percent-<?=$products['id_product']; ?>" name="product_percent" class="form-control" />
		       			</div>
		       		</div>
		       		<div class="col-md-8">
		       			<ul class="list-group">
						  
						  <li class="list-group-item d-flex justify-content-between align-items-center">
						  <small>Valor</small>  R$ <?=App::formatMoney($products['product_value'], 'out'); ?>
						    <span class="badge badge-primary badge-pill">R$</span>
						  </li>
						  <li class="list-group-item d-flex justify-content-between align-items-center">
						    <small>Desconto</small> <span id="value-percent-<?=$products['id_product']; ?>"></span>
						    <span class="badge badge-primary badge-pill">%</span>
						  </li>
						  <li class="list-group-item d-flex justify-content-between align-items-center">
						    <small>Novo Valor</small> <span id="new-value-<?=$products['id_product']; ?>"></span>
						    <span class="badge badge-primary badge-pill">R$</span>
						  </li>
						</ul>
		       		</div>
		       	</div>

		       	<hr>
		       	Ou <br />
		       	<div class="custom-control custom-checkbox">
				  <input type="checkbox" name="remove-percent" value="<?=$products['id_product']; ?>" class="custom-control-input" id="customCheck<?=$products['id_product']; ?>">
				  <label class="custom-control-label" for="customCheck<?=$products['id_product']; ?>">Remover Desconto de Produto</label>
				</div>

		       	<script type="text/javascript">
		       		$(function() {
		       			// claculo percentual
		       			$("#product-percent-<?=$products['id_product']; ?>").keyup(function() {
		       				var product_value = "<?=$products['product_value']; ?>";
		       				
		       				$("#value-percent-<?=$products['id_product']; ?>").html( $("#product-percent-<?=$products['id_product']; ?>").val() + '%')
		       				$("input[name=product_percent]").val( $("#product-percent-<?=$products['id_product']; ?>").val())
		       				

		       				$("#new-value-<?=$products['id_product']; ?>").html('R$' + ( product_value - ( $("#product-percent-<?=$products['id_product']; ?>").val() * product_value / 100) ) )
		       				$("input[name=product_valuewithpercent]").val(( product_value - ( $("#product-percent-<?=$products['id_product']; ?>").val() * product_value / 100) ) )
		       			})
		       		})
		       	</script>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		        <button type="submit" class="btn btn-info"><i class="fa fa-check-circle-o"></i> <b>Aplicar Desconto</b></button>
		      </div>
		    </form>
		    </div>
		  </div>
		</div>

		<div class="modal fade" id="view-<?=$products['id_product']; ?>" tabindex="-1" role="dialog">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title"><?=$products['product_name']; ?></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<?php App::getImage($products['product_image']); ?>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
		      </div>
		    </div>
		  </div>
		</div>

		<div class="modal fade" id="edit-<?=$category['id_category']; ?>" tabindex="-1" role="dialog">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		    <form action="<?=$GLOBALS['index']; ?>/controllers/category.php?action=edit" method="post">
		      <div class="modal-header">
		        <h5 class="modal-title">Modificar Categoria</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">

		      	<div class="form-group">
		       		<label>Categoria</label>
		       		<input type="text" name="category_name" value="<?=$category['category_name']; ?>" class="form-control" required />
		       	</div>
		       	<div class="form-group">
		       		<label>Descrição</label>
		       		<textarea name="category_describe" rows="3" class="form-control"><?=$category['category_describe']; ?></textarea>
		       	</div>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		        <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle-o"></i> <b>Editar</b></button>
		      </div>
		    </form>
		    </div>
		  </div>
		</div>


		<?php endforeach; ?>
	</tbody>
</table>
<?php else: ?>
<div class="alert alert-warning" role="alert">
  <h4 class="alert-heading">Vazio</h4>
  <p>Não há produtos cadastradas no sistema</p>
</div>
<?php endif; ?>