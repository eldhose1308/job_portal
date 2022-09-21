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


    <title><?= APP_NAME ?> | Setup Profile </title>

</head>

<body>

    <constants data-base="<?= base_url() ?>" />


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
                    <div class="header-logo"><a class="d-flex" href="<?= base_url() ?>"><img alt="Nexcode" src="<?= base_url() ?>assets/users/imgs/template/jobhub-logo.svg"></a></div>
                </div>
                <div class="header-nav">
                    <nav class="nav-main-menu">
                        <ul class="main-menu">
                            <li class="has-children"><a class="active" href="<?= base_url() ?>">Home</a>
                                <ul class="sub-menu">
                                    <li><a href="<?= base_url() ?>">Home 1</a></li>
                                    <li><a href="index-2.html">Home 2</a></li>
                                    <li><a href="index-3.html">Home 3</a></li>
                                    <li><a href="index-4.html">Home 4</a></li>
                                    <li><a href="index-5.html">Home 5</a></li>
                                    <li><a href="index-6.html">Home 6</a></li>
                                </ul>
                            </li>
                            <li class="has-children"><a href="jobs-grid.html">Find a Job</a>
                                <ul class="sub-menu">
                                    <li><a href="jobs-grid.html">Jobs Grid</a></li>
                                    <li><a href="jobs-list.html">Jobs List</a></li>
                                    <li><a href="job-details.html">Jobs Details </a></li>
                                    <li><a href="job-details-2.html">Jobs Details 2 </a></li>
                                </ul>
                            </li>
                            <li class="has-children"><a href="companies-grid.html">Recruiters</a>
                                <ul class="sub-menu">
                                    <li><a href="companies-grid.html">Recruiters</a></li>
                                    <li><a href="company-details.html">Company Details</a></li>
                                </ul>
                            </li>
                            <li class="has-children"><a href="candidates-grid.html">Candidates</a>
                                <ul class="sub-menu">
                                    <li><a href="candidates-grid.html">Candidates Grid</a></li>
                                    <li><a href="candidate-details.html">Candidate Details</a></li>
                                    <li><a href="candidate-profile.html">Candidate Profile</a></li>
                                </ul>
                            </li>
                            <li class="has-children"><a href="blog-grid.html">Pages</a>
                                <ul class="sub-menu">
                                    <li><a href="page-about.html">About Us</a></li>
                                    <li><a href="page-pricing.html">Pricing Plan</a></li>
                                    <li><a href="page-contact.html">Contact Us</a></li>
                                    <li><a href="page-register.html">Register</a></li>
                                    <li><a href="page-signin.html">Signin</a></li>
                                    <li><a href="page-reset-password.html">Reset Password</a></li>
                                    <li><a href="page-content-protected.html">Content Protected</a></li>
                                </ul>
                            </li>
                            <li class="has-children"><a href="blog-grid.html">Blog</a>
                                <ul class="sub-menu">
                                    <li><a href="blog-grid.html">Blog Grid</a></li>
                                    <li><a href="blog-grid-2.html">Blog Grid 2</a></li>
                                    <li><a href="blog-details.html">Blog Single</a></li>
                                </ul>
                            </li>
                            <li><a href="page-contact.html">Contact</a></li>
                        </ul>
                    </nav>
                    <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
                </div>
                <div class="header-right">
                    <div class="block-signin">
                        <a class="text-link-bd-btom hover-up" href="<?= base_url() ?>users/register">Register</a>
                        <a class="btn btn-default btn-shadow ml-40 hover-up" href="<?= base_url() ?>users/login">Sign in</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-content-area">
                <div class="perfect-scroll">
                    <div class="mobile-search mobile-header-border mb-30">
                        <form action="#">
                            <input type="text" placeholder="Search…"><i class="fi-rr-search"></i>
                        </form>
                    </div>
                    <div class="mobile-menu-wrap mobile-header-border">
                        <!-- mobile menu start-->
                        <nav>
                            <ul class="mobile-menu font-heading">
                                <li class="has-children"><a class="active" href="<?= base_url() ?>">Home</a>
                                    <ul class="sub-menu">
                                        <li><a href="<?= base_url() ?>">Home 1</a></li>
                                        <li><a href="index-2.html">Home 2</a></li>
                                        <li><a href="index-3.html">Home 3</a></li>
                                        <li><a href="index-4.html">Home 4</a></li>
                                        <li><a href="index-5.html">Home 5</a></li>
                                        <li><a href="index-6.html">Home 6</a></li>
                                    </ul>
                                </li>
                                <li class="has-children"><a href="jobs-grid.html">Find a Job</a>
                                    <ul class="sub-menu">
                                        <li><a href="jobs-grid.html">Jobs Grid</a></li>
                                        <li><a href="jobs-list.html">Jobs List</a></li>
                                        <li><a href="job-details.html">Jobs Details </a></li>
                                        <li><a href="job-details-2.html">Jobs Details 2 </a></li>
                                    </ul>
                                </li>
                                <li class="has-children"><a href="companies-grid.html">Recruiters</a>
                                    <ul class="sub-menu">
                                        <li><a href="companies-grid.html">Recruiters</a></li>
                                        <li><a href="company-details.html">Company Details</a></li>
                                    </ul>
                                </li>
                                <li class="has-children"><a href="candidates-grid.html">Candidates</a>
                                    <ul class="sub-menu">
                                        <li><a href="candidates-grid.html">Candidates Grid</a></li>
                                        <li><a href="candidate-details.html">Candidate Details</a></li>
                                    </ul>
                                </li>
                                <li class="has-children"><a href="blog-grid.html">Pages</a>
                                    <ul class="sub-menu">
                                        <li><a href="page-about.html">About Us</a></li>
                                        <li><a href="page-pricing.html">Pricing Plan</a></li>
                                        <li><a href="page-contact.html">Contact Us</a></li>
                                        <li><a href="page-register.html">Register</a></li>
                                        <li><a href="page-signin.html">Signin</a></li>
                                        <li><a href="page-reset-password.html">Reset Password</a></li>
                                        <li><a href="page-content-protected.html">Content Protected</a></li>
                                    </ul>
                                </li>
                                <li class="has-children"><a href="blog-grid.html">Blog</a>
                                    <ul class="sub-menu">
                                        <li><a href="blog-grid.html">Blog Grid</a></li>
                                        <li><a href="blog-grid-2.html">Blog Grid 2</a></li>
                                        <li><a href="blog-details.html">Blog Single</a></li>
                                    </ul>
                                </li>
                                <li><a href="page-contact.html">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="mobile-account">
                        <h6 class="mb-10">Your Account</h6>
                        <ul class="mobile-menu font-heading">
                            <li><a href="#">Profile</a></li>
                            <li><a href="#">Work Preferences</a></li>
                            <li><a href="#">Account Settings</a></li>
                            <li><a href="#">Go Pro</a></li>
                            <li><a href="page-signin.html">Sign Out</a></li>
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
                    <div class="mobile-search mobile-header-border mb-30">
                        <form action="#">
                            <input type="text" placeholder="Search…"><i class="fi-rr-search"></i>
                        </form>
                    </div>
                    <div class="mobile-menu-wrap mobile-header-border">
                        <!-- mobile menu start-->
                        <nav>
                            <ul class="mobile-menu font-heading">
                                <li class="has-children"><a class="active" href="<?= base_url() ?>">Home</a>
                                    <ul class="sub-menu">
                                        <li><a href="<?= base_url() ?>">Home 1</a></li>
                                        <li><a href="index-2.html">Home 2</a></li>
                                        <li><a href="index-3.html">Home 3</a></li>
                                        <li><a href="index-4.html">Home 4</a></li>
                                        <li><a href="index-5.html">Home 5</a></li>
                                        <li><a href="index-6.html">Home 6</a></li>
                                    </ul>
                                </li>
                                <li class="has-children"><a href="jobs-grid.html">Find a Job</a>
                                    <ul class="sub-menu">
                                        <li><a href="jobs-grid.html">Jobs Grid</a></li>
                                        <li><a href="jobs-list.html">Jobs List</a></li>
                                        <li><a href="job-details.html">Jobs Details </a></li>
                                        <li><a href="job-details-2.html">Jobs Details 2 </a></li>
                                    </ul>
                                </li>
                                <li class="has-children"><a href="companies-grid.html">Recruiters</a>
                                    <ul class="sub-menu">
                                        <li><a href="companies-grid.html">Recruiters</a></li>
                                        <li><a href="company-details.html">Company Details</a></li>
                                    </ul>
                                </li>
                                <li class="has-children"><a href="candidates-grid.html">Candidates</a>
                                    <ul class="sub-menu">
                                        <li><a href="candidates-grid.html">Candidates Grid</a></li>
                                        <li><a href="candidate-details.html">Candidate Details</a></li>
                                    </ul>
                                </li>
                                <li class="has-children"><a href="blog-grid.html">Pages</a>
                                    <ul class="sub-menu">
                                        <li><a href="page-about.html">About Us</a></li>
                                        <li><a href="page-pricing.html">Pricing Plan</a></li>
                                        <li><a href="page-contact.html">Contact Us</a></li>
                                        <li><a href="page-register.html">Register</a></li>
                                        <li><a href="page-signin.html">Signin</a></li>
                                        <li><a href="page-reset-password.html">Reset Password</a></li>
                                        <li><a href="page-content-protected.html">Content Protected</a></li>
                                    </ul>
                                </li>
                                <li class="has-children"><a href="blog-grid.html">Blog</a>
                                    <ul class="sub-menu">
                                        <li><a href="blog-grid.html">Blog Grid</a></li>
                                        <li><a href="blog-grid-2.html">Blog Grid 2</a></li>
                                        <li><a href="blog-details.html">Blog Single</a></li>
                                    </ul>
                                </li>
                                <li><a href="page-contact.html">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="mobile-account">
                        <h6 class="mb-10">Your Account</h6>
                        <ul class="mobile-menu font-heading">
                            <li><a href="#">Profile</a></li>
                            <li><a href="#">Work Preferences</a></li>
                            <li><a href="#">Account Settings</a></li>
                            <li><a href="#">Go Pro</a></li>
                            <li><a href="page-signin.html">Sign Out</a></li>
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
                <div class="row login-register-cover pb-250">
                    <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">
                        <div class="text-center"><img src="<?= base_url() ?>assets/users/imgs/user_avatar.png" alt="Nexcode">
                            <h2 class="mt-10 mb-5 text-brand-1">Complete Profile</h2>
                            <p class="font-sm text-muted mb-30">
                                Please fill your phone number as this can be used for further communications.
                            </p>
                        </div>
                        <?php echo form_open(base_url('users/complete_profile'), 'class="login-register text-start mt-20" id="login-forms" autocomplete="off" '); ?>

                        <div id="alert-message-div" style="display: none; padding: 0% 3%;">
                        </div>


                        <div class="form-group">
                            <label class="form-label" for="input-1">Your Full Name *</label>
                            <input data-validation="required|alpha" value="<?= $full_name ?>" class="form-control" id="full_name" type="text" name="full_name">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="input-1">Your Mobile number *</label>
                            <input data-validation="required|numeric|exact_length-10" class="form-control" id="user_mobile" type="text" name="user_mobile">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-brand-1 hover-up w-100" type="submit" name="login">Submit</button>
                        </div>

                        <?php echo form_close(); ?>


                    </div>
                </div>
            </div>
        </section>
    </main>




    <footer class="footer mt-50">
        <div class="container">
            <div class="row">

                <div class="footer-col-6 col-md-6 col-sm-12"><a href="<?= base_url() ?>"><img alt="Nexcode" src="<?= base_url() ?>assets/users/imgs/template/jobhub-logo.svg"></a>
                    <div class="mt-20 mb-20 font-xs color-text-paragraph-2">Nexcode is the heart of the design community and the best resource to discover and connect with designers and jobs worldwide.</div>
                    <div class="footer-social"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-twitter" href="#"></a><a class="icon-socials icon-linkedin" href="#"></a></div>
                </div>

                <div class="footer-col-2 col-md-2 col-xs-6">
                    <h6 class="mb-20">Resources</h6>
                    <ul class="menu-footer">
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Our Team</a></li>
                        <li><a href="#">Products</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>


                <div class="footer-col-5 col-md-2 col-xs-6">
                    <h6 class="mb-20">More</h6>
                    <ul class="menu-footer">
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Terms</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>



            </div>
            <div class="footer-bottom mt-50">
                <div class="row">
                    <div class="col-md-6"><span class="font-xs color-text-paragraph">Copyright &copy; 2022. Nexcode all right reserved</span></div>
                    <div class="col-md-6 text-md-end text-start">
                        <div class="footer-social"><a class="font-xs color-text-paragraph" href="#">Privacy Policy</a><a class="font-xs color-text-paragraph mr-30 ml-30" href="#">Terms &amp; Conditions</a><a class="font-xs color-text-paragraph" href="#">Security</a></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <script src="<?= base_url() ?>assets/users/js/vendor/jquery-3.6.0.min.js"></script>


    <script src="<?= base_url() ?>assets/users/js/custom.js"></script>
    <script src="<?= base_url() ?>assets/auth/scripts.js"></script>

    <script src="<?= base_url() ?>assets/users/scripts/common.js"></script>
    <script src="<?= base_url() ?>assets/users/extras/validation.js"></script>



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