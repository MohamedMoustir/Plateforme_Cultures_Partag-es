
<?php
require_once  "../database/connexion.php";
require_once "../class/class_article.php";

require_once "../auteur/createArticle.php";


$article = new Article();

$id= $_GET['id_article'];
$allarticle= $article->afficherDetailsArticle($id);


if ($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_POST['bt_submit'])) {


    $article = new Article();
    $title = $_POST['title'];
    $content = $_POST['description'];
    $category_id = $_POST['category'];
    $tags = $_POST['tags'];
    $author_id = $_SESSION['id_users']; 
    $upload_img = $_FILES['avatar']; 

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
   

   
    $article->editArticle($title, $content, $category_id, $author_id, $id,$upload_img);

    
    $article->insertArticle_Tags($id, $tags);

  
        // header('location:../auteur/createArticle.php');
   
}


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



<div id="modal" class="fixed inset-0 flex justify-center items-center bg-gray-500  bg-opacity-50 z-50">
    <div class=" scale-[0.85] bg-white p-6 rounded-lg w-96">
        <h2 class="text-2xl font-semibold mb-4">Add New Article</h2>
        <form action="" method="POST" enctype="multipart/form-data">
      
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input value="<?= $allarticle['title']  ?>" type="text" id="title" name="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

         
            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select id="category" name="category" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                <?php
                foreach ($allcategory as $cate) {
                    echo '<option value="' . $cate['CategoryID'] . '">' . $cate['names'] . '</option>';
                }
                ?>
                </select>
            </div>

            <!-- Tags Section -->
    <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
    <select id="tags" name="tags[]" multiple class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <?php
        foreach ($alltags as $tag) {
            echo '<option value="' . $tag['idTag'] . '">' . $tag['nomTag'] . '</option>';
        }
        ?>
    </select>

                <p class="text-xs text-gray-500">

            <!-- Description Section -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required><?= $allarticle['content']  ?></textarea>
            </div>

            <!-- File Upload Section -->
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-700">Upload File</label>
                <input type="file" id="file" name="avatar" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Buttons Section -->
            <div class="flex items-center justify-between">
                <button type="submit" name="bt_submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700">edite Article</button>
                <button type="button" id="closeModal" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-700">Close</button>
            </div>
        </form>
    </div>
</div>


<!-- <script>
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
</script> -->
 </main>
</body>
</html>
