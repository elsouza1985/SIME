<?php
require_once ('functions1.php');
index ();
?>
<?php include(NEWHEADER_TEMPLATE); ?>
<form action="add.php" method="post" class="card">
	
	<hr>
	<div class="form-group">
		
    <?php if ($Clientes) : ?>
    	<label class="form-label">Cliente</label> 
    	<select id="ddrCliente" class="form-control custom-select">
    	<option class="selectgroup-item" value="0">
	            Selecione o cliente...
	    	</option>
		<?php foreach ($Clientes as $Cliente) : ?>
		    <option class="selectgroup-item" value="<?php echo $Cliente['id']; ?>">
	            <?php echo $Cliente['name']; ?>
	    	</option>
		<?php endforeach; ?>
	<?php else : ?>
	 <label class="form-label">Nenhum registro encontrado.</label>
	<?php endif; ?>
    </select>
	</div>
	<div class="form-group">
		<label class="form-label">Serviços</label>
			<?php if ($Products) : ?>
					<?php foreach ($Products as $Service) : ?>
					<?php if($Service['Tipo'] == 2):?>
                        <div class="selectgroup selectgroup-pills">
			<label class="selectgroup-item"> <input type="checkbox" name="value"
				value="<?php echo $Service['ID']; ?>" class="selectgroup-input"> <span
				class="selectgroup-button"><?php echo $Service['Nome']; ?></span>
			</label>
		</div>
                       <?php endif;?>
						<?php endforeach; ?>
						<?php else : ?>
	 <label class="form-label">Nenhum registro encontrado.</label>
<?php endif; ?>
                      </div>
                      <hr />
	<div class="form-group" style="display:none">
		<label class="form-label">Nota Fiscal</label>
		<video id="video" width="640" height="480" autoplay></video>
		<button id="snap">Snap Photo</button>
		<canvas id="canvas" width="640" height="480"></canvas>
	</div>
	<hr />
	<div class="form-group">
		<label class="form-label">Produtos</label>
	<?php if ($Products) : ?>
		<?php foreach ($Products as $Product) : ?>
			<?php if($Product['Tipo'] == 1):?>
	        <div class="selectgroup selectgroup-pills">
				<label class="selectgroup-item"> 
					<input type="checkbox" name="value" value="<?php echo $Product['ID']; ?>" class="selectgroup-input"> 
					<span class="selectgroup-button"><?php echo $Product['Nome']; ?></span>
				</label>
			</div>
	       <?php endif;?>
		<?php endforeach; ?>
	<?php else : ?>
	 <label class="form-label">Nenhum registro encontrado.</label>
	<?php endif; ?>
    </div>
	<hr />
	<div class="form-group">
		<label class="form-label">Pagamento</label> 
		<div class="selectgroup selectgroup-pills">
			<label class="selectgroup-item"> 
				<input type="radio" group="pay" name="value"	value="" class="selectgroup-input">
				<span class="selectgroup-button">
					<i class="payment payment-visa selectgroup-button"></i>
				</span>
			</label>
		</div> 
			<div class="selectgroup selectgroup-pills">
			<label class="selectgroup-item"> 
				<input type="radio" group="pay" name="value"	value="" class="selectgroup-input">
				<span class="selectgroup-button">
					<i class="payment payment-money selectgroup-button"></i>
				</span>
			</label>
		</div> 

<div class="form-group"
		style="text-align: center; background-color: aliceblue; border-bottom-left-radius: 100px; border-bottom-right-radius: 100px; position: relative;">
		<label class="form-label">Valor R$35,00</label>
	</div>

	</div>

	<div class="card-footer text-right">
		<div class="d-flex">
			<a href="index.php" class="btn btn-link">Cancelar</a>
			<button type="submit" class="btn btn-primary ml-auto">Salvar</button>
		</div>
	</div>
</form>
<?php include(FOOTER_TEMPLATE); ?>
