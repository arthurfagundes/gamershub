<?php
class User
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function register($username, $password, $confirm_password, $email)
    {
        if ($password !== $confirm_password) {
            echo "As senhas não coincidem. Tente novamente.";
            return;
        }

        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->conn->prepare("INSERT INTO users (username, password, email)
            VALUES (:username, :password, :email)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            echo "Registro bem-sucedido!";
        } catch (PDOException $e) {
            echo "Erro no registro: " . $e->getMessage();
        }
    }

    public function login($username, $password)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam('username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['username'] = $user['username'];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro no login: " . $e->getMessage();
        }
    }

    public function logout()
    {
        try {
            session_start();
            session_destroy();
        } catch (PDOException $e) {
            echo "Erro no logout: " . $e->getMessage();
        }
    }
}
