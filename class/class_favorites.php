
<?php

class favorites {
    private $id_users;
    private $id_article;
   
    public function __construct (){
      $db =new Database();
      $this->pdo = $db->getPdo();
     }
            
        public function insertfavoritesArticle($id_users,$id_article){
            try{
            $query = "INSERT INTO favorites (user_id, article_id) VALUES (:id_users, :id_article)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id_users', $id_users, PDO::PARAM_INT);
            $stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT); 
            $stmt->execute();

        } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
}

}

    }