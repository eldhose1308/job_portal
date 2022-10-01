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

            <?php if ($this->session->has_userdata('user_login_status')) : ?>

              <li><a href="<?= base_url() ?>usershome">Dashboard</a></li>
              <li><a href="<?= base_url() ?>users/jobs/job_applications">Jobs applications</a></li>
            <?php endif; ?>

            <li><a href="<?= base_url() ?>jobs">Jobs</a></li>

            <li><a href="<?= base_url() ?>contact_us">Contact us</a></li>

          </ul>
        </nav>

        <?php if ($this->session->has_userdata('user_login_status')) : ?>

          <div class="wishlist-div">
            <a class="btn-sm btn-custom" href="<?= base_url() ?>users/jobs/saved"><span>❤</span> Saved Jobs</a>
          </div>

        <?php else : ?>
          <div class="wishlist-div">
            <a class="btn-sm btn-primary" href="<?= base_url() ?>users/login">Sign In <i class="fa fa-sign-in"></i></a>
          </div>

        <?php endif; ?>

        <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
      </div>
      <div class="header-right">
        <div class="block-signin">
          <?php if ($this->session->has_userdata('user_login_status')) : ?>

            <a class="text-link-bd-btom hover-up" href="<?= base_url() ?>users/profile"><?= ss('user_name') ?></a>
            <a class="btn btn-sm btn-outline-custom hover-up text-underline" href="<?= base_url() ?>users/jobs/saved"><span>❤</span> Saved Jobs</a>
            <a class="btn btn-default btn-shadow ml-15 hover-up" href="<?= base_url() ?>users/logout"> Sign out <i class="fa fa-sign-out"></i></a>

          <?php else : ?>

            <a class="text-link-bd-btom hover-up" href="<?= base_url() ?>users/register">Register</a>
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
              <li><a href="<?= base_url() ?>usershome">Dashboard</a></li>

              <li><a href="<?= base_url() ?>jobs">Jobs</a></li>
              <li><a href="<?= base_url() ?>users/jobs/job_applications">Jobs applications</a></li>

              <li><a href="<?= base_url() ?>contact_us">Contact us</a></li>


            </ul>
          </nav>
        </div>
        <div class="mobile-account">
          <h6 class="mb-10">Your Account</h6>
          <ul class="mobile-menu font-heading">
            <li><a href="<?= base_url() ?>users/profile">Profile</a></li>
            <li><a href="<?= base_url() ?>users/logout">Sign Out</a></li>
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
              <li><a href="<?= base_url() ?>usershome">Dashboard</a></li>

              <li><a href="<?= base_url() ?>jobs">Jobs</a></li>
              <li><a href="<?= base_url() ?>users/jobs/job_applications">Jobs applications</a></li>

              <li><a href="<?= base_url() ?>contact_us">Contact us</a></li>


            </ul>
          </nav>
        </div>
        <div class="mobile-account">
          <h6 class="mb-10">Your Account</h6>
          <ul class="mobile-menu font-heading">
            <li><a href="<?= base_url() ?>users/profile">Profile</a></li>
            <li><a href="<?= base_url() ?>users/logout">Sign Out</a></li>
          </ul>
        </div>
        <div class="site-copyright">Copyright 2022 &copy; Nexcode.</div>
      </div>
    </div>
  </div>
</div>