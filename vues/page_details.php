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

<style>

.relative:hover .absolute {
    display: flex;
}


.emoji {
    transition: background-color 0.3s;
}

</style>

<div class="flex flex-wrap">
  <!-- Left Section -->
  <div class="w-full sm:w-8/12 mb-10 px-6 sm:px-10">
    <div class="container mx-auto h-full">
      <nav class="flex justify-between items-center py-6">
        <div class="text-4xl font-bold text-gray-800">
        Cultures <span class="text-green-700">.</span>
        </div>
        <div>
          <img src="https://image.flaticon.com/icons/svg/497/497348.svg" alt="" class="w-8">
        </div>
      </nav>
      <header class="lg:flex mt-12 items-center">
        <div class="w-full lg:w-8/12">
          <h1 class="text-4xl lg:text-5xl font-semibold text-gray-800 leading-tight mb-4">Partageons la Culture <span class="text-green-700"><?= $Detail['names']; ?></span></h1>
          <div class="w-20 h-2 bg-green-700 mb-6"></div>
          <p class="text-lg mb-10 text-gray-600"><?= $Detail['content']; ?></p>
          <button class="bg-green-500 text-white text-xl font-semibold py-3 px-6 rounded-md shadow-md hover:bg-green-600 transition duration-300 ease-in-out">Explore Our Collection</button>
        </div>
      </header>

      <!-- Likes, Comments, and Jim Section -->
      <div class="mt-8 flex justify-between items-center text-gray-600">
    <!-- Likes Button with Emoji Picker -->
    <div class="relative flex items-center space-x-4">
        <!-- Button -->
        <form method="POST" class="flex justify-between items-center mt-6">
                <button type="submit" name="like" class="flex items-center text-teal-500 hover:bg-teal-500 hover:text-white px-6 py-3 rounded-full transition">
                    <i class="fac fa-solid fa-thumbs-up mr-3"></i><?= $likeExists ?> J’aime
                </button>
            </form>
        
        <!-- Emoji Picker (Hidden by Default) -->
        <div class="absolute top-[100%] left-0 hidden group-hover:flex flex-row bg-white border rounded-lg shadow-lg p-2 space-x-2">
            <i onclick="getLike('fa-solid fa-thumbs-up  mr-3 text-xl')" class="fa-solid fa-thumbs-up text-xl hover:text-teal-500 cursor-pointer transition"></i>
            <i onclick="getLike('fa-solid fa-heart  mr-3 text-xl')" class="fa-solid fa-heart text-xl hover:text-red-500 cursor-pointer transition"></i>
            <i onclick="getLike('fa-solid fa-face-grin-beam mr-3 text-xl')" class="fa-solid fa-face-grin-beam text-xl hover:text-yellow-500 cursor-pointer transition"></i>
            <i onclick="getLike('fa-solid fa-surprise  mr-3 text-xl')" class="fa-solid fa-surprise text-xl hover:text-blue-500 cursor-pointer transition"></i>
            <i onclick="getLike('fa-solid fa-face-sad-tear  mr-3 text-xl')" class="fa-solid fa-face-sad-tear text-xl hover:text-gray-500 cursor-pointer transition"></i>
        </div>
    </div>
</div>



      <!-- Category and Description Section -->
      <div class="mt-12">
        <div class="flex items-center space-x-6">
        

          <!-- Category Title -->
         
        </div>

      </div>

      <!-- Comment Section -->
      <div class="mt-12">
        <h4 class="text-xl font-semibold text-teal-700 mb-4">Add a Comment:</h4>
        <form method="POST" class="flex flex-col space-y-4">
          <!-- Textarea for Comment -->
          <textarea name="comment_text" rows="4" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 mb-4" placeholder="Write your comment here..."></textarea>

          <!-- Submit Button with Icon -->
          <button type="submit" name="comment" class="flex items-center bg-teal-500 text-white px-6 py-3 rounded-lg hover:bg-teal-600 transition">
            <i class="fa fa-paper-plane mr-3"></i> Submit Comment
          </button>
        </form>
      </div>

      <!-- Existing Comments -->
      <div class="mt-8">
        <h4 class="text-xl font-semibold text-teal-700 mb-6">Comments:</h4>
        <div class="space-y-4">
          <!-- Example Comment -->
          <div class="border-b border-gray-200 pb-4">
            <p class="text-gray-800">This plant is beautiful! It looks amazing in my living room.</p>
            <small class="text-gray-500">
              <i class="fa fa-user text-teal-500 mr-1"></i>
              John Doe - January 1, 2025
            </small>
          </div>
          <div class="border-b border-gray-200 pb-4">
            <p class="text-gray-800">Love the variety of plants offered here. Great selection!</p>
            <small class="text-gray-500">
              <i class="fa fa-user text-teal-500 mr-1"></i>
              Jane Doe - January 1, 2025
            </small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Right Side Image -->
  <div class="w-full sm:w-4/12">
    <img src="<?= $Detail['image'] ?>" alt="Leafs" class="w-full h-48 object-cover sm:h-screen sm:w-full rounded-lg shadow-lg">
  </div>
</div>









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
<script>

document.querySelectorAll('.emoji').forEach(emoji => {
    emoji.addEventListener('click', (event) => {
        const selectedEmoji = event.target.textContent;
        alert(`You selected: ${selectedEmoji}`);
     
     
    });
     

});
      function getLike(iconClass) {
    const mainButtonIcon = document.querySelector('.fac'); 
    mainButtonIcon.className = iconClass; 
}

</script>
</html>