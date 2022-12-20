<?php
  include 'acao.php';
  include_once 'conexao.php';

  if(!isset($_SESSION['usuario'])){
    header('location: login.php');
  }

  $id = isset($_POST['id'])?$_POST['id']:0;
  $nome = isset($_POST['nome'])?$_POST['nome']:"";
  $sobrenome = isset($_POST['sobrenome'])?$_POST['sobrenome']:"";
  $email = isset($_POST['email'])?$_POST['email']:"";
  $senha = isset($_POST['senha'])?$_POST['senha']:"";
  $cidade = isset($_POST['cidade'])?$_POST['cidade']:"";

 ?>
<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Estacionamento</title>
    
    <head> 
  
</head>
<body>
<nav class="navbar navbar-dark bg-dark" style="background-color: indigo;">
  <div class="container-fluid">
    <a class="navbar-brand" href="login.php">Logout</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="cad_cliente.php">Cadastro Cliente</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="cad_veiculo.php">Cadastro Veículo</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
    <br>
    <h3 >AQUI VOCÊ PODERÁ VER, CADASTRAR, EDITAR E REMOVER OS VEÍCULOS E CLIENTES.</h3 >
   <br>
    <section>
      <h2>Lista de clientes:</h2>
            <form action="" method="post" id="pesquisa" >
                <input type="text" class="form-control" placeholder="Buscar cliente" name="busca" id="busca">
                <br>
                <button type="submit" class="btn btn-dark" name="buscar" id="buscar">Buscar</button>
            </form>
  </section>
    <br>
  <section>
      <div class="table-responsive">
            <?php    

            try{
                    $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);//cria conexão com banco de dados

                    $busca = isset($_POST['busca'])?$_POST['busca']:"";
                    $query = 'SELECT * FROM cliente';
                    if($busca != ""){
                        $busca =  $busca.'%';
                        $query .= ' WHERE nome LIKE :busca' ;
                    }

                    $stnt = $conexao->prepare($query);
                    if ($busca != "") 
                        $stnt->bindValue(':busca',$busca);

                    $stnt->execute();

                    $clientes = $stnt->fetchAll();
                    echo'<table class="table "table-secondary" table-striped">';
                    echo '<tr><th>id</th><th>Nome</th><th>Sobrenome</th><th>Email</th><th>Senha</th><th>Cidade</th><th>Alterar</th><th>Deletar</th></tr>';
                    foreach($clientes as $cliente){
                        $editar = '<a href=cad_cliente.php?acao=editar&id='.$cliente['id'].'>Alt</a>';
                        $excluir = '<a href=acao.php?acao=c_excluir&id='.$cliente['id'].'>Excluir</a>';
                        echo'<tr><td>'.$cliente['id'].'</td><td>'.$cliente['nome'].'</td><td>'.$cliente['sobrenome'].'</td><td>'.$cliente['email'].'</td><td>'.$cliente['senha'].'</td><td>'.$cliente['cidade'].'</td><td>'.$editar.'</td><td>'.$excluir.'</td>';
                    }
                    echo'</table>';
                    }catch(PDOException $e){
                    print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
                    die();
                 }
                ?>
                </div>
                </div>
    </section>
    <div class="container">
    <section>
      <h2>Lista de veículos:</h2>
            <form action="" method="post" id="pesquisa" >
                <input type="text" class="form-control" placeholder="Buscar veículo" name="busca2" id="busca2"> <br>
                <button type="submit" class="btn btn-dark" name="buscar2" id="buscar2">Buscar</button>


            </form>
  </section> <br>
  <section>
      <div class="table-responsive">
            <?php    

            try{
                    $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);//cria conexão com banco de dados

                    $busca = isset($_POST['busca2'])?$_POST['busca2']:"";
                    $query = 'SELECT * FROM veiculo';
                    if($busca != ""){
                        $busca =  $busca.'%';
                        $query .= ' WHERE modelo LIKE :busca or id LIKE :busca or cor LIKE :busca or placa LIKE :busca' ;
                    }

                    $stnt = $conexao->prepare($query);
                    if ($busca != "") 
                        $stnt->bindValue(':busca',$busca);

                    $stnt->execute();

                    $veiculos = $stnt->fetchAll();
                    echo'<table class="table "table-secondary" table-striped">';
                    echo '<tr><th>id</th><th>Modelo</th><th>Placa</th><th>Cor</th><th>Alterar</th><th>Deletar</th></tr>';
                    foreach($veiculos as $veiculo){
                      $editar = '<a href=cad_veiculo.php?acao=editar&id='.$veiculo['id'].'>Alt</a>';
                      $excluir = '<a href=acao.php?acao=v_excluir&id='.$veiculo['id'].'>Excluir</a>';
                      echo'<tr><td>'.$veiculo['id'].'</td><td>'.$veiculo['modelo'].'</td><td>'.$veiculo['placa'].'</td><td>'.$veiculo['cor'].'</td><td>'.$editar.'</td><td>'.$excluir.'</td>';
                     }
                    echo'</table>';
                    }catch(PDOException $e){
                    print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
                    die();
                 }
                ?>
                </div>
                </div>
    </section>
</body>

<?php

?>
