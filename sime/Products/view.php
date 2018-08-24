<?php
require_once('functions.php');
view($_GET['ID']);
?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Cliente <?php echo $Product['ID']; ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php endif; ?>

<dl class="dl-horizontal">
	<dt>Nome:</dt>
	<dd><?php echo $Product['Nome']; ?></dd>

</dl>




<div id="actions" class="row">
	<div class="col-md-12">
	  <a href="edit.php?id=<?php echo $Product['ID']; ?>" class="btn btn-primary">Editar</a>
	  <a href="index.php" class="btn btn-default">Voltar</a>
	</div>
</div>

<?php include(FOOTER_TEMPLATE); ?>