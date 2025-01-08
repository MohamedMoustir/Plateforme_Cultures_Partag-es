




<?php
session_start();

require_once "../class/class_users.php"; 
require_once  "../database/connexion.php";

$utilisateurs = new utilisateurs(); 
if (isset($_GET['id'])) {
    $utilisateurID = $_GET['id'];
}else {
    $utilisateurID = $_SESSION['id_users'];
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upt_submit'])) {

 $username = $_POST['firstName'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 $phone = $_POST['phone'];
 $bio = $_POST['bio'];
 $address = $_POST['address'];
 $birthday = $_POST['date'];
 if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    $upload_img = $_FILES['avatar']; 
} else {
    $upload_img = null;  
}


 $utilisateurs->UpdateUsers($username, $email, $password, $phone, $bio, $address, $birthday,$upload_img, $utilisateurID);

}

$user = $utilisateurs->Selectutilisateurs($utilisateurID);


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
   <!-- component -->
<style>
    :root {
        --main-color: #4a76a8;
    }

    .bg-main-color {
        background-color: var(--main-color);
    }

    .text-main-color {
        color: var(--main-color);
    }

    .border-main-color {
        border-color: var(--main-color);
    }
</style>
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>



<div class="bg-gray-100 ">
 <div class="w-full text-white bg-main-color">
        <div x-data="{ open: false }"
            class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
            <div class="p-4 flex flex-row items-center justify-between">
                <a href="#"
                    class="text-lg font-semibold tracking-widest uppercase rounded-lg focus:outline-none focus:shadow-outline">
                    profile</a>
                <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                        <path x-show="!open" fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                        <path x-show="open" fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
          
            <nav :class="{'flex': open, 'hidden': !open}"
                class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row">
                <div @click.away="open = false" class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex flex-row items-center space-x-2 w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent hover:bg-blue-800 md:w-auto md:inline md:mt-0 md:ml-4 hover:bg-gray-200 focus:bg-blue-800 focus:outline-none focus:shadow-outline">
                        
                        <span><?= $user->name ?></span>
                        <img class="inline h-6 rounded-full"
                            src="<?= $user->upload_img ?>">
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}"
                            class="inline w-4 h-4 transition-transform duration-200 transform">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                        <div class="py-2 bg-white text-blue-800 text-sm rounded-sm border border-main-color shadow-sm">
                        <?php  if (!isset($_GET['id']) || empty($_GET['id'])) {?>
 <a class="block px-4 py-2 mt-2 text-sm bg-white md:mt-0 focus:text-gray-900 hover:bg-indigo-100 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                            href="index.php">Home</a>
                           
                        <?php }else{?>
                            <a class="block px-4 py-2 mt-2 text-sm bg-white md:mt-0 focus:text-gray-900 hover:bg-indigo-100 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                href="../dashorad/users.php">dashbord</a>
                        <?php } ?>
                            <a class="block px-4 py-2 mt-2 text-sm bg-white md:mt-0 focus:text-gray-900 hover:bg-indigo-100 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                href="#">Help</a>
                            <div class="border-b"></div>
                            <a class="block px-4 py-2 mt-2 text-sm bg-white md:mt-0 focus:text-gray-900 hover:bg-indigo-100 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                href="#">Logout</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- End of Navbar -->

    <div class="container mx-auto my-5 p-5">
    <div class="md:flex no-wrap md:-mx-2">
        <!-- Left Side -->
        <div class="w-full md:w-3/12 md:mx-2">
            <!-- Profile Card -->
            <div class="bg-white p-3 border-t-4 border-green-400">
    <div class="image overflow-hidden">
        <img class="h-auto w-full mx-auto" src="<?= $user->upload_img ?>" alt="">
    </div>
    <h1 class="text-gray-900 font-bold text-xl leading-8 my-1"><?= $user->name ?></h1>
    <h3 class="text-gray-600 font-lg text-semibold leading-6"><?= $user->bio ?></h3>
    <p class="text-sm text-gray-500 hover:text-gray-600 leading-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, eligendi dolorum sequi illum qui unde aspernatur non deserunt</p>
    <ul class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
        <li class="flex items-center py-3">
            <span>Status</span>
            <span class="ml-auto"><span class="bg-green-500 py-1 px-2 rounded text-white text-sm">Active</span></span>
        </li>
        <li class="flex items-center py-3">
            <span>Member since</span>
            <span class="ml-auto"><?=  date("d M Y", strtotime($user->created_date));?></span>
        </li>
    </ul>
</div>

            <!-- End of profile card -->
        <div class="my-4"></div>
          
        </div>
        <!-- Right Side -->
        <div class="w-full md:w-9/12 mx-2 h-64">
            <!-- Profile tab -->
         
 <div class="bg-white p-3 shadow-sm rounded-sm">
    <!-- About Section -->
    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
        <span class="text-green-500">
            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </span>
        <span class="tracking-wide">About</span>
    </div>
   
    <div class="text-gray-700">
        <div class="grid md:grid-cols-2 text-sm">
            <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">Full Name</div>
                <div class="px-4 py-2"><?= htmlspecialchars($user->name) ?></div>
            </div>
            
            <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">password</div>
                <div class="px-4 py-2">***********</div>
            </div>
            <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">Current Address</div>
                <div class="px-4 py-2"><?= $user->address ? $user->address : '123 Main Street, Suite 456' ?></div>
            </div>
            <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">Email</div>
                <div class="px-4 py-2">
                    <a class="text-blue-800" href="mailto:jane@example.com"><?= htmlspecialchars($user->email) ?></a>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">Birthday</div>
                <div class="px-4 py-2"><?= $user->birthday? $user->birthday : '08 ex 2025'  ?></div>
            </div>
        </div>
       
    </div>
    <button class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">Show Full Information</button>
</div>

<hr>

<?php 



if (!isset($_GET['id']) || empty($_GET['id'])) {
 
   
?>

 
<form method="POST" class="bg-white p-6 shadow-lg rounded-lg" enctype="multipart/form-data">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Update Your Information</h2>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="firstName" class="text-gray-700">First Name</label>
            <input type="text" id="firstName" name="firstName" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?= $user->name ?>">
        </div>
        <div>
            <label for="email" class="text-gray-700">Email</label>
            <input type="email" id="email" name="email" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?= $user->email ?>">
        </div>
        <div>
            <label for="phone" class="text-gray-700">Phone</label>
            <input type="text" id="phone" name="phone" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?= $user->phone ?>">
        </div>
        <div>
            <label for="password" class="text-gray-700">Password</label>
            <input type="text" id="password" name="password" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="">
        </div>
        
        <div>
            <label for="date" class="text-gray-700">Birthday</label>
            <input type="date" id="date" name="date" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?= $user->birthday ?>">
        </div>
        <div>
            <label for="address" class="text-gray-700">Address</label>
            <input type="text" id="address" name="address" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?= $user->address ?>">
        </div>
        <div class="col-span-2">
            <label for="bio" class="text-gray-700">Bio</label>
            <textarea id="bio" name="bio" rows="4" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= $user->bio ?></textarea>
        </div>
        
        <!-- Image Upload -->
        <div class="col-span-2">
            <label for="avatar" class="text-gray-700">Profile Picture</label>
            <input type="file" id="avatar" name="avatar" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
    </div>
    
    <button type="submit" name="upt_submit" class="mt-4 w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 focus:outline-none">Update Information</button>
</form>

<?php }?>

    </div>
</div>

</div> 
