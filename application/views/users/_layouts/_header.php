
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
      <a class="navbar-brand" href="<?= base_url () ?>assets/users/index.html">
        <img class="img-fluid" src="<?= base_url () ?>assets/users/images/logo.svg" alt="logo">
      </a>
      <div class="navbar-collapse collapse justify-content-start">
        <ul class="nav navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link" href="<?= base_url () ?>assets/users/#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Home<i class="fas fa-chevron-down fa-xs"></i></a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/index.html">index Default</a></li>
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/index-02.html">index 02</a></li>
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/index-03.html">index 03</a></li>
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/index-map.html">index map</a></li>
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/index-slider.html">index Slider</a></li>
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/index-bg-video.html">index bg video</a></li>
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/index-splash.html">index splash</a></li>
            </ul>
          </li>
          <li class="dropdown nav-item active">
            <a href="<?= base_url () ?>assets/users/properties.html" class="nav-link" data-bs-toggle="dropdown">Pages<i class="fas fa-chevron-down fa-xs"></i></a>
            <ul class="dropdown-menu megamenu dropdown-menu-lg">
              <li>
                <div class="row">
                  <div class="col-sm-4 mb-2 mb-sm-0">
                    <h6 class="mb-3 nav-title">Pages</h6>
                    <ul class="list-unstyled mt-lg-3">
                      <li><a href="<?= base_url () ?>assets/users/about.html">About</a></li>
                      <li><a href="<?= base_url () ?>assets/users/services.html">Services</a></li>
                      <li><a href="<?= base_url () ?>assets/users/pricing.html">Pricing</a></li>
                      <li><a href="<?= base_url () ?>assets/users/career.html">Career</a></li>
                      <li><a href="<?= base_url () ?>assets/users/advertising.html">Advertising</a></li>
                      <li><a href="<?= base_url () ?>assets/users/contact-us.html">Contact Us</a></li>
                    </ul>
                  </div>
                  <div class="col-sm-4 mb-2 mb-sm-0">
                    <h6 class="mb-3 nav-title">Pages</h6>
                    <ul class="list-unstyled mt-lg-3">
                      <li><a href="<?= base_url () ?>assets/users/blog.html">Blog</a></li>
                      <li><a href="<?= base_url () ?>assets/users/blog-detail.html">Blog Detail</a></li>
                      <li><a href="<?= base_url () ?>assets/users/post-a-job.html">Post a Job</a></li>
                      <li><a href="<?= base_url () ?>assets/users/faqs.html">Faq</a></li>
                      <li><a href="<?= base_url () ?>assets/users/browse-categories.html">Browse Categories</a></li>
                      <li><a href="<?= base_url () ?>assets/users/browse-locations.html">Browse Locations</a></li>
                    </ul>
                  </div>
                  <div class="col-sm-4">
                    <h6 class="mb-3 nav-title">Pages</h6>
                    <ul class="list-unstyled mt-lg-3">
                      <li class="active"><a href="<?= base_url () ?>assets/users/login.html">Login</a></li>
                      <li><a href="<?= base_url () ?>assets/users/register.html">Register</a></li>
                      <li><a href="<?= base_url () ?>assets/users/coming-soon.html">Coming soon</a></li>
                      <li><a href="<?= base_url () ?>assets/users/404-error.html">404 Error</a></li>
                      <li><a href="<?= base_url () ?>assets/users/terms-and-conditions.html">T&C</a></li>
                    </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="agency-logo pt-4 pb-3">
                      <h6 class="mb-3 nav-title">Top Agency</h6>
                      <ul class="list-unstyled">
                        <li>
                          <div class="job-list">
                            <div class="job-list-logo">
                              <img class="img-fluid" src="<?= base_url () ?>assets/users/images/svg/07.svg" alt="">
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="job-list">
                            <div class="job-list-logo">
                              <img class="img-fluid" src="<?= base_url () ?>assets/users/images/svg/06.svg" alt="">
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="job-list">
                            <div class="job-list-logo">
                              <img class="img-fluid" src="<?= base_url () ?>assets/users/images/svg/05.svg" alt="">
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="job-list">
                            <div class="job-list-logo">
                              <img class="img-fluid" src="<?= base_url () ?>assets/users/images/svg/04.svg" alt="">
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="job-list">
                            <div class="job-list-logo">
                              <img class="img-fluid" src="<?= base_url () ?>assets/users/images/svg/03.svg" alt="">
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="<?= base_url () ?>assets/users/javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Listing <i class="fas fa-chevron-down fa-xs"></i>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/job-grid.html">Job Grid</a></li>
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/job-listing.html">Job Listing</a></li>
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/job-detail.html">Job Detail</a></li>
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/job-listing-map.html">Job Listing Map</a></li>
            </ul>
          </li>
          <li class="dropdown nav-item mega-menu">
            <a href="<?= base_url () ?>assets/users/javascript:void(0)" class="nav-link" data-bs-toggle="dropdown">Elements<i class="fas fa-chevron-down fa-xs"></i></a>
            <ul class="dropdown-menu megamenu">
              <li>
                <div class="row">
                  <div class="col-sm-6 col-lg-5 mb-3 mb-lg-0">
                    <h6 class="mb-3 nav-title">Search Types</h6>
                    <ul class="list-unstyled mt-lg-3">
                      <li><a href="<?= base_url () ?>assets/users/search-style-under-banner.html">Search style under banner</a></li>
                      <li><a href="<?= base_url () ?>assets/users/search-style-above-banner.html">Search style above banner</a></li>
                      <li><a href="<?= base_url () ?>assets/users/search-style-below-banner.html">Search style below banner</a></li>
                      <li><a href="<?= base_url () ?>assets/users/search-style-advanced.html">Advanced Search style</a></li>
                      <li><a href="<?= base_url () ?>assets/users/search-style-classic.html">Search style classic</a></li>
                      <li><a href="<?= base_url () ?>assets/users/search-style-with-filter.html">Search style with filter</a></li>
                      <li><a href="<?= base_url () ?>assets/users/search-style-advanced-02.html">Advanced Search style 02 </a></li>
                      <li><a href="<?= base_url () ?>assets/users/search-style-advanced-03.html">Advanced Search style 03 </a></li>
                    </ul>
                  </div>
                  <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
                    <h6 class="mb-3 nav-title">Elements</h6>
                    <ul class="list-unstyled mt-lg-3">
                      <li><a href="<?= base_url () ?>assets/users/element-feature-box.html">Feature box</a></li>
                      <li><a href="<?= base_url () ?>assets/users/element-testimonials.html">Testimonials</a></li>
                      <li><a href="<?= base_url () ?>assets/users/element-accordion.html">Accordion</a></li>
                      <li><a href="<?= base_url () ?>assets/users/element-tabs.html">Tabs</a></li>
                      <li><a href="<?= base_url () ?>assets/users/element-typography.html">Typography</a></li>
                      <li><a href="<?= base_url () ?>assets/users/element-counter.html">counter</a></li>
                      <li><a href="<?= base_url () ?>assets/users/element-countdown.html">Countdown</a></li>
                      <li><a href="<?= base_url () ?>assets/users/element-category.html">Category</a></li>
                    </ul>
                  </div>
                  <div class="col-sm-6 col-lg-4">
                    <div class="menu-banner bg-dark p-3 pt-4 text-center border-radius h-100 d-none d-lg-block">
                        <h5 class="text-primary mb-3 pt-2">Advertise your job with us</h5>
                        <span class="text-light"> Starting from</span>
                        <h3 class="text-white my-3">$99 <small>/mo</small></h3>
                        <p class="text-primary p-2 small text-white">Save 30% for new customer</p>
                        <a class="btn btn-light btn-sm" href="<?= base_url () ?>assets/users/post-a-job.html">Post a job now!</a>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="<?= base_url () ?>assets/users/javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Employer <i class="fas fa-chevron-down fa-xs"></i>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/employer-grid.html">Employer Grid</a></li>
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/employer-listing.html">Employer list</a></li>
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/employer-detail.html">Employer detail</a></li>
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/employer-listing-map.html">Employer Listing Map</a></li>
              <li class="dropdown-submenu">
                <a class="dropdown-item dropdown-toggle" href="<?= base_url () ?>assets/users/javascript:void(0)">Dashboard <i class="fas fa-chevron-right fa-xs"></i></a>
                <ul class="dropdown-menu left-side">
                  <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/dashboard-employer.html">Dashboard</a></li>
                  <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/dashboard-employer-my-profile.html">Profile</a></li>
                  <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/dashboard-employer-change-password.html">Change Password </a></li>
                  <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/dashboard-employer-manage-candidates.html">Manage Candidates</a></li>
                  <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/dashboard-employer-manage-jobs.html">Manage Jobs</a></li>
                  <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/dashboard-employer-post-new-job.html">Post New Job</a></li>
                  <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/dashboard-employer-pricing.html">Pricing</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="<?= base_url () ?>assets/users/javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Candidates <i class="fas fa-chevron-down fa-xs"></i>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/candidates-grid.html">Candidates Grid</a></li>
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/candidates-listing.html">Candidates list</a></li>
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/candidate-detail.html">Candidates detail</a></li>
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/candidates-listing-map.html">Candidates Listing Map</a></li>
              <li class="dropdown-submenu">
                <a class="dropdown-item dropdown-toggle" href="<?= base_url () ?>assets/users/javascript:void(0)">Dashboard <i class="fas fa-chevron-right fa-xs"></i></a>
                <ul class="dropdown-menu left-side">
                  <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/dashboard-candidates.html">Dashboard</a></li>
                  <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/dashboard-candidates-my-profile.html">Profile</a></li>
                  <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/dashboard-candidates-change-password.html">Change Password </a></li>
                  <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/dashboard-candidates-my-resume.html">My Resume</a></li>
                  <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/dashboard-candidates-manage-jobs.html">Manage Jobs</a></li>
                  <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/dashboard-candidates-saved-jobs.html">Saved Jobs</a></li>
                  <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/dashboard-candidates-pricing.html">Pricing</a></li>
                </ul>
              </li>
              <li><a class="dropdown-item" href="<?= base_url () ?>assets/users/my-resume.html">My Resume <span class="badge bg-danger ms-2">CV</span></a></li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="add-listing">
          <div class="login d-inline-block me-4">
            <a href="<?= base_url () ?>assets/users/#"><i class="far fa-user pe-2"></i>Sign in</a>
          </div>
          <a class="btn btn-white btn-md" href="<?= base_url () ?>assets/users/post-a-job.html"> <i class="fas fa-plus-circle"></i>Post a job</a>
        </div>
    </div>
  </nav>
</header>
  <!--=================================
  header -->