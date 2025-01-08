
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



}