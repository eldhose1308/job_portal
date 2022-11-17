<main class="main">
    <section class="section-box">
        <div class="breacrumb-cover bg-img-contact">
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


        <form action="<?= base_url('admin/home/dashboard_counts') ?>" id="dashboard_counts_form"></form>




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
                                    <h6 class="candidates-info-title text-white">Total Candidates</h6>
                                </div>
                                <div class="candidates-info-count">
                                    <h3 class="mb-0 text-white total_candidates">00</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <div class="candidates-feature-info bg-danger">
                                <div class="candidates-info-icon text-white">
                                    <i class="fa fa-thumbs-down"></i>
                                </div>
                                <div class="candidates-info-content">
                                    <h6 class="candidates-info-title text-white">Total Openings</h6>
                                </div>
                                <div class="candidates-info-count">
                                    <h3 class="mb-0 text-white total_openings">00</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="<?= base_url() ?>admin/candidates/recent_candidates_json" class="candidates_datacard-list">


                    <div class="user-dashboard-info-box mb-0 pb-4">
                        <div class="section-title">
                            <h4>New Registrations </h4>
                        </div>

                        <div id="candidates-na_datacard" class="row" data-class="row">
                            <center><i class="datacard-loader fa fa-circle-o-notch fa-spin"></i></center>
                        </div>


                        <div class="candidates-paginations float-end paginations">
                            <ul class="pager" id="job-pagination_btns">

                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<script src="<?= base_url() ?>assets/users/scripts/candidates.js"></script>
<script src="<?= base_url() ?>assets/users/scripts/dashboard.js"></script>