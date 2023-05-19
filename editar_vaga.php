<?php
require ('config.php');
require 'classes/usuarios.class.php';
require 'classes/tarefas.class.php';

if(isset($_GET['id']) && empty($_GET['id']) == false){
    $id = $_GET['id'];
    
    if($tarefas->criarTarefa($titulo, $descricao)) {
      header("Location: index.php");
    } else {
      echo "Usuário e/ou senha estão errados!";
    }   
}
