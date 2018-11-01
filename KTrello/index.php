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
			<div class="row">
				<h1>Kozima's Trello</h1>
			</div>
			<div class="row">
				<p>
					<a href="create.php" class="btn btn-primary">Criar nova tarefa</a>
				</p>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Tarefa</th>
							<th>Descrição</th>
							<th>Status</th>
							<th>Última alteração</th>
							<th>Modificar / Excluir</th>
						</tr>
					</thead>
					<tbody>
						<?php require 'loadTable.php';?>
					</tbody>
				</table>
			</div>
			<div class="footer">
				<p><?php require 'footer.php';?></p>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="js/jquery-3.3.1.js"></script>   
	<script type="text/javascript" src="js/bootstrap-4.1.js"></script>
</html>
