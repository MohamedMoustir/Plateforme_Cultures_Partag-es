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
                <form method="post" action="./src/singup.php" class="space-y-6">
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
                            <option value="utilisateur">Utilisateur</option>
                        </select>
                    </div>

                    <button 
                        type="submit"
                        name="signup" 
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
        // Add fade-in animation when page loads
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelector('.fade-in').classList.add('active');
        });

        // Add hover animation for form inputs
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('focused');
            });
            input.addEventListener('blur', () => {
                input.parentElement.classList.remove('focused');
            });
        });
    </script>
</body>
</html>