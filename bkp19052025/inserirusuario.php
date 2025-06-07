<?php 
    require_once("includes/topo.php"); 
    session_start();

    if(isset($_SESSION['tipoUsuario']) && $_SESSION['tipoUsuario']=="Administrador"){
        try {
            unset($_SESSION['erros']);

            // VARIÁVEIS DOS CAMPOS
            $nomeUsuario = '';
            $emailUsuario = '';
            $senhaUsuario = '';

            // VARIÁVEIS DE VALIDAÇÃO
            $validacaoNome = '';
            $validacaoEmail = '';
            $validacaoSenha = '';

            // VALIDAÇÕES DO CAMPO NOME
            if(isset($_POST['nome']) && strlen($_POST['nome']) > 0){
                $nomeUsuario = $_POST['nome'];
            } else {
                $validacaoNome = 'Digite um nome válido';
            }

            // VALIDAÇÕES DO CAMPO DE E-MAIL
            if(isset($_POST['email']) && strlen($_POST['email']) > 0){
                $emailUsuario = $_POST['email'];
            } else {
                $validacaoEmail = 'Digite um e-mail válido';
            }

            // VALIDAÇÕES DO CAMPO DE SENHA
            if(isset($_POST['senha']) && strlen($_POST['senha']) > 0){
                $senhaUsuario = $_POST['senha'];
            } else {
                $validacaoSenha = 'Digite uma senha válida';
            }

            if(strlen($validacaoNome) == 0 &&
                strlen($validacaoEmail) == 0 && 
                strlen($validacaoSenha) == 0
            ){
                require_once("banco/conexao.php");

                // CRIPTOGRAFIA DA SENHA 
                $senhaCriptografada = password_hash($senhaUsuario, PASSWORD_DEFAULT);

                $sql = "insert into tbusuarios (nome, email, senha) values ('{$nomeUsuario}', '{$emailUsuario}', '{$senhaCriptografada}')";
                $conn->exec($sql);

                echo "<script>window.alert('Usuário Salvo com Sucesso!')
                window.location.href='listausuarios.php'</script>";
                echo "<a href='listausuarios.php'>Voltar para a Listagem</a>";

                unset($_SESSION['erros']);
                unset($_SESSION['campos']);
                exit;
            } else {
                $_SESSION['erros'] = [
                    'nome' => $validacaoNome,
                    'email' => $validacaoEmail,
                    'senha' => $validacaoSenha
                ];

                $_SESSION['campos'] = [
                    'nome' => $nomeUsuario,
                    'email' => $emailUsuario,
                    'senha' => $senhaUsuario
                ];

                header('Location: cadastrousuario.php');
            }
        } catch(PDOException $e) {
            echo "<h2 style='color:red;'>Erro: " . $e->getMessage() . 
            "</h2>";
        }
    
        $conn=null;
    } else {
        echo "<h2 style='color:red;'>Você não tem permissão para acessar este conteúdo.</h2>";
    } 

    require_once("includes/rodape.php"); 
?>