<?php
session_start();
if(empty($_SESSION)){
    print "<script>location.href = '../front/index.html';</script>";
}
//Verificação para impedir entrar na dashboard sem logar