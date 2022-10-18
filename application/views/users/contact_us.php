<script src='https://www.google.com/recaptcha/api.js'></script>


<main class="main">
    <section class="section-box">
        <div class="breacrumb-cover bg-img-contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="mb-10">Contact Us</h2>
                        <p class="font-lg color-text-paragraph-2">Get in touch with us</p>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <ul class="breadcrumbs mt-40">
                            <li><a class="home-icon" href="<?= base_url() ?>">Home</a></li>
                            <li>Contact</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-40"><span class="font-md color-brand-2 mt-20 d-inline-block">Contact us</span>
                    <h2 class="mt-5 mb-10">Get in touch</h2>
                    <?php echo form_open(base_url('save_contact_us'), 'class="contact-form-style mt-30" id="contact-form" autocomplete="off" '); ?>

                    <div class="row wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <div class="col-lg-6 col-md-6">
                            <div class="input-style mb-20">
                                <input class="font-sm color-text-paragraph-2" data-validation="required|alpha" id="full_name" name="full_name" placeholder="Enter your name" type="text">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="input-style mb-20">
                                <input class="font-sm color-text-paragraph-2" data-validation="required|valid_email" name="email_address" id="email_address" placeholder="Your email" type="email">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="input-style mb-20">
                                <input class="font-sm color-text-paragraph-2" data-validation="required|numeric|exact_length-10" name="phone_number" id="phone_number" placeholder="Phone number" type="tel">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">

                            <div class="col-md-6 mb-3">
                                <div class="check-box">
                                    <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div>
                                </div>

                                <span class="text-primary">Refresh captcha? <a class="" onclick="grecaptcha.reset()" id="refresh_button" style="cursor: pointer;color:#96c952">Click here to refresh
                                        <i class="fas fa-sync" aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="textarea-style mb-30">
                                <textarea class="font-sm color-text-paragraph-2" data-validation="required" id="feedback" name="feedback" placeholder="Tell us about yourself"></textarea>
                            </div>
                            <button class="submit btn btn-send-message submit-form" type="submit">Send message</button>
                            <label class="ml-20">
                                We will get in touch with you as soon as we receive your query,
                            </label>
                        </div>
                    </div>

                    <?php echo form_close(); ?>

                    <p class="form-messege"></p>
                </div>
                <div class="col-lg-4 text-center d-none d-lg-block"><img src="<?= base_url() ?>assets/users/imgs/page/contact/img.png" alt="joxBox"></div>
            </div>
        </div>
    </section>


    <section class="section-box mt-80">
        <div class="container">
            <div class="box-info-contact">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-30"><a href="#"><img src="<?= base_url() ?>assets/users/imgs/page/contact/logo.svg" alt="joxBox"></a>
                        <div class="font-sm color-text-paragraph">205 North Michigan Avenue, Suite 810 Chicago, 60601, USA<br> Phone: (123) 456-7890<br> Email: <a>[email&#160;protected]</a></div><a class="text-uppercase color-brand-2 link-map" href="#">View map</a>
                    </div>

                </div>
            </div>
        </div>
    </section>


</main>

<script src="<?= base_url() ?>assets/users/scripts/home.js"></script>