<!-- Modal de Vendas-->

<div class="modal fade" id="Vendas-modal" tabindex="-1" role="dialog"
	 aria-labelledby="modalLabel" >
	<div class="modal-dialog" role="document" >
		<div class="modal-content">
			<div class="modal-header" style="background-color: aliceblue;">
				<h2>Nova Venda</h2>
			</div>
			<div class="modal-body">
			<div class="form-group" style="
    text-align: center;
    background-color: aliceblue;
    border-bottom-left-radius: 100px;
    border-bottom-right-radius: 100px;
    position: relative;
">
     <label class="form-label">Valor R$35,00</label>
    </div>
    <hr>
    
    <div class="form-group">
    <label class="form-label">Cliente</label>
    <select id="ddrCliente" class="form-control custom-select">
    	
    </select>
    </div>
<div class="form-group">
                        <label class="form-label">Serviços</label>
			<?php if ($Services) : ?>
					<?php foreach ($Services as $Service) : ?>
                        <div class="selectgroup selectgroup-pills">
                          <label class="selectgroup-item">
                            <input type="checkbox" name="value" value="<?php echo $Service['ID']; ?>" class="selectgroup-input" >
                            <span class="selectgroup-button"><?php echo $Service['Nome']; ?></span>
                          </label>
                       </div>
						<?php endforeach; ?>
						<?php else : ?>
	 <label class="form-label">Nenhum registro encontrado.</label>
<?php endif; ?>
                      </div>
                      <hr />
                      <div class="form-group">
                        <label class="form-label">Produtos</label>
			<?php if ($Products) : ?>
					<?php foreach ($Products as $Product) : ?>
                        <div class="selectgroup selectgroup-pills">
                          <label class="selectgroup-item">
                            <input type="checkbox" name="value" value="<?php echo $Product['ID']; ?>" class="selectgroup-input" >
                            <span class="selectgroup-button"><?php echo $Product['Nome']; ?></span>
                          </label>
                       </div>
						<?php endforeach; ?>
						<?php else : ?>
	 <label class="form-label">Nenhum registro encontrado.</label>
<?php endif; ?>
                      </div>
                      <hr />
                      <div class="form-group">
                           <label class="form-label">Pagamento</label>
                       <label class="selectgroup-item">
                             
                            <span class="selectgroup-button"><i class="payment payment-visa"></i></span>
                          </label>
                     
                     
                      </div>
					   <div class="card-footer text-right">
                  <div class="d-flex">
                    <a  href="index.php" class="btn btn-link">Cancelar</a>
                    <button type="submit" class="btn btn-primary ml-auto">Salvar</button>
                  </div>
                </div>
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
