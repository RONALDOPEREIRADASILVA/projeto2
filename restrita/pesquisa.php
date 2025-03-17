<!doctype html>
<html lang="pt-br">

<head>
    <title>Pesquisa</title>
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
    <link rel="stylesheet" href="style2.css">

</head>

<body>
    <header>

    </header>
    <?php
    // Inclui a biblioteca BcMath para operações matemáticas de precisão arbitrária
    use BcMath\Number;
    // Obtém o termo de pesquisa do formulário via método POST, se existir, senão define como vazio.

    $pesquisa = $_POST['busca'] ?? '';
    // Inclui o arquivo de conexão com o banco de dados.
    include "conecxao.php";
    //Monta a query SQL para selecionar os dados da tabela de gastos que correspondem ao termo de pesquisa.
    $sql = "SELECT * FROM tabela_de_gastos WHERE nome LIKE'%$pesquisa%' ";
    // Executa a query SQL no banco de dados e armazena o resultado.
    $dados = mysqli_query($conn, $sql);
    // Inicializa a variável para armazenar o total dos valores.
    $total = 0;
    ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Pesquisar</h1>
                <nav class="navbar navbar-light">
                    <form class="form-inline" action="pesquisa.php" method="post">
                        <input class="forme-control mr-sm-2" type="search" placeholder="search" aria-label="search" name="busca" autofocus>
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">pesquisar</button>
                    </form>
                </nav>

                <table class="table table-hover">
                    ...<table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Foto</th>
                                <th scope="col">Idpessoa</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Tipogasto</th>
                                <th scope="col">Data</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Finches</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop para percorrer os resultados da query e exibir os dados na tabela.
                            while ($linha = mysqli_fetch_assoc($dados)) {
                                $idpessoa = $linha['idpessoa'];
                                $nome = $linha['nome'];
                                $tipogastos = $linha['tipogastos'];
                                $data = $linha['data'];
                                $valor = $linha['valor'];
                                $foto = $linha['foto'];
                                // Define o valor padrão para a classe da foto.
                                $lista_foto = "minha_classe_padrao";
                                // Verifica se a foto existe e exibe a imagem ou um espaço em branco.
                                if (!$foto == null) {
                                    $mostra_foto = "<img src='img/$foto' class='$lista_foto'>";
                                } else {
                                    $mostra_foto = '';
                                }
                                // Exibe os dados da linha em uma linha da tabela.
                                echo "
                                  <tr> 
                                       <th>$mostra_foto</th>
                                      <th>$idpessoa</th>
                                      <td>$nome</td>
                                      <td>$tipogastos</td>
                                      <td>$data</td>
                                       <td>$valor</td>
                                      <td width=150px>
                                        <a href='cadastro_edit.php?id=$idpessoa' class='btn btn-success btn-sm'>Editar<a/>
                                         <a href='excluir_script.php'class='btn btn-danger btn-sm'data-bs-toggle='modal' data-bs-target='#confirma' onclick=" . '"' . "pegar_dados($idpessoa, '$nome')" . '"' . ">Excluir<a/>
                                      </td>
                                  </tr>";
                                $total += $valor;
                                //Acumula o valor na variável $total
                            };
                            ?>
                        </tbody>
                    </table>
                    <p>Total: <?php echo number_format($total, 2, ',', '.'); ?>
                    </p>
                </table>
                <a href="index.php" class="btn btn-info">Voltar Para o Início</a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmação de exclusão</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="excluir_script.php" method="POST">
                        <p>Deseja realmente excluir<b id="nome_pessoa">Nome da pessoa</b> ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                    <input type="hidden" name="nome" id="nome_pessoa_1" value="">
                    <input type="hidden" name="id" id="idpessoa" value="">
                    <input type="submit" class="btn btn-danger" value="Sim">
                    </form>
                </div>
            </div>
            <script type="text/javascript">
                // Função JavaScript para preencher os dados do modal de confirmação de exclusão.
                function pegar_dados(id, nome) {
                    document.getElementById('nome_pessoa').innerHTML = nome;
                    document.getElementById('nome_pessoa_1').value = nome;
                    document.getElementById('idpessoa').value = id;
                }
            </script>

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