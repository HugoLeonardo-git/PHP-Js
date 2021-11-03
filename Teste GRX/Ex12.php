<?php

session_start();
//print_r($_SESSION);
//print_r($_POST);

	if(empty($_POST["i"])){

		$i=0;
		unset($_SESSION["nome"]);
		unset($_SESSION["idade"]);

	}else{

        $erro = 0;
		$i = $_POST["i"];
        $nome = $_POST["nome"];
        $idade = $_POST["idade"];

		if(!empty($_SESSION["nome"])){

			foreach($_SESSION["nome"] as $j=>$v){

				if(strcmp("$v","$nome") == 0){

					echo"O nome digitado: $nome já foi cadastrado! <br />";
					echo"<b>$v, " . $_SESSION['idade'][$j] . " Anos</b>";
					$erro = 1;
					break;
				}

			}
		}
        if($erro == 0){

            $_SESSION["nome"][$i-1] = $nome;
		    $_SESSION["idade"][$i-1] = $idade;

        }
		
	}
?>

<!DOCTYPE html>

<html>

    <head>
        <title>Ex12</title>
        <meta charset = "utf-8" />

    </head>

	<body>
		<h2>Ex12: Cadastre um novo cliente - Cadastro feito usando $_SESSION, case sensitive</h2>
		<form action = "Ex12.php" method = "post">
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