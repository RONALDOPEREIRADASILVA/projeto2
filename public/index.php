<?php
//inicio da sessão
session_start();

//carregamento das rotas permitidas
$rotas_permitidas = require_once __DIR__ . '/../inc/rotas.php';
//definição da rota
$rota = $_GET['rota'] ?? 'home';

//Verifica se o usuario esta logado
if (!isset($_SESSION['usuario']) && $rota !== 'login_submit') {
    $rota = "login";
}

//se o usuario está logado e tenta entra no login..
if (isset($_SESSION['usuario']) && $rota === 'login') {
    $rota = 'home';
}
//se a rota não existe
if (
    !in_array($rota, $rotas_permitidas)
) {
    $rota = '404';
}

//preparação da pagina
$script = null;
switch ($rota) {
    case '404':
        $script = '404.php';
        break;

    case 'login':
        $script = 'login.php';
        break;

    case 'login_submit':
        $script = 'login_submit.php';
        break;

    case 'logout':
        $script = 'logout.php';
        break;


    case 'home':
        $script = 'home.php';
        break;
}

//carregamento de scripts permanentes
require_once __DIR__ . "/../inc/config.php";
require_once __DIR__ . "/../inc/database.php";


//apresentação da pagina
require_once __DIR__ . "/../inc/header.php";
require_once __DIR__ . "/../scripts/$script";
require_once __DIR__ . "/../inc/footer.php";
