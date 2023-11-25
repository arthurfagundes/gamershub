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

    public function curtirPost($post_id)
    {
        try {
            $query = "UPDATE " . $this->table_name . " SET curtidas = curtidas + 1 WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$post_id]);

            echo "Postagem curtida com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao curtir postagem: " . $e->getMessage();
        }
    }

    public function deletarPost($post_id)
    {
        try {
            // Primeiro, obtenha o nome da imagem para excluí-la do diretório
            $imagem_query = "SELECT imagem FROM " . $this->table_name . " WHERE id = ?";
            $imagem_stmt = $this->conn->prepare($imagem_query);
            $imagem_stmt->execute([$post_id]);
            $imagem_result = $imagem_stmt->fetch(PDO::FETCH_ASSOC);

            // Exclua a imagem do diretório
            $imagem_path = './img/' . $imagem_result['imagem'];
            if (file_exists($imagem_path)) {
                unlink($imagem_path);
            }

            // Agora, delete a postagem do banco de dados
            $query = "DELETE FROM " . $this->table_name . " WHERE id = ?"; 
            $stmt = $this->conn->prepare($query); 
            $stmt->execute([$post_id]);

            echo "Postagem deletada com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao deletar postagem: " . $e->getMessage();
        }
    }

    public function listarPostagensPorUsuario($usuario_id)
    {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE usuario_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$usuario_id]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao listar postagens por usuário: " . $e->getMessage();
        }
    }
}
