<?php
$created_at = $jobsDetails->created_at;

$timeFirst  = strtotime($created_at);
$timeSecond = strtotime(date("Y-m-d h:i:s"));

$differenceInSeconds = $timeSecond - $timeFirst;

?>

<?php echo form_open(base_url('home/add_to_wishlist/'), 'class=" text-start mt-20" id="job_wishlist-forms" autocomplete="off" '); ?>
<?php echo form_close(); ?>

<main class="main">

    <section class="section-box">
        <div class="breacrumb-cover bg-img-about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="mb-10">Job Details</h2>
                        <p class="font-lg color-text-paragraph-2">Complete info about the job</p>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <ul class="breadcrumbs mt-40">
                            <li><a class="home-icon" href="<?= base_url() ?>">Home</a></li>
                            <li>Job Details</li>
                        </ul>
                    </div>


                </div>
            </div>
        </div>
    </section>


    <section class="section-box-2 mt-45">
        <div class="container">

            <div class="row mt-10">
                <div class="col-lg-8 col-md-12">
                    <h3> <?= $jobsDetails->job_title ?> </h3>
                    <div class="mt-0 mb-15"><span class="card-briefcase"><?= $jobsDetails->job_openings ?> Openings</span>
                        <span class="card-time"><?= seconds2format($differenceInSeconds) ?> ago</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 text-lg-end">
                    <div class="btn btn-apply-icon btn-apply btn-apply-big hover-up open-right-offcanvas <?= $applied ? 'btn-custom' : '' ?>" data-url="<?= base_url() ?>home/apply_job_page/<?= en_func($jobsDetails->job_id, 'e') ?>"><?= ($applied) ? 'Applied 🗸' : 'Apply now' ?></div>
                </div>

                <div class="col-md-12 text-lg-end mt-25 social-share">
                    <h6 class="color-text-paragraph-2 d-inline-block d-baseline mr-10">Share this</h6>
                    <a class="d-inline-block d-middle web-share" data-text="Job Description for <?= $jobsDetails->job_title ?> in <?= $jobsDetails->country_name ?> for <?= $jobsDetails->min_experience ?> - <?= $jobsDetails->max_experience ?> years of experience .Apply Now !" data-url="<?= base_url() ?>job_details/<?= $job_id ?>"><i class="fa fa-share-alt ml-0 btn text-primary"></i></a>

                    <a class="d-inline-block d-middle copy-to-clipboard" data-url="<?= base_url() ?>job_details/<?= $job_id ?>"><i class="fa fa-clone ml-0 btn text-primary"></i></a>
                    <a class="d-inline-block d-middle" href="whatsapp://send?text=Job Description for <?= $jobsDetails->job_title ?> in <?= $jobsDetails->country_name ?> 
                                    for <?= $jobsDetails->min_experience . ' - ' . $jobsDetails->max_experience ?> years of experience .Apply Now ! <?= base_url() ?>job_details/<?= $job_id ?>" data-action="share/whatsapp/share">
                        <img alt="nexcode" src="<?= base_url() ?>assets/users/imgs/template/icons/share-whatsapp.svg">
                    </a>
                </div>


            </div>
            <div class="border-bottom pt-10 pb-10"></div>
        </div>
    </section>

    <section class="section-box mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="job-overview">
                        <h5 class="border-bottom pb-15 mb-30">Employment Information</h5>

                        <div class="row mt-25">
                            <div class="col-md-6 d-flex mt-sm-15">
                                <div class="sidebar-icon-item"><img src="<?= base_url() ?>assets/users/imgs/page/job-single/salary.svg" alt="nexcode"></div>
                                <div class="sidebar-text-info ml-10"><span class="text-description salary-icon mb-10">Salary</span><strong class="small-heading">INR <?= $jobsDetails->min_salary . ' - ' . $jobsDetails->max_salary ?> / Month</strong></div>
                            </div>
                            <div class="col-md-6 d-flex">
                                <div class="sidebar-icon-item"><img src="<?= base_url() ?>assets/users/imgs/page/job-single/experience.svg" alt="nexcode"></div>
                                <div class="sidebar-text-info ml-10"><span class="text-description experience-icon mb-10">Experience</span><strong class="small-heading"><?= $jobsDetails->min_experience . ' - ' . $jobsDetails->max_experience ?> years</strong></div>
                            </div>
                        </div>

                        <div class="row mt-25">
                            <div class="col-md-6 d-flex mt-sm-15">
                                <div class="sidebar-icon-item"><img src="<?= base_url() ?>assets/users/imgs/page/job-single/updated.svg" alt="nexcode"></div>
                                <div class="sidebar-text-info ml-10"><span class="text-description jobtype-icon mb-10">Updated</span><strong class="small-heading"><?= date('d M , Y', strtotime($jobsDetails->created_at)) . ' | ' . date('h:i a', strtotime($jobsDetails->created_at)) ?></strong></div>
                            </div>
                            <div class="col-md-6 d-flex mt-sm-15">
                                <div class="sidebar-icon-item"><img src="<?= base_url() ?>assets/users/imgs/page/job-single/location.svg" alt="nexcode"></div>
                                <div class="sidebar-text-info ml-10"><span class="text-description mb-10">Location</span><strong class="small-heading"><?= $jobsDetails->country_name ?></strong></div>
                            </div>
                        </div>
                    </div>
                    <div class="content-single">

                        <h4>Brief description</h4>
                        <p><?= $jobsDetails->brief_description ?></p>

                        <h4>Full description</h4>
                        <p><?= $jobsDetails->job_description ?></p>

                    </div>
                    <div class="single-apply-jobs">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <a class="btn btn-default mr-15 open-right-offcanvas <?= $applied ? 'btn-custom' : '' ?>" data-url="<?= base_url() ?>home/apply_job_page/<?= en_func($jobsDetails->job_id, 'e') ?>"><?= ($applied) ? 'Applied 🗸' : 'Apply now' ?></a>
                                <input type="hidden" name="job_id" class="job_id" value="<?= $job_id ?>">
                                <input type="hidden" name="wishlist_status" class="wishlist_status" value="<?= $wishlist ? 1 : 0 ?>">
                                <a class="btn btn-border add-to-wishlist <?= $wishlist ? 'active' : '' ?>"><span>&#x2764;</span><span class="wishlisted-text"> <?= ($wishlist) ? 'Remove From Wishlist' : 'Add To Wishlist' ?></a>
                            </div>
                            <div class="col-md-7 text-lg-end social-share">
                                <h6 class="color-text-paragraph-2 d-inline-block d-baseline mr-10">Share this</h6>
                                <a class="d-inline-block d-middle web-share" data-text="Job Description for <?= $jobsDetails->job_title ?> in <?= $jobsDetails->country_name ?> for <?= $jobsDetails->min_experience ?> - <?= $jobsDetails->max_experience ?> years of experience .Apply Now !" data-url="<?= base_url() ?>job_details/<?= $job_id ?>"><i class="fa fa-share-alt ml-0 btn text-primary"></i></a>

                                <a class="d-inline-block d-middle copy-to-clipboard" data-url="<?= base_url() ?>job_details/<?= $job_id ?>"><i class="fa fa-clone ml-0 btn text-primary"></i></a>
                                <a class="d-inline-block d-middle" href="whatsapp://send?text=Job Description for <?= $jobsDetails->job_title ?> in <?= $jobsDetails->country_name ?> 
                                    for <?= $jobsDetails->min_experience . ' - ' . $jobsDetails->max_experience ?> years of experience .Apply Now ! <?= base_url() ?>job_details/<?= $job_id ?>" data-action="share/whatsapp/share">
                                    <img alt="nexcode" src="<?= base_url() ?>assets/users/imgs/template/icons/share-whatsapp.svg">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <section class="section-box mt-50 mb-50">
        <div class="container">
            <div class="text-left">
                <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">Featured Jobs</h2>
                <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">Get the latest jobs</p>
            </div>


            <form action="<?= base_url() ?>home/home_jobs_json" class="jobs_datacard-list float-right">
            </form>

            <div class="mt-50">
                <div class="box-swiper style-nav-top">

                    <div id="jobs-na_datacard" class="row" data-class="row">
                        <center><i class="datacard-loader fa fa-circle-o-notch fa-spin"></i></center>
                    </div>


                </div>
                <div class="text-center"><a class="btn btn-grey" href="<?= base_url() ?>jobs">Load more posts</a></div>
            </div>

        </div>
    </section>




    <!--- Right canvas -->
    <div id="bs-canvas-right" class="bs-canvas bs-canvas-anim bs-canvas-right position-fixed bg-light h-100">
        <header class="bs-canvas-header p-3 bg-primary overflow-auto">
            <button type="button" class="bs-canvas-close float-left close" aria-label="Close" style="background: transparent; border: none;">
                <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
            </button>
            <h5 class="d-inline-block text-light mb-0 float-righ offcanvas-heading">Canvas Header</h5>
            <p class="mt-10 ml-50 offcanvas-subheading text-white">Subheading</p>
        </header>

        <div id="alert-message-div" class="mt-15 alert-message-div" style="display: none; padding: 0% 3%;">
        </div>


        <div class="bs-canvas-content px-3 offcanvas-content mt-10">
            ...
        </div>
    </div>
    <!--- Right canvas -->




</main>

<script src="<?= base_url() ?>assets/users/scripts/jobs.js"></script>