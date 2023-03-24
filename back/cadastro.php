<?php

include 'config.php';

$email = $_POST["email"];
$telefone = $_POST["telefone"];
$senha = $_POST["senha"];
$usuario = $_POST["usuario"];

//Verifica se o usuário já existe
$stmt = $conexao->prepare("SELECT id_user FROM usuario WHERE usuario_user = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    echo "Este usuário já está em uso.";
    exit();
}

//Insere o novo cliente no banco de dados
$stmt = $conexao->prepare("INSERT INTO usuario (email_user, telefone_user, senha_user, usuario_user) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $email, $telefone, base64_encode($senha), $usuario);
if ($stmt->execute()) {
    echo "Cliente cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar o cliente: " . $conexao->error;
}
//Fecha a conexão com o banco de dados
$stmt->close();
$conexao->close();

header('Location: ../front/index.html');