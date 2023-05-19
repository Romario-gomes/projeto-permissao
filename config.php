<?php
try {
	$options = [
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	];
	$pdo = new PDO("mysql:dbname=projeto_permissao;host=localhost;charset=utf8", "root", "admin", $options);
} catch (PDOException $e) {
	echo "ERRO: " . $e->getMessage();
}
