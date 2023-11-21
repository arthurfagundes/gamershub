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
    
    public function logar($email, $senha) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $crudUsuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($crudUsuario && password_verify($senha, $crudUsuario['senha'])) {
                session_start();
                $_SESSION['id'] = $crudUsuario['id']; // Adicione esta linha para armazenar o ID na sessão
                $_SESSION['email'] = $crudUsuario['email'];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro no login: " . $e->getMessage();
        }
    }

    public function buscarPorId($id)
    {
    try {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao buscar usuário por ID: " . $e->getMessage();
        return false;
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
    
    public function editarPerfil($id, $nome, $imgperfil, $bio)
    {
        try {
            // Verifica se o usuário com o ID especificado existe
            $verifica_query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
            $verifica_stmt = $this->conn->prepare($verifica_query);
            $verifica_stmt->execute([$id]);
    
            if ($verifica_stmt->rowCount() > 0) {
                // Usuário encontrado, proceder com a edição
    
                $update_fields = [];
                $update_values = [];
    
                if (!empty($nome)) {
                    $update_fields[] = "nome = ?";
                    $update_values[] = $nome;
                }
    
                if (!empty($bio)) {
                    $update_fields[] = "bio = ?";
                    $update_values[] = $bio;
                }
    
                if (!empty($imgperfil)) {
                    $update_fields[] = "imgperfil = ?";
                    $update_values[] = $imgperfil;
                }
    
                $update_fields_str = implode(", ", $update_fields);
                $query = "UPDATE " . $this->table_name . " SET " . $update_fields_str . " WHERE id = ?";
                $stmt = $this->conn->prepare($query);
    
                $update_values[] = $id;
    
                $stmt->execute($update_values);
    
                return true; // Edição bem-sucedida
            } else {
                return false; // Usuário não encontrado
            }
        } catch (PDOException $e) {
            echo "Erro na edição do perfil: " . $e->getMessage();
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