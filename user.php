<?php
    session_start();
    $_SESSION['user_id'];
    if(!isset($_SESSION['user_id'])){
        header("Location: index.php");
        exit();
    }

    require_once("modulos.php");
    $user = selectUpdate($_SESSION['user_id']);
    $email = $user['email'];
    $nome = $user['nome'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Restrita USer</title>
</head>
<style>
    label{
        display: block;
        
    }
    input{
        margin-bottom: 1rem;
    }
</style>
<body>
    <h1>Bem vindo a página Restrita do usuario <?php echo htmlspecialchars($_SESSION['user_name']) ?></h1>
    <p>Somente usuários logados podem ver este conteúdo.</p>
    


    <form action="update.php" method="POST">
        <label for="nome" id="nome"><?= $nome ?></label>
        <input type="text" name="nome">

        <label for="email" id="email"><?= $email ?></label>
        <input type="email" name="email">

        <label for="email" id="senha">Senha</label>
        <input type="password" name="senha">

        <input type="hidden" id="update" value="Update">
        <input type="hidden" name="id" value=<?= $_SESSION['user_id']?>><br>
        <button type="submit">Update</button>
    </form>
    <form action="delete.php" method="POST">
        <input type="hidden" id="delete" value="Deletar">
        <input type="hidden" name="id" value=<?= $_SESSION['user_id']?>>
        <button type="submit">Deletar</button>
    </form>
    <a href="logout.php">Sair</a>
</body>
</html>