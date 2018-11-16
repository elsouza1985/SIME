<!DOCTYPE html>
<html>
	<head>
		<title>Curso PHP</title>
	</head>
	<body>
		<?php 
			$usuario_possui_cartao_loja = true;
			$valor_compra = 400

		?>
		<h1>Detalhes do pedido</h1>
		<p>Possui cartão da loja? 
		<?php
		 $teste =	$usuario_possui_cartao_loja == true ?  "sim":  "não";
		 echo $teste;
		?>
		</p>
		<p>Valor da compra: <?= $valor_compra ?></p>

	</body>
</html>
