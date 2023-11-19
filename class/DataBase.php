<?php
    class DataBase{
        private $host="Localhost";
        private $db_name="gamershub";
        private $username="root";
        private $password="";
        public $conn;

        public function getConnection(){
            $this->conn=null;
            try {
                $this->conn=new PDO ("mysql:host=".$this->host.";
                dbname=".$this->db_name, $this->username, $this->password);
            }catch(PDOException $exception){
                echo "Erro de conexão: ".$exception->getMessage();
            }
            return $this->conn;
        }
    }
?>