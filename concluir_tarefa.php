<?php
require ('config.php');
require 'classes/usuarios.class.php';
require 'classes/tarefas.class.php';

if(isset($_GET['id']) && empty($_GET['id']) == false){
  $id = addslashes($_GET['id']);
}
$tarefas = new Tarefas($pdo);

if($tarefas->concluirTarefa($id)) {
  header("Location: index.php");
} else{ 
  echo "Usuário e/ou senha estão errados!";
}
