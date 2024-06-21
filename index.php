<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
    <form action="cadastro.php" method="POST">
        <h1>Cadastro</h1>
        <?php 
            if(isset($_SESSION['error'])){
                echo '<p style="color:red;">' . htmlspecialchars($_SESSION['error']) . '</p>';
                unset($_SESSION['error']);
            } elseif(isset($_SESSION['success'])){
                echo '<p style="color:green;">' . htmlspecialchars($_SESSION['success']) . '</p>';
                unset($_SESSION['success']);
            } // mensagem de erro ou acerto
        ?>
        <input type="text" id="nome" name="nome" placeholder="nome">
        <input type="email" id="email" name="email" placeholder="email">
        <input type="password" name="password" id="password" placeholder="senha">

        <button type="submit">Cadastrar</button>
    </form>
    <h2>LOGIN</h2>
    <form action="login.php" method="POST">
        <?php
            if(isset($_SESSION['login_error'])){
                echo '<p style="color:red;">' . htmlspecialchars($_SESSION['login_error']) . '</p>';
                unset($_SESSION['login_error']);
            } elseif (isset($_SESSION['success'])){
                echo '<p style="color:green;">' . htmlspecialchars($_SESSION['login_success']) . '</p>';
                unset($_SESSION['login_success']);
            }
        ?>
        <input type="email" id="emailLogin" name="emailLogin" placeholder="email">
        <input type="password" name="passwordLogin" id="passwordLogin" placeholder="senha">
        <button type="submit">Entrar</button>
    </form>

</body>
</html>