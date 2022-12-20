<?php
    session_start();
    include_once "conexao.php";
   

//login
    $log_acao= isset($_POST['log_acao'])?$_POST['log_acao']:"";
    $login_nome= isset($_POST['login_nome'])?$_POST['login_nome']:"";
    $login_senha= isset($_POST['login_senha'])?$_POST['login_senha']:"";

    if($log_acao == 'logar'){
        if($login_nome != "" && $login_senha != ""){
            $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);//cria conexão com banco de dados
            $query = "SELECT * FROM usuario
                    WHERE nome = :nome AND senha = :senha";
        }
            $stmt = $conexao->prepare($query);
            $stmt ->bindValue(':nome', $login_nome);
            $stmt ->bindValue(':senha', $login_senha);
    
            if($stmt->execute()){
                $usuario = $stmt->fetch();
                if($usuario){
                    $_SESSION['usuario'] = $usuario['nome'];
                    $_SESSION['id_usuario'] = $usuario['id'];
                    echo $_SESSION['usuario'];
                    header('location: clindex.php');
                }else{
                    header('location: login.php');
                }
            }                          
        
    }else if ($log_acao =='registrar'){
        $log_acao= isset($_POST['log_acao'])?$_POST['log_acao']:"";
        $cad_id= isset($_POST['cad_id'])?$_POST['cad_id']:"";
        $cad_nome= isset($_POST['cad_nome'])?$_POST['cad_nome']:"";
        $cad_email= isset($_POST['cad_email'])?$_POST['cad_email']:"";
        $cad_senha= isset($_POST['cad_senha'])?$_POST['cad_senha']:"";

        try{
            $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);//cria conexão com banco de dados

            // Monta a consulta
            $query = 'INSERT INTO usuario(nome, email, senha) VALUES (:nome, :email, :senha)';

            $stmt = $conexao->prepare($query);
            if($id != 0)
            $stmt->bindValue(':id', $cad_id);

            $stmt->bindValue(':nome', $cad_nome);
            $stmt->bindValue(':email', $cad_email);
            $stmt->bindValue(':senha', $cad_senha);

            $stmt->execute();
            header('location: login.php');

        }catch(PDOException $e){
            print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
            die();
        }

    }
    

//veículo


    $car_id = isset($_GET['car_id'])?$_GET['car_id']:0;
    $modelo = isset($_POST['modelo'])?$_POST['modelo']:"";
    $placa = isset($_POST['placa'])?$_POST['placa']:"";
    $cor = isset($_POST['cor'])?$_POST['senha']:"";

    $v_id = isset($_GET['v_id'])?$_GET['v_id']:0;
    $v_acao = isset($_GET['v_acao'])?$_GET['v_acao']:"";

    if($v_acao =='excluir'){
        echo("oi kk");
        try{
            $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);//cria conexão com banco de dados
 
            $query = 'DELETE FROM veiculo WHERE id = :id';
    
            $stnt = $conexao->prepare($query);
    
            $stnt->bindValue(':id', $v_id);

            if($stnt->execute()){
   
            }


    
        }catch(PDOException $e){
            print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
            die();
        }

    } else if(isset($_POST['placa'])&&(isset($_POST['modelo']))){
        $id = isset($_POST['car_id'])?$_POST['car_id']:0;
        $modelo = isset($_POST['modelo'])?$_POST['modelo']:"";
        $placa = isset($_POST['placa'])?$_POST['placa']:"";
        $cor = isset($_POST['cor'])?$_POST['cor']:"";
     

        try{
            $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);//cria conexão com banco de dados

            // Monta a consulta
            if($id > 0)
                $query = "UPDATE veiculo SET modelo = :modelo, placa = :placa, cor = :cor
                WHERE id = :id";
            
            else
            $query = 'INSERT INTO veiculo(modelo, placa, cor) VALUES (:modelo, :placa, :cor)';

            $stmt = $conexao->prepare($query);
            if($id != 0)
            $stmt->bindValue(':id', $id);

            $stmt->bindValue(':modelo', $modelo);
            $stmt->bindValue(':placa', $placa);
            $stmt->bindValue(':cor', $cor);

            $stmt->execute();
            header('location: clindex.php');

        }catch(PDOException $e){
            print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
            die();
        }
    }

    //cliente
    $cli_acao= isset($_POST['cli_acao'])?$_POST['cli_acao']:"";

    $id = isset($_GET['id'])?$_GET['id']:0;
    $nome = isset($_POST['nome'])?$_POST['nome']:"";
    $sobrenome = isset($_POST['sobrenome'])?$_POST['sobrenome']:"";
    $email = isset($_POST['email'])?$_POST['email']:"";
    $senha = isset($_POST['senha'])?$_POST['senha']:"";
    $cidade = isset($_POST['cidade'])?$_POST['cidade']:"";

    if($cli_acao =='excluir'){
        try{
            $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);//cria conexão com banco de dados
 
            $query = 'DELETE FROM cliente WHERE id = :id';
    
            $stnt = $conexao->prepare($query);
    
            $stnt->bindValue(':id', $id);

            if($stnt->execute())
                header('location: clindex.php');
    
        }catch(PDOException $e){
            print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
            die();
        }

    } else if(isset($_POST['nome'])&&(isset($_POST['email']))){
        $id = isset($_POST['id'])?$_POST['id']:0;
        $nome = isset($_POST['nome'])?$_POST['nome']:"";
        $sobrenome = isset($_POST['sobrenome'])?$_POST['sobrenome']:"";
        $email = isset($_POST['email'])?$_POST['email']:"";
        $senha = isset($_POST['senha'])?$_POST['senha']:"";
        $cidade = isset($_POST['cidade'])?$_POST['cidade']:"";

        try{
            $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);//cria conexão com banco de dados

            // Monta a consulta
            if($id > 0)
                $query = "UPDATE cliente SET nome = :nome, sobrenome = :sobrenome, email = :email, senha = :senha, cidade = :cidade 
                WHERE id = :id";
            
            else
            $query = 'INSERT INTO cliente(nome, sobrenome,  email, senha, cidade) VALUES (:nome, :sobrenome, :email, :senha, :cidade)';

            $stmt = $conexao->prepare($query);
            if($id != 0)
            $stmt->bindValue(':id', $id);

            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':sobrenome', $sobrenome);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':senha', $senha);
            $stmt->bindValue(':cidade', $cidade);

            $stmt->execute();
            header('location: clindex.php');

            

        }catch(PDOException $e){
            print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
            die();
        }
    }

?>