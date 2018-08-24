
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

                        <div class="selectgroup selectgroup-pills">
                          <label class="selectgroup-item">
                            <input type="checkbox" name="value" value="" class="selectgroup-input" >
                            <span class="selectgroup-button"></span>
                          </label>
                       </div>
						
	 <label class="form-label">Nenhum registro encontrado.</label>

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
					  </form>
<?php include(FOOTER_TEMPLATE); ?>