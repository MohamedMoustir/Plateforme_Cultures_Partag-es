


<?php
require_once "../class/class_rejister.php";
class utilisateurs extends Register{

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
        if ($user) {
         
      return $user;
        }
 

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
            if ($stmt) {
                echo "<script>window.location.href = 'users.php';</script>";
            }
        } catch (PDOException $e) {
            echo "Errors: " . $e->getMessage();
        }
    }
    
    public function activeUsers($id){
        try {
            $sql = "UPDATE utilisateurs SET archived = 0 WHERE utilisateurID = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt) {
                echo "<script>window.location.href = 'users.php';</script>";
            }
        } catch (PDOException $e) {
            echo "Errors: " . $e->getMessage();
        }
    
    }




    public function UsersCount() {
        try {
            $Countreservation = $this->pdo->prepare("SELECT COUNT(*) AS row_counts FROM utilisateurs where archived = 0");
            $Countreservation->execute();
            $row = $Countreservation->fetch(PDO::FETCH_ASSOC); 
            return $row;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 0; 
        }
    }
















}