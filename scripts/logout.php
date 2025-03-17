<?php 
//destroi a sessão
session_destroy();

//redireciona para página inicial
header('Location: index.php?rota=home');
?>