<?php
require_once "../dashorad/dashbord.php";
require_once "../class/class_tags.php";

$afficherTags = new tags();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $alltags = $afficherTags->afficherTagsById($id);
}
if (isset($_POST['submit_btn'])) {
   $idTag = $_POST['idTag'];
   $nomTag = $_POST['nomTag'];

    $afficherTags->SetId($idTag);
    $afficherTags->SetNom($nomTag);
    $afficherTags->EditeRoleUsers($nomTag,$idTag);
    
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tag</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css">
</head>
<body>
    !<?php 
    // include '../dashorad/table_tag.php';
    ?>

<div class="fixed inset-0 z-[9999] flex items-center justify-center bg-gray-800 bg-opacity-50">
    <div class="bg-white shadow-lg rounded-lg p-8 w-[90%] sm:w-[400px]">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Edit Tag</h2>

        <form action="" method="POST">

            <input type="hidden" name="idTag" value="<?= $alltags['idTag'] ?>">

            <div class="mb-4">
                <label for="nomTag" class="block text-gray-700 font-medium">Tag Name</label>
                <input type="text" id="nomTag" value="<?= $alltags['nomTag'] ?>" name="nomTag"  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="flex justify-center mt-6">
                <button type="submit" name="submit_btn" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-700 flex items-center transition-colors duration-300">
                    <i class="fas fa-save mr-2"></i> Save Changes
                </button>
            </div>
        </form>

        <div class="text-center mt-4">
            <a href="../dashorad/table_tag.php" class="text-blue-500 hover:text-blue-700 transition-colors duration-300">Back to Tags</a>
        </div>
    </div>
</div>


</body>
</html>
