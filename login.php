<?php

    session_start();
    require_once('modulos.php');
        
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $email = $_POST['emailLogin'];
        $pass = $_POST['passwordLogin'];

        $user = selectUser($email, $pass);

        if($user && $user['admin'] !== 1){
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['user_name'] = $user['nome'];
            $_SESSION['login_success'] = 'Login realizado com sucesso!';
            header('Location: user.php');
            exit();
        } elseif($user && $user['admin'] === 1){
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['user_name'] = $user['nome'];
            $_SESSION['login_success'] = 'Login realizado com sucesso!';
            header('Location: admin.php');
        }else{
            $_SESSION['login_error'] = 'Email ou senha inválidos.';
            header('Location: index.php');
            exit();
        }
    }