<?php


class Register 
{
    protected $username;
    protected $email;
    protected $password;
    protected $role;
    protected $pdo;
    protected $upload_img;
    protected $bio;
    protected $phone;
    protected $address;
    protected $birthday;
    protected $utilisateurID;

    
   

    public function __construct (){
        $db =new Database();
        $this->pdo = $db->getPdo();
       }
    public function insertUtilisateurs($username, $email, $password, $role)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->role = $role;
        $this->upload_img = NULL;  
        try {
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    
                $allowedExtensions = ['jpg', 'png', 'jpeg', 'gif'];
    
                $file_name = $_FILES['avatar']['name'];
                $file_size = $_FILES['avatar']['size'];
                $file_temp = $_FILES['avatar']['tmp_name'];
    
                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
    
                if (in_array($file_ext, $allowedExtensions)) {
                    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
                    $this->upload_img = "../upload/" . $unique_image;
    
                    if (move_uploaded_file($file_temp, $this->upload_img)) {
                    } else {
                        $this->upload_img = NULL;
                    }
                }
            }
    
            $query = "INSERT INTO utilisateurs (name, email, password, role, upload_img) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$this->username, $this->email, $this->password, $this->role, $this->upload_img]);
    
            return true;
        } catch (PDOException $e) {
            echo "error " . $e->getMessage();
            return false;
        }
    }
    

  

}

?>