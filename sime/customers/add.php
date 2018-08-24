<script>
$('#txtNumeroCliente').mask('(00) 00000-0000');

</script>
<div class="modal fade" id="add-modal" tabindex="-1" role="dialog"
	aria-labelledby="modalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color: aliceblue;">
				<h2>Novo Cliente</h2>
			</div>
			<div class="modal-body">
				<table class="table card-table table-striped table-vcenter"
					id="tblModalCliente">
					<thead>
						<tr>
							<th colspan="2"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="form-group">
									<label for="name">Nome</label> <input type="text"
										class="form-control" name="customer['name']" id="txtNomeCliente">
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="form-group">
									<label for="campo2">Celular</label> <input type="text"
										class="form-control" id="txtNumeroCliente"
										data-mask="(00) 0000-0000" name="customer['Mobile']">
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="form-group">
									<label for="campo3">Aniversario</label> <input type="text" id="txtAniversario"
										class="form-control" name="customer['DataNascimento']">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<a id="confirm" class="btn btn-primary" href="#" onclick="salvarCliente()">Salvar</a> <a
					id="cancel" class="btn btn-default" data-dismiss="modal">Fechar</a>

			</div>

		</div>
	</div>
</div>