<?php

use function PHPSTORM_META\type;

    session_start();
    require_once('modulos.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $tipoUser = selectTypeUser($id);

        if (deleteUser($id)) {
            if($tipoUser === 1){
                $_SESSION['message'] = 'Usuário deletado com sucesso!';
                $_SESSION['message_type'] = 'success';
                header("Location: admin.php");
                exit();
            } else{
                $_SESSION['message'] = 'Usuário deletado com sucesso!';
                $_SESSION['message_type'] = 'success';
                header("Location: index.php");
                exit();
            }

        } else {
            if($tipoUser == 1){
                $_SESSION['message'] = 'Erro ao deletar usuário.';
                $_SESSION['message_type'] = 'error';
                header("Location: admin.php");
                exit();
            } else{
                $_SESSION['message'] = 'Erro ao deletar usuário.';
                $_SESSION['message_type'] = 'error';
                header("Location: user.php");
                exit();
            }
        }
    }