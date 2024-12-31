<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD','root');
define('DATABASE', 'artcultureplatform');

class Database
{
    private $host = HOST;
    private $username = USER;
    private $password = PASSWORD;
    private $database = DATABASE;
    private $pdo;
    public $error;

    public function __construct()
    {
        $this->db_connect();
    }

    private function db_connect()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->error = "Connection successful.";
            return $this->error;
        } catch (PDOException $e) {
            $this->error = "Connection failed: " . $e->getMessage();
            echo $this->error;
            
        }
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}
?>
