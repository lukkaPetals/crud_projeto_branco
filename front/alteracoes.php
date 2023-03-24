<?php
error_reporting(0);
session_start();
if(empty($_SESSION)){
    print "<script>location.href = '../front/index.html';</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Usuário!</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/alt.css">
</head>
<body>
<section class="container">
	<h2>Atualizar informações do usuário</h2>
		<form method="post" action="alteracoes.php">
			<label for="email">Email:</label>
			<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='email' required><br>
			<label for="telefone">Telefone:</label>
			<input type="text" class="form-control" id="exampleInputText1" aria-describedby="textHelp" name='telefone' required><br>
			<label for="senha">Senha:</label>
			<input type="password" class="form-control" id="exampleInputPassword1" aria-describedby="passwordHelp" name='senha' required><br>
			<label for="usuario">Usuário:</label>
			<input type="text" class="form-control" id="exampleInputText1" aria-describedby="textHelp" name='usuario' required><br>
			<input type="hidden" name="acao" value="atualizar">
			<button class="btn btn-primary" type="submit" id="update">Atualizar</button>
		</form>

		<h2>Excluir informações do usuário</h2>
		<form method="post" action="alteracoes.php">
			<label for="usuario">Usuário:</label>
			<input type="text" class="form-control" id="exampleInputText1" aria-describedby="textHelp" name='usuario' required>
			<input type="hidden" name="acao" value="excluir">
			<button type="submit" class="btn btn-danger btn-lg" id="delete">Excluir</button>
		</form>
		<a href="logged.php">Voltar</a>
<section>
	
	<?php
	include '../back/config.php';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if ($_POST['acao'] === 'atualizar') {
			$email = $_POST["email"];
			$telefone = $_POST["telefone"];
			$senha = $_POST["senha"];
			$usuario = $_POST["usuario"];
			$stmt = $conexao->prepare("UPDATE usuario SET email_user=?, telefone_user=?, senha_user=?, usuario_user=?");
			$stmt->bind_param("ssss", $email, $telefone, base64_encode($senha), $usuario);
			if ($stmt->execute()) {
				echo "<p>As informações do usuário foram atualizadas com sucesso!</p>";
			} else {
				echo "<p>Erro ao atualizar as informações do usuário: " . $conexao->error . "</p>";
			}
			$_SESSION['email'] = $_POST['email'];
			$stmt->close();
			$conexao->close();
		} elseif ($_POST['acao'] === 'excluir') {
			$usuario = $_POST['usuario'];
			$stmt = $conexao->prepare('DELETE FROM usuario WHERE usuario_user = ?');
			$stmt->bind_param('s', $usuario);
			if ($stmt->execute()) {
				echo "<p>Usuário excluído.</p>";
			} else {
				echo "<p>Erro ao excluir o usuário: " . $conexao->error . "</p>";
			}
			$stmt->close();
			$conexao->close();
		}
	}
	?>
	
</body>
</html>