<?php
include 'acao.php';
include_once 'conexao.php';

?>
<!DOCTYPE html>
<html lang="en">

<head class="simple-linear">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
        
<body class="simple-linear">
    
    <h1>Login</h1>
    <form  action="acao.php" id="log_form" method="post">
        <div class="inputbox">
        <div class="form-floating">
        <input class="form-control" type="text" id="login_nome" name="login_nome"  >
        <label for="login_nome">Usuário</label>

        </div>
        <div class="form-floating">
        <input class="form-control" type="password" id="login_senha" name="login_senha" >
        <label for="login_senha">Senha</label>

        </div>
       
        <button type="submit" class="btn btn-primary" id="log_acao" name='log_acao' value='logar' >Enviar</button> 
        <a href="cad_login.php" class="btn btn-primary">Registrar</a>
        </div>
    </form>

</body>


<script>
    /*
    form.addEventListener('submit' , (e) =>{
        e.preventDefault();

        checar();
    })

function checar (){
    var login_nome = document.getElementById('login_nome').value;
    var login_senha = document.getElementById('login_senha').value;



if(login_nome == "" || login_nome < 3){
       alert("Nome inválido!")
       return false
    }else{
        document.getElementById("sem_nome").innerHTML = "";
    }
}

    const form = document.GetElementById['log_form'];
    const campos = document.QuerySelectorAll('.requiered');
    const spans = document.QuerySelectorAll(".span-required");

    function erro(index){
        campos[index].style.border ='2px sodid red';
        spans[index].style.display = 'block';

    }

    function acerto(index){
        campo[index].style.border ='2px sodid green';
    }

    function validanome(){
        if(campos[0].value.lenght < 3){
            echo("oi");
            erro(0);
        }else{
            acerto(0);
        }
    }

    function validasenha(){
        if(campos[1].value.lenght < 8){
            erro(1);
        }else{
            acerto(1);
        }
    }
*/

</script>
