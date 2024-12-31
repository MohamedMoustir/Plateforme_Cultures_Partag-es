

<?php
 class Article {
  private $title;
  private $content; 
  private $category_id;
  private $author_id;
  private $status;
  private $pdo;
  private $upload_img; 



  public function __construct (){
   $db =new Database();
   $this->pdo = $db->getPdo();
  }

  public function createArticle($title,$content,$category_id,$author_id,$upload_img){
    
   try{
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $permited = array('jpg','png','jpeg','gif');
          $file_name = $_FILES['avatar']['name'];
          $file_size = $_FILES['avatar']['size'];
          $file_temp = $_FILES['avatar']['tmp_name'];
          $div = explode('.',$file_name);
          $file_ext = strtolower(end($div));
          $unique_imge = substr(md5(time()),0,10).'.'.$file_ext;
          $this->upload_img = "../upload/".$unique_imge;
          move_uploaded_file($file_temp, $this->upload_img);
         
              }
               
    $query = "INSERT INTO article (title,content,category_id, author_id,image) VALUES (:title,:content,:category_id,:author_id,:upload_img)";
     $stmt = $this->pdo->prepare( $query);
    $stmt->bindParam(':title',$title,PDO::PARAM_STR);
    $stmt->bindParam(':content',$content,PDO::PARAM_STR);
    $stmt->bindParam(':category_id',$category_id,PDO::PARAM_INT);
    $stmt->bindParam(':author_id',$author_id , PDO::PARAM_INT);
    $stmt->bindParam(':upload_img',$this->upload_img,PDO::PARAM_STR);
     $stmt->execute();

   }catch (PDOException $e) {
    echo "Errors: " . $e->getMessage();
   }
  

  }


 public function afficherArticle($email){
    try {
        $query = "SELECT * FROM article
        JOIN utilisateurs ON article.author_id = utilisateurs.utilisateurID 
        JOIN category ON article.category_id = category.CategoryID 
        WHERE utilisateurs.email = :email";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->execute();
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $article;
        
    } catch (PDOException $e) {
        echo "Errors: " . $e->getMessage();
    }
 }


 public function afficherArticleApproved(){
    try {
        $query = "SELECT * FROM article
        JOIN utilisateurs ON article.author_id = utilisateurs.utilisateurID
        WHERE article.status ='approved'";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $articleapproved = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $articleapproved;
        
    } catch (PDOException $e) {
        echo "Errors: " . $e->getMessage();
    }
 }


//  public editArticle();
//  public annuleArticle();














  // Getters
  public function getTitle()
  {
      return $this->title;
  }

  public function getContent()
  {
      return $this->content;
  }

  public function getCategory_id()
  {
      return $this->category_id;
  }

  public function getAuthor_id()
  {
      return $this->author_id;
  }

  public function getStatus()
  {
      return $this->status;
  }
  public function getImage_pth()
  {
      return $this->image_pth;
  }
  // Setters
  public function setTitle($title)
  {
      $this->title = $title;
  }

  public function setAuthor_id($author_id)
  {
      $this->author_id = $author_id;
  }

  public function setContent($content)
  {
      $this->content = $content;
  }

  public function setCategory_id($category_id)
  {
      $this->category_id = $category_id;
  }
  
  public function setStatus($status)
  {
      $this->status = $status;
  } 
  public function setImage_pth($image_pth)
  {
      $this->image_pth = $image_pth;
  }

  
}