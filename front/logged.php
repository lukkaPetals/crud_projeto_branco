<?php

include '../back/config.php';
session_start();

//deveria pegar do banco mas como não funciona, forçamos
$email = $_SESSION['email'];

$stmt = $conexao->prepare("SELECT * FROM usuario WHERE email_user = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Logado</title>
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/logged.css">
</head>

<body>
    



<section class="container">
    <h1>Bem vindo!</h1>
    <h2>Suas informações:</h2>
    <div class="info">
        Email: <br>
        <?php echo $usuario["email_user"] ?> <br>
        
    </div>
    <div class="info">
        Telefone: <br>
        <?php echo $usuario["telefone_user"] ?> <br>
        
    </div>
    <div class="info">
        Usuário: <br>
        <?php echo $usuario["usuario_user"] ?> <br>
        
    </div>
    <a href="alteracoes.php"><button type="button" class="btn btn-primary btn-sm">Editar</button></a> <br>
    <a href="../back/logout.php"><button type="button" class="btn btn-primary btn-sm">Encerrar sessão</button></a> <br>
    <button type="button" class="btn btn-danger btn-lg" id="delete">Apagar conta</button>
    
</section>

  
</body>

</html>