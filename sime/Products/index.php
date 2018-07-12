


<?php
    require_once('functions.php');
    index();
?>

<?php include(NEWHEADER_TEMPLATE); ?>
<script type="text/javascript">
 $(document).ready(function(){
 var url = "add.php";
 jQuery('#btnAdd').click(function(e) {
     $('.modal-container').load(url,function(result){
 $('#myModal').modal({show:true});
 });
 });
 jQuery('#btnEdit').click(function(e) {
	 url = 'edit.php?id='+this.
     $('.modal-container').load(url,function(result){
 $('#myModal').modal({show:true});
 });
 });
 });
</script>
<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Produtos e Serviços</h2>
		</div>
		<div class="col-sm-6 text-right h2">
	    	<button class="btn btn-primary" id="btnAdd"><i class="fa fa-plus"></i> Novo Produto</button>
	    	<a class="btn btn-default" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
	    </div>
	</div>
</header>



<hr>
<div class="table-responsive">
                    <table class="table card-table table-striped table-vcenter">
                      <thead>
                        <tr>
                          <th >Nome</th>
                          <th >Tipo</th>
                          <th >Valor Atual</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                    <?php if ($Products) : ?>
					<?php foreach ($Products as $Product) : ?>
                        <tr>
                         <td><?php echo $Product['Nome']; ?></td>
                         <td><?php echo $Product['Tipo']; ?></td>
                         <td>R$<?php echo $Product['Valor']; ?><td>
                         <td>
                         <a href="#" class="icon" data-toggle="modal" data-target="#edit-modal" data-customerID="<?php echo $Product['ID']; ?>" data-customer="<?php echo $Product['Nome']; ?>"><i class="fe fe-pencil"></i>
                         <a href="#" class="icon" data-toggle="modal" data-target="#delete-modal" data-customerID="<?php echo $Product['ID']; ?>" data-customer="<?php echo $Product['Nome']; ?>"><i class="fe fe-trash"></i></a>
                          </td>
                        </tr>
                        <?php endforeach; ?>
<?php else : ?>
	<tr>
		<td colspan="6">Nenhum registro encontrado.</td>
	</tr>
<?php endif; ?>
                      </tbody>
                 
                    </table>
                  </div>

<div class="modal-container" ></div>

<?php include(FOOTER_TEMPLATE); ?>