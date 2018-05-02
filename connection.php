<?php

	//連線資料庫
	$hostName = 'localhost';
	$userName = 'root';
	$password = '123456';
	$db_name = 'typicode_user';	
	$dsn = 'mysql:host='.$hostName.';dbname='.$db_name;
	$pdo = new PDO($dsn, $userName, $password);
	$pdo -> query('set names utf8');
	