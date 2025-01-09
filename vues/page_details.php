<?php  
session_start();
require_once "../class/class_article.php";
require_once  "../database/connexion.php";
require_once "../class/class_likes.php";
require_once "../class/class_Comments.php";

if (isset($_GET['id'])) { 
    $id = $_GET['id'];
    $article = new Article();
   $Detail=$article->afficherDetailsArticle($id);
 
}

 

  $like = new likes();
if (isset($_POST['like'])) {
    $id_user = htmlspecialchars($_SESSION['id_users']);
    $id_article = htmlspecialchars($_GET['id']);
    $like->addlikes($id_user, $id_article);

}

$id_article = $_GET['id'];
$likeExists = $like->Getlike($id_article);


$comment = new Comments();
if (isset($_POST['comment'])|| isset($_POST['comment_text'])) {
    $id_user = htmlspecialchars($_SESSION['id_users']);
    $id_article = htmlspecialchars($_GET['id']);
    $comment_text = htmlspecialchars($_POST['comment_text']);
    $comment->addComment($id_user, $id_article,$comment_text);

}

$id_article = $_GET['id'];
 $allcomment =$comment->SelectComment($id_article);
 
 if (!isset($_SESSION['role']) || $_SESSION['role'] === '' || $_SESSION['role'] !== 'user') {
  header('Location: ../login.php');
  exit;
}


// require_once '../vendor/autoload.php'; 
// $pdf = new \Mpdf\Mpdf(); 
// $html = file_get_contents('vues\page_details.php');
// $pdf->WriteHTML($html);
// $pdf->Output('page_details.pdf', 'D');

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


<style>

      .relative:hover .absolute {
          display: flex;
      }


      .emoji {
          transition: background-color 0.3s;
      }

</style>




<div class="flex flex-wrap"  id="mybilling">
  <!-- Left Section -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   <div class="w-full sm:w-8/12 mb-10 px-6 sm:px-10">
    <div class="container mx-auto h-full">
      <nav class="flex justify-between items-center py-6">
        <div class="text-4xl font-bold text-gray-800">
        Cultures <span class="text-green-700">.</span>
        </div>
        <div class="flex items-center space-x-4">
    <a href="index.php" class="text-teal-500 hover:text-teal-700 font-semibold px-4 py-2 border border-teal-500 rounded-md hover:bg-teal-100 transition duration-200">
    Accueil
    </a>
          <img src="https://image.flaticon.com/icons/svg/497/497348.svg" alt="" class="w-8">
        </div>
      </nav>
      

   <header class="lg:flex mt-12 items-center">
    <div class="w-full lg:w-8/12">
        <h1 class="text-4xl lg:text-5xl font-semibold text-gray-800 leading-tight mb-4">Partageons la Culture <span class="text-green-700"><?= $Detail['names']; ?></span></h1>
        <div class="w-20 h-2 bg-green-700 mb-6"></div>
        <p class="text-lg mb-10 text-gray-600"><?= $Detail['content']; ?></p>
        <div class="mt-3">
    <!-- Tags section -->
    <div class="tags space-x-3 mb-2">
    <?php foreach ($Detail['tags'] as $tag) {
    echo '<span class="inline-block text-teal-800   rounded-full text-sm font-semibold">#' . htmlspecialchars($tag) . '</span>';
    } ?>

          </div>
      </div>
          </div>
      </header>


      <!-- Likes, Comments, and Jim Section -->
      <div class="mt-8 flex justify-between items-center text-gray-600">
    <!-- Likes Button with Emoji Picker -->
    <div class="relative flex items-center space-x-4">
        <!-- Button -->
        <form method="POST" class="flex justify-between items-center mt-6">
        <button type="submit" name="like" class="flex items-center text-teal-500 hover:bg-teal-500 hover:text-white px-6 py-3 rounded-full border-2 border-teal-500 hover:border-transparent transition duration-300">
    <i class="fas fa-thumbs-up mr-3"></i><?= $likeExists ?> J’aime
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


<div class="flex items-center mt-3">
    <span class="text-yellow-500">
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star-half-alt"></i>
        <i class="fa-regular fa-star"></i>
    </span>
    <span class="ml-2 text-gray-500 text-sm">(4.5)</span>
</div>

      <!-- Category and Description Section -->
      <div class="mt-12">
        <div class="flex items-center space-x-6">
        

       
         
        </div>

      </div>

      <!-- Comment Section -->
      <div class="mt-12">
        <h4 class="text-xl font-semibold text-teal-700 mb-4">Add a Comment:</h4>
        <form method="POST" class="flex flex-col space-y-4">
          <!-- Textarea for Comment -->
          <input name="comment_text" rows="4" class="w-full h-[100px] p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 mb-4" placeholder="Write your comment here..."></input>

          <!-- Submit Button with Icon -->
          <button type="submit" name="comment" class="flex items-center bg-teal-500 text-white px-6 py-3 rounded-lg hover:bg-teal-600 transition">
            <i class="fa fa-paper-plane mr-3"></i> Submit Comment
          </button>
        </form>
      </div>
      <!-- <button class="text-red-500 hover:text-red-700 text-sm font-semibold py-1 px-3 rounded-lg border border-red-500 hover:bg-red-50 transition duration-200" onclick="printeArticle()">print</button> -->

      <!-- Existing Comments -->
      <div class="mt-8">
        <h4 class="text-xl font-semibold text-teal-700 mb-6">Comments:</h4>
        <div class="space-y-4">
          
        <?php foreach($allcomment as $comment) : ?>
<div class="border-b border-gray-200 pb-4 px-6 flex items-start space-x-4">

    <i class="fas fa-user-circle text-4xl text-teal-500"></i>

    <div class="flex-1">
        <p class="text-gray-800 font-semibold text-lg"><?= $comment->name ?></p>
        <p class="text-gray-600 text-sm"><?= date("d M Y", strtotime($comment->comment_date)); ?></p>

        <p class="text-gray-800 mt-2" id="comment-text"><?= $comment->comment_text ?></p>
    </div>
    <!-- <button class="text-red-500 hover:text-red-700 text-sm font-semibold py-1 px-3 rounded-lg border border-red-500 hover:bg-red-50 transition duration-200" onclick="printeArticle()">print</button> -->

    <?php  if ($_SESSION['id_users'] == $Detail['id']){ ?>
    <div class="ml-4 space-x-2">
        <button class="text-teal-500 hover:text-teal-700 text-sm font-semibold py-1 px-3 rounded-lg border border-teal-500 hover:bg-teal-50 transition duration-200" onclick="editComment()">Edit</button>
        <button class="text-red-500 hover:text-red-700 text-sm font-semibold py-1 px-3 rounded-lg border border-red-500 hover:bg-red-50 transition duration-200" onclick="removeComment()">Remove</button>
    </div>
    <?php }?>
</div>
<?php endforeach ?>

        </div>
      </div>
     
    </div>
  </div>

  <!-- Right Side Image -->
  <div class="w-full sm:w-4/12">
    <img src="<?= $Detail['image'] ?>" alt="Leafs" class="w-full h-48 object-cover sm:h-screen sm:w-full rounded-lg shadow-lg">
  </div>
</div>
<!-- <button class="text-red-500 hover:text-red-700 text-sm font-semibold py-1 px-3 rounded-lg border border-red-500 hover:bg-red-50 transition duration-200" onclick="generatePDF()">Generate PDF</button> -->











<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://unpkg.com/html2pdf.js@0.9.2/dist/html2pdf.bundle.js"></script>

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

//   document.querySelectorAll('.emoji').forEach(emoji => {
//       emoji.addEventListener('click', (event) => {
//           const selectedEmoji = event.target.textContent;
//           alert(`You selected: ${selectedEmoji}`);
      
      
//       });
      

//   });
//         function getLike(iconClass) {
//     const mainButtonIcon = document.querySelector('.fac'); 
//     mainButtonIcon.className = iconClass; 

//     function printeArticle(){
//       let divcontent = document.getElementById('');
//         }
// }


</script>
</html>