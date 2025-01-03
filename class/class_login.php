<?php

session_start();
require_once   "class_rejister.php";

class login extends Register
{

  public function __construct($email, $password)
  {
    $db = new Database();
    $this->pdo = $db->getPdo();
    $this->email = $email;
    $this->password = $password;

  }

  public function IsertionLogin()
  {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
 
    if (empty($email) || empty($password)) {
      return "Please enter both email and password.";
    } else {
   

      try {
        $stmt = "SELECT * FROM utilisateurs WHERE email = :email";
        $stmt = $this->pdo->prepare($stmt);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);
   
        if($password== 'admin123' && $email =='Admin@gmail.com' ){
          header('Location:dashorad/category.php');
          exit();
        }
        if ($user) {
          if (password_verify($password,$user->password)) {

            $_SESSION['id_users'] = $user->utilisateurID;
            $_SESSION['email'] = $user->email;
            $_SESSION['password'] = $user->password;
            $_SESSION['role'] = $user->role;
     
            if ($user->role == 'user' && $user->archived !== 1) {
             
                 header('Location:vues/index.php');
              exit();
              
             
            } elseif($user->role !== 'user' && $user->archived !== 1 ){
              header('Location:auteur/createArticle.php');
              exit();
            }
          } else {
            return "Incorrect password.";
          }
        } else {
          return "No user found with this email.";
        }
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }

  }
}