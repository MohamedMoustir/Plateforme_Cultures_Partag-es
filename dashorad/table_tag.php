


<?php 

require_once "../dashorad/dashbord.php";
require_once "../class/class_tags.php";

$afficherTags = new tags();
$alltags = $afficherTags->afficherTags();


if (isset($_GET['delete'])) {

    $id = $_GET['delete'];
   $afficherTags->removetag($id);
  }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
<table class="ml-[340px] border-collapse w-[75%] bg-white shadow-lg rounded-lg">
    <thead class="bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-white">
        <tr>
            <th class="p-3 font-bold uppercase border border-gray-300 text-center">ID</th>
            <th class="p-3 font-bold uppercase border border-gray-300 text-center">Name</th>
            <th class="p-3 font-bold uppercase border border-gray-300 text-center">Actions</th>
        </tr>
    </thead>
    <?php foreach($alltags as $tag): ?>
    <tbody>
        <tr class="bg-white hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">ID</span>
                <?= $tag['idTag'] ?>
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Name</span>
                <?= $tag['nomTag'] ?>
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
            <a href="../dashorad/editetags.php?id=<?= $tag['idTag'] ?>" class="text-green-500 hover:text-green-700 font-medium underline">
                    <i class="fas fa-edit"></i> 
                </a>
                <a href="../dashorad/table_tag.php?delete=<?= $tag['idTag'] ?>" class="text-red-500 hover:text-red-700 font-medium underline pl-6">
                    <i class="fas fa-trash-alt"></i> 
                </a>
            </td>
        </tr>
    </tbody>
    <?php endforeach; ?>
</table>



