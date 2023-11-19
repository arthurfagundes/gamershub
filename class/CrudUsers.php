<?php
    class CrudUsers{
        private $conn;
        private $table_name="tbusuario";
        public function __construct($db){
            $this->conn=$db;
        }
        public function creat($nome, $idade, $cpf){
            $query = "INSERT INTO " .$this->table_name." (nome,idade,cpf)values(?,?,?)";
                $stmt=$this->conn->prepare($query);
                $stmt->execute([$nome, $idade, $cpf]);
                return $stmt;
        }
        public function read(){
            $query="SELECT * FROM " .$this->table_name;
            $stmt=$this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function readEdit($id){
            $query="SELECT * FROM " .$this->table_name. " where id=:id";
            $stmt= $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt;
        }
        public function update($id,$nome,$idade,$cpf){
            $query = "UPDATE " . $this->table_name . " set nome = ?, idade = ?, cpf = ? where id = ? ";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$nome, $idade, $cpf, $id]);
            return $stmt;
        }
        public function delete($id){
            $query="DELETE FROM " .$this->table_name. " where id=?";
            $stmt=$this->conn->prepare($query);
            $stmt->execute([$id]);
            return $stmt;
        }
    }