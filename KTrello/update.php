<?php
  	// Inclusão de informações vindas do arquivo de conexão (database).
	require 'database.php';
	$id = null; // Reseta o ID de tarefa

	// Solicita o ID da tarefa escolhida (linha no BD) 
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

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

	    /* Abre a janela de criação de tarefa, porém mostrando as informações atuais (as informações são puxadas pelo devido grupo no form), e dando ao usuario chance de edição.
	    Se as informações forem validadas, está função as adiciona ao banco. */
	    if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE taskMenu  set task = ?, description = ?, status =?, lastDate =? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($task,$description,$status,$lastDate,$id));
			Database::disconnect();
			header("Location: index.php");
	    }

  	// Em caso de informações não válidas, recarrega informações fornecidas préviamente.
  	}else {    
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM taskMenu where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$task = $data['task'];
		$description = $data['description'];
		$status = $data['status'];    
		Database::disconnect(); 
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
					<h2>Editar Tarefa</h2>
				</div>
				<form class="form-group" action="update.php?id=<?php echo $id?>" method="post">
					<div class="form-group">
						<label class="control-label">Título da tarefa</label>
						<input name="task" type="text" class="form-control" placeholder="Título" value="<?php echo !empty($task)?$task:'';?>" required>
					</div>
					<div class="form-group">
						<label class="control-label">Informações da tarefa</label>
						<input name="description" type="text" class="form-control" placeholder="Descrição" value="<?php echo !empty($description)?$description:'';?>"  required>
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
						<button type="submit" class="btn btn-primary">Atualizar</button>
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
