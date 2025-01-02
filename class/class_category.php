
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
}

