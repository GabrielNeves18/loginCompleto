<?php
    require_once('db.php');
    
    function insertUser($nome, $email, $pass, $admin = 1){
        global $conn;

        try{
            $stmt = $conn->prepare("INSERT INTO users (nome, email, password, admin) VALUES (:nome,:email, :password, :admin)");
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $pass);
            $stmt->bindParam(":admin", $admin);
            $stmt->execute();
        } catch (PDOException $e){
            echo "Erro ao inserir usuário: " . $e->getMessage();
        }
    }

    function selectUser($email, $pass){
        global $conn;

        try{
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute((['email' => $email]));
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user && password_verify($pass, $user['password'])){
                return $user;
            } else {
                return false;
            }
        } catch (PDOException $e){
            return false;
        }
    }

    function selectTypeUser($id){
        global $conn;
        try{
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            return $user['admin'];
        } catch (PDOException $e){
            return false;
        }
    }

    function selectUpdate($id){
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id'=> $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }
    function isAdmin($userId) {
        global $conn;
    
        try {
            $stmt = $conn->prepare("SELECT admin FROM users WHERE id = :id");
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && $user['admin'] == 1) {
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }
    function selectAllUser(){
        global $conn;

        try{
            $stmt = $conn->prepare("SELECT * FROM users");
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
             return $users;   
        } catch(PDOException $e){
            return false;
        }
    }

    function deleteUser($id){
        global $conn;

        try{
            $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return True;
        } catch (PDOException $e){
            return false;
            
        }
    }

    function updateUser($id, $email = null, $pass = null, $nome = null) {
        global $conn;
    
        // Inicia a query base
        $query = "UPDATE users SET ";
        $parametros = [];
        $clausulas = [];
    
        // Verifica quais parâmetros foram fornecidos e adiciona as respectivas partes na query
        if ($email !== null) {
            $clausulas[] = "email = :email";
            $parametros[':email'] = $email;
        }
        if ($pass !== null) {
            $clausulas[] = "password = :password";
            $parametros[':password'] = password_hash($pass, PASSWORD_DEFAULT); // Hash da senha antes de armazenar
        }
        if ($nome !== null) {
            $clausulas[] = "nome = :nome";
            $parametros[':nome'] = $nome;
        }
    
        // Se não houver nenhum parâmetro para atualizar, retorne falso
        if (empty($clausulas)) {
            return false;
        }
    
        // Concatena as partes SET na query base
        $query .= implode(", ", $clausulas);
        $query .= " WHERE id = :id";
        $parametros[':id'] = $id;
    
        // Prepara e executa a query
        try {
            $stmt = $conn->prepare($query);
            $stmt->execute($parametros);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }
?>