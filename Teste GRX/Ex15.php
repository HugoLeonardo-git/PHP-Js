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
        if(!empty($_POST["nome"])){

            $nome = $_POST["nome"];

            if($i>=2){

                foreach($_SESSION["nome"] as $j=>$v){
    
                    if(strcmp("$v","$nome") == 0){
    
                        echo"O nome digitado: $nome já foi cadastrado! <br />";
                        echo"<b>$v, " . $_SESSION['idade'][$j] . " Anos</b>";
                        $erro = 1;
                        break;
                    }
    
                }
            }
        }
        if(!empty($_POST["idade"])){
            $idade = $_POST["idade"];
        }

        if($erro == 0 && !empty($nome)){

            $_SESSION["nome"][$i-1] = $nome;
		    $_SESSION["idade"][$i-1] = $idade;

        }
		
	}
?>

<!DOCTYPE html>

<html>

    <head>
        <title>Ex15</title>
        <meta charset = "utf-8" />
        <script src="jquery-3.5.1.min.js"></script>

    </head>

    <script>
		 
        $(document).ready(function() {
            $(".button_class").click(function () {
                
                if (confirm("Deseja apagar esta linha?") == true) {
                    document.getElementById('myform').submit();
                    location.reload();
                    return(true);
                }else{

                    return(false);

                } 
    
             });
        });

		

    </script>

	<body>
		<h2>Ex15: Cadastre um novo cliente - confirmação de exclusão com js</h2>
    
        <form id = "myform" action = "Ex15.php" method = "post">
            <input type = 'hidden' name = 'i' value = "<?=$i?>" />
        </form>

		<form action = "Ex15.php" method = "post">
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

                    if(!empty($_POST["delete"])){

                        //echo $_POST["delete"];
                        $nome_deletar = $_POST["delete"];
                        if(strcmp("$v","$nome_deletar") == 0){
                            //echo $_SESSION["nome"][$j];
                            unset($_SESSION["nome"][$j]);

                        }
                        
                    }     
				
				}

                foreach($_SESSION["nome"] as $j=>$v){

                    $idade = $_SESSION["idade"][$j];
                    $nome_idade["$v"] = $idade;

                }
                //print_r($nome_idade);
                if(empty($nome_idade)){

                    echo"Não existem pessoas cadastradas!";
                   /* onclick="Funcao_Deletar('<?= $nome;?>')"*/

                }else{
                    arsort($nome_idade);
                    
                    foreach($nome_idade as $nome=>$idade){?>
                        
                        <tbody><tr><td><?= $nome; ?></td><td><?= $idade; ?></td>
                        <td><button type = "submit" form = "myform" 
                        name = "delete" class = "button_class" value = "<?=$nome;?>">Deletar</button></td></tr></tbody>

           <?php    }
                }
			}
		?>
		</table>
	</body>
</html>