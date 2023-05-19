<?php
session_start();
require 'config.php';
require 'classes/usuarios.class.php';

if(!empty($_POST['email'])) {
	$email = addslashes($_POST['email']);
	$senha = md5($_POST['senha']);

	$usuarios = new Usuarios($pdo);

	if($usuarios->fazerLogin($email, $senha)) {
		header("Location: index.php");
		exit;
	} else {
		echo "Usuário e/ou senha estão errados!";
	}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<title>Document</title>
</head>
<body>

<div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card shadow">
          <div class="card-title text-center border-bottom">
            <h2 class="p-2">Entrar</h2>
          </div>
          <div class="card-body">
            <form method="POST">
              <div class="mb-4">
                <label for="username" class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" id="username" />
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="senha" id="password" />
              </div>
              
              <div class="d-grid">
                <button type="submit" class="btn btn-success">Login</button>
              </div>
							<div class="mt-2 text-center">
                <p>Não possui uma conta? <a href="cadastrar.php">Cadastrar</a></p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>


