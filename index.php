<?php
session_start();
require 'vendor/autoload.php';
require 'config.php';
require 'classes/usuarios.class.php';
require 'classes/tarefas.class.php';

if (!isset($_SESSION['logado'])) {
	header("Location: login.php");
	exit;
}


$usuarios = new Usuarios($pdo);
$usuarios->setUsuario($_SESSION['logado']);

$idUser = $usuarios->pegarUsuario();

$tarefas = new Tarefas($pdo);
$lista = $tarefas->getTarefas();
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<h1 class="text-center">Listagem de tarefas</h1>
	<div class="d-flex flex-row justify-content-between">
		<div class="d-flex flex-row justify-content-start">

			<?php if ($usuarios->temPermissao('cadastrar')) : ?>
				<div>
					<button type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#addTask">
						Adicionar Tarefa
					</button>
					<div class="modal fade" id="addTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog  modal-xl modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Adicionar Tarefa</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<form method="POST" action="adicionar_tarefa.php">
									<div class="modal-body">
										Titulo:<br />
										<input type="text" class="form-control" name="titulo" /><br /><br />

										Descrição: <br />
										<input type="text" class="form-control" name="descricao" /><br /><br />
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
										<button type="submit" class="btn btn-primary">Adicionar</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>


				<!-- Modal -->

			<?php endif; ?>
			<div>

				<?php if ($usuarios->temPermissao('imprimir')) : ?>
					<button type="button" class="btn btn-secondary m-1" data-bs-toggle="modal" data-bs-target="#imprimirTask">
						Imprimir
					</button>

					<div class="modal fade" id="imprimirTask" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
						<div class="modal-dialog  modal-xl modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="editModal">Imprimir Tarefa via:</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="row d-flex justify-content-center">
									<div class="col-2 p-3">
										<a href="imprimir_pdf.php" class="btn btn-primary btn-lg">PDF</a>
										<a href="imprimir_excel.php" class="btn btn-success btn-lg">Excel</a>
									</div>
								</div>



								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
								</div>
								</form>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>

		</div>

		<div>
			<a href="sair.php" class="btn btn-danger m-1 me-4">Sair</a>
		</div>
	</div>




	<div class="row d-flex justify-content-center m-0">
		<div class="col-12">
			<table class="table table-hover table-bordered">
				<tr>
					<th>Título da tarefa</th>
					<th>Descrição</th>
					<th>Data de criação</th>
					<th>Data de conclusão</th>
					<th>Status</th>
					<th>Ações</th>
				</tr>
				<?php foreach ($lista as $item) : ?>

					<tr <?php if ($item['status'] === 'concluido') {
								echo 'class="table-success"';
							}  ?>>
						<td><?php echo $item['titulo']; ?></td>
						<td><?php echo $item['descricao']; ?></td>
						<td><?php echo  date('d/m/Y', strtotime($item['data_criacao'])); ?></td>
						<td><?php if ($item['data_conclusao']) {
									echo date('d/m/Y', strtotime($item['data_criacao']));
								} else echo 'Não concluído'; ?></td>
						<td><?php echo $item['status']; ?></td>
						<td>
							<?php if ($usuarios->temPermissao('editar')) : ?>
								<?php if ($item['status'] == 'pendente') {
									echo '<a href="concluir_tarefa.php?id=' . $item['id'] . '" class="btn btn-success">Concluir</a>';
								} else {
									echo '<a href="concluir_tarefa.php?id=' . $item['id'] . '" class="btn btn-warning">Pendente</a>';
								} ?>
							<?php endif; ?>
							<?php if ($usuarios->temPermissao('editar')) : ?>
								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editTask<?php echo $item['id'];
																																																							?>">
									Editar
								</button>
								<div class="modal fade" id="editTask<?php echo $item['id'];
																										?>" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
									<div class="modal-dialog  modal-xl modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="editModal">Editar Tarefa</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<form method="POST" action="editar_tarefa.php?id=<?php echo $item['id']  ?>">
												<div class="modal-body">
													Titulo:<br />
													<input type="text" class="form-control mb-3" value="<?php echo $item['titulo'];  ?>" name="titulo" />

													Descrição: <br />
													<input type="text" class="form-control" value="<?php echo $item['descricao'];  ?>" name="descricao" />
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
													<button type="submit" class="btn btn-primary">Editar</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							<?php endif; ?>

							<?php if ($usuarios->temPermissao('excluir')) : ?>
								<a href="excluir_tarefa.php?id=<?php echo $item['id'] ?>" class="btn btn-danger">Excluir</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>