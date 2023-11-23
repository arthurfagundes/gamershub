<?php

class CrudPost
{
    private $conn;
    private $table_name = "posts";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function adicionarPost($titulo, $texto, $usuario_id, $imagem)
    {
        try {
            // Insira a postagem no banco de dados
            $query = "INSERT INTO " . $this->table_name . " (titulo, texto, usuario_id, imagem) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$titulo, $texto, $usuario_id, $imagem]);
    
            // Mova o arquivo para o diretório desejado
            move_uploaded_file($_FILES['imagem']['tmp_name'], './img/' . $imagem);
    
            echo "Postagem criada com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao criar postagem: " . $e->getMessage();
        }
    }
    
    public function curtirPost($id)
    {
        try {
            // Removed game ID from query
            $query = "UPDATE " . $this->table_name . " SET curtidas = curtidas + 1 WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);

            echo "Postagem curtida com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao curtir postagem: " . $e->getMessage();
        }
    }

    public function deletarPost($id)
    {
        try {
            $query = "DELETE FROM " . $this->table_name . " WHERE id=?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);

            echo "Postagem excluída com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao excluir postagem: " . $e->getMessage();
        }
    }

    public function buscarPostPorId($id)
    {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao buscar postagem por ID: " . $e->getMessage();
        }
    }

    public function listarPostagens()
    {
        try {
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($posts) {
                foreach ($posts as $post) {
                    echo "<hr>";
                }
            } else {
                echo "Sem postagens encontradas";
            }

            return $posts;
        } catch (PDOException $e) {
            echo "Erro ao exibir postagens: " . $e->getMessage();
        }
    }
}
