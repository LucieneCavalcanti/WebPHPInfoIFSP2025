<?php 
    require_once("includes/topo.php"); 
    session_start();
    if(isset($_SESSION['tipoUsuario']) && $_SESSION['tipoUsuario'] == "Administrador"){
?>
    <form name="cadastro" action="inserirusuario.php" method="post">
        <!-- CONTAINER -->
        <div class="container"> 
            <!-- TITULO -->
            <h2>Cadastro de Usuários</h2>

            <!-- LINHA -->
            <div class="row mb-2">
                <!-- PRIMEIRA COLUNA -->
                <div class="col-3">
                    <!-- PRIMEIRO GRUPO DE INPUT -->
                    <div class="form-group">
                        <!-- LABEL -->
                        <label class="form-label" for="nome">Digite seu nome:</label>
                        <!-- INPUT NOME -->
                        <input class="form-control <?php echo strlen(@$_SESSION['erros']['nome']) ? 'is-invalid' : ''; ?>" type="text" name="nome" id="nome" value="<?php echo @$_SESSION['campos']['nome']; ?>" placeholder="Digite seu nome aqui" maxlength="200">
                        <!-- SPAN DO NOME -->
                        <span class="invalid-feedback"><?php echo @$_SESSION['erros']['nome']; ?></span>
                    </div>
                </div>

                <!-- SEGUNDA COLUNA -->
                <div class="col-3">
                    <!-- SEGUNDO GRUPO DE INPUT -->
                    <div class="form-group">
                        <!-- LABEL -->
                        <label class="form-label" for="email">Digite seu email:</label>
                        <!-- INPUT DO EMAIL -->
                        <input class="form-control <?php echo strlen(@$_SESSION['erros']['email']) ? 'is-invalid' : ''; ?>" type="email" name="email" id="email" value="<?php echo @$_SESSION['campos']['email']; ?>" placeholder="Digite seu email aqui" maxlength="200">
                        <!-- SPAN DO EMAIL -->
                        <span class="invalid-feedback" id="vemail"><?php echo @$_SESSION['erros']['email']; ?></span>
                    </div>
                </div>

                <!-- TERCEIRA COLUNA -->
                <div class="col-3">
                    <!-- TERCEIRO GRUPO DE INPUT -->
                    <div class="form-group">
                        <!-- LABEL -->
                        <label class="form-label" for="senha">Digite sua senha:</label>
                        <!-- INPUT DE SENHA -->
                        <input class="form-control <?php echo strlen(@$_SESSION['erros']['senha']) ? 'is-invalid' : ''; ?>" type="password" name="senha" id="senha" value="<?php echo @$_SESSION['campos']['senha']; ?>" placeholder="Digite sua senha aqui" maxlength="20">
                        <!-- SPAN DE SENHA -->
                        <span class="invalid-feedback" id="vsenha"><?php echo @$_SESSION['erros']['senha']; ?></span>
                    </div>
                </div>
            </div>

            <input class="btn btn-primary" type="submit" value="Cadastrar">
            <input class="btn btn-outline-primary" type="reset" value="Limpar">
        </div>
    </form>
    <?php     
    }
    else {
        echo "<h2 style='color:red;'>Você não tem permissão para acessar este conteúdo.</h2>";
    } 

    unset($_SESSION['erros']);
    unset($_SESSION['campos']);
    require_once("includes/rodape.php"); 
    ?>