
<?php

require_once "../auteur/createArticle.php"
?> 
<!-- Modal Structure -->
<div id="modal" class="fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50  z-50">
    <div class="bg-white p-6 rounded-lg w-96">
        <!-- Image Section -->
      

        <h2 class="text-2xl font-semibold mb-4">Add New Article</h2>
        <form action="" method="POST" enctype="multipart/form-data">
       
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input value="<?= $Detail['title'] ?>" type="text" id="title" name="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select value="<?= $Detail['category_id'] ?>" id="category" name="category" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="1">Technology</option>
                    <?php foreach($allcategory as $cate){
             
             echo '<option value="' . $cate['CategoryID'] . '">' . $cate['names'] . '</option>';
           
         }
       ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea value="<?= $Detail['content'] ?>" id="description" name="description" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
            </div>

            <!-- File Upload Section -->
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-700">Upload File</label>
                <input value="<?= $Detail['content'] ?>" type="file" id="file" name="avatar" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
           
            <div class="flex items-center justify-between">
                <button type="submit" name="edit_submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Add Article</button>
                <a href="../auteur/createArticle.php" type="button" id="closeModal" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-700">Close</a>
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
