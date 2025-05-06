<?php
    require_once("banco/conexao.php");
    require_once("includes/topo.php");
    try{
        if(isset($_POST['email']) && isset($_POST['senha'])){
            $email = $_POST['email']; //pega o email
            $senha = $_POST['senha'];
            $select = $conn->prepare("select * from tbusuarios where email=:email
            and senha=:senha");
            // Define o parâmetro
            $select->bindParam(":email", $email, PDO::PARAM_STR);
            $select->bindParam(":senha", $senha, PDO::PARAM_STR);
            $select->execute();

            $usuarios = $select->fetchAll(PDO::FETCH_ASSOC); //pegar o registro
            if(count($usuarios)==1) { //encontrou o usuario 
                //echo $usuarios[0]['id']; //mostrando na tela o id do usuário
                //logica do login
                if($usuarios[0]['status']==1)
                    echo "<p>Seu login está inativo, entre em contato com o administrador.</p>";
                if($usuarios[0]['status']==2){
                    session_start();
                    $_SESSION['idUsuario']= $usuarios[0]['id'];
                    $_SESSION['nomeUsuario']= $usuarios[0]['nome'];
                    //usuário ativo
                    if($usuarios[0]['tipo']=="Comum"){
                        $_SESSION['tipoUsuario'] = "Comum";
                        echo "<p style='color:blue;'>Seja bem vindo(a) " . $usuarios[0]['nome'] . "</p>"; //mostrando na tela o nome do usuário
                        echo "<p>Seu nível de usuário é Comum.</p>";
                        echo "<p><a href='perfil.php'>Perfil</a></p>";
                        echo "<p><a href='sair.php'>Sair</a></p>";
                    }
                    if($usuarios[0]['tipo']=="Administrador"){
                        $_SESSION['tipoUsuario']="Administrador";
                        echo "<p style='color:pink;'>Seja bem vindo(a) " . $usuarios[0]['nome'] . "</p>"; //mostrando na tela o nome do usuário
                        echo "<p><a href='perfil.php'>Perfil</a></p>";
                        echo "<p><a href='listausuarios.php'>Usuários</a></p>";
                        echo "<p><a href='listaprodutos.php'>Produtos</a></p>";
                        echo "<p><a href='sair.php'>Sair</a></p>";
                    }
                }
            }else {
                echo "<h2>Usuário ou senha inválidos!</h2>";
                echo "<p>Faça <a href='login.php'>login</a> novamente.";
            }
        }else{
            echo "<script>window.alert('Digite seu e-mail e senha!')
                window.location.href='login.php'</script>";
        }
    } catch(PDOException $e) {
        echo "<h2 style='color:red;'>Erro: " . $e->getMessage() . "</h2>";
    }
?>



<?php require_once("includes/rodape.php"); ?>