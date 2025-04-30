<?php require_once("includes/topo.php"); ?>

    <?php
    try {
        //validações ????
        $nomeUsuario=$_POST['nome'];
        $emailUsuario=$_POST['email'];
        $senhaUsuario=$_POST['senha'];

        require_once("banco/conexao.php");
        $sql = "insert into tbusuarios (nome,email,senha)
        values('".$nomeUsuario."','".$emailUsuario."','".
        $senhaUsuario."')";
       // echo $sql;
        $conn->exec($sql);
        echo "<p style='color:blue;'>Usuário Salvo com Sucesso!</p>";
    } catch(PDOException $e) {
        echo "<h2 style='color:red;'>Erro: " . $e->getMessage() . 
        "</h2>";
    }
    $conn=null;
    ?>
<?php require_once("includes/rodape.php"); ?>