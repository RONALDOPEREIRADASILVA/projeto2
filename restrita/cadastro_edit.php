

<!doctype html>
<html lang="pt-br">

<head>
    <title>Alteração de cadastro Cadastro</title>
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
    <?php
    include "conecxao.php";
    $id = $_GET['id'] ?? '';
    $sql ="SELECT *FROM tabela_de_gastos WHERE idpessoa=$id";
    $dados = mysqli_query($conn, $sql);
    $linha = mysqli_fetch_assoc($dados);

    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Cadastro</h1>
                <form action="edit_script.php" method="POST"> <!--Formulario de cadastro-->
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" required value="<?php echo $linha['nome']; ?>">
                    </div>
                    <div class="form group">
                        <label for="tipogastos">Tipos de Gastos</label>
                        <input type="text" class="form-control" name="tipogastos" id="tipogastos" value="<?php echo $linha['tipogastos']; ?>">
                    </div>
                    <div class="form group">
                        <label for="data">Data</label>
                        <input type="date" class="form-control" name="data" id="data" value="<?php echo $linha['data']; ?>">
                    </div>
                    <div class="form group">
                        <label for="valor">Valor</label>
                        <input type="text" class="form-control" name="valor" id="valor" value="<?php echo $linha ['valor']; ?>">
                    </div>

                    <div class="form group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control" name="foto" id="foto" accept="image/*" value="<?php echo $linha ['foto'];?> ">
                    </div>
                    
                    <input type="submit" class="btn btn-success" value="Salvar Alterações"> <!--Botão de subimição-->
                   <input type="hidden" name="id" value="<?php echo $linha['idpessoa']?>">
                </form>
                <a href ="index.php" class='btn btn-info'>Voltar Para o Início</a>
            </div>
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