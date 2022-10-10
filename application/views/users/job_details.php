<?php
$created_at = $jobsDetails->created_at;

$timeFirst  = strtotime($created_at);
$timeSecond = strtotime(date("Y-m-d h:i:s"));

$differenceInSeconds = $timeSecond - $timeFirst;

?>

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
                    <div class="btn btn-apply-icon btn-apply btn-apply-big hover-up" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
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
                                <div class="sidebar-text-info ml-10"><span class="text-description jobtype-icon mb-10">Updated</span><strong class="small-heading"><?=  date('d M , Y', strtotime($jobsDetails->created_at)) . ' | ' . date('h:i a', strtotime($jobsDetails->created_at)) ?></strong></div>
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
                            <div class="col-md-5"><a class="btn btn-default mr-15" href="#">Apply now</a><a class="btn btn-border" href="#">Save job</a></div>
                            <div class="col-md-7 text-lg-end social-share">
                                <h6 class="color-text-paragraph-2 d-inline-block d-baseline mr-10">Share this</h6>
                                <a class="mr-5 d-inline-block d-middle" href="#"><i class="fa fa-share-alt btn text-primary"></i></a>
                                <a class="d-inline-block d-middle" href="#"><img alt="nexcode" src="<?= base_url() ?>assets/users/imgs/template/icons/share-whatsapp.svg"></a>
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
                <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">Get the latest news, updates and tips</p>
            </div>
            <div class="mt-50">
                <div class="box-swiper style-nav-top">
                    <div class="swiper-container swiper-group-4 swiper">
                        <div class="swiper-wrapper pb-10 pt-5">
                            <div class="swiper-slide">
                                <div class="card-grid-2 hover-up">
                                    <div class="card-grid-2-image-left"><span class="flash"></span>
                                        <div class="image-box"><img src="<?= base_url() ?>assets/users/imgs/brands/brand-6.png" alt="nexcode"></div>
                                        <div class="right-info"><a class="name-job" href="company-details.html">Quora JSC</a><span class="location-small">New York, US</span></div>
                                    </div>
                                    <div class="card-block-info">
                                        <h6><a href="job-details.html">Senior System Engineer</a></h6>
                                        <div class="mt-5"><span class="card-briefcase">Part time</span><span class="card-time">5<span> minutes ago</span></span></div>
                                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur.</p>
                                        <div class="mt-30"><a class="btn btn-grey-small mr-5" href="job-details.html">PHP</a><a class="btn btn-grey-small mr-5" href="job-details.html">Android </a>
                                        </div>
                                        <div class="card-2-bottom mt-30">
                                            <div class="row">
                                                <div class="col-lg-7 col-7"><span class="card-text-price">$800</span><span class="text-muted">/Hour</span></div>
                                                <div class="col-lg-5 col-5 text-end">
                                                    <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card-grid-2 hover-up">
                                    <div class="card-grid-2-image-left"><span class="flash"></span>
                                        <div class="image-box"><img src="<?= base_url() ?>assets/users/imgs/brands/brand-4.png" alt="nexcode"></div>
                                        <div class="right-info"><a class="name-job" href="company-details.html">Dailymotion</a><span class="location-small">New York, US</span></div>
                                    </div>
                                    <div class="card-block-info">
                                        <h6><a href="job-details.html">Frontend Developer</a></h6>
                                        <div class="mt-5"><span class="card-briefcase">Full time</span><span class="card-time">6<span> minutes ago</span></span></div>
                                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur.</p>
                                        <div class="mt-30"><a class="btn btn-grey-small mr-5" href="jobs-grid.html">Typescript</a><a class="btn btn-grey-small mr-5" href="jobs-grid.html">Java</a>
                                        </div>
                                        <div class="card-2-bottom mt-30">
                                            <div class="row">
                                                <div class="col-lg-7 col-7"><span class="card-text-price">$250</span><span class="text-muted">/Hour</span></div>
                                                <div class="col-lg-5 col-5 text-end">
                                                    <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card-grid-2 hover-up">
                                    <div class="card-grid-2-image-left"><span class="flash"></span>
                                        <div class="image-box"><img src="<?= base_url() ?>assets/users/imgs/brands/brand-8.png" alt="nexcode"></div>
                                        <div class="right-info"><a class="name-job" href="company-details.html">Periscope</a><span class="location-small">New York, US</span></div>
                                    </div>
                                    <div class="card-block-info">
                                        <h6><a href="job-details.html">Lead Quality Control QA</a></h6>
                                        <div class="mt-5"><span class="card-briefcase">Full time</span><span class="card-time">6<span> minutes ago</span></span></div>
                                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur.</p>
                                        <div class="mt-30"><a class="btn btn-grey-small mr-5" href="job-details.html">iOS</a><a class="btn btn-grey-small mr-5" href="job-details.html">Laravel</a><a class="btn btn-grey-small mr-5" href="job-details.html">Golang</a>
                                        </div>
                                        <div class="card-2-bottom mt-30">
                                            <div class="row">
                                                <div class="col-lg-7 col-7"><span class="card-text-price">$250</span><span class="text-muted">/Hour</span></div>
                                                <div class="col-lg-5 col-5 text-end">
                                                    <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card-grid-2 hover-up">
                                    <div class="card-grid-2-image-left"><span class="flash"></span>
                                        <div class="image-box"><img src="<?= base_url() ?>assets/users/imgs/brands/brand-4.png" alt="nexcode"></div>
                                        <div class="right-info"><a class="name-job" href="company-details.html">Dailymotion</a><span class="location-small">New York, US</span></div>
                                    </div>
                                    <div class="card-block-info">
                                        <h6><a href="job-details.html">Frontend Developer</a></h6>
                                        <div class="mt-5"><span class="card-briefcase">Full time</span><span class="card-time">6<span> minutes ago</span></span></div>
                                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur.</p>
                                        <div class="mt-30"><a class="btn btn-grey-small mr-5" href="jobs-grid.html">Typescript</a><a class="btn btn-grey-small mr-5" href="jobs-grid.html">Java</a>
                                        </div>
                                        <div class="card-2-bottom mt-30">
                                            <div class="row">
                                                <div class="col-lg-7 col-7"><span class="card-text-price">$250</span><span class="text-muted">/Hour</span></div>
                                                <div class="col-lg-5 col-5 text-end">
                                                    <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-next swiper-button-next-4"></div>
                    <div class="swiper-button-prev swiper-button-prev-4"></div>
                </div>
                <div class="text-center"><a class="btn btn-grey" href="#">Load more posts</a></div>
            </div>
        </div>
    </section>

</main>