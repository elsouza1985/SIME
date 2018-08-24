<?php
require_once('functions.php');
add();
?>

<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">&times;</button>
				<h4 class="modal-title">Adicionar novo Produto/Serviço</h4>
			</div>
			<div class="modal-body">
				<form action="add.php" method="post" class="card">
					<!-- area de campos do form -->
					<hr />
					<div class="card-header">
						<h3 class="card-title">Novo Produto</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="form-group col-md-7">
								<label for="name">Nome</label> <input type="text"
									class="form-control" name="Product['Nome']">
							</div>

						</div>
						<div class="row">
							<div class="form-group col-md-7">
								<label for="name">Tipo</label> 
								<select type="text"
									class="form-control" name="Product['Tipo']">
									<option value="1" > Serviço</option>
									<option value="2" > Produto</option>
								</select>
							</div>

						</div>
							<div class="row">
							<div class="form-group col-md-7">
								<label for="name">Valor</label> <input type="text"
									class="form-control" name="Valor['Valor']">
							</div>

						</div>
						

						<div class="card-footer text-right">
							<div class="d-flex">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary ml-auto">Salvar</button>
							</div>
						</div>

					</div>
				</form>
			</div>
			
		</div>
	</div>
</div>

