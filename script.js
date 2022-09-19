function carregar(){
    var msg = window.document.getElementById('msg')
    var img = window.document.getElementById('imagem')
    var data = new Date()
    var hora = data.getHours()
    msg.innerHTML =`Agora São ${hora} horas.`
    if (hora >= 0 && hora< 12){
        //BOM DIA!
        msg.innerHTML='Bom Dia'
        img.src ='fotomanhã.png'
        document.body.style.background='#E6E100'
    }else if(hora >= 12 && hora <=18){
        //'BOA TARDE!
        msg.innerHTML='Boa Tarde'
        img.src = 'fototarde.png'
        document.body.style.background='#AD005B'
    }else{
        //'BOA NOITE!'
        msg.innerText='Boa Noite!'
        img.src ='fotonoite.png'
        document.body.style.background='#7D7D7D'
    }
}