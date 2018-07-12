<?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>
<?php $db = open_database(); ?>
<?php if ($db) : ?>
<?php include(NEWHEADER_TEMPLATE); ?>
<div class="page-header">
	<h1 class="page-title">Dashboard</h1>
</div>
<div class="row row-cards">
	<div class="col-6 col-sm-4 col-lg-2">
		<a href="Vendas/index.php">
			<div class="card">
				<div class="card-body p-2 text-center">
					<div class="text-right text-green">
						<i class="fe fe-shopping-cart"></i>
					</div>
					<div class="h2 m-0">Vendas</div>
					<div class="text-muted mb-4">15</div>
				</div>
			</div>
		</a>
	</div>
		<div class="col-6 col-sm-4 col-lg-2">
		<a href="Vendas/index.php">
			<div class="card">
				<div class="card-body p-2 text-center">
					<div class="text-right text-green">
						<i class="fa fa-motorcycle"></i>
					</div>
					<div class="h2 m-0">Entregas</div>
					<div class="text-muted mb-4">15</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-6 col-sm-4 col-lg-2">
		<a href="Agenda/index.php">
			<div class="card">
				<div class="card-body p-2 text-center">
					<div class="text-right text-green">
					<i class="fa fa-calendar-check-o"></i>
					</div>
					<div class="h2 m-0">Agenda</div>
					<div class="text-muted mb-4">15</div>
				</div>
			</div>
		</a>
	</div>
	<!-- <div class="col-6 col-sm-4 col-lg-2">
		<a href="Products/index.php">
			<div class="card">
				<div class="card-body p-3 text-center">
					<div class="text-right text-green">
						6% <i class="fe fe-chevron-up"></i>
					</div>
					<div class="h1 m-0">Produtos</div>
					<div class="text-muted mb-4">15</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-6 col-sm-4 col-lg-2">
		<a href="Services/index.php">
			<div class="card">
				<div class="card-body p-3 text-center">
					<div class="text-right text-green">
						9% <i class="fe fe-chevron-up"></i>
					</div>
					<div class="h1 m-0">Serviços</div>
					<div class="text-muted mb-4">10</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-6 col-sm-4 col-lg-2">
		<a href="customers/add.php">
			<div class="card">
				<div class="card-body p-3 text-center">
					<div class="text-right text-green">
						3% <i class="fe fe-chevron-up"></i>
					</div>
					<div class="h1 m-0">Clientes</div>
					<div class="text-muted mb-4">10</div>
				</div>
			</div>
		</a>
	</div> -->
	<div class="col-6 col-sm-4 col-lg-2">
		<a href="configuration/add.php">
			<div class="card">
				<div class="card-body p-2 text-center">
					<div class="text-right text-red">
							<i class="fa fa-wrench"></i>
					</div>
					<div class="h2 m-0" style="font-size: 23px !important;white-space: nowrap;">Configurações</div>
					<div class="text-muted mb-4">4</div>

				</div>
			</div>
		</a>
	</div>
	<!-- <div class="col-6 col-sm-4 col-lg-2">
		<a href="Users/add.php">
			<div class="card">
				<div class="card-body p-3 text-center">
					<div class="text-right text-red">
						-1% <i class="fe fe-chevron-down"></i>
					</div>
					<div class="h1 m-0" style="font-size: 23px !important;">Usuarios</div>
					<div class="text-muted mb-4">1</div>


				</div>
			</div>
		</a>
	</div> -->

</div>

<?php else : ?>
<div class="alert alert-danger" role="alert">
	<p>
		<strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!
	</p>
</div>

<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>