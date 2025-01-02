

<?php
require_once "../dashorad/dashbord.php";
require_once "../class/class_users.php";



  $users = new utilisateurs;
  $allusers = $users->Selectutilisateurs();

  if (isset($_POST['archived']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $article = new utilisateurs();
   $article->archivedUsers($id);
  
  }
  
  
//   if (!isset($_SESSION['role']) || $_SESSION['role'] === null || $_SESSION['role'] === '') {
//     header('Location: ../login.php');
//     exit;
//   }
?>

<div class="overflow-hidden">
    <table class="ml-[340px] w-[80%] divide-y divide-gray-200 shadow-md rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach($allusers as $user): ?>
                <form action="users.php?id=<?php echo $user->utilisateurID ?>" method="POST">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap"><?= $user->name ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $user->email ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $user->role ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php  if ($user->archived == 1) {?>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                        </td>   <?php }?>
                        <?php  if ($user->archived == 0) {?>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">this</span>
                        </td>   <?php }?>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button type="submit" name="archived" class="ml-2 px-4 py-2 font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:shadow-outline-red active:bg-red-600 transition duration-150 ease-in-out">Delete</button>
                        </td>
                    </tr>
                </form>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
