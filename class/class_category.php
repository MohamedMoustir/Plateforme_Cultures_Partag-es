
<?php

class Category {
  private $names;
  private $description;
 
  public function __construct (){
    $db =new Database();
    $this->pdo = $db->getPdo();
   }


  public function AjouteCategory($names,$description){

    try {
    
       $sql = "INSERT INTO category( names,description) VALUES (:names,:description) ";
       $stmt = $this->pdo->prepare($sql);
       $stmt->bindParam(':names',$names,PDO::PARAM_STR);
       $stmt->bindParam(':description',$description,PDO::PARAM_STR);
       $stmt->execute();
    } catch (PDOException $e) {
        echo "Errors: " . $e->getMessage();
    }
  }

  public function afficherCategory(){

    try {
       $sql = "SELECT * FROM category";
       $stmt = $this->pdo->prepare($sql);
       $stmt->execute();
       $allcategory = $stmt->fetchAll(PDO::FETCH_ASSOC);
       return $allcategory ;
    } catch (PDOException $e) {
        echo "Errors: " . $e->getMessage();
    }
  }


  public function removeCategory($id){
  try {
      $sql = "DELETE FROM category WHERE CategoryID = :id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindParam(':id', $id);
       $stmt->execute();
      if ($stmt) {
          echo "<script>window.location.href = '../dashorad/afficheCategory.php';</script>";
      }
  } catch (PDOException $e) {
      return "Erreur : " . $e->getMessage();
  }
}


public function Countcategory() {
  
    try {
        $Countreservation = $this->pdo->prepare("SELECT COUNT(*) AS row_counts FROM category");
        $Countreservation->execute();
        $row = $Countreservation->fetch(PDO::FETCH_ASSOC); 
        return $row;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return 0; 
    }

}


}