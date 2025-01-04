<?php 


class Comments 
{

    private $user_id ;
    private $comment_text ;
    private $article_id ;
    public $pdo;

    public function __construct (){
        $db =new Database();
        $this->pdo = $db->getPdo();
       }


        public function addComment($user_id, $id_article,$comment_text){
            try {
                    $query = "INSERT INTO comments (user_id, article_id,comment_text) VALUES (:user_id, :article_id , :comment_text)";
                    $stmt = $this->pdo->prepare($query);
                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $stmt->bindParam(':article_id', $id_article, PDO::PARAM_INT); 
                    $stmt->bindParam(':comment_text', $comment_text, PDO::PARAM_STR); 
                    $stmt->execute();
                
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
              }
        }

        
        public function SelectComment($id_article){
            try {
                                    $query = "SELECT * FROM comments
                JOIN article ON comments.article_id = article.id
                JOIN utilisateurs ON comments.user_id = utilisateurs.utilisateurID
                WHERE  comments.article_id = :article_id";
                                    $stmt = $this->pdo->prepare($query);
                    $stmt->bindParam(':article_id', $id_article, PDO::PARAM_INT); 
                    $stmt->execute();
                    $allcomment = $stmt->fetchAll(PDO::FETCH_OBJ);
                    return $allcomment;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
              }
        }


        public function CountCommit($content_id){
            try {
                $stmt = "SELECT COUNT(*) AS allcomments FROM comments WHERE  article_id = :article_id";
                    $stmt = $this->pdo->prepare($stmt);
                    $stmt->bindParam(':article_id', $content_id, PDO::PARAM_INT); 
                    $stmt->execute();
                    $likeExists = $stmt->fetchColumn(); 
                return $likeExists; 
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
          }
}

