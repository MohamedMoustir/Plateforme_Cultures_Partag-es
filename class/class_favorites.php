
<?php

class favorites {
    private $id_users;
    private $id_article;
   
    public function __construct (){
      $db =new Database();
      $this->pdo = $db->getPdo();
     }
            
     public function insertfavoritesArticle($id_users, $id_article, $email) {
        try {
            $stmt = "SELECT * FROM `favorites` 
                     JOIN utilisateurs ON favorites.user_id = utilisateurs.utilisateurID 
                     JOIN article ON favorites.article_id = article.id 
                     JOIN category ON article.category_id = category.CategoryID 
                     WHERE user_id = :id_users AND article_id = :id_article AND email = :email";
            $stmt = $this->pdo->prepare($stmt);
            $stmt->bindParam(':id_users', $id_users, PDO::PARAM_INT);
            $stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR); 
    
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $sql = "DELETE FROM favorites WHERE user_id = :user_id AND article_id = :id_article";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':user_id', $id_users, PDO::PARAM_INT);
                $stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT);
                $stmt->execute();
            } else {
                $query = "INSERT INTO favorites (user_id, article_id) VALUES (:id_users, :id_article)";
                $stmt = $this->pdo->prepare($query);
                $stmt->bindParam(':id_users', $id_users, PDO::PARAM_INT);
                $stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT);
                $stmt->execute();
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    

        public function SelectFavoritesArticle($email){
            try {
                $query = "SELECT * FROM `favorites` 
                JOIN utilisateurs ON favorites.user_id = utilisateurs.utilisateurID 
                JOIN article ON favorites.article_id = article.id 
                JOIN category ON article.category_id = category.CategoryID
                WHERE email =  :email"; 
                $stmt = $this->pdo->prepare($query);
                $stmt->bindParam(':email',$email,PDO::PARAM_STR);
                $stmt->execute();
                $allFavorites=$stmt->fetchAll(PDO::FETCH_ASSOC);
                return $allFavorites;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
        }
        }

    }