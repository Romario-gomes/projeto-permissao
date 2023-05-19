<?php
class Tarefas {
	private $pdo;
	public function __construct($pdo) {
		$this->pdo = $pdo;
	}

	public function getTarefas() {
		$array = array();

		$sql = "SELECT * FROM tb_tarefas";
		$sql = $this->pdo->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}


	public function criarTarefa($titulo, $descricao) {
		$sql = "INSERT INTO tb_tarefas (titulo, descricao, data_criacao, status) VALUES (:titulo, :descricao, NOW(), 'pendente')";

    $sql = $this->pdo->prepare($sql);
    $sql->bindValue(':titulo', $titulo);
    $sql->bindValue(':descricao', $descricao);
    $sql = $sql->execute();
		
		return true;

	}

	public function editarTarefa($id, $titulo, $descricao) {
		$sql =  "UPDATE tb_tarefas SET titulo = :titulo, descricao = :descricao WHERE id = :id";


		$sql = $this->pdo->prepare($sql);
    $sql->bindValue(':titulo', $titulo);
    $sql->bindValue(':descricao', $descricao);
    $sql->bindValue(':id', $id);

    $sql = $sql->execute();

		return true;
	}

	public function concluirTarefa($id) {		
		$sql =  "SELECT * FROM tb_tarefas WHERE id = '$id'";

    $sql = $this->pdo->query($sql);

		if($sql->rowCount() > 0) {
			$tarefa = $sql->fetch();
			if($tarefa['status'] == 'pendente') {
				$sql = "UPDATE tb_tarefas SET status = 'concluido', data_conclusao = NOW()  WHERE id = :id";
			} else {
				$sql = "UPDATE tb_tarefas SET status = 'pendente', data_conclusao = NULL WHERE id = :id";
			}

			$sql = $this->pdo->prepare($sql);
    	$sql->bindValue(':id', $id);
			$sql = $sql->execute();

			return true;
		}

		return false;
	}

	public function excluirTarefa($id) {		
		$sql =  "SELECT * FROM tb_tarefas WHERE id = '$id'";
		$sql = "DELETE FROM tb_tarefas WHERE id = :id";
   
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();

		return true;
	}


}