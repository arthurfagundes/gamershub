<?php
   class CrudPostPerfil{
    private $conn;
    private $table_name="posts";

    public function __construct($db){
        $this->conn = $db;
    }

public function exibirPost($id)
    {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);

            $post = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($post) {
                echo "<h1>" . $post['titulo'] . "</h1>";
                echo "<p>" . $post['texto'] . "</p>";
                echo "<p>Curtidas: " . $post['curtidas'] . "</p>";
            } else {
                echo "Postagem não encontrada";
            }
        } catch (PDOException $e) {
            echo "Erro ao exibir postagem: " . $e->getMessage();
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
                    echo "<h1>" . $post['titulo'] . "</h1>";
                    echo "<p>" . $post['texto'] . "</p>";
                    echo "<p>Curtidas: " . $post['curtidas'] . "</p>";
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