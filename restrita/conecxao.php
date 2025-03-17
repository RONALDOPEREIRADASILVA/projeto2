
<?php
//conexão com banco de dados

$server = "localhost"; //servider
$user = "root"; //Usuario
$pass = ""; //senha do usuario
$bd = "empresa"; //Nome do banco de dado

//estabelecendo conexão com o banco de dado e se(fi)conectar(echo) mostra "conectado" 
//(else) se não conectar (echo) mostra "erro"
if ($conn = mysqli_connect($server, $user, $pass, $bd)) {
} else
    echo " erro";


function mover_foto($vetor_foto)
{
    $vtipo = explode("/", $vetor_foto['type']);
    $tipo = $vtipo[0] ?? '';
     // Verifica se existe um segundo elemento em $vtipo
     if (strpos($vetor_foto['type'], "/") !== false) {
        $extensao = "." . $vtipo[1];
    } else {
        $extensao = ""; // Ou defina um valor padrão, se necessário
    }

    if (
        (!$vetor_foto['error']) and ($vetor_foto['size'] <= 500000) and ($tipo == "image")
    ) {
        $nome_arquivo = date('Ymdhms') . $extensao;
        move_uploaded_file($vetor_foto['tmp_name'], "img/" . $nome_arquivo);
        return $nome_arquivo;
    } else {
        return 0;
    }
}
