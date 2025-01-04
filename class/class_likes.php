
<?php 


class likes 
{

    private $user_id ;
    private $content_id ;
    public $pdo;

    public function __construct (){
        $db =new Database();
        $this->pdo = $db->getPdo();
       }
       
       public function addlikes($user_id, $content_id) {
        try {
            $stmt = "SELECT COUNT(*) FROM likes WHERE user_id = :user_id AND content_id = :content_id";
            $stmt = $this->pdo->prepare($stmt);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT); 
            $stmt->bindParam(':content_id', $content_id, PDO::PARAM_INT); 
            $stmt->execute();
            $likeExists = $stmt->fetchColumn();
            if ($likeExists > 0) {
                $sql = "DELETE FROM likes WHERE user_id = :user_id AND content_id = :content_id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT); 
                $stmt->bindParam(':content_id', $content_id, PDO::PARAM_INT); 
                $stmt->execute();
            } else {
                $query = "INSERT INTO `likes` (user_id, content_id) VALUES (:user_id, :content_id)";
                $stmt = $this->pdo->prepare($query);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->bindParam(':content_id', $content_id, PDO::PARAM_INT); 
                $stmt->execute();
            }
    
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
  public function Getlike($content_id){
    try {
        $stmt = "SELECT COUNT(*) AS allLike FROM likes WHERE  content_id = :content_id";
            $stmt = $this->pdo->prepare($stmt);
            $stmt->bindParam(':content_id', $content_id, PDO::PARAM_INT); 
            $stmt->execute();
            $likeExists = $stmt->fetchColumn(); 
        return $likeExists; 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }
  

 public function totalLikeParauteur($id){
    try {
        $stmt = " SELECT  COUNT(*) FROM likes 
    JOIN article on likes.content_id = article.id
    JOIN utilisateurs ON likes.user_id = utilisateurs.utilisateurID 
    WHERE article.author_id = :id";
            $stmt = $this->pdo->prepare($stmt);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
            $stmt->execute();
            $likeExists = $stmt->fetchColumn(); 
        return $likeExists; 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }
  
 
}