<?php

include("../../system/sy-conexao.php");

if (!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['usuario_id'])){
    header('Location: ../../login');
    exit;
}

$userSenha = $_POST['password'];
$userSenha2 = $_POST['confirmPassword'];

if ($userSenha==$userSenha2){
    $novaSenha =  crypt($userSenha);

    $query = "UPDATE `nc_users` set user_password=? where user_id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('si', $novaSenha,$_SESSION['usuario_id']);
    $stmt->execute();

    if ($stmt->affected_rows==1){
        echo "<script> location.href='../perfil?ok=2';</script>";
    }else{
        if ($stmt->affected_rows==0){
            echo "<script> location.href='../perfil?ok=2';</script>";
        }else{ 
            echo "<script> location.href='../perfil?ok=3';</script>";
        }
    }
}else{
    echo "<script> location.href='../perfil?ok=4';</script>";
}


?>