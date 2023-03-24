<?php

session_start();
//Verifica se o espaço está vazio.
if(empty(empty($_POST["email"])) or (empty($_POST["senha"]))){
    echo 'teste';
    //print "<script>location.href='../front/index.html';</script>";
    //exit();
}
include('config.php');
$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuario WHERE email_user = ?"; 
$stmt = $conexao->prepare($sql);
$stmt->execute([$email]);
$res = $stmt->get_result();
$row = $res->fetch_object();
$qtd = $res->num_rows;
//Decodificar a senha e verificar a senha inserida com a do banco de dados
if ($qtd > 0) {
    if ($senha == base64_decode($row->senha_user)) {
        $_SESSION["email"] = $row->email_user;
        $_SESSION["senha"] = $senha;
        header('Location: ../front/logged.php');
        exit();
    } else {
        $erroLogin = "Senha incorreta.";
        echo 'teste';
    }
} else {
    $erroLogin = "Usuário não encontrado.";
    echo 'teste3';
}

//Fecha a conexão com o banco de dados
$stmt->close();
$conexao->close();


