

<?php
require_once "../dashorad/dashbord.php";
require_once "../class/class_users.php";



  $users = new utilisateurs;
  $allusers = $users->Allutilisateurs();

  if (isset($_POST['archived']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $article = new utilisateurs();
   $article->archivedUsers($id);
  
  }
  
  if (isset($_POST['Active']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $article = new utilisateurs();
   $article->activeUsers($id);
  
  }
  
//   if (!isset($_SESSION['role']) || $_SESSION['role'] === null || $_SESSION['role'] === '') {
//     header('Location: ../login.php');
//     exit;
//   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <title>DataTable Example</title>
</head>
<body>
<div class="overflow-hidden ml-[340px] ">
    <table id="usersTable" class="w-[80%] divide-y divide-gray-200 shadow-md rounded-lg">
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
                            <?php if ($user->archived == 1): ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                            <?php else: ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="../vues/profile.php?id=<?= $user->utilisateurID ?>" name="eye" class="ml-2 px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none"><i class="fa-solid fa-eye"></i></a>
                            <?php if ($user->role != 'admin'): ?>
                                <button type="submit" name="archived" class="ml-2 px-4 py-2 font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none"><i class="fas fa-archive mr-2"></i></button>
                                <button type="submit" name="Active" class="ml-2 px-4 py-2 font-medium text-white bg-green-600 rounded-md hover:bg-green-500 focus:outline-none"><i class="fas fa-check-circle mr-2"></i></button>
                                <a href="../dashorad/editeRole.php?id=<?= $user->utilisateurID ?>" name="edit" class="ml-2 px-4 py-2 font-medium text-white bg-yellow-500 rounded-md hover:bg-yellow-400 focus:outline-none"><i class="fas fa-edit mr-2"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                </form>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            paging: true,
            searching: true,
            info: true,
            responsive: true,
            columnDefs: [
                { orderable: false, targets: [4] }
            ]
        });
    });
</script>
</body>
</html>




