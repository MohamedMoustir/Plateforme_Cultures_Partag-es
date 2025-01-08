


<?php
require_once "../class/class_rejister.php";
class utilisateurs extends Register{

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getPdo();
        
    }

  public function Selectutilisateurs($utilisateurID){
      try {
        $stmt = "SELECT * FROM utilisateurs  WHERE utilisateurID = :utilisateurID";
        $stmt = $this->pdo->prepare($stmt); 
         $stmt->bindParam(':utilisateurID', $utilisateurID);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        if ($user) {
         
      return $user;
        }
      }
    catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    }

    public function Allutilisateurs(){
            try {
              $stmt = "SELECT * FROM utilisateurs ";
              $stmt = $this->pdo->prepare($stmt); 
              $stmt->execute();
              $user = $stmt->fetchAll(PDO::FETCH_OBJ);
              if ($user) {
               
            return $user;
              }

      }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }
    


    public function archivedUsers($id){
        try {
            $sql = "UPDATE utilisateurs SET archived = 1 WHERE utilisateurID = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt) {
                echo "<script>window.location.href = 'users.php';</script>";
            }
        } catch (PDOException $e) {
            echo "Errors: " . $e->getMessage();
        }
    }
    
    public function activeUsers($id){
        try {
            $sql = "UPDATE utilisateurs SET archived = 0 WHERE utilisateurID = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt) {
                echo "<script>window.location.href = 'users.php';</script>";
            }
        } catch (PDOException $e) {
            echo "Errors: " . $e->getMessage();
        }
    
    }




    public function UsersCount() {
        try {
            $Countreservation = $this->pdo->prepare("SELECT COUNT(*) AS row_counts FROM utilisateurs where archived = 0");
            $Countreservation->execute();
            $row = $Countreservation->fetch(PDO::FETCH_ASSOC); 
            return $row;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 0; 
        }
    }



     public function getCurrentPassword($utilisateurID){
        try {
            $stmt = "SELECT password FROM utilisateurs  WHERE utilisateurID = :utilisateurID";
            $stmt = $this->pdo->prepare($stmt); 
             $stmt->bindParam(':utilisateurID', $utilisateurID);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            if ($user) {
             
          return $user;
            }
          }
        catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
        }          
     }

     public function UpdateUsers($username, $email, $password, $phone, $bio, $address, $birthday,$upload_img, $utilisateurID) {
        try {
           

            if (!empty($password)) {
               $password = password_hash($password, PASSWORD_BCRYPT);
            } else {
                $password = $this->getCurrentPassword($utilisateurID); 
            }
           
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $allowedExtensions = ['jpg', 'png', 'jpeg', 'gif'];
    
                $file_name = $_FILES['avatar']['name'];
                $file_size = $_FILES['avatar']['size'];
                $file_temp = $_FILES['avatar']['tmp_name'];
    
                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
    
                if (in_array($file_ext, $allowedExtensions)) {
                    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
                    $upload_img = "../upload/" . $unique_image;
    
                    if (!move_uploaded_file($file_temp, $upload_img)) {
                        $upload_img = null;
                    }
                }
            }
    
            $query = "UPDATE utilisateurs SET 
                      name=:username,
                      email=:email,
                      password=:password,
                      upload_img=COALESCE(:upload_img, upload_img),
                      phone=:phone,
                      bio=:bio,
                      address=:address,
                      birthday=:birthday 
                      WHERE utilisateurID = :utilisateurID";
    
            $UpdateUsers = $this->pdo->prepare($query);
    
            $UpdateUsers->bindParam(':username', $username, PDO::PARAM_STR);
        $UpdateUsers->bindParam(':email', $email, PDO::PARAM_STR);
        $UpdateUsers->bindParam(':password', $password, PDO::PARAM_STR);
        $UpdateUsers->bindParam(':upload_img', $upload_img, PDO::PARAM_STR);
        $UpdateUsers->bindParam(':phone', $phone, PDO::PARAM_STR);
        $UpdateUsers->bindParam(':bio', $bio, PDO::PARAM_STR);
        $UpdateUsers->bindParam(':address', $address, PDO::PARAM_STR);
        $UpdateUsers->bindParam(':birthday', $birthday, PDO::PARAM_STR);
        $UpdateUsers->bindParam(':utilisateurID', $utilisateurID, PDO::PARAM_INT);
            
            $UpdateUsers->execute();
           
    
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 0;
        }
    }
    
    














}