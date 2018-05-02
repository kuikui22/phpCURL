<?php
	require('./connection.php');

	$id = $_POST['id'];
	$name = $_POST['name'];
	$username = $_POST['username'];
	$email = $_POST['email'];

	echo $id;
	
	global $pdo;
	$table_name = 'user';
	$sql = "UPDATE ".$table_name." SET name = :name, username = :username, email = :email WHERE id = :id";
	$sqlResult = $pdo -> prepare($sql);
	
	$sqlResult->bindParam(':name', $_POST['name'], PDO::PARAM_STR); 
	$sqlResult->bindParam(':username', $_POST['username'], PDO::PARAM_STR); 
	$sqlResult->bindParam(':email', $_POST['email'], PDO::PARAM_STR); 
	$sqlResult->bindParam(':id', $_POST['id'], PDO::PARAM_INT);		
	$sqlResult->execute(); 
?>