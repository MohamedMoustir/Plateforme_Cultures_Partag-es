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
    <section class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg mt-12">
    <!-- Profile Header -->
    <div class="flex items-center mb-8">
        <div class="w-32 h-32 rounded-full overflow-hidden mr-6 relative">
            <img src="profile-pic.jpg" alt="Profile Picture" class="w-full h-full object-cover" id="profile-pic">
            <div class="absolute top-0 left-0 w-full h-full bg-gray-500 opacity-0 transition-opacity duration-300" id="overlay"></div>
        </div>
        <div>
            <h2 class="text-3xl font-semibold text-gray-800 mb-2">محمد مستير</h2>
            <p class="text-lg text-gray-600 mb-2">email@example.com</p>
            <p class="text-gray-500 text-sm mb-6">مطور ويب مهتم بالتكنولوجيا والثقافة. هنا لتبادل المعرفة والتعلم.</p>
            <button class="bg-green-500 text-white text-xl font-semibold py-3 px-6 rounded-md shadow-md hover:bg-green-600 transition duration-300 ease-in-out">
                تعديل البروفايل
            </button>
        </div>
    </div>

    <!-- Favorite Articles -->
    <div>
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">مقالاتي المفضلة</h3>
        <ul class="space-y-3">
            <li><a href="#" class="text-blue-500 hover:underline">مقال عن البرمجة</a></li>
            <li><a href="#" class="text-blue-500 hover:underline">مقال عن التصميم</a></li>
            <li><a href="#" class="text-blue-500 hover:underline">مقال عن التسويق الرقمي</a></li>
        </ul>
    </div>
</section>

<script>
    // Get the image element
    const profilePic = document.getElementById("profile-pic");

    // Add event listener for the click event
    profilePic.addEventListener("click", function() {
        // Apply the animation to move the image out of view
        profilePic.classList.toggle("move-out");
        document.getElementById("overlay").classList.toggle("opacity-100");
    });
</script>

<style>
    /* Add CSS transition for the image movement */
    #profile-pic.move-out {
        transform: translateX(200px); /* Move image 200px to the right */
        transition: transform 0.5s ease;
    }

    /* Overlay to cover the image when clicked */
    #overlay {
        transition: opacity 0.3s ease;
    }

    #overlay.opacity-100 {
        opacity: 1; /* Show overlay */
    }
</style>
