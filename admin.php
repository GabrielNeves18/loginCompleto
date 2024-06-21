<?php
    session_start();
    require_once('buscaAdmin.php');
   
    $_SESSION['user_id'];
    if(!isset($_SESSION['user_id'])){
        header("Location: index.php");
        exit();
    }
    

    if (!isAdmin($_SESSION['user_id'])) {
        $_SESSION['message'] = "Acesso negado. Apenas administradores podem acessar esta página.";
        $_SESSION['message_type'] = "error";
        header("Location: user.php");
        exit();
    }


?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Restrita Admin</title>

    <style>
        .btns{
            display: flex;
            margin-top: 1rem;
        }

        form{
            margin-right: 1rem;
        }
    </style>
</head>
<body>
    <h1>Bem vindo a página Restrita do Admin <?php echo htmlspecialchars($_SESSION['user_name']) ?></h1>
    <p>Somente usuários administradores logados podem ver este conteúdo.</p>
    <?php
    if(isset($_SESSION['message'])) {
        $messageType = $_SESSION['message_type'] === 'success' ? 'color:green;' : 'color:red;';
        echo '<p style="' . $messageType . '">' . htmlspecialchars($_SESSION['message']) . '</p>';
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }
    ?>
    <ul>
        <h2>Lista de usuários</h2>
        <?php foreach($users as $user) :?>
            <?php $admin = (htmlspecialchars($user['admin']) === '1' )? 'Administrador': "Usuário"?>
            <li><?= 'Nome: ' . htmlspecialchars($user['nome'] . ' - email: ' . htmlspecialchars($user['email']) . ' - id: ' . htmlspecialchars($user['id']) . ' - Privilégio: ' . $admin)?>
            <br><br>
            <form action="update.php" method="POST">
                <label for="nome" id="nome"><?= htmlspecialchars($user['nome'])?></label>
                <input type="text" name="nome">

                <label for="email" id="email"><?= htmlspecialchars($user['email']) ?></label>
                <input type="email" name="email">

                <label for="email" id="senha">Senha</label>
                <input type="password" name="senha">

                <input type="hidden" id="update" value="Update">
                <input type="hidden" name="tipoUser" value=<?= $_SESSION['user_id']?>> 
                <input type="hidden" name="id" value=<?= $user['id']?>><br>
                <button type="submit">Update</button>
            </form>
                <div class="btns">
                    <form action="delete.php" method="POST">
                        <input type="hidden" id="delete" value="Deletar">
                        <input type="hidden" name="id" value=<?= $user['id']?>>
                        <button type="submit">Deletar</button>
                    </form>
                </div>
        </li>
        
        <?php endforeach ;?>
    </ul>
    <br>
    <a href="logout.php">Sair</a>
</body>
</html>