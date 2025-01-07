

<?php
session_start();
require_once "../class/class_article.php";
require_once  "../database/connexion.php";
require_once "../class/class_category.php";
require_once "../class/class_likes.php";
require_once "../class/class_Comments.php";
require_once "../class/class_favorites.php";


 $article = new favorites();
 $email = $_SESSION['email'];
 $articleapproved=$article->SelectFavoritesArticle($email);

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

    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>
<style>
       #popup {
        transition: opacity 0.5s ease, pointer-events 0s 0.5s;
    }

    #popup-content {
        transition: transform 0.5s ease;
    }



        .favorite-btn {
            background-color: #ffcc00;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .favorite-btn:hover {
            background-color: #ffaa00;
        }

        .favorite {
            background-color: #f0f0f0;
        }
    </style>

</head>

<!-- Navbar Start -->
<div class="container-fluid nav-bar bg-transparent  ">
    <nav class="navbar  navbar-expand-lg bg-white navbar-light py-0 px-4">
        <a href="index.html" class="navbar-brand d-flex align-items-center text-center">
            <div class="icon p-2 me-2">
                <!-- Resized the image size -->
                <img class="img-fluid" src="../img/icon-deal.png" alt="Icon" style="width: 20px; height: 20px;">
            </div>
            <h1 class="m-0 text-primary">Makaan</h1>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="index.html" class="nav-item nav-link">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Property</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="property-list.html" class="dropdown-item active">Cultures Partagées</a>
                        <a href="property-type.html" class="dropdown-item">Property Type</a>
                        <a href="property-agent.html" class="dropdown-item">Property Agent</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="404.html" class="dropdown-item">404 Error</a>
                    </div>
                </div>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
            <a href="" class="btn btn-primary px-3 d-none d-lg-flex">Add Property</a>
        </div>
    </nav>
    <form method="POST" action="../login.php?logout" class="d-flex justify-content-end p-2" style="position: absolute; top: 15%; right: 5%;">
        <button type="submit" name="logout" class="bg-primary text-white p-2 rounded">Logout</button>
        <!-- Profile image next to logout button -->
        <a href="#" class="profile ml-3" id="profile-pic">
            <img class="w-[36px] h-[36px] object-cover rounded-full" width="36" height="36" src="../upload/ef47b5d601.jpg" alt="Profile Picture">
        </a>
    </form>
</div>
<body class="bg-gray-100 font-sans">

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-teal-700 mb-6">Favorite Articles</h1>
         <!-- Property List Start -->
         <div class="container-xxl py-5">
            <div class="container">
 <!-- Property List Start -->
 <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-0 gx-5 align-items-end">
                    <div class="col-lg-6">
                    <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
    <h1 class="mb-3">Explore Our Favorite Cultural Articles</h1>
    <p>Découvrez des articles captivants sur l'art et la culture, soigneusement choisis pour inspirer et enrichir vos connaissances.</p>
</div>
                    </div>
                    

                    <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                        <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-primary active" data-bs-toggle="pill" href="#tab-1">Featured</a>
                            </li>
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-2">For Sell</a>
                            </li>
                            <li class="nav-item me-0">
                                <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-3">For Rent</a>
                            </li>
                        </ul>
                    </div>
                </div>
               

                <div class="tab-content">
    <div id="tab-1" class="tab-pane fade show p-0 active">
        <div class="row g-4">
            <?php foreach ($articleapproved as $article): 
                $like = new likes();
                $id_article = $article['id'];
                $likeExists = $like->Getlike($id_article);

                $Comments = new Comments();
                $id_article = $article['id'];
                $CommitExists = $Comments->CountCommit($id_article);
            ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="property-item rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 bg-white">
                    <div class="relative overflow-hidden">
                        <a href="#">
                            <img class="w-full h-64 object-cover transition-transform duration-300 transform hover:scale-110"
                                 src="<?= htmlspecialchars($article['image']); ?>" alt="Property Image">
                        </a>
                         
                        <div class="absolute top-4 left-4 bg-teal-500 text-white text-xs font-medium py-1 px-3 rounded-lg shadow-md">
                            <?= htmlspecialchars($article['title']); ?>
                        </div>
                        <div class="absolute bottom-4 left-4 bg-white text-teal-500 text-xs font-medium py-1 px-3 rounded-lg shadow-md">
                            <?= htmlspecialchars($article['names']); ?>
                        </div>
                    </div>

                    <div class="p-4">
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="flex items-center justify-center w-10 h-10 border-2 border-teal-500 rounded-full">
                                <i class="fa-solid fa-user text-teal-500 text-lg"></i>
                            </div>
                            <h5 class="text-teal-700 text-sm font-medium">
                                <?= htmlspecialchars($article['name']); ?>
                            </h5>
                        </div>
                        <a href="#"
                           class="text-gray-800 text-lg font-semibold hover:text-teal-500 transition-colors duration-200 block">
                           <?= htmlspecialchars($article['content']); ?>
                        </a>
                        <p class="text-gray-600 text-sm mt-2 flex items-center">
                            <i class="fa fa-calendar-alt text-teal-500 mr-2"></i>
                            <?= "Publié le " . date("d M Y", strtotime($article['created_at'])); ?>
                        </p>
                    

                        <div class="flex items-center mt-3">
                            <span class="text-yellow-500">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half-alt"></i>
                                <i class="fa-regular fa-star"></i>
                            </span>
                            <span class="ml-2 text-gray-500 text-sm">(4.5)</span>
                        </div>

                        <div class="flex justify-between items-center text-gray-500 text-sm mt-3">
                            <div class="flex items-center space-x-2">
                                <i class="fa-solid fa-thumbs-up text-teal-500"></i>
                                <span class=""><?= $likeExists ?> J’aime</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fa-solid fa-comments"></i>
                                <span><?= $CommitExists ?> commentaires</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center p-4 border-t border-gray-200 bg-gray-50">
                        <a href="../vues/page_details.php?id=<?= $article['id']; ?>" target="_blank" 
                           class="text-teal-500 hover:text-teal-700 text-sm font-semibold hover:underline transition-all duration-300">
                            Lire la suite
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            
        </div>
    </div>
</div>





                    
            </div>
                    </div>
                </div>
            </div>
        </div>
    

     
    </div>

 

</body>
</html>
