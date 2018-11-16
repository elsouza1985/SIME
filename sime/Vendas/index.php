<?php
require_once ('../config.php');
include (NEWHEADER_TEMPLATE);
?>


<div class="page-header">
	<h1 class="page-title">Vendas</h1>
</div>
<div class="row row-cards">
	<div class="col-6 col-sm-4 col-lg-2">
		<a href="add_1.php">
			<div class="card">
				<div class="card-body p-2 text-center">
					<div class="text-right text-green">
						<i class="fe fe-shopping-cart"></i>
					</div>
					<div class="h2 m-0">Vender</div>
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
					<div class="h2 m-0">Consultas</div>
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
					<div class="h2 m-0">Configurações</div>
					<div class="text-muted mb-4">15</div>
				</div>
			</div>
		</a>
	</div>
<?php include(FOOTER_TEMPLATE); ?>

