<?php


session_start();
//print_r($_SESSION);
//print_r($_POST);

	if(empty($_POST["i"])){

		$i=0;
		unset($_SESSION["nome"]);
		unset($_SESSION["idade"]);

	}else{

		$i = $_POST["i"];
		$_SESSION["nome"][$i-1] = $_POST["nome"];
		$_SESSION["idade"][$i-1] = $_POST["idade"];
				
		
	}
?>

<!DOCTYPE html>

<html>
	<head>

        <title>Ex11</title>
        <meta charset = "utf-8" />

    </head>

	<body>
		<h2>Ex11: Cadastre um novo cliente - Cadastro feito usando $_SESSION</h2>
		<form action = "Ex11.php" method = "post">
			<label>
				Nome:
			<input type = "text" name = "nome" required = "required">
			</label><br />
			<label>
				Idade:
			<input type = "number" name = "idade" required = "required">
			</label><br />
			<input type = 'hidden' name = 'i' value = "<?=$i+1?>" />
			<input type = "submit" value = "Cadastrar">
		</form>

		<table>

		<thead><tr><th>Nome</th><th>Idade</th></tr></thead>

		<?php
			if($i>=1){

				foreach($_SESSION["nome"] as $j=>$v){
				
				$idade = $_SESSION["idade"][$j];
				echo"<tbody><tr><td>$v</td><td>$idade</td></tr></tbody>";
				}

			}
		?>
		</table>
	</body>
</html>