<?php
	// Inclusão de informações vindas do arquivo de conexão (database).   
  	require 'database.php';

	if ( !empty($_POST)) {

	    
	    Database::timeset();
	    // Associação de valor a variáveis pelo metodo post do formulário.     
	    $task = $_POST['task'];
	    $description = $_POST['description'];
	    $status = $_POST['status'];
	    $lastDate =  date("H:i:s d/m/Y"); // Gera data atual.
	     
	    // Validação de informações preenchidas.       
	    $valid = true;
	    if (empty($task)) {   
	  		$valid = false;
	    }
	     
	    if (empty($description)) {
	  		$valid = false;
	    }  

	    //Inicia a conexão com o banco, então insere as infoprmações preenchidas se as mesmas forem validas.
	    if ($valid) {
			$pdo = Database::connect();
		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $sql = "INSERT INTO taskMenu (task,description,status,lastDate) values(?, ?, ?, ?)";
		    $q = $pdo->prepare($sql);
		    $q->execute(array($task,$description,$status,$lastDate));
		    Database::disconnect();
		    header("Location: index.php");    
  		}
  	}  
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>KT</title>
		<link rel="icon" type="text/css" href="img/KT.png">
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Covered+By+Your+Grace" rel="stylesheet">
		<link href="css/KStyle.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div>
				<div class="row">
					<h2>Criar nova tarefa</h2>
				</div>
				<form class="form-group" action="create.php" method="post">
					<div class="form-group">
						<label class="control-label">Título da tarefa</label>
						<input name="task" type="text" class="form-control" placeholder="Título" required>
					</div>
					<div class="form-group">
						<label class="control-label">Informações da tarefa</label>
						<input name="description" type="text" class="form-control" placeholder="Descrição" required>
					</div>
					<div class="form-group">
						<label class="control-label">Status da tarefa</label>
						<div class="controls">
							<select name="status" class="custom-select">
								<option>Em desenvolvimento</option>
								<option>Concluído</option>
							</select>
						</div>
					</div>
					<div>
						<button type="submit" class="btn btn-primary">Criar</button>                        
						<a class="btn btn-danger" href="index.php">Voltar</a>
					</div>
				</form>
			</div>
			<div class="footer">
				<p><?php require 'footer.php';?></p>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="js/jquery-3.3.1.js"></script>   
	<script type="text/javascript" src="js/bootstrap-4.1.js"></script>
</html>
