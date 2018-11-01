<?php
	require 'database.php'; // Inclusão de informações vindas do arquivo de conexão (database).
	$pdo = Database::connect(); // Chama a função de conexão do banco. 
	$sql = 'SELECT * FROM taskMenu ORDER BY id DESC'; // Solicita as informações do banco.
	foreach ($pdo->query($sql) as $row) { // Estrutura de repetição que preenche a grid com as informações do bd.
		echo '<tr>';
		echo '<td>'. $row['task'] . '</td>';
		echo '<td>'. $row['description'] . '</td>';
		echo '<td>'. $row['status'] . '</td>';
		echo '<td>'. $row['lastDate']. '</td>';
		echo '<td width=100>';                
		echo '<a class="btn btn-primary" href="update.php?id='.$row['id'].'">Editar</a>';              
		echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Excluir</a>';
		echo '</td>';
		echo '</tr>';                
	}
	Database::disconnect(); // Chama a função de desconexão do banco.                                       
?>