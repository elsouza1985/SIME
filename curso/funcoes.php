<!DOCTYPE html>
<html>
	<head>
		<title>Curso PHP</title>
	</head>
	<body>
		<?php 
			function exibirBoasVindas(){
				echo "Bem vindo ao curso <br>";

			}	
			exibirBoasVindas();
			function calcularAreaTerreno($Largura, $Comprimento){

				$area = $Largura * $Comprimento;

				return $area;

			}
				$var1 =calcularAreaTerreno(30,50); 
			echo "$var1";

			function stringCorrect($valor){
				$ret = ucfirst($valor);
				return $ret;
			}

			echo "<br>";
			echo stringCorrect("aLIne");

		?>
	</body>
</html>