

<?php


 class Article 
 {
  private $title;
  private $content; 
  private $category_id;
  private $author_id;
  private $status;
  private $pdo;
  private $upload_img; 
  private $tags; 


  public function __construct (){
   $db =new Database();
   $this->pdo = $db->getPdo();
  }

  public function createArticle($title, $content, $category_id, $author_id, $image_path, $tags){
    
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
     return $this->pdo->lastInsertId();
   }catch (PDOException $e) {
    echo "Errors: " . $e->getMessage();
   }
  

  }


 public function afficherArticle($email){
    try {
        $query = "SELECT * FROM article
        JOIN utilisateurs ON article.author_id = utilisateurs.utilisateurID 
        JOIN category ON article.category_id = category.CategoryID 
        WHERE utilisateurs.email = :email ";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->execute();
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $article;
        
    } catch (PDOException $e) {
        echo "Errors: " . $e->getMessage();
    }
 }

 public function afficherArticleApproved() {
    try {
        $starts = 0;
        $rows_pre_page = 6;

        $recordQuery = "SELECT COUNT(*) FROM article
                        JOIN utilisateurs ON article.author_id = utilisateurs.utilisateurID
                        WHERE article.status = 'approved'";

       
        $filterQuery = "";
        if (isset($_GET['category']) && !empty($_GET['category'])) {
            $filterQuery = " AND article.category_id = :category_id";
        }

        if (isset($_GET['Search']) && !empty($_GET['Search'])) {
            $filterQuery .= " AND category.names LIKE :Search";
        }

        if (isset($_GET['category']) && empty($_GET['category'])) { 
            header('Location: ../vues/index.php?page-nr=1');
            exit();
        }

        $recordQuery .= $filterQuery;

        $stmt = $this->pdo->prepare($recordQuery);

        if (!empty($filterQuery)) {
            $stmt->bindParam(':category_id', $_GET['category'], PDO::PARAM_INT);
        }

        if (isset($_GET['Search']) && !empty($_GET['Search'])) {
            $stmt->bindValue(':Search', '%' . $_GET['Search'] . '%', PDO::PARAM_STR);
        }

        $stmt->execute();
        $record = $stmt->fetchColumn();
        $this->pages = ceil($record / $rows_pre_page);

        $page = 0;
        if (isset($_GET['page-nr'])) {
            $page = intval($_GET['page-nr']) - 1;
            $starts = $page * $rows_pre_page;
        }

        $query = "SELECT * FROM article
                  JOIN utilisateurs ON article.author_id = utilisateurs.utilisateurID 
                  JOIN category ON article.category_id = category.CategoryID 
                  WHERE article.status = 'approved' " . $filterQuery . "
                  ORDER BY article.id DESC
                  LIMIT :starts, :rows_pre_page";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':starts', $starts, PDO::PARAM_INT);
        $stmt->bindParam(':rows_pre_page', $rows_pre_page, PDO::PARAM_INT);

        if (!empty($filterQuery)) {
            $stmt->bindParam(':category_id', $_GET['category'], PDO::PARAM_INT);
        }
        
        if (isset($_GET['Search']) && !empty($_GET['Search'])) {
            $stmt->bindValue(':Search', '%' . $_GET['Search'] . '%', PDO::PARAM_STR);
        }

        $stmt->execute();
        $articleapproved = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $articleapproved;

    } catch (PDOException $e) {
        echo "Errors: " . $e->getMessage();
    }
}


public function afficherDetailsArticle($id){
    try {
        $query = "SELECT *
        FROM article
        JOIN utilisateurs ON article.author_id = utilisateurs.utilisateurID
        JOIN category ON article.category_id = category.CategoryID
        JOIN article_tags ON article.id = article_tags.id_article
        JOIN tags ON article_tags.id_tag = tags.idTag
        WHERE article.id = :id ";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($article) {
            $tags = array();
            foreach ($article as $row) {
                $tags[] = $row['nomTag'];  
            }
           
            $articleDetails = $article[0]; 
            $articleDetails['tags'] = $tags; 

            return $articleDetails;
        } 
    } catch (PDOException $e) {
        echo "Errors: " . $e->getMessage();
    }
 }



 public function editArticle($title, $content, $category_id, $author_id, $id, $upload_img) {
    try {
        // استخدام COALESCE لتحديد الصورة إذا كانت موجودة
        $sql = "UPDATE article SET
            title = :title,
            content = :content,
            category_id = :category_id,
            author_id = :author_id,
            image = COALESCE(:upload_img, image)  -- إذا كانت الصورة الجديدة غير موجودة، يتم الاحتفاظ بالصورة القديمة
            WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':author_id', $author_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':upload_img', $upload_img, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "<script>window.location.href = '../auteur/createArticle.php';</script>";
        }  
        exit();
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
}




public function removeArticle($id){
    try {
        $sql = "DELETE FROM article WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
         $stmt->execute();
        if ($stmt) {
            echo "<script>window.location.href = '../auteur/createArticle.php';</script>";
        }
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
}

public function approvedArticle($id) {

    try {
        $query = $this->pdo->prepare("UPDATE article SET status ='approved' WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();

     
        if ($query->rowCount() > 0) {
            echo "<script>window.location.href = 'category.php';</script>";

            exit; 
        } else {
            return "No rows were updated."; 
        }
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
  
}

public function afficherArticleAdmin(){
    try {
        $query = "SELECT * FROM article
        JOIN utilisateurs ON article.author_id = utilisateurs.utilisateurID 
        JOIN category ON article.category_id = category.CategoryID  ";


        $stmt = $this->pdo->prepare($query);
       
        $stmt->execute();
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $article;
        
    } catch (PDOException $e) {
        echo "Errors: " . $e->getMessage();
    }
 }


public function CancelArticle($id) {

    try {
      
        $query = $this->pdo->prepare("UPDATE article SET status ='rejected' WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();

     
        if ($query->rowCount() > 0) {
            echo "<script>window.location.href = 'category.php';</script>";
            exit; 
        } else {
            return "No rows were updated."; 
        }
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
  
}


// statictick

public function ArticleCount() {
    try {
        $Countreservation = $this->pdo->prepare("SELECT COUNT(*) AS row_count FROM article");
        $Countreservation->execute();
        $row = $Countreservation->fetch(PDO::FETCH_ASSOC); 
        return $row;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return 0; 
    }
}

public function ArticleCountAuteur($email) {
    try {
        $Countreservation = $this->pdo->prepare("SELECT COUNT(*) as count FROM article
        JOIN utilisateurs ON article.author_id = utilisateurs.utilisateurID 
        JOIN category ON article.category_id = category.CategoryID 
        WHERE utilisateurs.email = :email");
        $Countreservation->bindParam(':email', $email, PDO::PARAM_STR);
        $Countreservation->execute();
        $row = $Countreservation->fetch(PDO::FETCH_ASSOC);
        
        return $row['count']; 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return 0;
    }
}



    public function insertArticle_Tags($articleId, $tags) {
        try {
            foreach ($tags as $tagId) {
                $sql = "INSERT INTO article_tags (id_article, id_tag) VALUES (:articleId, :tagId)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':articleId', $articleId, PDO::PARAM_INT);
                $stmt->bindParam(':tagId', $tagId, PDO::PARAM_INT);
                $stmt->execute();
            }
        } catch (PDOException $e) {
            echo "error: " . $e->getMessage();
        }
    }




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

  public function gettags()
  {
      return $this->tags;
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

  public function settags($tags)
  {
      $this->tags = $tags;
  }
}