<?php

error_reporting(0);
ini_set(“display_errors”, 0 );

session_start();

include("system/sy-conexao.php");
ini_set('default_charset','UTF-8');

if (isset($_GET['success'])){
    $cadastrado=$_GET['success'];
}else{
    $cadastrado=0;
}

if (isset($_GET['erro'])){
    $erro=$_GET['erro'];
}else{
    $erro=0;
}

if (!isset($_SESSION)){
    session_start();
}else{
    if (isset($_SESSION['usuario_id'])){
        $query = "SELECT * FROM nc_users WHERE user_id=? ";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $_SESSION['usuario_id']);
        $stmt->execute();
        
        if ($stmt->fetch()){
            echo "<script>location.href='painel/inicio';</script>";
        }else{
            session_destroy();
            header('location:login.php');
        }
        
    }

}
?>

<!DOCTYPE HTML>
<html lang="pt-br">

<head>

    <?php include("layout/header.php");?>

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-0 col-sm-6 col-md-4 col-lg-4 col-xs-12">
                <div class="login-panel panel panel-default">
                    <div class="panel-body">
                    <div align="center">
                        <h3>Conecte-se</h3>
                    </div>
                    <br>
                    <div align="center">
                        <img src="img/icone.png">
                    </div>
                    
                    <?php
                        if (isset($erro)){
                            if ($erro==1){
                                echo "
                                <br>
                                <div class='alert alert-danger alert-dismissable'>
                                    Usuário ou senha inválidos!
                                </div>


                                ";
                                $erro=0;
                            }else{
                                if ($cadastrado==1){
                                    echo "
                                    <br>
                                    <div class='alert alert-success alert-dismissable'>
                                        Você foi cadastrado com sucesso!
                                    </div>  

                                    ";
                                    $cadastrado=0;
                                    } 
                            } 
                            
                        }

                        
                    ?>
                        <form action="system/sy-login.php" method="POST" role="form" id="loginSap">
                            <input type="hidden" name="sent" />
                            <fieldset>
                                <br>
                                <div class="form-group">
                                    <div class="input-group col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                        <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-user"></i>
                                        </span>
                                        <input type="email" value="" name="email" class="form-control" placeholder="Email" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                        <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-lock"></i>
                                        </span>
                                        <input type="password" value="" name="senha" class="form-control" placeholder="Senha" required/>
                                    </div>
                                </div>
                                <div class="form-group" align="center">
                                    <div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
                                    </div>
                                    <div class="col-sm-8 col-md-8 col-lg-8 col-xs-8">
                                        <div class=>
                                            <button type="submit" class="btn btn-success btn-block">Entrar</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12" align="center">
                                    <p>
                                        <a href="recuperarSenha">Esqueci minha senha</a>
                                    </p>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include("layout/foot.php");?>

</body>

</html>