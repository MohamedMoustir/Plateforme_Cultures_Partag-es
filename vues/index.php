

<?php
session_start();
require_once "../class/class_article.php";
require_once  "../database/connexion.php";
require_once "../class/class_category.php";
require_once "../class/class_likes.php";
require_once "../class/class_Comments.php";
require_once "../class/class_favorites.php";


 $article = new Article();

 if (isset($_POST['CategoryID'])) {
    $id = htmlspecialchars($_POST['CategoryID']);
    header('Location: ../vues/index.php?page-nr=1&category=' . $id);
    exit(); 
}



 $articleapproved=$article->afficherArticleApproved();
 $pages = $article->pages;

 
 $categorys = new Category();
 $allcategory = $categorys->afficherCategory();

 if (!isset($_SESSION['role']) || $_SESSION['role'] === '' || $_SESSION['role'] !== 'user') {
    header('Location: ../login.php');
    exit;
}


if (isset($_GET['AddTofavorites'])) {
    $favorites = new favorites();
    $id_users = $_SESSION['id_users'];
    $id_article = $_GET['AddTofavorites'] ;
    $favorites->insertfavoritesArticle($id_users,$id_article);
}
var_dump($_SESSION['id_users'], $_GET['AddTofavorites']);

// $to = "itsmoustir@gmail.com";
// $subject = "My subject";
// $message = "Hi Moustir";
// $headers = "From: your-email@example.com" . "\r\n" .
//            "Reply-To: your-email@example.com" . "\r\n" .
//            "X-Mailer: PHP/" . phpversion();

// if (mail($to, $subject, $message, $headers)) {
//     echo "Email sent successfully!";
// } else {
//     echo "Failed to send the email.";
// }
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
</style>
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
            <form method="POST" action="" class="container">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" class="form-control border-0 py-3" placeholder="Search Keyword">
                            </div>
                            <div class="col-md-4">
                                <select name="CategoryID" class="form-select border-0 py-3">
                                <option value="">All Category</option>
                                   <?php foreach($allcategory as $cate){
                                    
                                        echo '<option value = "' . $cate['CategoryID'] . '">' . $cate['names'] . '</option>';
                                    
                                    }
                                         ?>
                                   
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
                        <button type ="submit" class="btn btn-dark border-0 w-100 py-3">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Search End -->
   

        <!-- Property List Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-0 gx-5 align-items-end">
                    <div class="col-lg-6">
                    <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
    <h1 class="mb-3">Explore Our Cultural Articles</h1>
    <p>Discover a wide range of articles covering various aspects of art and culture. Whether you're interested in painting, music, literature, or cinema, you'll find content that inspires and educates.</p>
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
                         <form action="../vues/index.php?AddTofavorites=<?= $article['id']; ?>" method="POST">
                        <button type="submit" class="absolute  top-3 right-3 text-white hover:text-red-500 text-2xl transition-all duration-300"
                                onclick="toggleFavorite(<?= $article['id']; ?>)">
                            <i class="fa-regular fa-heart " id="heart-icon-<?= $article['id']; ?>"></i>
                        </button>
                        </form>
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



                    
    <ul class="flex mt-8 space-x-5 justify-center font-[sans-serif]">

      <li class="flex items-center justify-center shrink-0 bg-gray-100 w-10 h-10 rounded-full">
        <a href="?page-nr=<?= max(1, (isset($_GET['page-nr']) ? $_GET['page-nr'] : 0) - 1) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-300" viewBox="0 0 55.753 55.753">
          <path
            d="M12.745 23.915c.283-.282.59-.52.913-.727L35.266 1.581a5.4 5.4 0 0 1 7.637 7.638L24.294 27.828l18.705 18.706a5.4 5.4 0 0 1-7.636 7.637L13.658 32.464a5.367 5.367 0 0 1-.913-.727 5.367 5.367 0 0 1-1.572-3.911 5.369 5.369 0 0 1 1.572-3.911z"
            data-original="#000000" />
        </svg>
    </a>
      </li>  
         <?php for ( $count = 1 ; $count <= $pages ; $count++ ):?>
      <li
        class="flex items-center justify-center shrink-0 bg-blue-500  border-2 border-blue-500 cursor-pointer text-base font-bold text-white w-10 h-10 rounded-full">
        <?= $count?>
      </li>
      <?php endfor;?>
      <li class="flex items-center justify-center shrink-0 hover:bg-gray-50 border-2 cursor-pointer w-10 h-10 rounded-full">
      
      <a onclick="loadData()" href="?page-nr=<?= min($pages,(isset($_GET['page-nr']) ? $_GET['page-nr'] : 0) + 1) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-400 rotate-180" viewBox="0 0 55.753 55.753">
          <path
            d="M12.745 23.915c.283-.282.59-.52.913-.727L35.266 1.581a5.4 5.4 0 0 1 7.637 7.638L24.294 27.828l18.705 18.706a5.4 5.4 0 0 1-7.636 7.637L13.658 32.464a5.367 5.367 0 0 1-.913-.727 5.367 5.367 0 0 1-1.572-3.911 5.369 5.369 0 0 1 1.572-3.911z"
            data-original="#000000" />
        </svg>
        </a>
      </li>
    </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <script>
        function loadData(){
            let myRequest = new XMLHttpRequest();
            myRequest.onreadstatechange = function(){
                if (this.readyState === 4 && this.status === 200) {
                    console.log(this.responseText);
                }
            };
            myRequest.open('GET',"?page-nr=mohamed",true);
            myRequest.send();
        }
        
        </script>

        <!-- Call to Action Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="bg-light rounded p-3">
                    <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3)">
                        <div class="row g-5 align-items-center">
                            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                                <img class="img-fluid rounded w-100" src="../img/call-to-action.jpg" alt="">
                            </div>
                            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                                <div class="mb-4">
                                    <h1 class="mb-3">Contact With Our Certified Agent</h1>
                                    <p>Eirmod sed ipsum dolor sit rebum magna erat. Tempor lorem kasd vero ipsum sit sit diam justo sed vero dolor duo.</p>
                                </div>
                                <a href="" class="btn btn-primary py-3 px-4 me-2"><i class="fa fa-phone-alt me-2"></i>Make A Call</a>
                                <a href="" class="btn btn-dark py-3 px-4"><i class="fa fa-calendar-alt me-2"></i>Get Appoinment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call to Action End -->
        

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Get In Touch</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a class="btn btn-link text-white-50" href="">About Us</a>
                        <a class="btn btn-link text-white-50" href="">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="">Our Services</a>
                        <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Photo Gallery</h5>
                        <div class="row g-2 pt-2">
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-1.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="../img/property-2.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="../img/property-3.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="../img/property-4.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="../img/property-5.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="../img/property-6.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Newsletter</h5>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved. 
							
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
      
    
<!-- Popup Modal -->
<div id="popup" class="fixed inset-0 flex items-center justify-end bg-gray-500 bg-opacity-50 opacity-0 pointer-events-none transition-all duration-500 z-[9999]">
<div class="bg-white">
    <div class="container mx-auto py-8">
        <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
            <!-- Profile Section -->
            <div class="col-span-4 sm:col-span-3">
                <div class=" shadow rounded-lg p-6">
                    <div class="flex flex-col items-center">
                        <img src="https://randomuser.me/api/portraits/men/94.jpg" class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0" alt="John Doe">
                        <h1 class="text-xl font-bold">John Doe</h1>
                        <p class="text-gray-700">Software Developer</p>
                        <div class="mt-6 flex flex-wrap gap-4 justify-center">
                            <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Contact</a>
                            <a href="#" class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded">Resume</a>
                        </div>
                    </div>
                    <hr class="my-6 border-t border-gray-300">
                    <div class="flex flex-col">
                        <span class="text-gray-700 uppercase font-bold tracking-wider mb-2">Skills</span>
                        <ul>
                            <li class="mb-2">JavaScript</li>
                            <li class="mb-2">React</li>
                            <li class="mb-2">Node.js</li>
                            <li class="mb-2">HTML/CSS</li>
                            <li class="mb-2">Tailwind CSS</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- About and Experience Section -->
            <div class="col-span-4 sm:col-span-9">
    <div class="shadow rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">About Me</h2>
        <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed finibus est vitae tortor ullamcorper, ut vestibulum velit convallis. Aenean posuere risus non velit egestas suscipit. Nunc finibus vel ante id euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam erat volutpat. Nulla vulputate pharetra tellus, in luctus risus rhoncus id.</p>

        <h3 class="font-semibold text-center mt-3 -mb-2">Find me on</h3>
        <div class="flex justify-center items-center gap-6 my-6">
            <!-- Social Media Icons -->
            <a href="#" class="text-gray-700 hover:text-orange-600" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-6">
                    <path fill="currentColor" d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"></path>
                </svg>
            </a>
            <!-- Add other social media icons as needed -->
        </div>

        <!-- Experience Section -->
        <h2 class="text-xl font-bold mt-6 mb-4">Experience</h2>
        <div class="mb-6">
            <div class="flex justify-between flex-wrap gap-2 w-full">
                <span class="text-gray-700 font-bold">Web Developer</span>
                <p><span class="text-gray-700 mr-2">at ABC Company</span><span class="text-gray-700">2017 - 2019</span></p>
            </div>
            <p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed finibus est vitae tortor ullamcorper, ut vestibulum velit convallis. Aenean posuere risus non velit egestas suscipit.</p>
        </div>

        <!-- Additional Experience Entries can be added similarly -->
    </div>
</div>
</div>
</div>
</div>
</div>


<script>
  
    const profilePic = document.getElementById("profile-pic");
    const popup = document.getElementById("popup");
    const closePopupButton = document.getElementById("close-popup");
    const popupContent = document.getElementById("popup-content");

    
    profilePic.addEventListener("click", function() {
        popup.classList.remove("opacity-0", "pointer-events-none");
        popup.classList.add("opacity-100", "pointer-events-auto");
        popupContent.classList.remove("translate-x-full");
        popupContent.classList.add("translate-x-0");
    });

  
    closePopupButton.addEventListener("click", function() {
        popup.classList.remove("opacity-100", "pointer-events-auto");
        popup.classList.add("opacity-0", "pointer-events-none");
        popupContent.classList.remove("translate-x-0");
        popupContent.classList.add("translate-x-full");
    });
</script>

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