<?php require_once 'config.php'; ?>
<?php
    require_once('inc/functions.php');
    index();
?>

<?php include(NEWHEADER_TEMPLATE); ?>
<script type="text/javascript" src="../assets/js/cliente-ajax.js" ></script>
<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Lançamento de despesas</h2>
		</div>
		<div class="col-sm-6 text-right h2">
			<a class="btn btn-primary" href="#" data-toggle="modal"
					data-target="#add-modal"><i class="fa fa-plus"></i>
				Novo Lançamento</a> <a class="btn btn-default" href="index.php"><i
				class="fa fa-refresh"></i> Atualizar</a>
		</div>
	</div>
</header>


<hr>
<div class="table-responsive">
	<table class="table card-table table-striped table-vcenter">
		<thead>
			<tr>
				<th colspan="2">Nome</th>
				<th>Contato</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
                    <?php if ($customers) : ?>
					<?php foreach ($customers as $customer) : ?>
                        <tr>
				<td><span class="avatar">Cli</span></td>
				<td><?php echo $customer['name']; ?></td>
				<td><?php echo $customer['mobile']; ?></td>
				<td><a href="#" class="icon" data-toggle="modal"
					data-target="#delete-modal"
					data-customerID="<?php echo $customer['id']; ?>"
					data-customer="<?php echo $customer['name']; ?>"><i
						class="fe fe-trash"></i></a></td>
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

<?php include('modal/modal.php'); ?>
<?php include('add.php'); ?>

<?php include(FOOTER_TEMPLATE); ?>