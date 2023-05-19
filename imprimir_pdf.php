<?php 
  
require 'vendor/autoload.php';
require 'classes/tarefas.class.php';
require 'config.php';

$tarefas = new Tarefas($pdo);
$lista = $tarefas->getTarefas();




?>
<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    td, th{
      padding: 0.5rem;
    }
    .table-success{
      background-color:#d1e7dd;
    }
  </style>
  <title>Document</title>
</head>
<body>

<table border="1" width="100%">
	<tr>
		<th>Título da tarefa</th>
		<th>Descrição</th>
		<th>Data de criação</th>
		<th>Data de conclusão</th>
		<th>Status</th>

	</tr>
	<?php foreach($lista as $item): ?>

	<tr <?php if($item['status'] === 'concluido') { echo 'class="table-success"'; }  ?>>
		<td><?php echo $item['titulo']; ?></td>
		<td><?php echo $item['descricao']; ?></td>
		<td><?php echo date('d/m/Y',strtotime($item['data_criacao'])); ?></td>
		<td><?php if($item['data_conclusao']){ echo date('d/m/Y',strtotime($item['data_criacao'])); } else echo 'Não concluído'; ?></td>
		<td><?php echo $item['status']; ?></td>
	</tr>
	<?php endforeach; ?>
</table>

<?php $html = ob_get_contents();  ?>
</body>
</html>

<?php

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
ob_clean();
$mpdf->Output();
exit;
?>