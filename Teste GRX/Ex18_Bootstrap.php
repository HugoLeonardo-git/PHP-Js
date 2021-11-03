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
    
                        echo"<p class = 'lead'>O nome digitado: $nome já foi cadastrado!</p>";
                        echo"<p class = 'lead'><b>$v, " . $_SESSION['idade'][$j] . " Anos</b></p>";
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
        <title>Ex18 - Bootstrap</title>
        <meta charset = "utf-8" />
        <script src="jquery-3.5.1.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
		<h2>Ex18 - Bootstrap</h2>
    
        <form id = "myform" action = "Ex18_Bootstrap.php" method = "post">
            <input type = 'hidden' name = 'i' value = "<?=$i?>" />
        </form>
        
		<form action = "Ex18_Bootstrap.php" method = "post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="label_nome">Nome</label>
                    <input type = "text" id = "label_nome" name = "nome" class="form-control" placeholder="Digite o nome" required = "required">
                </div>  
            
                <div class="form-group col-md-6">
                    <label for="label_idade">Idade</label>
                    <input type = "number" name = "idade" class="form-control" id="label_idade" placeholder="Digite a idade" required = "required">
                </div>
            </div>
            <br />
                <input type = 'hidden' name = 'i' value = "<?=$i+1?>" />
            <div class="col-sm-12">
                <input type = "submit" value = "Cadastrar" class="btn btn-primary btn-lg btn-block">
            </div>
           
		</form>

		<table class="table table-bordered table-hover">
        <caption>Lista de usuários</caption>
		<thead class="thead-dark">
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Idade</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>

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
                if(empty($nome_idade)){?>

                    <p class = "lead text-center" style = "color:red;">Não existem pessoas cadastradas!</p>
                   

         <?php }else{
                    arsort($nome_idade);
                    
                    foreach($nome_idade as $nome=>$idade){?>
                        
                        <tbody><tr><td><?= $nome; ?></td><td><?= $idade; ?></td>
                        <td><button type = "submit" form = "myform" 
                        name = "delete" class = "button_class btn btn-outline-danger" value = "<?=$nome;?>">Deletar</button></td></tr></tbody>

           <?php    }
                }
			}
		?>
		</table>
	</body>
</html>