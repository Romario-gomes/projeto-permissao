<?php
require ('config.php');
require 'classes/usuarios.class.php';
require 'classes/tarefas.class.php';

if(isset($_POST['titulo']) && empty($_POST['titulo']) == false){
    $titulo = addslashes($_POST['titulo']);
    $descricao = addslashes($_POST['descricao']);
   
    $tarefas = new Tarefas($pdo);

    echo $titulo;
    echo $descricao;
    if($tarefas->criarTarefa($titulo, $descricao)) {
      header("Location: index.php");
    } else {
      echo "Usuário e/ou senha estão errados!";
    }   
}

?>
