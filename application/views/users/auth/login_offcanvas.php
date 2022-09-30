<main class="main">
    <section class="pt-55 login-register">
      <div class="container">
        <div class="row login-register-cover">
          <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">
            <div class="text-center">
              <p class="font-sm text-brand-2">Welcome back! </p>
              <h2 class="mt-10 mb-5 text-brand-1">Member Login</h2>
              <p class="font-sm text-muted mb-30">Access to all features. No credit card required.</p>
              <a href="<?= $googleAuth ?>" class="btn social-login hover-up mb-20">
                <img src="<?= base_url() ?>assets/users/imgs/template/icons/icon-google.svg" alt="Nexcode"><strong>Sign in with Google</strong>
              </a>
              <div class="divider-text-center"><span>Or continue with</span></div>
            </div>


            <?php echo form_open(base_url('users/save_login'), 'class="login-register text-start mt-20" id="login-forms" autocomplete="off" '); ?>


            <!--print error messages-->
            <?php if ($this->session->flashdata('error_msg')) : ?>

              <div class="alert alert-danger alert-dismissable">
                <?= $this->session->flashdata('error_msg') ?>
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

            <?php endif; ?>


            <div id="alert-message-div" style="display: none; padding: 0% 3%;">
            </div>

            <div class="form-group">
              <label class="form-label" for="input-1">Email address *</label>
              <input class="form-control" id="user_email" value="<?= ($this->input->get('_') ? $this->input->get('_') : '') ?>" type="email" required="" name="user_email" placeholder="abc@gmail.com">
            </div>
            <div class="form-group">
              <label class="form-label" for="input-4">Password *</label>
              <input class="form-control" id="user_password1" type="password" required="" name="user_password" placeholder="************">
            </div>

            <div class="form-group">
              <label class="form-label" for="input-4">Captcha *</label>

              <div class="col-12 mt--30 text-center">
                <div class="check-box">
                  <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div>
                </div>
                <span class="text-black"><a class="" onclick="grecaptcha.reset()" id="refresh_button" style="cursor: pointer;color:#96c952">
                    Refresh Captcha
                    <i class="fas fa-sync" aria-hidden="true"></i></a></span>
              </div>
            </div>

            <div class="login_footer form-group d-flex justify-content-between">
              <label class="cb-container">
                <input type="checkbox"><span class="text-small">Remember me</span><span class="checkmark"></span>
              </label><a class="text-muted" href="<?= base_url() ?>users/forgot_password">Forgot Password</a>
            </div>

            <div class="progress mb-3 progress-lg" style="display: none;">
              <div class="progress-bar bg-custom" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
              </div>
            </div>

            <div class="form-group">
              <button class="btn btn-brand-1 hover-up w-100 login-btn" name="login">Login</button>
            </div>
            <div class="text-muted text-center">Don't have an Account? <a href="<?= base_url() ?>users/register">Sign up</a></div>


            <?php echo form_close(); ?>




          </div>
          <div class="img-1 d-none d-lg-block"><img class="shape-1" src="<?= base_url() ?>assets/users/imgs/page/login-register/img-4.svg" alt="Nexcode"></div>
          <div class="img-2"><img src="<?= base_url() ?>assets/users/imgs/page/login-register/img-3.svg" alt="Nexcode"></div>
        </div>
      </div>
    </section>
  </main>