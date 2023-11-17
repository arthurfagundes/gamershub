<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamershub";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die("Conexão falhou: " . $e->getMessage());
}
?>