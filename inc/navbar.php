<nav class="container mt-5 p-4 border rounded-3 shadow-sm bg-light">
    <div class="row align-items-center">
        <div class="col">
            <h4>Aplicação de contole de gastos</h4>

        </div>
        <div class="col text-center">
    
            <a href="../restrita/index.php">Pagina de area caadastro</a>
            <span class="mx-2"> </span>
        </div>
        <div class="col text-end">
            <span><strong><?=$_SESSION['usuario']->usuario ?></strong></span>
            <span class="mx-2"></span>
            <a href="?rota=logout">Sair</a>
        </div>

    </div>

</nav>