<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <header>
        <h1>Resultados</h1>
    </header>

    <main>
        <?php
        // Inclui a biblioteca BcMath para operações matemáticas de precisão arbitrária
        use BcMath\Number;
        // Inclui o arquivo de conexão com o banco de dados
        include "conecxao.php";
        // Verifica se a requisição é do tipo GET e se os parâmetros 'nome', 'tipogasto' ,'data'e 'valor' estão definidos
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome'], $_POST['tipogastos'], $_POST['data'], $_POST['valor'], $_FILES['foto'])) {
            // Obtém os valores dos parâmetros 'nome', 'tipogasto','data' e 'valor' da requisição GET
            $nome = $_POST['nome'];
            $tipogastos = $_POST['tipogastos'];
            $data = $_POST['data'];
            $valor = str_replace(['.', ','], ['', '.'], $_POST['valor']); //formatacão de valores
            $foto = $_FILES['foto'];
            $nome_foto = mover_foto($foto);
            if ($nome_foto == 0) {
                $nome_foto = null;
            }


            // Cria a query SQL para inserir os dados na tabela 'tabela_de_gastos'
            // Usa placeholders '?' para evitar injeção de SQL
            $sql = "INSERT INTO tabela_de_gastos (nome, tipogastos, data, valor , foto) VALUES (?, ?, ?, ?,?)";
            // Prepara a query SQL para execução
            $stmt = mysqli_prepare($conn, $sql);
            // Verifica se a preparação da query foi bem-sucedida
            if ($stmt) {

                // Vincula os parâmetros à query preparada, especificando o tipo de cada parâmetro ('sss' para strings)
                mysqli_stmt_bind_param($stmt, "ssssd", $nome, $tipogastos, $data, $valor, $nome_foto);

                // Executa a query preparada
                if (mysqli_stmt_execute($stmt)) {
                    if ($nome_foto != null) {

                        // Se a execução for bem-sucedida, exibe uma mensagem de sucesso
                        echo "<img src='img/$nome_foto' title='$nome_foto' class='mostra_foto'>
                    cadastrada com sucesso.";
                    }
                } else {

                    // Se houver um erro na execução, exibe uma mensagem de erro com detalhes do erro
                    echo "Erro ao cadastrar pessoa: " . mysqli_stmt_error($stmt);
                }

                // Fecha a declaração preparada
                mysqli_stmt_close($stmt);
            } else {

                // Se houver um erro na preparação da query, exibe uma mensagem de erro com detalhes do erro
                echo "Erro na preparação da consulta: " . mysqli_error($conn);
            }
        } else {
            // Se houver um erro na preparação da query, exibe uma mensagem de erro com detalhes do erro
            echo "Dados inválidos ou incompletos.";
        }
        ?>
        <a href ="index.php" class='btn btn-info'>Voltar Para o Início</a>
    </main>

</body>

</html>