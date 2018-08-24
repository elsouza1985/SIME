<!-- Modal de Agendamento-->

<div class="modal fade" id="Agendamento-modal" tabindex="-1" role="dialog"
	 aria-labelledby="modalLabel" >
	<div class="modal-dialog" role="document" >
		<div class="modal-content">
			<div class="modal-header" style="background-color: aliceblue;">
				<h2>Agendamento</h2>
			</div>
			<div class="modal-body">
				<table class="table card-table table-striped table-vcenter" id="tblModalAgenda">
					<thead>
						<tr>
							<th colspan="2">
							<label id="modal-AgendaData"></label> 
							<br> Horario: <label id="modal-AgendaHorario"></label>:00 hrs
						</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="w-1"><span class="avatar">ES</span></td>
							<td>Erick Souza</td>
						</tr>
						<tr>
							<td>Contato</td>
							<td><a class="icon"
								href="https://api.whatsapp.com/send?phone=5511991012655&text=teste">
									<i class="fa fa-whatsapp"
									style="font-size: x-large; padding: 10px;"></i>
							</a> <a href="tel:11984488400"> <i class="fa fa-phone"
									style="font-size: x-large; padding: 10px;"></i>
							</a> <a href=sms:11984488400"> <i class="fa fa-wpforms"
									style="font-size: x-large; padding: 10px;"></i>
							</a></td>

						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer" style="display: none">
				<a id="confirm" class="btn btn-primary" href="#" >Desmarcar</a> <a
					id="cancel" class="btn btn-default" data-dismiss="modal">N&atilde;o</a>
					<input type="hidden" value="false" id="isNewUser" />
			</div>
		</div>
	</div>
</div>
<!-- /.modal -->
