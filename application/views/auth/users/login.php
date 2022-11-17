<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="msapplication-TileColor" content="#0E0E0E">
  <meta name="template-color" content="#0E0E0E">
  <meta name="msapplication-config" content="browserconfig.xml">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">

  <link rel="manifest" href="manifest.json" crossorigin>
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/users/imgs/template/favicon.svg">
  <link href="<?= base_url() ?>assets/users/css/style.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src='https://www.google.com/recaptcha/api.js'></script>

  <title><?= APP_NAME ?> | Login </title>

</head>

<body>
  <div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
      <div class="preloader-inner position-relative">
        <div class="text-center"><img src="<?= base_url() ?>assets/users/imgs/template/loading.gif" alt="Nexcode"></div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="ModalApplyJobForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content apply-job-form">
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-body pl-30 pr-30 pt-50">
          <div class="text-center">
            <p class="font-sm text-brand-2">Job Application </p>
            <h2 class="mt-10 mb-5 text-brand-1 text-capitalize">Start your career today</h2>
            <p class="font-sm text-muted mb-30">Please fill in your information and send it to the employer. </p>
          </div>
          <form class="login-register text-start mt-20 pb-30" action="#">
            <div class="form-group">
              <label class="form-label" for="input-1">Full Name *</label>
              <input class="form-control" id="input-1" type="text" required="" name="fullname" placeholder="Steven Job">
            </div>
            <div class="form-group">
              <label class="form-label" for="input-2">Email *</label>
              <input class="form-control" id="input-2" type="email" required="" name="emailaddress" placeholder="stevenjob@gmail.com">
            </div>
            <div class="form-group">
              <label class="form-label" for="number">Contact Number *</label>
              <input class="form-control" id="number" type="text" required="" name="phone" placeholder="(+01) 234 567 89">
            </div>
            <div class="form-group">
              <label class="form-label" for="des">Description</label>
              <input class="form-control" id="des" type="text" required="" name="Description" placeholder="Your description...">
            </div>
            <div class="form-group">
              <label class="form-label" for="file">Upload Resume</label>
              <input class="form-control" id="file" name="resume" type="file">
            </div>
            <div class="login_footer form-group d-flex justify-content-between">
              <label class="cb-container">
                <input type="checkbox"><span class="text-small">Agree our terms and policy</span><span class="checkmark"></span>
              </label><a class="text-muted" href="page-contact.html">Lean more</a>
            </div>
            <div class="form-group">
              <button class="btn btn-default hover-up w-100" type="submit" name="login">Apply Job</button>
            </div>
            <div class="text-muted text-center">Do you need support? <a href="page-contact.html">Contact Us</a></div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <header class="header sticky-bar">
    <div class="container">
      <div class="main-header">
        <div class="header-left">
          <div class="header-logo"><a class="d-flex" href="<?= base_url() ?>"><img alt="jobBox" src="<?= base_url() ?>assets/users/imgs/template/jobhub-logo.svg"></a></div>
        </div>
        <div class="header-nav">
          <nav class="nav-main-menu">
            <ul class="main-menu">

              <li><a href="<?= base_url() ?>">Home</a></li>
              <li><a href="<?= base_url() ?>about_us">About us</a></li>

              <li><a href="<?= base_url() ?>jobs">Jobs</a></li>

              <li><a href="<?= base_url() ?>contact_us">Contact us</a></li>

            </ul>
          </nav>
          <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
        </div>
        <div class="header-right">
          <div class="block-signin">

            <?php if ($this->session->has_userdata('user_login_status')) : ?>

              <a class="text-link-bd-btom hover-up" href="<?= base_url() ?>users/profile"><?= ss('user_name') ?></a>
              <a class="btn btn-default btn-shadow ml-40 hover-up" href="<?= base_url() ?>users/logout"> Sign out <i class="fa fa-sign-out"></i></a>

            <?php else : ?>

              <a class="text-link-bd-btom hover-up text-white" href="<?= base_url() ?>users/register">Register</a>
              <a class="btn btn-default btn-shadow ml-40 hover-up" href="<?= base_url() ?>users/login"> Sign in <i class="fa fa-sign-in"></i></a>

            <?php endif; ?>

          </div>
        </div>
      </div>
    </div>
  </header>




  <div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
    <div class="mobile-header-wrapper-inner">
      <div class="mobile-header-content-area">
        <div class="perfect-scroll">

          <div class="mobile-menu-wrap mobile-header-border">
            <!-- mobile menu start-->
            <nav>
              <ul class="mobile-menu font-heading">
                <li><a href="<?= base_url() ?>">Home</a></li>
                <li><a href="<?= base_url() ?>about_us">About us</a></li>

                <li><a href="<?= base_url() ?>jobs">Jobs</a></li>

                <li><a href="<?= base_url() ?>contact_us">Contact us</a></li>


              </ul>
            </nav>
          </div>
          <div class="mobile-account">
            <h6 class="mb-10">Your Account</h6>
            <ul class="mobile-menu font-heading">


              <?php if ($this->session->has_userdata('user_login_status')) : ?>

                <li><a href="<?= base_url() ?>users/profile">Profile</a></li>
                <li><a href="<?= base_url() ?>users/logout">Sign Out</a></li>

              <?php else : ?>

                <li><a href="<?= base_url() ?>users/register">Register</a></li>
                <li><a href="<?= base_url() ?>users/login">Sign in</a></li>

              <?php endif; ?>



            </ul>
          </div>
          <div class="site-copyright">Copyright 2022 &copy; Nexcode.</div>
        </div>
      </div>
    </div>
  </div>

  <div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
    <div class="mobile-header-wrapper-inner">
      <div class="mobile-header-content-area">
        <div class="perfect-scroll">

          <div class="mobile-menu-wrap mobile-header-border">
            <!-- mobile menu start-->
            <nav>
              <ul class="mobile-menu font-heading">

                <li><a href="<?= base_url() ?>">Home</a></li>
                <li><a href="<?= base_url() ?>about_us">About us</a></li>

                <li><a href="<?= base_url() ?>jobs">Jobs</a></li>

                <li><a href="<?= base_url() ?>contact_us">Contact us</a></li>


              </ul>
            </nav>
          </div>
          <div class="mobile-account">
            <h6 class="mb-10">Your Account</h6>
            <ul class="mobile-menu font-heading">

              <?php if ($this->session->has_userdata('user_login_status')) : ?>

                <li><a href="<?= base_url() ?>users/profile">Profile</a></li>
                <li><a href="<?= base_url() ?>users/logout">Sign Out</a></li>

              <?php else : ?>

                <li><a href="<?= base_url() ?>users/register">Register</a></li>
                <li><a href="<?= base_url() ?>users/login">Sign in</a></li>

              <?php endif; ?>

            </ul>
          </div>
          <div class="site-copyright">Copyright 2022 &copy; Nexcode.</div>
        </div>
      </div>
    </div>
  </div>



  <main class="main">
    <section class="pt-55 login-register">
      <div class="container">
        <div class="row login-register-cover">
          <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">
            <div class="text-center">
              <p class="font-sm text-brand-2">Welcome back! </p>
              <h2 class="mt-10 mb-5 text-brand-1">Member Login</h2>
              <p class="font-sm text-muted mb-30">Access to all features. No credit card required.</p>
              <a href="<?= $googleAuth ?>" class="btn social-login hover-up mb-20">
                <img src="<?= base_url() ?>assets/users/imgs/template/icons/icon-google.svg" alt="Nexcode"><strong>Sign in with Google</strong>
              </a>
              <div class="divider-text-center"><span>Or continue with</span></div>
            </div>


            <?php echo form_open(base_url('users/save_login'), 'class="login-register text-start mt-20" id="login-forms" autocomplete="off" '); ?>


            <!--print error messages-->
            <?php if ($this->session->flashdata('error_msg')) : ?>

              <div class="alert alert-danger alert-dismissable">
                <?= $this->session->flashdata('error_msg') ?>
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

            <?php endif; ?>


            <div id="alert-message-div" style="display: none; padding: 0% 3%;">
            </div>

            <div class="form-group">
              <label class="form-label" for="input-1">Email address *</label>
              <input class="form-control" id="user_email" value="<?= ($this->input->get('_') ? $this->input->get('_') : '') ?>" type="email" required="" name="user_email" placeholder="abc@gmail.com">
            </div>
            <div class="form-group">
              <label class="form-label" for="input-4">Password *</label>
              <input class="form-control" id="user_password1" type="password" required="" name="user_password" placeholder="************">
            </div>

            <div class="form-group">
              <label class="form-label" for="input-4">Captcha *</label>

              <div class="col-12 mt--30 text-center">
                <div class="check-box">
                  <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div>
                </div>
                <span class="text-black"><a class="" onclick="grecaptcha.reset()" id="refresh_button" style="cursor: pointer;color:#96c952">
                    Refresh Captcha
                    <i class="fas fa-sync" aria-hidden="true"></i></a></span>
              </div>
            </div>

            <div class="login_footer form-group d-flex justify-content-between">
              <label class="cb-container">
                <input type="checkbox"><span class="text-small">Remember me</span><span class="checkmark"></span>
              </label><a class="text-muted" href="<?= base_url() ?>users/forgot_password">Forgot Password</a>
            </div>

            <div class="progress mb-3 progress-lg" style="display: none;">
              <div class="progress-bar bg-custom" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
              </div>
            </div>

            <div class="form-group">
              <button class="btn btn-brand-1 hover-up w-100 login-btn" name="login">Login</button>
            </div>
            <div class="text-muted text-center">Don't have an Account? <a href="<?= base_url() ?>users/register">Sign up</a></div>


            <?php echo form_close(); ?>




          </div>
          <div class="img-1 d-none d-lg-block"><img class="shape-1" src="<?= base_url() ?>assets/users/imgs/page/login-register/img-4.svg" alt="Nexcode"></div>
          <div class="img-2"><img src="<?= base_url() ?>assets/users/imgs/page/login-register/img-3.svg" alt="Nexcode"></div>
        </div>
      </div>
    </section>
  </main>
  <footer class="footer mt-50">
    <div class="container">
      <div class="row">

        <div class="footer-col-6 col-md-6 col-sm-12"><a href="index.html"><img alt="jobBox" src="<?= base_url() ?>assets/users/imgs/template/jobhub-logo.svg"></a>
          <div class="mt-20 mb-20 font-xs color-text-paragraph-2">
            Amore Holidays Tours And Travels is a reliable name in the industry as we aim to deliver the best experience to their customers. </div>
          <ul>

            <li>
              <a class="text-custom" href="tel:7558055198"> <i class="fa fa-phone mr-5"></i> 7558055198</a> <br>
            </li>
            <li><a class="text-custom" href="mailto:support@amoreholidayz.com"> <i class="fa fa-envelope mr-1"></i> support@amoreholidayz.com</a>
            </li>

          </ul>

          <div class="footer-social mt-15"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-twitter" href="#"></a><a class="icon-socials icon-linkedin" href="#"></a></div>
        </div>

        <div class="footer-col-2 col-md-2 col-xs-6">
          <h6 class="mb-20">Resources</h6>
          <ul class="menu-footer">
            <li><a href="<?= base_url() ?>about_us">About us</a></li>
            <li><a href="<?= base_url() ?>jobs">Careers</a></li>
            <li><a href="<?= base_url() ?>contact_us">Contact</a></li>
          </ul>
        </div>


        <div class="footer-col-2 col-md-2 col-xs-6">
          <h6 class="mb-20">More</h6>
          <ul class="menu-footer">
            <li><a href="<?= base_url() ?>privacy_policy">Privacy</a></li>
            <li><a href="<?= base_url() ?>terms">Terms</a></li>
            <li><a href="<?= base_url() ?>faqs">FAQ</a></li>
          </ul>
        </div>





      </div>
      <div class="footer-bottom mt-50">
        <div class="row">
          <div class="col-md-6"><span class="font-xs color-text-paragraph">Copyright &copy; 2022. Nexcode all right reserved</span></div>
          <div class="col-md-6 text-md-end text-start">
          </div>
        </div>
      </div>
    </div>
  </footer>


  <script src="<?= base_url() ?>assets/users/js/vendor/jquery-3.6.0.min.js"></script>


  <script src="<?= base_url() ?>assets/auth/scripts.js"></script>




  <script src="<?= base_url() ?>assets/users/js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="<?= base_url() ?>assets/users/js/vendor/jquery-migrate-3.3.0.min.js"></script>
  <script src="<?= base_url() ?>assets/users/js/vendor/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/users/js/plugins/waypoints.js"></script>
  <script src="<?= base_url() ?>assets/users/js/plugins/wow.js"></script>
  <script src="<?= base_url() ?>assets/users/js/plugins/magnific-popup.js"></script>
  <script src="<?= base_url() ?>assets/users/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="<?= base_url() ?>assets/users/js/plugins/select2.min.js"></script>
  <script src="<?= base_url() ?>assets/users/js/plugins/isotope.js"></script>
  <script src="<?= base_url() ?>assets/users/js/plugins/scrollup.js"></script>
  <script src="<?= base_url() ?>assets/users/js/plugins/swiper-bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/users/js/main.js"></script>

</body>

</html>