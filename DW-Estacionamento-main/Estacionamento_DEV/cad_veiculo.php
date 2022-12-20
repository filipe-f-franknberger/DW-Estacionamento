<?php
    include 'acao.php';
    include_once 'conexao.php';

    $acao = isset($_GET['acao'])?$_GET['acao']:"";
    $id = isset($_GET['id'])?$_GET['id']:"";

    if ($acao == 'editar'){
        //busca dados do usuario
        try{
            $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);//cria conexão com banco de dados
            $query = 'SELECT * FROM veiculo WHERE id = :id';
           
            // Monta consulta
            $stmt = $conexao->prepare($query);

            //Vincula váriaveis com a consulta
            $stmt->bindValue(':id',$id);
            $stmt->execute();
            $veiculo = $stmt->fetch();

    }catch(PDOException $e){
        print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Cadastro</title>
    <script>
        function excluir(url){
            if(confirm("Confirmar Exclusão?"))
                window.location.href=url;
        }
    </script>

</head>
<body class="simple-linear">
    <h1>Cadastrar Veículo</h1> <a href="clindex.php"><button type="button" class="btn btn-primary">Voltar</button></a>
    <form action="acao.php" method="post">
        <div class="form-floating">
        <input type="text" class="form-control" id="car_id" name="car_id"placeholder="ID" value=<?php if (isset($veiculo)) echo $veiculo['id']; else echo 0; ?>>
        <label for="car_id">ID</label>
        </div>
        <div class="form-floating">
        <input class="form-control" type="text" id="modelo" name="modelo"value=<?php if(isset($veiculo))echo $veiculo['modelo'] ?>>
        <label for="modelo">Modelo</label>
        </div>
        <div class="form-floating">
        <input class="form-control" type="text" id="placa" name="placa" value=<?php if (isset($veiculo)) echo $veiculo['placa'] ?>>
        <label for="placa">Placa</label>
        </div>
        <div class="form-floating">
        <input class="form-control" type="text" id="cor" name="cor" value=<?php if (isset($veiculo))echo $veiculo['cor'] ?>>
        <label for="cor">Cor</label>
        </div>
       
        <button type="submit" class="btn btn-primary" name='car_acao' value='salvar'>Enviar</button>
    </form>



</body>
</html>
