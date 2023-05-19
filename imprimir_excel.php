<?php

require 'vendor/autoload.php';
require 'classes/tarefas.class.php';
require 'config.php';

$tarefas = new Tarefas($pdo);
$lista = $tarefas->getTarefas();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    table,
    th,
    td {
      border: 1px solid black;
      border-collapse: collapse;
    }

    td,
    th {
      padding: 0.5rem;
    }

    .table-success {
      background-color: #d1e7dd;
    }
  </style>
  <title>Document</title>
</head>

<body>

  <?php
  // Criamos uma tabela HTML com o formato da planilha
  $arquivo = "registros.xls";
  $html = '';
  $html .= '<table border="1">';
  $html .= '<tr>';
  $html .= '<td colspan="5">Listagem das tarefas</tr>';
  $html .= '</tr>';


  $html .= '<tr>';
  $html .= '<td><b>Título da tarefa</b></td>';
  $html .= '<td><b>Descrição</b></td>';
  $html .= '<td><b>Data de criação</b></td>';
  $html .= '<td><b>Data de conclusão</b></td>';
  $html .= '<td><b>Status</b></td>';
  $html .= '</tr>';

  foreach ($lista as $item) {
    if ($item['status'] === 'concluido') {
      $html .= '<tr style="background-color:#d1e7dd;">';
    } else {
      $html .= '<tr>';
    }
    $html .= '<td>' . $item['titulo'] . '</td>';
    $html .= '<td>' . $item["descricao"] . '</td>';
    $html .= '<td>' . $item['data_criacao'] . '</td>';
    $html .= '<td>' . $item['data_conclusao'] . '</td>';
    $html .= '<td>' . $item['status'] . '</td>';
    $html .= '</tr>';
  }

  // Configurações header para forçar o download
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  header("Content-type: application/x-msexcel");
  header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
  header("Content-Description: PHP Generated Data");
  // Envia o conteúdo do arquivo

  echo $html;
  exit;
  ?>
</body>

</html>