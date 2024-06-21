<?php
    require_once('modulos.php');
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $id = $_POST['id'];
        $nome = !empty($_POST['nome']) ? $_POST['nome'] : null;
        $email = !empty($_POST['email']) ? $_POST['email'] : null;
        $senha = !empty($_POST['senha']) ? $_POST['senha'] : null;
        $admin = isAdmin($_POST['tipoUser']);
        if (updateUser($id, $email, $senha, $nome)) {
            if($admin){
                echo "Usuário atualizado com sucesso.";
                header('Location: admin.php');
                exit;
            }else{
                echo "Usuário atualizado com sucesso.";
                header('Location: user.php');
            exit;}
        } else {
            echo "Erro ao atualizar o usuário.";
            header('Location: user.php');
            exit;
        }
    }