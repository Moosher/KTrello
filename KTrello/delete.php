<?php
  	// Inclusão de informações vindas do arquivo de conexão (database).
	require 'database.php';
	$id = null; // Reseta o ID de tarefa

	// Solicita o ID da tarefa escolhida (linha no BD) 
	if ( !empty($_GET['id'])) {
		$id = $_GET['id']; // Marca a tarefa selecionada.    
	}

	if ( !empty($_POST)) {

    	$id = $_POST['id']; // Marca a tarefa selecionada.    

    	// Inicia a conexão com o banco, excluir as informações com o ID selecionado.
	    $pdo = Database::connect();
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "DELETE FROM taskMenu  WHERE id = ?";
	    $q = $pdo->prepare($sql);
	    $q->execute(array($id));
	    Database::disconnect();
	    header("Location: index.php");         
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
					<h2>Excluir Tarefa</h2>
				</div>
				<form class="form-group" action="delete.php" method="post">
					<input type="hidden" name="id" value="<?php echo $id;?>"/>
					<p class="alert alert-danger">Você realmente deseja deletar esta tarefa?</p>
					<div>
						<button type="submit" class="btn btn-danger">Sim</button>
						<a class="btn btn-primary" href="index.php">Não</a>
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