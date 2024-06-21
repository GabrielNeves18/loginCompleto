<?php
    session_start();
    require_once('modulos.php');
    


    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $error = '';
        $success = '';

        //Verifica as possiveis falhas que pode existir
        if ($nome === '' || $email === '' || $pass === '') {
            if ($nome === '' && $email === '' && $pass === '') {
                $error = 'Nome, email e senha são obrigatórios';
            } elseif ($nome === '' && $email === '') {
                $error = 'Nome e email são obrigatórios';
            } elseif ($nome === '' && $pass === '') {
                $error = 'Nome e senha são obrigatórios';
            } elseif ($email === '' && $pass === '') {
                $error = 'Email e senha são obrigatórios';
            } elseif ($nome === '') {
                $error = 'Nome é obrigatório';
            } elseif ($email === '') {
                $error = 'Email é obrigatório';
            } elseif ($pass === '') {
                $error = 'Senha é obrigatória';
            }
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $nome)) {
            $error = 'O nome deve conter somente letras ou espaços em branco';
        } else {
            // Aqui você pode inserir o usuário no banco de dados ou realizar outra ação de sucesso
            insertUser($nome, $email, password_hash($pass, PASSWORD_DEFAULT), $admin=0);
            $success = 'Enviado com sucesso';
        }

        if($error){
            $_SESSION['error'] = $error;
            header("Location: index.php"); // Mensagem de erro
            exit();
        } else {
            $_SESSION['success'] = $success;
            header("Location: index.php");
            exit();
        }
    }
    
?>