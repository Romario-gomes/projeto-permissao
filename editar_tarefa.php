<?php
require ('config.php');
require 'classes/usuarios.class.php';
require 'classes/tarefas.class.php';

if(isset($_GET['id']) && empty($_GET['id']) == false){
  $id = addslashes($_GET['id']);
}
if(isset($_POST['titulo']) && empty($_POST['titulo']) == false){
  $titulo = addslashes($_POST['titulo']);
  $descricao = addslashes($_POST['descricao']);

  $tarefas = new Tarefas($pdo);

  if($tarefas->editarTarefa($id, $titulo, $descricao)) {
    header("Location: index.php");
  } else{ 
    echo "Usuário e/ou senha estão errados!";
  }
 
}
