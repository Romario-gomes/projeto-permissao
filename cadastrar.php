<?php
require ('config.php');

if(isset($_POST['nome']) && empty($_POST['nome']) == false){
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $permissoes = $_POST['permissoes'];
    $permissions_string = implode(",", $permissoes);

    echo $nome.'<br>';
    echo $telefone.'<br>';
    echo $email.'<br>';
    echo $permissions_string.'<br>';
    echo $senha.'<br>';


    $sql = "INSERT INTO tb_usuarios (nome, telefone, email, senha, permissoes) VALUES (:nome, :telefone, :email, :senha, :permissoes)";

    $sql = $pdo->prepare($sql);
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':telefone', $telefone);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':senha', md5($senha));
    $sql->bindValue(':permissoes', $permissions_string);

    $sql = $sql->execute();
    header("Location: login.php");    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="card shadow">
          <div class="card-title text-center border-bottom">
            <h2 class="p-2 pt-3">Cadastrar usuário</h2>
          </div>
          <div class="card-body">
            <form method="POST">
              <div class="row">
                <div class="col-lg-6 mb-2">
                  <label for="username" class="form-label">Nome</label>
                  <input type="text" class="form-control" placeholder="nome" name="nome" id="username" required/>
                </div>

                <div class="col-lg-6 mb-2">
                  <label for="telefone" class="form-label">Telefone/Celular</label>
                  <input type="text" class="form-control phone-mask" placeholder="Telefone/Celular"  name="telefone" id="telefone" required/>
                </div>
              </div>
              
              <div class="row mb-3">
                <div class="col-lg-6 mb-2">
                  <label for="email" class="form-label">E-mail</label>
                  <input type="email" class="form-control" placeholder="E-mail"  name="email" id="email" required/>
                </div>

                <div class="col-lg-6 mb-2">
                  <label for="senha" class="form-label">Senha</label>
                  <input type="password" class="form-control" placeholder="Senha"  name="senha" id="senha" required/>
                </div>
              </div>
              <hr>
              <div class="row d-flex flex-row justify-content-center mb-3">
                <p class="text-center">Permissões do usuário</p>
                <div class="col-6">
                  <input type="checkbox" name="permissoes[]" value="visualizar" class="form-check-input" id="same-address">
                  <label class="form-check-label"  for="same-address">visualizar</label>
                </div>
                <div class="col-6">
                  <input type="checkbox"  name="permissoes[]" value="editar" class="form-check-input" id="same-address">
                  <label class="form-check-label" for="same-address">editar</label>
                </div>
                <div class="col-6">
                  <input type="checkbox"  name="permissoes[]" value="cadastrar"  class="form-check-input" id="same-address">
                  <label class="form-check-label"for="same-address">cadastrar</label>
                </div>
                <div class="col-6">
                  <input type="checkbox"  name="permissoes[]" value="excluir"  class="form-check-input" id="same-address">
                  <label class="form-check-label"for="same-address">excluir</label>
                </div>
                <div class="col-12">
                  <input type="checkbox"  name="permissoes[]" value="imprimir"  class="form-check-input" id="same-address">
                  <label class="form-check-label"for="same-address">imprimir</label>
                </div>
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






  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>



  <script>
  // Obtém o elemento do campo de telefone
  var telefoneInput = document.getElementById('telefone');
  
  // Adiciona um evento de digitação ao campo de telefone
  telefoneInput.addEventListener('input', function(event) {
    var telefone = event.target.value;
    
    // Remove todos os caracteres que não sejam números
    telefone = telefone.replace(/\D/g, '');
    
    // Aplica a máscara
    if (telefone.length === 11) {
      telefone = telefone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
    } else {
      telefone = telefone.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
    }
    
    // Define o valor formatado no campo de telefone
    event.target.value = telefone;
    
  });
</script>

<script>
var senhaInput = document.getElementById('senha');

senhaInput.addEventListener('blur', function() {
  validarSenha();
});

function validarSenha() {
  var senha = senhaInput.value;
  
  // Verifica se a senha possui pelo menos 8 caracteres
  if (senha.length < 8) {
    alert("A senha deve ter pelo menos 8 caracteres");
    return;
  }
  
  // Verifica se a senha contém pelo menos um caractere maiúsculo, um caractere especial e um número
  var regexMaiusculo = /[A-Z]/;
  var regexEspecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
  var regexNumero = /[0-9]/;
  
  if (!regexMaiusculo.test(senha) || !regexEspecial.test(senha) || !regexNumero.test(senha)) {
    alert("A senha deve conter pelo menos um caractere maiúsculo, um caractere especial e um número");
    return;
  }

}
</script>


 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>