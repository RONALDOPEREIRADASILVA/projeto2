<?php
//verifica se aconteceu um post
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?rota=login');
    exit;
}
//vai busca os dados do POST
$usuario = $_POST['text_usuario'] ?? null;
$senha = $_POST['text_senha'] ?? null;
//varifica se os dados estão preenchidos
if (empty($usuario) || empty($senha)) {
    header('Location: index.php?rota=login');
    exit;
}
//aclass da base de dados ja esta carregada no index.php
$db = new database();
$params = [
    ':usuario' => $usuario
];
$sql = "SELECT * FROM usuario WHERE usuario = :usuario";
$result =$db->query($sql, $params);
//verifica se aconteceu um erro
if ($result['status'] === 'error'){
    header('Location: index.php?rota=404');
    exit;
}
//verifica se o usuario existe
if (count($result['data']) === 0){
    //erro na sessão
    $_SESSION['error'] = 'Usuario ou senha invalidos';
    header('Location: index.php?rota=login');
    exit;
}
//verifica se o usuario existe
if (!password_verify($senha, $result['data'][0]->senha)) {
    //erro na sessão
    $_SESSION['error'] = 'Usuario ou senha invalidos';

    header('Location: index.php?rota=login');
    exit;
}

//define a sessão do usuario
$_SESSION['usuario'] = $result['data'][0];



//redirecionar para a pagina do usuario
header('Location: index.php?rota=home');
