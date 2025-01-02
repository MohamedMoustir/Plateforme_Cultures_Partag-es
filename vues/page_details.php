<?php  

require_once "../class/class_article.php";
require_once  "../database/connexion.php";

if (isset($_GET['id'])) { 
    $id = $_GET['id'];
    $article = new Article();
   $Detail=$article->afficherDetailsArticle($id);
   var_dump($Detail);
}

 
// if (!isset($_SESSION['role']) || $_SESSION['role'] === null || $_SESSION['role'] === '') {
//     header('Location: ../login.php');
//     exit;
//   }
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

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <div class="container-fluid nav-bar bg-transparent">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
                <a href="index.html" class="navbar-brand d-flex align-items-center text-center">
                    <div class="icon p-2 me-2">
                        <img class="img-fluid" src="../img/icon-deal.png" alt="Icon" style="width: 30px; height: 30px;">
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
        </div>
        <!-- Navbar End -->


        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="display-5 animated fadeIn mb-4">Cultures Partagées</h1> 
                        <nav aria-label="breadcrumb animated fadeIn">
                        <ol class="breadcrumb text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-body active" aria-current="page">Cultures Partagées</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 animated fadeIn">
                    <img class="img-fluid" src="../img/header.jpg" alt="">
                </div>
            </div>
        </div>
        <!-- Header End -->


        <!-- Search Start -->
        <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" class="form-control border-0 py-3" placeholder="Search Keyword">
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0 py-3">
                                    <option selected>Property Type</option>
                                    <option value="1">Property Type 1</option>
                                    <option value="2">Property Type 2</option>
                                    <option value="3">Property Type 3</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0 py-3">
                                    <option selected>Location</option>
                                    <option value="1">Location 1</option>
                                    <option value="2">Location 2</option>
                                    <option value="3">Location 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark border-0 w-100 py-3">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search End -->




<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <div class="bg-white  p-6">
            <!-- Titre de l'article -->
            <h1 class="text-2xl font-bold text-teal-700 mb-4"> <?= $Detail['title']; ?></h1>

            <!-- Image de l'article -->
            <img src="<?= $Detail['image'] ?>" alt="Image de l'article" class="w-full h-96 object-cover rounded-lg mb-4">

            <!-- Auteur -->
            <div class="flex items-center space-x-3 mb-4">
                <div class="flex items-center justify-center w-12 h-12 border-2 border-teal-500 rounded-full">
                    <i class="fa-solid fa-user text-teal-500 text-lg"></i>
                </div>
                <h5 class="text-teal-700 text-lg font-semibold"><?= $Detail['name']; ?></h5>
            </div>

            <p class="text-gray-700 leading-relaxed mb-6"><?= $Detail['content']; ?></p>

            <p class="text-gray-500 text-sm">
                <i class="fa fa-calendar-alt text-teal-500 mr-2"></i>
                <?= $Detail['created_at']; ?>
            </p>

            <div class="flex justify-between items-center mt-4">
                <button class="flex items-center text-teal-500 hover:bg-teal-500 hover:text-white px-4 py-2 rounded-lg transition">
                    <i class="fa-solid fa-thumbs-up mr-2"></i> J’aime
                </button>
                <span class="text-gray-500 text-sm">50 J’aimes</span>
            </div>

            <div class="mt-6">
                <h4 class="text-lg font-semibold text-teal-700 mb-2">Ajouter un commentaire :</h4>
                <textarea rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="Écrivez votre commentaire ici..."></textarea>
                <button class="mt-3 bg-teal-500 text-white px-6 py-2 rounded-lg hover:bg-teal-600 transition">
                    Envoyer
                </button>
            </div>

            <div class="mt-6">
                <h4 class="text-lg font-semibold text-teal-700 mb-4">Commentaires :</h4>
                <div class="border-b border-gray-200 pb-4 mb-4">
                    <p class="text-gray-800">This is a comment.</p>
                    <small class="text-gray-500">
                        <i class="fa fa-user text-teal-500 mr-1"></i>
                        John Doe - January 1, 2025
                    </small>
                </div>
                <div class="border-b border-gray-200 pb-4 mb-4">
                    <p class="text-gray-800">This is another comment.</p>
                    <small class="text-gray-500">
                        <i class="fa fa-user text-teal-500 mr-1"></i>
                        Jane Doe - January 1, 2025
                    </small>
                </div>
            </div>

            <!-- Bouton retour -->
            <a href="index.html" class="mt-4 inline-block bg-teal-500 text-white px-6 py-2 rounded-lg hover:bg-teal-600 transition">
                Retour à la page principale
            </a>
        </div>
    </div>
</body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX Example</title>
    



    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>