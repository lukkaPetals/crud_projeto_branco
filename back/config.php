<?php
define('HOST', 'localhost');
define('USER', 'root');
define('SENHA','');
define('BD','cadastro');
//Conexão com Banco de Dados.
$conexao = new MySQLi(HOST, USER, SENHA, BD);

if($conexao->connect_error){
   die("Erro 400".$conexao->connect_error); 
}
 
?>