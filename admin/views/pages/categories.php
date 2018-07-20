<div class="pull-right">
	<button class="btn btn-success" data-toggle="modal" data-target="#new-category"><i class="fa fa-plus"></i> <b>Nova Categoria</b></button>
</div>

<div class="modal fade" id="new-category" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="<?=$GLOBALS['index']; ?>/controllers/category.php?action=new" method="post">
      <div class="modal-header">
        <h5 class="modal-title">Nova Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       	<div class="form-group">
       		<label>Categoria</label>
       		<input type="text" name="category_name" class="form-control" required />
       	</div>
       	<div class="form-group">
       		<label>Descrição</label>
       		<textarea name="category_describe" rows="3" class="form-control"></textarea>
       	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle-o"></i> <b>Cadastrar Categoria</b></button>
      </div>
    </form>
    </div>
  </div>
</div>


<br><br>
<?php if( $dependency['categories'] ): ?>
<table class="table table-hover table-bordered datatable">
	<thead>
		<tr>
			<th><b>#</b></th>
			<th>Categoria</th>
			<th>Descrição</th>
			<th><i class="fa fa-gears"></i></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach( $dependency['categories'] as $category ): ?>
		<tr>
			<td><b><?=$category['id_category']; ?></b></td>
			<td><?=$category['category_name']; ?></td>
			<td><?=$category['category_describe']; ?></td>
			<td>
				<button class="btn btn-primary" data-toggle="modal" data-target="#edit-<?=$category['id_category']; ?>" title="Editar"><i class="fa fa-edit"></i></button>
				<button class="btn btn-danger" data-toggle="modal" data-target="#delete-<?=$category['id_category']; ?>" title="Deletar"><i class="fa fa-trash"></i></button>
			</td>
		</tr>

		<div class="modal fade" id="delete-<?=$category['id_category']; ?>" tabindex="-1" role="dialog">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		    <form action="<?=$GLOBALS['index']; ?>/controllers/category.php?action=delete" method="post">
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
  <p>Não há categorias cadastradas no sistema</p>
</div>
<?php endif; ?>