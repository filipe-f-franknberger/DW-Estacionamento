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


  if ($cli_acao == 'editar'){
    //busca dados do usuario
    echo("edit main");
    try{
        $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);//cria conexão com banco de dados
        $query = 'SELECT * FROM cliente 
        WHERE id = :id ';

        // Monta consulta
        $stmt = $conexao->prepare($query);

        //Vincula váriaveis com a consulta
        $stmt->bindValue(':id',$id);
  
        $stmt->execute();
        $usuario = $stmt->fetch();

}catch(PDOException $e){
    print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
    die();
}
}
/*
$car_id = isset($_POST['car_id'])?$_POST['car_id']:0;

if ($car_acao == 'editar'){
  //busca dados do usuario
  echo("edit main");
  try{
      $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);//cria conexão com banco de dados
      $query = 'SELECT * FROM veiculo WHERE id = :id';

      // Monta consulta
      $stmt = $conexao->prepare($query);

      //Vincula váriaveis com a consulta
      $stmt->bindValue(':id',$car_id);
      $stmt->execute();
      $usuario = $stmt->fetch();

}catch(PDOException $e){
  print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
  die();
}

}*/


 ?>
<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Estacionamento</title>
    
    <head> 
    <h1></h1>
    <h5>      Seja bem-vindo(a) <a href="login.php"><a href="login.php"><button type="button" class="btn btn-primary">Logout</button></a>
    </h5>

    AQUI VOCÊ PODERÁ VER, CADASTRAR, EDITAR E REMOVER OS CARROS E CLIENTES.

   <br>
    <a href="cad_veiculo.php"><button type="button" class="btn btn-primary">Cadastro veículo</button></a>
    <a href="cad_cliente.php"><button type="button" class="btn btn-primary">Cadastro cliente</button></a>
    <br>

</head>
<body>
<section>
            <form action="" method="post" id="pesquisa" >
                <input type="text" name="busca" id="busca">
                <button type="submit" name="buscar" id="buscar">Buscar</button>

            </form>
  </section>
  <section>
      <h2>Lista de clientes:</h2>
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
                    echo'<table class="table">';
                    echo '<tr><th>id</th><th>Nome</th><th>Sobrenome</th><th>Email</th><th>Senha</th><th>Cidade</th></tr>';
                    foreach($clientes as $cliente){
                        $editar = '<a href=cad_cliente.php?acao=editar&id='.$cliente['id'].'>Alt</a>';
                        $excluir = "<a href='#' onclick=excluir('acao.php?acao=excluir&id={$cliente['id']}')>Excluir</a>";
                        echo'<tr><td>'.$cliente['id'].'</td><td>'.$cliente['nome'].'</td><td>'.$cliente['sobrenome'].'</td><td>'.$cliente['email'].'</td><td>'.$cliente['senha'].'</td><td>'.$cliente['cidade'].'</td><td>'.$editar.'</td><td>'.$excluir.'</td>';
                    }
                    echo'</table>';
                    }catch(PDOException $e){
                    print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
                    die();
                 }
                ?>
    </section>

    <section>
            <form action="" method="post" id="pesquisa" >
                <input type="text" name="busca2" id="busca2">
                <button type="submit" name="buscar2" id="buscar2">Buscar</button>

            </form>
  </section>
  <section>
      <h2>Lista de veículos:</h2>
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
                    echo'<table class="table">';
                    echo '<tr><th>id</th><th>Modelo</th><th>Placa</th><th>Cor</th></tr>';
                    foreach($veiculos as $veiculo){
                      $editar = '<a href=cad_veiculo.php?acao=editar&id='.$veiculo['id'].'>Alt</a>';
                      $excluir = "<a href='#' onclick=excluir('acao.php?acao=excluir&id={$veiculo['id']}')>Excluir</a>";
                      echo'<tr><td>'.$veiculo['id'].'</td><td>'.$veiculo['modelo'].'</td><td>'.$veiculo['placa'].'</td><td>'.$veiculo['cor'].'</td><td>'.$editar.'</td><td>'.$excluir.'</td>';
                     }
                    echo'</table>';
                    }catch(PDOException $e){
                    print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
                    die();
                 }
                ?>
    </section>
</body>

<?php

?>
