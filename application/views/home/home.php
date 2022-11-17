<main class="main">
    <div class="bg-homepage4"></div>
    <section class="section-box">
        <div class="banner-hero hero-1 banner-homepage4">
            <div class="banner-inner">
                <div class="row">
                    <div class="col-xl-7 col-lg-12">
                        <div class="block-banner">
                            <h1 class="heading-banner wow animate__animated animate__fadeInUp">Get The <span class="color-brand-2">Best Offers</span><br class="d-none d-lg-block">You Deserve</h1>
                            <div class="banner-description mt-20 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                                Amore Holidays Tours And Travels is a reliable name in the industry as we aim to deliver the best experience to their customers.
                            </div>

                            <div class="mt-30">
                                <a href="<?= base_url() ?>about_us" class="btn btn-default mr-15">Know more</a>
                                <a href="<?= base_url() ?>jobs" class="btn btn-border-brand-2">Careers</a>
                            </div>

                            <div class="list-tags-banner mt-60 wow animate__animated animate__fadeInUp d-none" data-wow-delay=".3s">
                                <strong>Popular Searches:</strong><a href="#">Designer</a>, <a href="#">Web</a>, <a href="#">IOS</a>, <a href="#">Developer</a>, <a href="#">PHP</a>, <a href="#">Senior</a>, <a href="#">Engineer</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-12 d-none d-xl-block col-md-6">
                        <div class="banner-imgs">
                            <div class="block-1 shape-1"><img class="img-responsive" alt="jobBox" src="<?= base_url() ?>assets/users/imgs/page/homepage4/banner.png"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="section-box mt-70">
        <div class="section-box wow animate__animated animate__fadeIn">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">Our Packages</h2>
                    <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">Checkout our packages and book one that suits you.</p>
                </div>


                <div class="row mt-50">

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="card-image-top hover-up"><a href="jobs-grid.html">
                                <div class="image" style="background-image: url(<?= base_url() ?>assets/users/imgs/page/homepage1/location1.png);"><span class="lbl-hot">Hot</span></div>
                            </a>
                            <div class="informations"><a href="jobs-grid.html">
                                    <h5>Paris, France</h5>
                                </a>
                                <div class="row">
                                    <div class="col-lg-6 col-6"><span class="text-14 color-text-paragraph-2">5 Vacancy</span></div>
                                    <div class="col-lg-6 col-6 text-end"><span class="color-text-paragraph-2 text-14">120 companies</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="card-image-top hover-up"><a href="jobs-grid.html">
                                <div class="image" style="background-image: url(<?= base_url() ?>assets/users/imgs/page/homepage1/location2.png);"><span class="lbl-hot">Trending</span></div>
                            </a>
                            <div class="informations"><a href="jobs-grid.html">
                                    <h5>London, England</h5>
                                </a>
                                <div class="row">
                                    <div class="col-lg-6 col-6"><span class="text-14 color-text-paragraph-2">7 Vacancy</span></div>
                                    <div class="col-lg-6 col-6 text-end"><span class="color-text-paragraph-2 text-14">68 companies</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="card-image-top hover-up"><a href="jobs-grid.html">
                                <div class="image" style="background-image: url(<?= base_url() ?>assets/users/imgs/page/homepage1/location3.png);"><span class="lbl-hot">Hot</span></div>
                            </a>
                            <div class="informations"><a href="jobs-grid.html">
                                    <h5>New York, USA</h5>
                                </a>
                                <div class="row">
                                    <div class="col-lg-6 col-6"><span class="text-14 color-text-paragraph-2">9 Vacancy</span></div>
                                    <div class="col-lg-6 col-6 text-end"><span class="color-text-paragraph-2 text-14">80 companies</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    


                </div>


            </div>
        </div>
    </section>







    <form action="<?= base_url() ?>home/home_jobs_json" class="jobs_datacard-list float-right">
    </form>

    <section class="section-box mt-110">
        <div class="section-box wow animate__animated animate__fadeIn mt-70">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">Latest Jobs Post</h2>
                    <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">Explore the different types of available jobs to apply<br class="d-none d-lg-block">discover which is right for you.</p>

                </div>
                <div class="mt-10">
                    <div class="row">




                        <div id="jobs-na_datacard" class="row" data-class="row">
                            <center><i class="datacard-loader fa fa-circle-o-notch fa-spin"></i></center>
                        </div>





                    </div>
                    <div class="text-center mt-10"><a href="<?= base_url() ?>jobs" class="btn btn-brand-1 btn-icon-more hover-up">See more </a></div>







                </div>
            </div>
        </div>
    </section>











</main>

<script src="<?= base_url() ?>assets/users/scripts/home.js"></script>