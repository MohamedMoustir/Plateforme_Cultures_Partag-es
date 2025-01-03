

<?php 
require_once "../dashorad/dashbord.php";
require_once "../class/class_category.php";

$categorys = new Category();
$allcategory = $categorys->afficherCategory();


if (isset($_GET['delet'])) {
    $id = $_GET['delet'];
      $categorys->removeCategory($id);
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
 
              <!-- component -->
<table class="ml-[340px] border-collapse w-[75%]">
    <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">CategoryID</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Category</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Actions</th>
        </tr>
    </thead>
    <?php foreach($allcategory as $category): ?>
    <tbody>
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Company name</span>
                <?= $category['CategoryID'] ?>
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Country</span>
                <?= $category['names'] ?>
            </td>
          	
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                <a href="../dashorad/afficheCategory.php?edite=<?= $category['CategoryID']   ?>" class="text-blue-400 hover:text-blue-600 underline">Edit</a>
                <a href="../dashorad/afficheCategory.php?delet=<?= $category['CategoryID']   ?>" class="text-blue-400 hover:text-blue-600 underline pl-6">Remove</a>
            </td>
        </tr>
       
    </tbody>
    <?php endforeach; ?>
</table>
            
</section>

</body>
</html>