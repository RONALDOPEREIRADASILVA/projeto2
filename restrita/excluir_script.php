<!doctype html>
<html lang="pt-br">

<head>
    <title>exclusão de Cadastro</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
</head>

<body>
    <header>
    </header>
    <div class="container">
        <div class="row">
            <?php
            // Inclui o arquivo de conexão com o banco de dados.
            include "conecxao.php";
            // Obtém o ID do item a ser excluído via método POST.
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            // Validação de dados: verifica se o ID foi enviado.
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
            }
            // Usando prepared statements para evitar injeção de SQL
            $sql = "DELETE FROM tabela_de_gastos  WHERE idpessoa = ?";
            $stmt = mysqli_prepare($conn, $sql);
            // Verifica se a preparação da query foi bem-sucedida.
            if ($stmt) {
                // Vincula o parâmetro ID à query preparada.
                mysqli_stmt_bind_param($stmt, "i", $id);
                // Executa a query preparada.
                if (mysqli_stmt_execute($stmt)) {
                    // Exibe mensagem de sucesso se a exclusão for bem-sucedida.
                    echo "Item excluido com sucesso!! <a href='pesquisa.php' class='btn btn-info'>Voltar </a> ";
                } else {
                    // Exibe mensagem de erro se a exclusão falhar.
                    echo "Erro ao excluir o item: " . mysqli_stmt_error($stmt);
                }
                // Fecha o statement.
                mysqli_stmt_close($stmt);
            } else {
                // Exibe mensagem de erro se a preparação da query falhar.
                echo "Erro na preparação da query: " . mysqli_error($conn);
            }
            // Fecha a conexão com o banco de dados.
            mysqli_close($conn);
            ?>
        </div>
    </div>

    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>