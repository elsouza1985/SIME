<!DOCTYPE html>
<html>
	<head>
		<title>Curso PHP</title>
	</head>
	<body>
		<p>Salario: 
			<?php 
			$valorSalario = 1234.80;
			echo $valorSalario;
			?>
		</p>
		<p>valor imposto a pagar: 
		<?php

			if($valorSalario > 1903.98 & $valorSalario <= 2826.65){
				echo "imposto: 7,5%";
			}elseif ( $valorSalario > 2826.65 & $valorSalario <= 3751.05){
				echo "imposto: 15%";
			
			}elseif ($valorSalario > 3751.05 & $valorSalario <= 4664.68) {
				echo "imposto: 22,5%";
			}elseif ($valorSalario > 4664.68) {
				echo "imposto: 27,5%";
			}else{
				echo "isento";
			}

		?>
		</p>
	</body>
</html>