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
            <li><a href="<?= base_url() ?>adminhome">Dashboard</a></li>

            <li class="has-children"><a href="#0">Candidates</a>
              <ul class="sub-menu">
                <li><a href="<?= base_url() ?>admin/candidates">Candidates list</a></li>
              </ul>
            </li>

            <li class="has-children"><a href="#0">Jobs</a>
              <ul class="sub-menu">
                <li><a href="<?= base_url() ?>admin/jobs">Jobs list</a></li>
                <li><a href="<?= base_url() ?>admin/jobs/countries">Jobs Countries</a></li>
                <li><a href="<?= base_url() ?>admin/jobs/types">Jobs types</a></li>
              </ul>
            </li>

            <li><a href="<?= base_url() ?>admin/contact_messages">Contact queries</a></li>

          </ul>
        </nav>
        <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
      </div>
      <div class="header-right">
        <div class="block-signin">
          <a class="text-link-bd-btom hover-up" href="<?= base_url() ?>admin/profile"><?= ss('user_name') ?></a>
          <a class="btn btn-default btn-shadow ml-40 hover-up" href="<?= base_url() ?>admin/logout"> Sign out <i class="fa fa-sign-out"></i></a>
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
              <li><a href="<?= base_url() ?>adminhome">Dashboard</a></li>

              <li class="has-children"><a href="#0">Candidates</a>
                <ul class="sub-menu">
                  <li><a href="<?= base_url() ?>admin/candidates">Candidates list</a></li>
                </ul>
              </li>

              <li class="has-children"><a href="#0">Jobs</a>
                <ul class="sub-menu">
                  <li><a href="<?= base_url() ?>admin/jobs">Jobs list</a></li>
                  <li><a href="<?= base_url() ?>admin/jobs/countries">Jobs Countries</a></li>
                  <li><a href="<?= base_url() ?>admin/jobs/types">Jobs types</a></li>
                </ul>
              </li>

              <li><a href="<?= base_url() ?>admin/contact_messages">Contact queries</a></li>


            </ul>
          </nav>
        </div>
        <div class="mobile-account">
          <h6 class="mb-10">Your Account</h6>
          <ul class="mobile-menu font-heading">
            <li><a href="<?= base_url() ?>admin/profile">Profile</a></li>
            <li><a href="<?= base_url() ?>admin/logout">Sign Out</a></li>
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
              <li><a href="<?= base_url() ?>adminhome">Dashboard</a></li>

              <li class="has-children"><a href="#0">Candidates</a>
                <ul class="sub-menu">
                  <li><a href="<?= base_url() ?>admin/candidates">Candidates list</a></li>
                </ul>
              </li>

              <li class="has-children"><a href="#0">Jobs</a>
                <ul class="sub-menu">
                  <li><a href="<?= base_url() ?>admin/jobs">Jobs list</a></li>
                  <li><a href="<?= base_url() ?>admin/jobs/countries">Jobs Countries</a></li>
                  <li><a href="<?= base_url() ?>admin/jobs/types">Jobs types</a></li>
                </ul>
              </li>

              <li><a href="<?= base_url() ?>admin/contact_messages">Contact queries</a></li>


            </ul>
          </nav>
        </div>
        <div class="mobile-account">
          <h6 class="mb-10">Your Account</h6>
          <ul class="mobile-menu font-heading">
            <li><a href="<?= base_url() ?>admin/profile">Profile</a></li>
            <li><a href="<?= base_url() ?>admin/logout">Sign Out</a></li>
          </ul>
        </div>
        <div class="site-copyright">Copyright 2022 &copy; Nexcode.</div>
      </div>
    </div>
  </div>
</div>