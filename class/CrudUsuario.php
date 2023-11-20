<?php
   class CrudUsuario{
    private $conn;
    private $table_name="usuarios";

    public function __construct($db){
        $this->conn = $db;
    }

    public function registrar($nome, $email, $datanasc, $senha, $comfirme_senha)
    {
        if ($senha !== $comfirme_senha) {
            echo "As senhas não coincidem. Tente novamente.";
            return;
        }

        try {
            $hashed_password = password_hash($senha, PASSWORD_DEFAULT);

            $query = "INSERT INTO " . $this->table_name . " (nome, email, datanasc, senha) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$nome, $email, $datanasc, $hashed_password]);

            echo "Registro bem-sucedido!";
        } catch (PDOException $e) {
            echo "Erro no registro: " . $e->getMessage();
        }
    }
    
    public function logar($nome, $senha)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE nome = :nome");
            $stmt->bindParam(':nome', $nome);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($senha, $user['senha'])) {
                session_start();
                $_SESSION['nome'] = $user['nome'];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro no login: " . $e->getMessage();
        }
    }
    
    public function sair()
    {
        try {
            session_start();
            session_destroy();
        } catch (PDOException $e) {
            echo "Erro no logout: " . $e->getMessage();
        }
    }

    public function editar($id, $nome, $email, $datanasc, $senha)
    {
        try {
            $hashed_password = password_hash($senha, PASSWORD_DEFAULT);

            $query = "UPDATE " . $this->table_name . " SET nome = ?, email = ?, datanasc = ?, senha = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$nome, $email, $datanasc, $hashed_password, $id]);
            return $stmt;
        } catch (PDOException $e) {
            echo "Erro na edição: " . $e->getMessage();
        }
    }

    public function deletar($id)
    {
        try {
            $query = "DELETE FROM " . $this->table_name . " WHERE id=?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);
            return $stmt;
        } catch (PDOException $e) {
            echo "Erro na exclusão: " . $e->getMessage();
        }
    }
}