
<?php

class tags {

    public $idtags;
    public $nomtags;
    public $pdo;


    public function __construct (){
        $db =new Database();
        $this->pdo = $db->getPdo();
       }


public function AjouteTags($names){

        try {
        
           $sql = "INSERT INTO tags(nomTag) VALUES (:names) ";
           $stmt = $this->pdo->prepare($sql);
           $stmt->bindParam(':names',$names,PDO::PARAM_STR);
           $stmt->execute();
        } catch (PDOException $e) {
            echo "Errors: " . $e->getMessage();
        }
      }
   
        public function afficherTags(){

            try {
            $sql = "SELECT * FROM tags";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $allcategory = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $allcategory ;
            } catch (PDOException $e) {
                echo "Errors: " . $e->getMessage();
            }
        }


        public function insertArticle_Tags($articleId,$tags) {
            try {
                $sql = "INSERT INTO Article_Tags (id_article, id_tag) VALUES (:articleId, :tagId)";
                $stmt = $this->pdo->prepare($sql);

                $stmt->bindParam(':articleId', $articleId, PDO::PARAM_INT);
                $stmt->bindParam(':tagId', $tagId, PDO::PARAM_INT);

                foreach ($tags as $tagId) {
                    $stmt->execute();
                }

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }



        public function removetag($id){
            try {
                $sql = "DELETE  FROM tags WHERE idTag = :id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':id', $id , PDO::PARAM_INT);
                 $stmt->execute();

                if ($stmt) {
                    echo "<script>window.location.href = '../dashorad/table_tag.php';</script>";
                }
            } catch (PDOException $e) {
                return "Erreur : " . $e->getMessage();
            }
          }

      
          
        public function afficherTagsById($id){

            try {
            $sql = "SELECT * FROM tags WHERE idTag = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id , PDO::PARAM_INT);
            $stmt->execute();
            $allcategory = $stmt->fetch(PDO::FETCH_ASSOC);
            return $allcategory ;
            } catch (PDOException $e) {
                echo "Errors: " . $e->getMessage();
            }
        }
  
        public function EditeRoleUsers($nomtags ,$idtags){ 
         
            try {
                $sql = "UPDATE tags SET nomTag = :nomtags WHERE idTag = :id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':id', $idtags, PDO::PARAM_INT);
                $stmt->bindParam(':nomtags', $nomtags, PDO::PARAM_STR);
                $stmt->execute();
                if ($stmt) {
                    echo "<script>window.location.href = '../dashorad/table_tag.php';</script>";
                }
            } catch (PDOException $e) {
                echo "Errors: " . $e->getMessage();
            }
        }


        
         
  // Getters
  public function GetNom()
  {
      return $this->nomtags;
  }

  public function GetId()
  {
      return $this->idtags;
  }

  public function SetNom($idtags)
  {
      $this->title = $idtags;
  }
   public function SetId($nomtags)
  {
      $this->title = $nomtags;
  }
}