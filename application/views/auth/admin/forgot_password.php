<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sanjeevini | Forgot Password</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/home/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/home/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/home/img/favicon-16x16.png">
    <link rel="manifest" href="<?= base_url() ?>assets/home/img/site.webmanifest">
    <link rel="mask-icon" href="<?= base_url() ?>assets/home/img/safari-pinned-tab.svg" color="#18393e">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/home/img/favicon.ico">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/fontawesome-free/css/all.min.css">


    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- CSS Files -->
    <link href="<?= base_url() ?>assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/admin/css/style.css" rel="stylesheet">

</head>

<body>


    <main>
        <div class="container">

            <section class="section register min-vh-70 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="<?= base_url() ?>" class="logo d-flex align-items-center w-auto">
                                    <img src="<?= base_url() ?>assets/admin/img/sanjeevini.png" alt="Logo">
                                    <span class="d-none d-lg-block text-sanj">Sanjeevini</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4 text-sanj">Forgot Password of Your Account</h5>
                                        <p class="text-center small text-white">Enter your email & captcha to send verification mail.Please dont refresh the page</p>
                                    </div>

                                    <div class="alert fade show alert-msg" style="display: none;" role="alert">
                                        <div class="message_content">
                                            Alert content
                                        </div>
                                    </div>


                                    <?php echo form_open(base_url('auth/forgot_password_post'), 'class="row g-3 needs-validation" id="forgot-forms" autocomplete="off" '); ?>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label text-label">Email</label>
                                        <div class="input-group has-validation">
                                            <input type="email" name="user_email" class="form-control" id="user_email" autocomplete="off" required>
                                            <div class="invalid-feedback text-white">Please enter your email.</div>
                                        </div>
                                    </div>





                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <div class="change-captcha">
                                                    <?php echo $captchaimage; ?>
                                                </div>

                                                <i id="loader" class="fas fa-cog fa-spin" style="font-size:24px; color: #19393d;display: none;"></i>


                                            </span>

                                        </div>
                                        <input type="text" class="form-control" name="user_captcha" placeholder="Captcha">
                                    </div>


                                    <div class="col-12">

                                        <div class="progress progress-md progress-md-forgot" style="display: none;width: 100%">
                                            <div class="progress-bar bg-success progress-bar progress-bar-forgot" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                            </div>
                                        </div>


                                        <button class="btn btn-primary-sanj w-100 forgot-btn" type="submit">Send verification mail</button>
                                    </div>


                                    <input type="hidden" name="device_type" id="device_type">
                                    <?php echo form_close(); ?>




                                    <?php echo form_open(base_url('auth/change_password_post'), 'class="row g-3 needs-validation" id="change-forms" autocomplete="off" style="display: none;"'); ?>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label text-label">Otp</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="user_otp" class="form-control" id="user_email" autocomplete="off" required>
                                            <div class="invalid-feedback text-white">Please enter Otp.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label text-label">New Password</label>
                                        <div class="input-group has-validation">
                                            <input type="password" name="new_password" class="form-control" id="user_email" autocomplete="off" required>
                                            <div class="invalid-feedback text-white">Please enter your password.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label text-label">Confirm Password</label>
                                        <div class="input-group has-validation">
                                            <input type="password" name="confirm_password" class="form-control" id="user_email" autocomplete="off" required>
                                            <div class="invalid-feedback text-white">Please enter your password.</div>
                                        </div>
                                    </div>



                                    <div class="col-12">

                                        <div class="progress progress-md progress-md-change" style="display: none;width: 100%">
                                            <div class="progress-bar bg-success progress-bar progress-bar-change" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                            </div>
                                        </div>


                                        <button class="btn btn-primary-sanj w-100 change-btn" type="submit">Change password</button>
                                    </div>

                                    <?php echo form_close(); ?>

                                    <div class="col-12">
                    <p class="small mb-0 text-white">Want to login?
                      <a href="<?= base_url('login') ?>" class="form-label text-label">Go to login</a>
                    </p>
                  </div>

                                </div>
                            </div>

                            <div class="credits text-white">
                                Designed by <a class="text-sanj" href="https://google.com/">Nobody</a>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


    <!-- Vendor JS Files -->
    <script src="<?= base_url() ?>assets/admin/vendor/bootstrap/js/bootstrap.bundle.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url() ?>assets/admin/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>

</html>


<script>
    $(document).on('submit', '#change-forms', function(e) {
        e.preventDefault();

        alertMessage('', '');

        $(".change-btn").toggle();
        $(".progress-md-change").toggle();

        var formData = new FormData($("#change-forms")[0]);
        var post_url = $($(this)).attr('action');
        var change_xhr = $.ajax({
            url: post_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = parseInt((evt.loaded / evt.total) * 100);
                        $(".progress-bar-change").width(percentComplete + '%');
                        $(".progress-bar-change").html(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            beforeSend: function() {
                $(".progress-change").show();
                $(".progress-bar-change").width('0%');
            }
        })

        change_xhr.done(function(data) {
            $(".change-btn").toggle();
            $(".progress-md-change").toggle();

            refresh_captcha();
            var out = jQuery.parseJSON(data);
            alertMessage(out.status, out.msg);
            $('.change-btn').show();

            if (out.status == 'success') {
             
            }

        });

        change_xhr.fail(function() {
            alertMessage('error', 'Page has expired, try later !');
            loading_btn();
            refresh_captcha();
            $('.change-btn').show();
            $(".progress-md-change").toggle();

        });
    });


    $(document).on('submit', '#forgot-forms', function(e) {
        e.preventDefault();

        alertMessage('', '');

        $(".forgot-btn").toggle();
        $(".progress-md-forgot").toggle();

        var formData = new FormData($("#forgot-forms")[0]);
        var post_url = $($(this)).attr('action');
        var usertype_xhr = $.ajax({
            url: post_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = parseInt((evt.loaded / evt.total) * 100);
                        $(".progress-bar-forgot").width(percentComplete + '%');
                        $(".progress-bar-forgot").html(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            beforeSend: function() {
                $(".progress-forgot").show();
                $(".progress-bar-forgot").width('0%');
            }
        })

        usertype_xhr.done(function(data) {
            $(".forgot-btn").toggle();
            $(".progress-md-forgot").toggle();

            refresh_captcha();
            var out = jQuery.parseJSON(data);
            alertMessage(out.status, out.msg);
            $('.forgot-btn').show();

            if (out.status == 'success') {
                $('#forgot-forms').hide();
                $('#change-forms').show();

            }

        });

        usertype_xhr.fail(function() {
            alertMessage('error', 'Page has expired, try later !');
            loading_btn();
            refresh_captcha();
            $('.forgot-btn').show();
            $(".progress-md-forgot").toggle();
        });
    });


    var url = '<?php echo base_url('change_captcha'); ?>';

    $(document).on("click", ".change-captcha", function(e) {

        e.preventDefault();
        refresh_captcha();
    });


    function refresh_captcha() {
        $('.change-captcha').html('');
        $('#loader').show();

        var fetching = $.get(url, {
            s: 'captcha'
        });

        fetching.done(function(data) {
            $('#loader').hide();
            $('.change-captcha').html(data);

        });
    }

    device_type = getDeviceType();
    $('#device_type').val(device_type);


    function getDeviceType() {
        const ua = navigator.userAgent;
        if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) {
            device_type = "Tablet";
        }
        if (/Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test(ua)) {
            device_type = "Mobile";
        }
        device_type = "Desktop";

        return device_type;
    }




    function reload_page(to_page = '') {
        setTimeout(function() {
            location.reload(true);
        }, 1000);
    }


    function loading_btn(this_elem = '') {
        var xhr_loader = document.querySelectorAll('.loader-xhr');
        if (xhr_loader.length > 0) {
            xhr_loader[0].remove();
        } else {
            //this_elem.css('opacity', '0.7');
            this_elem.append('<i class="fas fa-spinner fa-spin loader-xhr"></i>');
        }
        return;
    }

    function alertMessage(status, message) {
        $('.alert-msg').removeClass('alert-success');
        $('.alert-msg').removeClass('alert-danger');

        $('body,html').animate({
            scrollTop: 0
        }, 500);

        status = (status == 'error') ? 'alert-danger' : 'alert-' + status;

        $('.alert-msg').addClass(status);
        $('.message_content').html(message);
        $('.alert-msg').show(1200);

        reload_progressbar();

    }


    function reload_progressbar() {


        setTimeout(function() {
            $(".progress-bar").width('0%');
            $(".progress-bar").html('0%');
            //location.reload(true);
        }, 1000);
    }
</script>

<style>
    body {
        background: #2f4c50;
    }

    .card {
        background: #19393d;
    }

    .btn-primary-sanj {
        background: #96c952;
    }

    .text-sanj {
        color: #96c952 !important;
    }

    .text-label {
        color: #96c952;
        font-size: 14px;
    }
</style>