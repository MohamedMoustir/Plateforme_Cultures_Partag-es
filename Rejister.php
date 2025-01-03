
<?php
require_once  "./database/connexion.php";
require_once   "class/class_rejister.php";

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['btn_submit'])) {
  if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
       $username = $_POST['name'] ;
       $email = $_POST['email'] ;
       $password = $_POST['password'];
       $role = $_POST['role'];

   $register = new Register();
   $register->insertUtilisateurs($username, $email, $password, $role);
if ($register) {
    header('location:login.php');
    exit();
}
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - BlogPlatform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#22BAA0',
                        secondary: '#34425A',
                        neutral: '#B0B0B0',
                    }
                }
            }
        }
    </script>
    <style>
        .fade-in {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .fade-in.active {
            opacity: 1;
        }

        .adminicons{
            position: relative;
            left: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-left: 40px;
            cursor: pointer;
            transition: all 0.5s ease;
        }
        .adminicons:hover{
            transform: scale(1.02);
        }

        .adminicons i{
            font-size: 16px;
            background-color: #22BAA0;
            padding: 14px;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .adminicons h5{
            margin-top: 0;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-size: 10px;
        }

        .login-form {
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .input-group {
            transition: all 0.3s ease;
        }

        .input-group:focus-within {
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-gray-100">

<div id="alert-2" class="fixed hidden top-4 right-4 z-50 flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 shadow-lg transform transition duration-300 ease-in-out scale-100 hover:scale-105" role="alert">
  <svg class="flex-shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
  </svg>
  <span class="sr-only">Error</span>
  <div id="alert" class="ml-3 text-sm font-medium">Incorrect password.</div>
  <button onclick="hideAlert()" type="button" class="ml-4 -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" aria-label="Close">
    <span class="sr-only">Close</span>
    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
    </svg>
  </button>
</div>
    <!-- Navigation -->
    <nav class="bg-secondary text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <a href="blog.php"><div class="flex items-center cursor-pointer">
                    <i class="fas fa-blog mr-2"></i>
                    <h1 class="text-xl font-bold">BlogPlatform</h1>
                </div></a>
                
                <div class="hidden items-center space-x-4 " >
                    <button id="loginBtn" class="text-neutral hover:text-white">
                       <a href="./signin.php"><i class="fas fa-sign-in-alt mr-1"></i>Login</a> 
                    </button>
                    <button id="registerBtn" class="bg-primary text-white px-4 py-2 rounded hover:bg-opacity-90">
                       <a href="./singup.php"><i class="fas fa-user-plus mr-1"></i>Sign Up</a> 
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sign Up Form -->
    <div class="max-w-md mx-auto px-4 py-16">
        <div class="login-form bg-white rounded-lg shadow-md overflow-hidden fade-in active">
            <!-- Form Header -->
            <div class="bg-secondary p-6">
                <h2 class="text-2xl text-white font-bold flex items-center">
                    <i class="fas fa-user-plus mr-3"></i>
                    Create an Account
                </h2>
            </div>

            <!-- Form Body -->
            <div class="p-6 space-y-6">
                <form method="POST" action="" class="space-y-6">
                    <div class="input-group">
                        <label class="block text-secondary mb-2">
                            <i class="fas fa-user mr-2"></i>Full Name
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-primary transition-colors"
                            placeholder="Enter your full name"
                        >
                    </div>

                    <div class="input-group">
                        <label class="block text-secondary mb-2">
                            <i class="fas fa-envelope mr-2"></i>Email Address
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-primary transition-colors"
                            placeholder="Enter your email"
                        >
                    </div>

                    <div class="input-group">
                        <label class="block text-secondary mb-2">
                            <i class="fas fa-lock mr-2"></i>Password
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-primary transition-colors"
                            placeholder="Create a password"
                        >
                    </div>

                    <div class="input-group">
                        <label class="block text-secondary mb-2">
                            <i class="fas fa-user-tag mr-2"></i>Role
                        </label>
                        <select 
                            name="role" 
                            required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-primary transition-colors"
                        >
                            <option value="" disabled selected>Select your role</option>
                            <option value="auteur">Auteur</option>
                            <option value="user">Utilisateur</option>
                        </select>
                    </div>

                    <button 
                        type="submit"
                        name="btn_submit" 
                        class="w-full bg-primary text-white py-3 rounded-lg hover:bg-opacity-90 transition-all duration-200 flex items-center justify-center"
                    >
                        <i class="fas fa-user-plus mr-2"></i>
                        Create Account
                    </button>

                    <div class="text-center text-neutral">
                        Already have an account? 
                        <a href="signin.php" class="text-primary hover:underline">
                            Login here
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
       
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelector('.fade-in').classList.add('active');
        });

        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('focused');
            });
            input.addEventListener('blur', () => {
                input.parentElement.classList.remove('focused');
            });
        });


        function showAlert(message) {
        const alert = document.getElementById('alert-2');
        const alertText = document.getElementById('alert');
        alertText.textContent = message;
        alert.classList.remove('hidden');
    }

     function hideAlert() {
                    const alert = document.getElementById('alert-2');
                    alert.classList.add('hidden');
                }

                const form = document.querySelector('form');
                form.addEventListener('submit', (e) => {
                
                    let isValid = true;
                    let errorMessage = '';

                    const email = document.querySelector('input[name="email"]').value;
                    const password = document.querySelector('input[name="password"]').value;

                    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                    if (!emailRegex.test(email)) {
                        isValid = false;
                        errorMessage += 'Invalid email format.\n';
                    }

                    const passwordRegex = /^.*$/;
                    if (!passwordRegex.test(password)) {
                        isValid = false;
                        errorMessage += 'Password must be at least 8 characters, include uppercase, lowercase, number, and special character.\n';
                    }

                    if (!isValid) {
                        showAlert(errorMessage);
                    } else {
                        
                        form.submit();
                    }
            });

    </script>
</body>
</html>