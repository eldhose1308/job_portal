
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
      <div class="add-listing">
          <div class="login d-inline-block me-4">
            <a href="<?= base_url() ?>assets/users/#"><i class="far fa-user pe-2"></i>Username</a>
          </div>
          <a class="btn btn-white btn-md" href="<?= base_url() ?>admin/logout"> <i class="fa fa-sign-out"></i>Logout</a>
        </div>
    </div>
  </nav>
</header>
  <!--=================================
  header -->