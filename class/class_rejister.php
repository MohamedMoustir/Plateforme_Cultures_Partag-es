<?php
// require_once  "../database/connexion.php";

class Register 
{
    protected $username;
    protected $email;
    protected $password;
    protected $role;
    protected $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getPdo();
        
    }

    public function insertUtilisateurs($username, $email, $password, $role)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->role = $role;
        try {
            $query = "INSERT INTO utilisateurs (name, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$this->username, $this->email, $this->password, $this->role]);
            return true;
        } catch (PDOException $e) {
            echo "Insert failed: " . $e->getMessage();
            return false;
        }
    }

 

    // Getters
    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }

    // Setters
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function setRole($role)
    {
        $this->role = $role;
    }


}

?>