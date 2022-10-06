<main class="main">
    <section class="section-box">
        <div class="breacrumb-cover bg-img-about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="mb-10">Dashboard</h2>
                        <p class="font-lg color-text-paragraph-2">Your info in a glance</p>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <ul class="breadcrumbs mt-40">
                            <li><a class="home-icon" href="<?= base_url() ?>">Home</a></li>
                            <li>Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box mt-50">


        <form action="<?= base_url('users/home/dashboard_counts') ?>" id="dashboard_counts_form"></form>


        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-custom float-right mb-15" href="<?= base_url() ?>users/profile"> <i class="fa fa-file mr-10"></i> Add / Change Resume</a>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row mb-3 mb-lg-5 mt-3 mt-lg-0">
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <div class="candidates-feature-info bg-custom">
                                <div class="candidates-info-icon text-white">
                                    <i class="fa fa-globe"></i>
                                </div>
                                <div class="candidates-info-content">
                                    <h6 class="candidates-info-title text-white">Total Applications</h6>
                                </div>
                                <div class="candidates-info-count">
                                    <h3 class="mb-0 text-white total_applications">00</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <div class="candidates-feature-info bg-success">
                                <div class="candidates-info-icon text-white">
                                    <i class="fa fa-thumbs-up"></i>
                                </div>
                                <div class="candidates-info-content">
                                    <h6 class="candidates-info-title text-white">Shortlisted Applications</h6>
                                </div>
                                <div class="candidates-info-count">
                                    <h3 class="mb-0 text-white shortlisted_applications">00</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <div class="candidates-feature-info bg-danger">
                                <div class="candidates-info-icon text-white">
                                    <i class="fa fa-thumbs-down"></i>
                                </div>
                                <div class="candidates-info-content">
                                    <h6 class="candidates-info-title text-white">Rejected Applications</h6>
                                </div>
                                <div class="candidates-info-count">
                                    <h3 class="mb-0 text-white rejected_applications">00</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="<?= base_url() ?>users/jobs/recently_applied_jobs_json" class="jobs_datacard-list float-right">
                    </form>

                    <div class="user-dashboard-info-box mb-0 pb-4">
                        <div class="section-title">
                            <h4>Recently Applied Jobs</h4>
                        </div>

                        <div id="jobs-na_datacard" data-class="row">
                            <center><i class="datacard-loader fa fa-circle-o-notch fa-spin"></i></center>
                        </div>


                        <div class="jobs-paginations float-end paginations">
                            <ul class="pager" id="job-pagination_btns">

                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<script src="<?= base_url() ?>assets/users/scripts/jobs.js"></script>
<script src="<?= base_url() ?>assets/users/scripts/dashboard.js"></script>