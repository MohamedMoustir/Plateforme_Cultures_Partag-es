


<?php
require_once "../class/class_rejister.php";
class utilisateurs {

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getPdo();
        
    }

public function Selectutilisateurs(){
      try {
        $stmt = "SELECT * FROM utilisateurs ";
        $stmt = $this->pdo->prepare($stmt);
        $stmt->execute();
        $user = $stmt->fetchall(PDO::FETCH_OBJ);
     return $user;
      }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }

    }


    public function archivedUsers($id){
        try {
            $sql = "UPDATE utilisateurs SET archived = 1 WHERE utilisateurID = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Errors: " . $e->getMessage();
        }
    }
    
}