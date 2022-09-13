<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= APP_NAME ?> | Login</title>

    <!-- Favicon -->
    <link href="<?= BASE_URL ?>assets/users/images/favicon.ico" rel="shortcut icon" />

    <!-- Google Font -->
    <link href="<?= BASE_URL ?>assets/users/https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">

    <!-- CSS Global Compulsory (Do not remove)-->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/users/css/font-awesome/all.min.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/users/css/flaticon/flaticon.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/users/css/bootstrap/bootstrap.min.css" />

    <!-- Template Style -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/users/css/style.css" />

</head>

<body>


    <!--=================================
header -->
    <header class="header bg-dark">
        <nav class="navbar navbar-static-top navbar-expand-lg header-sticky">
            <div class="container-fluid">
                <button id="nav-icon4" type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <a class="navbar-brand" href="<?= BASE_URL ?>assets/users/index.html">
                    <img class="img-fluid" src="<?= BASE_URL ?>assets/users/images/logo.svg" alt="logo">
                </a>
                <div class="navbar-collapse collapse justify-content-start">
                    <ul class="nav navbar-nav">


                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>" role="button">Home</a>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Listing <i class="fas fa-chevron-down fa-xs"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>assets/users/job-grid.html">Job Grid</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>assets/users/job-listing.html">Job Listing</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>assets/users/job-detail.html">Job Detail</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>assets/users/job-listing-map.html">Job Listing Map</a></li>
                            </ul>
                        </li>



                    </ul>
                </div>

            </div>
        </nav>
    </header>
    <!--=================================
  header -->


    <!--=================================
inner banner -->
    <div class="header-inner bg-light text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-primary">404 Error</h2>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a></li>
                        <li class="breadcrumb-item active"> <i class="fas fa-chevron-right"></i> <span>404 Error</span></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--=================================
inner banner -->

    <!--=================================
404 error -->
    <section class="space-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <img class="img-fluid" src="<?= BASE_URL ?>assets/users/images/error-img.png" alt="">
                </div>
                <div class="col-lg-6 col-md-6 mt-4 mt-sm-0 text-center">
                    <div id="notfound">
                        <div class="notfound">
                            <div class="notfound-404">
                                <h1>Oops!</h1>
                            </div>
                            <h2>404 - Page not found</h2>
                            <p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
                            <a class="btn btn-primary" href="<?= BASE_URL ?>">Go To Homepage</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=================================
404 error -->


    <!--=================================
footer-->
    <footer class="footer bg-light">


        <div class="footer-bottom bg-dark mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="d-flex justify-content-md-start justify-content-center">
                            <ul class="list-unstyled d-flex mb-0">
                                <li><a href="<?= BASE_URL ?>assets/users/#">Privacy Policy</a></li>
                                <li><a href="<?= BASE_URL ?>assets/users/about.html">About</a></li>
                                <li><a href="<?= BASE_URL ?>assets/users/#">Team</a></li>
                                <li><a href="<?= BASE_URL ?>assets/users/contact-us.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 text-center text-md-end mt-4 mt-md-0">
                        <p class="mb-0"> &copy;Copyright <span id="copyright">
                                <script>
                                    document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                                </script>
                            </span> <a href="<?= BASE_URL ?>assets/users/#"> Nexcode </a>-<?= APP_NAME ?> Admin portal . All Rights Reserved </p>



                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--=================================
footer-->




    <!--=================================
Back To Top-->
    <div id="back-to-top" class="back-to-top">
        <i class="fas fa-angle-up"></i>
    </div>
    <!--=================================
Back To Top-->


    <!--=================================
  Javascript -->
    <!-- JS Global Compulsory (Do not remove)-->
    <script src="<?= BASE_URL ?>assets/users/js/jquery-3.6.0.min.js"></script>
    <script src="<?= BASE_URL ?>assets/users/js/popper/popper.min.js"></script>
    <script src="<?= BASE_URL ?>assets/users/js/bootstrap/bootstrap.min.js"></script>

    <!-- Template Scripts (Do not remove)-->
    <script src="<?= BASE_URL ?>assets/users/js/custom.js"></script>

</body>

</html>