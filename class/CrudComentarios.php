<?php

class CrudComentarios
{
    private $conn;
    private $table_name = "comentarios";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function criarComentario($texto, $usuario_id, $post_id, $imagem)
    {
        try {
            // Insira o comentário no banco de dados
            $query = "INSERT INTO " . $this->table_name . " (texto, usuario_id, posts_id, imagem) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$texto, $usuario_id, $post_id, $imagem]);

            // Mova o arquivo para o diretório desejado
            move_uploaded_file($_FILES['imagem']['tmp_name'], './img/' . $imagem);

            echo "Comentário criado com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao criar comentário: " . $e->getMessage();
        }
    }

    public function exibirComentarios($post_id)
    {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE posts_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$post_id]);

            $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($comentarios) {
                foreach ($comentarios as $comentario) {
                    // Adicione o formulário e o botão de apagar
                    echo '<form method="post" class="deletar-comentario-form" onsubmit="return confirm(\'Tem certeza que deseja deletar este comentário?\');">';
                    echo '<input type="hidden" name="comentario_id" value="' . $comentario['id'] . '">';
                    echo '<button type="submit" name="deletar_comentario">Apagar Comentário</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo "Sem comentários encontrados";
            }

            return $comentarios;
        } catch (PDOException $e) {
            echo "Erro ao exibir comentários: " . $e->getMessage();
        }
    }

    public function apagarComentario($comentario_id)
    {
        try {
            // Primeiro, obtenha o nome da imagem para excluí-la do diretório
            $imagem_query = "SELECT imagem FROM " . $this->table_name . " WHERE id = ?";
            $imagem_stmt = $this->conn->prepare($imagem_query);
            $imagem_stmt->execute([$comentario_id]);
            $imagem_result = $imagem_stmt->fetch(PDO::FETCH_ASSOC);

            // Exclua a imagem do diretório
            $imagem_path = './img/' . $imagem_result['imagem'];
            if (file_exists($imagem_path)) {
                unlink($imagem_path);
            }

            // Agora, delete o comentário do banco de dados
            $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$comentario_id]);

            echo "Comentário deletado com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao deletar comentário: " . $e->getMessage();
        }
    }

    public function listarComentariosPorUsuario($usuario_id)
    {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE usuario_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$usuario_id]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao listar comentários por usuário: " . $e->getMessage();
        }
    }
}