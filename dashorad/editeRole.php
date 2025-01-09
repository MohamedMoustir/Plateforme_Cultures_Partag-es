<?php  
require_once "../dashorad/users.php";
require_once "../class/class_rejister.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_GET['id'];
    $role = $_POST['role'];
    
    $register = new Register();
    $register->EditeRoleUsers($userId, $role);
}

?>

<div id="popupForm" class=" fixed inset-0 z-[9999] flex items-center justify-center bg-gray-800 bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Edit User Role</h3>
        
    
        <form id="roleForm" class="space-y-4" action="" method="POST" >
            <div>
                <label for="userId" class="block text-sm font-medium text-gray-700">User ID</label>
                <input type="text" id="userId" name="userId" value="<?=  $_GET['id']; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" readonly>
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select id="role" name="role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="user">user</option>
                    <option value="admin">Admin</option>
                    <option value="auteur">Author</option>
                </select>
            </div>

            <div>
                <button type="submit" id="submit" class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out">
                    <i class="fas fa-save mr-2"></i> Save Changes
                </button>
            </div>
        </form>

        <!-- Close Button -->
        <div class="mt-4 flex justify-end">
            <a href="../dashorad/users.php" id="closePopup" class="px-4 py-2 font-medium text-white bg-gray-600 rounded-md hover:bg-gray-500 focus:outline-none focus:shadow-outline-gray active:bg-gray-700 transition duration-150 ease-in-out">
                Close
            </a>
        </div>
    </div>
</div>


