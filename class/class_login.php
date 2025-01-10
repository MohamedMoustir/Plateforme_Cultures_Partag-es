<?php

session_start();
require_once "class_rejister.php";
// require_once "../vendor/autoload.php";
// require_once "../vues/mail.php";

class login extends Register
{
  
    public function __construct($email, $password) {
        parent::__construct($email, $password); 
    }

    public function IsertionLogin()
    {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

    
    //     if (empty($email) || empty($password)) {
    //         return "Please enter both email and password.";
    //     }
       
    //     $mail = new PHPMailer();
    //     $mail->setFrom('itsmoustir@gmail.com', 'Mohamed Moustir'); 
    //     $mail->addAddress($email, 'Recipient'); 

    //     $Subject = 'Welcome Email';
    //     $mail->isHTML(true);

    //     if (isset($this->role)) { 
    //         if ($this->role == 'user') { 
    //             $mail->Subject = $Subject;
    //             $mail->Body    = '<b>We encourage you to explore, comment, and add articles to your favorites</b>';
    //             $mail->AltBody = 'This is the plain text version of the email content';
    //         } elseif ($this->role == 'auteur') {
    //             $mail->Subject = $Subject;
    //             $mail->Body    = '<b>Welcome! You are invited to publish articles</b>';
    //             $mail->AltBody = 'This is the plain text version of the email content';
    //         }
    //     }

    //     if (!$mail->send()) {
    //         echo 'Error: ' . $mail->ErrorInfo;
    //     }

        try {
       
            $stmt = "SELECT * FROM utilisateurs WHERE email = :email";
            $stmt = $this->pdo->prepare($stmt);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);

            if ($user) {
                if (password_verify($password, $user->password)) {

                 
                    $_SESSION['id_users'] = $user->utilisateurID;
                    $_SESSION['email'] = $user->email;
                    $_SESSION['name'] = $user->name;
                    $_SESSION['password'] = $user->password;
                    $_SESSION['role'] = $user->role;

                    
                    if ($user->role == 'user' && $user->archived !== 1) {
                        header('Location:../vues/index.php');
                        exit();
                    } elseif ($user->role == 'auteur' && $user->archived !== 1) {
                        header('Location:../auteur/createArticle.php');
                        exit();
                    } elseif ($user->role == 'admin' && $user->archived !== 1) {
                        header('Location:../dashorad/category.php');
                        exit();
                    }
                } else {
                    return "Incorrect password.";
                }
            } else {
                return "No user found with this email.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
