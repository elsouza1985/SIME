<!DOCTYPE html>
<html>
	<head>
		<title>Curso PHP</title>
	</head>
	<body>
		<label>Insira a idade: </label><input type="text" name="idade"> <br>
		<label>Insira o peso: </label><input type="text" name="peso"><br>
		<button>ok</button>
		<?php 
			$Idade = 16;
			$Peso = 49;

			if($Idade >= 16 & $Idade <= 69 & $Peso >= 50 ){
				# code...
				echo 'Atende aos requisitos';
			}
			else{
				echo "Não atende aos requisitos";
			}

		?>
	</body>
</html>