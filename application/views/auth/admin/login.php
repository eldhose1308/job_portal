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
  <link href="<?= base_url() ?>assets/users/images/favicon.ico" rel="shortcut icon" />

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">

  <!-- CSS Global Compulsory (Do not remove)-->
  <link rel="stylesheet" href="<?= base_url() ?>assets/users/css/font-awesome/all.min.css" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/users/css/flaticon/flaticon.css" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/users/css/bootstrap/bootstrap.min.css" />

  <!-- Template Style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/users/css/style.css" />

  <script src='https://www.google.com/recaptcha/api.js'></script>

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
        <a class="navbar-brand" href="<?= base_url() ?>assets/users/index.html">
          <img class="img-fluid" src="<?= base_url() ?>assets/users/images/logo.svg" alt="logo">
        </a>
        <div class="navbar-collapse collapse justify-content-start">
          <ul class="nav navbar-nav">


            <li class="nav-item">
              <a class="nav-link" href="<?= base_url() ?>" role="button">Home</a>
            </li>


            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Listing <i class="fas fa-chevron-down fa-xs"></i>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= base_url() ?>assets/users/job-grid.html">Job Grid</a></li>
                <li><a class="dropdown-item" href="<?= base_url() ?>assets/users/job-listing.html">Job Listing</a></li>
                <li><a class="dropdown-item" href="<?= base_url() ?>assets/users/job-detail.html">Job Detail</a></li>
                <li><a class="dropdown-item" href="<?= base_url() ?>assets/users/job-listing-map.html">Job Listing Map</a></li>
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
          <h2 class="text-primary">Login</h2>
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>"> Home </a></li>
            <li class="breadcrumb-item active"> <i class="fas fa-chevron-right"></i> <span> Login </span></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!--=================================
inner banner -->

  <!--=================================
Signin -->
  <section class="space-ptb">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12">
          <div class="login-register">
            <div class="section-title">
              <h4 class="text-center">Login to Your Account</h4>
            </div>

            <div class="tab-content">
              <div class="tab-pane active" id="login-tab" role="tabpanel">



                <div id="alert-message-div" style="display: none; padding: 0% 3%;">
                </div>

                <?php echo form_open(base_url('admin/save_login'), 'class="mt-4" id="login-forms" autocomplete="off" '); ?>

                <div class="row">
                  <div class="mb-3 col-12">
                    <label class="form-label" for="Email2">Email Address</label>
                    <input type="email" name="user_email" class="form-control" id="user_email">
                  </div>
                  <div class="mb-3 col-12">
                    <label class="form-label" for="password2">Password*</label>
                    <input type="password" name="user_password" class="form-control" id="user_password">
                  </div>

                  <div class="col-12 mt--30 text-center">
                    <div class="check-box">
                      <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div>
                    </div>

                    <span class="text-black"><a class="" onclick="grecaptcha.reset()" id="refresh_button" style="cursor: pointer;color:#96c952">
                        Refresh Captcha
                        <i class="fas fa-sync" aria-hidden="true"></i></a></span>
                  </div>


                </div>
                <div class="row">
                  <div class="col-md-12 p-2">
                    <button class="btn btn-primary btn-100  d-grid" href="<?= base_url() ?>assets/users/#">Sign In</button>
                  </div>

                </div>

                <?php echo form_close(); ?>




              </div>

            </div>

            <div class="mt-4">
              <fieldset>
                <legend class="px-2">Login or Sign up with</legend>
                <div class="social-login">
                  <ul class="list-unstyled d-flex mb-0">


                    <li class="google text-center">
                      <a class="text-white" onclick="alert('You dont have this feature')"> <i class="fab fa-google me-4"></i>Login with Google</a>
                    </li>

                  </ul>
                </div>
              </fieldset>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=================================
Signin -->



  <!--=================================
footer-->
  <footer class="footer bg-light">


    <div class="footer-bottom bg-dark mt-5">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ">
            <div class="d-flex justify-content-md-start justify-content-center">
              <ul class="list-unstyled d-flex mb-0">
                <li><a href="<?= base_url() ?>assets/users/#">Privacy Policy</a></li>
                <li><a href="<?= base_url() ?>assets/users/about.html">About</a></li>
                <li><a href="<?= base_url() ?>assets/users/#">Team</a></li>
                <li><a href="<?= base_url() ?>assets/users/contact-us.html">Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 text-center text-md-end mt-4 mt-md-0">
            <p class="mb-0"> &copy;Copyright <span id="copyright">
                <script>
                  document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                </script>
              </span> <a href="<?= base_url() ?>assets/users/#"> Nexcode </a>-<?= APP_NAME ?> Admin portal . All Rights Reserved </p>

            <span> Page loaded in <?= page_speed() . ' seconds' ?> </span>


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
  <script src="<?= base_url() ?>assets/users/js/jquery-3.6.0.min.js"></script>
  <script src="<?= base_url() ?>assets/users/js/popper/popper.min.js"></script>
  <script src="<?= base_url() ?>assets/users/js/bootstrap/bootstrap.min.js"></script>

  <!-- Template Scripts (Do not remove)-->
  <script src="<?= base_url() ?>assets/users/js/custom.js"></script>
  <script src="<?= base_url() ?>assets/auth/scripts.js"></script>



  <style>
    .internet-connection-status {
      display: none;
      position: fixed;
      background-color: transparent;
      width: 100%;
      height: 32px;
      z-index: 99999;
      text-align: center;
      color: #ffffff;
      bottom: 0;
      left: 0;
      right: 0;
      line-height: 32px;
      font-weight: 700;
      font-size: 12px;
    }
  </style>


</body>

</html>