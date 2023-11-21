<?php
   class CrudJogos{
    private $conn;
    private $table_name="jogos";

    public function __construct($db){
        $this->conn = $db;
    }

    public function adicionarJogo($nomeJogo, $nomeDesenvolvedora, $genero, $plataforma, $classificacao, $imagemJogo)
    {
    try {
        $query = "INSERT INTO jogos (nomejogo, nomedesenvolvedora, genero, plataforma, classificacao, imgjogo) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nomeJogo, $nomeDesenvolvedora, $genero, $plataforma, $classificacao, $imagemJogo]);

        echo "Jogo adicionado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao adicionar jogo: " . $e->getMessage();
    }
    }

    public function listarJogos()
    {
        try {
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao listar jogos: " . $e->getMessage();
        }
    }

    public function getJogoById($id) {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao obter informações do jogo: " . $e->getMessage();
        }
    }

    public function atualizarJogo($id, $nomeJogo, $nomeDesenvolvedora, $genero, $plataforma, $classificacao, $imagemJogo) {
        try {
            $query = "UPDATE jogos SET nomejogo = ?, nomedesenvolvedora = ?, genero = ?, plataforma = ?, classificacao = ?, imgjogo = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$nomeJogo, $nomeDesenvolvedora, $genero, $plataforma, $classificacao, $imagemJogo, $id]);

            echo "Jogo atualizado com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao atualizar jogo: " . $e->getMessage();
        }
    }

}
