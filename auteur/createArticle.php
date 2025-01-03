

<?php
session_start();

require_once "../class/class_article.php";
require_once  "../database/connexion.php";
require_once "../class/class_category.php";

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['btn_submit'])) {
    if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['category'])&& isset($_FILES['avatar'])) {

         $title = $_POST['title'] ;
         $content = htmlspecialchars($_POST['description']) ;
         $category_id = htmlspecialchars($_POST['category']);
         $author_id = $_SESSION['id_users'];
         $image_path = $_FILES['avatar'];
         $article = new Article();
        
   if ($article->createArticle($title,$content,$category_id,$author_id,$image_path)) {
   } 
  }
}

  $article = new Article();
  $email = $_SESSION['email'];
  $articles=$article->afficherArticle($email);



  if (isset($_GET['remove'])) {
  $id = $_GET['remove'];
    $article->removeArticle($id);
  }

  if (isset($_GET['id_article'])) { 
    $id = $_GET['id'];
    $article = new Article();
   $Detail=$article->afficherDetailsArticle($id);

}

$categorys = new Category();
$allcategory = $categorys->afficherCategory();



//   if (!isset($_SESSION['role']) || $_SESSION['role'] === null || $_SESSION['role'] === '') {
//     header('Location: ../login.php');
//     exit;
//   }
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <script src=".././assets/tailwind.js"></script>
</head>

<body>



    
<!-- Side Bar -->
 <div class="fixed top-0 left-0 w-[230px] h-[100%] z-50 overflow-hidden sidebar">
    <a href="#" class="logo text-xl font-bold h-[56px] flex items-center text-[#1976D2] z-30 pb-[20px] box-content">
    <i class="fas fa-blog mr-2 m-5"></i>
        <div class="text-xl font-bold">BlogPlatform</div>
    </a>
   
    <ul class="side-menu w-full mt-12">
            <li class="h-12 bg-transparent ml-2.5 rounded-l-full p-1"><a href="listClients.php"><i class="fa-solid fa-user-group"></i>Clients</a></li>
            <li class="active h-12 bg-transparent ml-2.5 rounded-l-full p-1"><a href="listArticles.php"><i class="fa-solid fa-file-alt"></i>Articles</a></li>
            <li class="h-12 bg-transparent ml-1.5 rounded-l-full p-1"><a href="statistic.php"><i class="fa-solid fa-chart-simple"></i>Statistic</a></li>
    </ul>
    <ul class="side-menu w-full mt-12">
            <li class="h-12 bg-transparent ml-2.5 rounded-l-full p-1">
            <a href="../login.php?logout" class="logout">
                    <i class='bx bx-log-out-circle'></i> Logout
                </a>
            </li>
     </ul>
 </div>
<!-- end sidebar -->

<!-- Content -->
<div class="content">
    <!-- Navbar -->
    <nav class="flex items-center gap-6 h-14 bg-[#f6f6f9] sticky top-0 left-0 z-50 px-6">
            <i class='bx bx-menu'></i>
            <form action="#" class="max-w-[400px] w-full mr-auto">
                <div class="form-input flex items-center h-[36px]">
                    <input class="flex-grow px-[16px] h-full border-0 bg-[#eee] rounded-l-[36px] outline-none w-full text-[#363949]" type="search" placeholder="Search...">
                    <button class="w-[80px] h-full flex justify-center items-center bg-[#1976D2] text-[#f6f6f9] text-[18px] border-0 outline-none rounded-r-[36px] cursor-pointer" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle block min-w-[50px] h-[25px] bg-grey cursor-pointer relative rounded-full"></label>
            <a href="#" class="notif text-[20px] relative">
                <i class='bx bx-bell'></i>
                <span class="count absolute top-[-6px] right-[-6px] w-[20px] h-[20px] bg-[#D32F2F] text-[#f6f6f6] border-2 border-[#f6f6f9] font-semibold text-[12px] flex items-center justify-center rounded-full ">12</span>
            </a>
            <a href="#" class="profile">
                <img class="w-[36px] h-[36px] object-cover rounded-full" width="36" height="36" src=".././assets/image/1054-1728555216-removebg-preview.png">
            </a>
    </nav>
<!-- end nav -->

 <main class="mainn w-full p-[36px_24px] max-h-[calc(100vh_-_56px)]">
 <div class="header flex items-center justify-between gap-[16px] flex-wrap">
 <div class="left">
     <ul class="breadcrumb flex items-center space-x-[16px]">
        <li class="text-[#363949]"><a href="listClients.php">Clients</a></li>
        / <li class="text-[#363949]"><a href="listArticles.php" class="active">Articles</a></li> /
        <li class="text-[#363949]"><a href="statistic.php">Statistic</a></li>
     </ul>
</div>
   <button id="openModal" class="report h-[36px] px-[16px] rounded-[36px] bg-[#1976D2] text-[#f6f6f6] flex items-center justify-center gap-[10px] font-medium">
   <i class="fa-solid fa-plus"></i>
                    <span>Create Article</span>
    </button>
 </div>

 <ul class="insights grid grid-cols-[repeat(auto-fit,_minmax(240px,_1fr))] gap-[24px] mt-[36px]">
                <li>
                 <i class="fa-solid fa-user-group"></i>
                    <span class="info">
                        <h3>10</h3>
                        <p>Clients</p>
                    </span>
                </li>
                <li><i class="fa-solid fas fa-blog "></i>
                    <span class="info">
                        <h3>50</h3> 
                        <p>Article</p>
                    </span>
                </li>
                <li><i class="fa-solid fa-file-signature"></i>
                    <span class="info">
                        <h3>20</h3>
                        <p>Contrats</p>
                    </span>
                </li>
 </ul>

 <div class="bottom-data flex flex-wrap gap-[24px] mt-[24px] w-full">
 <div class="orders flex-grow flex-[1_0_500px]">
 <div class="header flex items-center gap-[16px] mb-[24px]">
 <i class="fas fa-blog mr-2 m-5"></i>
        <h3 class="mr-auto text-[24px] font-semibold">Articles List</h3>
</div>
<!--- tables---->
<table class="w-full border-collapse table-auto">
    <thead>
        <tr>
            <th class="pb-3 px-3 text-sm text-center border-b border-grey">Image</th>
            <th class="pb-3 px-3 text-sm text-center border-b border-grey">Title</th>
            <th class="pb-3 px-3 text-sm text-center border-b border-grey">Category</th>
            <th class="pb-3 px-3 text-sm text-center border-b border-grey">Date</th>
            <th class="pb-3 px-5 text-sm text-center border-b border-grey">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($articles as $article): ?>
    <?php 
        // Gérer l'état des icônes et de l'affichage
        if ($article['status'] == 'pending') {
            $type = 'hidden'; 
            $types = 'block';
            $approved = 'hidden';
        } elseif ($article['status'] == 'rejected') {
            $type = 'block'; 
            $types = 'hidden';
            $approved = 'hidden';
        } elseif ($article['status'] == 'approved') {
            $type = 'hidden';
            $types = 'hidden';
            $approved = 'block'; 
        } else {
            $type = 'hidden'; 
            $types = 'hidden';
            $approved = 'hidden';
        }
    ?>
    <tr>
        <td class="py-4 px-3 text-center">
            <img src="<?= $article['image'] ?>" alt="Article Image" class="w-10 h-10 object-cover rounded-full mx-auto">
        </td>
        <td class="py-4 px-3 text-center"><?= $article['title'] ?></td>
        <td class="py-4 px-3 text-center"><?= $article['names'] ?></td>
        <td class="py-4 px-3 text-center"><?= $article['created_at'] ?></td>
        <td class="py-4 px-3 text-center space-x-4">
            <a href="../auteur/editeArticle.php?id_article=<?= $article['id'] ?>" class="edit-btn">
                <i class='bx bx-edit-alt text-blue-500'></i>
            </a>
            
            <a href="../auteur/createArticle.php?remove=<?= $article['id'] ?>">
                <i class="bx bx-x-circle text-red-600 text-2xl" title="Annulé"></i>
            </a>

            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 animate-[spin_0.8s_linear_infinite] fill-blue-600 <?= $types ?> block mx-auto mt-2"
                viewBox="0 0 24 24">
                <path
                    d="M12 22c5.421 0 10-4.579 10-10h-2c0 4.337-3.663 8-8 8s-8-3.663-8-8c0-4.336 3.663-8 8-8V2C6.579 2 2 6.58 2 12c0 5.421 4.579 10 10 10z"
                    data-original="#000000" />
            </svg>

           
            <span class="<?= $type ?> text-red-600">Refusé</span>
                 
            <span class="<?= $approved ?> text-green-600">Approuvé</span>

        </td>
    </tr>
<?php endforeach; ?>

    </tbody>
</table>
<!-- end tables -->
 </div>
 </div>
 
<!-- Modal Structure -->
<div id="modal" class="fixed inset-0 flex justify-center items-center bg-gray-500 hidden bg-opacity-50  z-50">
    <div class="bg-white p-6 rounded-lg w-96">
        <!-- Image Section -->
      

        <h2 class="text-2xl font-semibold mb-4">Add New Article</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select id="category" name="category" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                <?php
            foreach($allcategory as $cate){
             
                echo '<option value="' . $cate['CategoryID'] . '">' . $cate['names'] . '</option>';
              
            }
          ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
            </div>

            <!-- File Upload Section -->
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-700">Upload File</label>
                <input type="file" id="file" name="avatar" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" name="btn_submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Add Article</button>
                <button type="button" id="closeModal" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-700">Close</button>
            </div>
        </form>
    </div>
</div>


<script>
    // Get modal and buttons
    const openModalButton = document.getElementById("openModal");
    const closeModalButton = document.getElementById("closeModal");
    const modal = document.getElementById("modal");

    // Open modal
    openModalButton.addEventListener("click", function() {
        modal.classList.remove("hidden");
    });

    // Close modal
    closeModalButton.addEventListener("click", function() {
        modal.classList.add("hidden");
    });

    // Close modal if clicked outside the modal content
    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.classList.add("hidden");
        }
    });
</script>
 </main>
</body>
</html>
