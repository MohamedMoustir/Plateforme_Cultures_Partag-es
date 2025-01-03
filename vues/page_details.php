<?php  
session_start();
require_once "../class/class_article.php";
require_once  "../database/connexion.php";
require_once "../class/class_likes";
if (isset($_GET['id'])) { 
    $id = $_GET['id'];
    $article = new Article();
   $Detail=$article->afficherDetailsArticle($id);
 
}

 
// if (!isset($_SESSION['role']) || $_SESSION['role'] === null || $_SESSION['role'] === '') {
//     header('Location: ../login.php');
//     exit;
//   }
  $like = new likes();
if (isset($_POST['like'])) {
    $id_user = $_SESSION['id_users'];
    $id_article = $_GET['id'];
    $like->addlikes($id_user, $id_article);

}
$id_article = $_GET['id'];
$likeExists = $like->Getlike($id_article);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Makaan - Real Estate HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <!-- Article Title -->
            <h1 class="text-3xl font-bold text-teal-700 mb-6"><?= $Detail['title']; ?></h1>

            <!-- Article Image -->
            <img src="<?= $Detail['image'] ?>" alt="Image de l'article" class="w-full h-96 object-cover rounded-lg mb-6 shadow-md">

            <!-- Author Info -->
            <div class="flex items-center space-x-3 mb-6">
                <div class="flex items-center justify-center w-14 h-14 border-4 border-teal-500 rounded-full">
                    <i class="fa-solid fa-user text-teal-500 text-xl"></i>
                </div>
                <h5 class="text-teal-700 text-xl font-semibold"><?= $Detail['name']; ?></h5>
            </div>

            <!-- Article Content -->
            <p class="text-gray-700 leading-relaxed mb-6"><?= $Detail['content']; ?></p>

            <p class="text-gray-500 text-sm mb-6">
                <i class="fa fa-calendar-alt text-teal-500 mr-2"></i>
                <?= $Detail['created_at']; ?>
            </p>

            <!-- Like Button -->
            <form method="POST" class="flex justify-between items-center mt-6">
                <button type="submit" name="like" class="flex items-center text-teal-500 hover:bg-teal-500 hover:text-white px-6 py-3 rounded-full transition">
                    <i class="fa-solid fa-thumbs-up mr-3"></i> J’aime
                </button>
                <span class="text-gray-500 text-sm"><?= $likeExists ?> J’aimes</span>
            </form>

            <!-- Comment Section -->
            <div class="mt-8">
                <h4 class="text-xl font-semibold text-teal-700 mb-4">Ajouter un commentaire :</h4>
                <textarea rows="3" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 mb-4" placeholder="Écrivez votre commentaire ici..."></textarea>
                <button class="bg-teal-500 text-white px-6 py-3 rounded-lg hover:bg-teal-600 transition">
                    Envoyer
                </button>
            </div>

            <!-- Existing Comments -->
            <div class="mt-8">
                <h4 class="text-xl font-semibold text-teal-700 mb-6">Commentaires :</h4>
                <div class="space-y-4">
                    <div class="border-b border-gray-200 pb-4">
                        <p class="text-gray-800">This is a comment.</p>
                        <small class="text-gray-500">
                            <i class="fa fa-user text-teal-500 mr-1"></i>
                            John Doe - January 1, 2025
                        </small>
                    </div>
                    <div class="border-b border-gray-200 pb-4">
                        <p class="text-gray-800">This is another comment.</p>
                        <small class="text-gray-500">
                            <i class="fa fa-user text-teal-500 mr-1"></i>
                            Jane Doe - January 1, 2025
                        </small>
                    </div>
                </div>
            </div>

            <!-- Back to Main Page Button -->
            <a href="index.php" class="mt-6 inline-block bg-teal-500 text-white px-6 py-3 rounded-lg hover:bg-teal-600 transition">
                Retour à la page principale
            </a>
        </div>
    </div>
</body>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX Example</title>
    



    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>