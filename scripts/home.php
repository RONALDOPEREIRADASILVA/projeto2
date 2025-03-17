<?php
// Inclui o arquivo de navegação (navbar).
require_once __DIR__ . '/../inc/navbar.php';
?>

<body onload="carregar()">
    <div class="container mt-5 p-4 border rounded-3 shadow-sm bg-light" >
        <div id="msg">Aqui vai aparecer a mensagem</div>
        <div id="foto">
            <img id="imagem" src="fotomanhã.png" alt="foto do dia">
        </div>
    </div>
</body>
<script>
    function carregar() {
         // Obtém os elementos HTML para exibir a mensagem e a imagem.
        var msg = window.document.getElementById('msg')
        var img = window.document.getElementById('imagem')
          // Obtém a hora atual.
        var data = new Date()
        var hora = data.getHours()
        // Exibe a hora atual na mensagem.
        msg.innerHTML = `Agora São ${hora} horas.`
          // Verifica a hora do dia e define a mensagem, a imagem e a cor de fundo de acordo.
        if (hora >= 0 && hora < 12) {
            //BOM DIA!
            msg.innerHTML = 'Bom Dia'
            img.src = 'fotomanhã.png'
            document.body.style.background = '#E6E100'
        } else if (hora >= 12 && hora <= 18) {
            //'BOA TARDE!
            msg.innerHTML = 'Boa Tarde'
            img.src = 'fototarde.png'
            document.body.style.background = '#AD005B'
        } else {
            //'BOA NOITE!'
            msg.innerText = 'Boa Noite!'
            img.src = 'fotonoite.png'
            document.body.style.background = '#7D7D7D'
        }
    }
</script>