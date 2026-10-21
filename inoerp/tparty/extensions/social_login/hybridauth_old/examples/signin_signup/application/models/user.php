<?php
/**
 * Hybridauth User Model (Old) - PDO Prepared Statements
 * 
 * Switches from raw SQL string interpolation to PDO prepared statements
 * to prevent SQL injection vulnerabilities. All user queries now use
 * bound parameters instead of string concatenation.
 */

class user extends model {
    private $pdo;

    public function __construct($pdo = null) {
        if ($pdo !== null) {
            $this->pdo = $pdo;
        }
    }

    function create( $email, $password, $first_name, $last_name){ 
        if ($this->pdo === null) {
            return false;
        }
        $stmt = $this->pdo->prepare(
            "INSERT INTO users ( email, password, first_name, last_name, created_at ) VALUES ( :email, :password, :first_name, :last_name, NOW() )"
        );
        $stmt->execute([
            'email' => $email,
            'password' => $password,
            'first_name' => $first_name,
            'last_name' => $last_name,
        ]);
        return $this->pdo->lastInsertId();
    }

    function update( $user_id, $email, $password, $first_name, $last_name){ 
        if ($this->pdo === null) {
            return false;
        }
        $stmt = $this->pdo->prepare(
            "UPDATE users SET email = :email, password = :password, first_name = :first_name, last_name = :last_name WHERE id = :user_id LIMIT 1"
        );
        $stmt->execute([
            'user_id' => $user_id,
            'email' => $email,
            'password' => $password,
            'first_name' => $first_name,
            'last_name' => $last_name,
        ]);
        return $stmt->rowCount() > 0;
    }

    function find_by_id( $id ){ 
        if ($this->pdo === null) {
            return null;
        }
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function find_by_email( $email ){ 
        if ($this->pdo === null) {
            return null;
        }
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function find_by_email_and_password( $email, $password ){ 
        if ($this->pdo === null) {
            return null;
        }
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1");
        $stmt->execute(['email' => $email, 'password' => $password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}