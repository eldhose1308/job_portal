<link rel="stylesheet" href="<?= base_url() ?>assets/users/croppie/croppie.css" />
<script src="<?= base_url() ?>assets/users/croppie/croppie.js"></script>

<main class="main">
  <section class="section-box mt-30">
    <div class="container">
      <div class="row  flex-row-reverse">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?= base_url() . 'uploads/users/profile_images/' . ss('user_photo') ?>" alt="Profile" class="rounded-circle">
              <h2><?= ss('full_name') ?></h2>
              <h3><?= ss('user_name') ?></h3>
              <h6><?= $this->input->ip_address() ?></h6>

            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">



                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#update-resume">Add/Update Resume</button>
                </li>


                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-history">Login History</button>
                </li>


              </ul>
              <div class="tab-content pt-2">


                <div id="upload-demo"></div>

                <div class="tab-pane  show active profile-edit pt-3" id="profile-edit">

                  <?php echo form_open(base_url('users/profile_image_store'), 'class="form-horizontal" id="profile-page" enctype="multipart/form-data"') ?>
                  <?php echo form_close(); ?>


                  <!-- Profile Edit Form -->
                  <?php echo form_open(base_url('users/update_profile'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label d-none">Profile Image</label>

                    <div class="col-md-8 col-lg-9 d-none">
                      <!-- <img id="profile_image" class="img-circle" src="<?= base_url() . 'uploads/users/profile_images/' . ss('user_photo') ?>" alt="Profile"> -->

                      <div class="pt-2">
                        <input type="file" name="upload" class="form-control" id="upload" accept="image/*">

                        <div class="mt-2">
                          <a class="btn btn-primary btn-sm" id="upload-profile-image" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a class="btn btn-danger btn-sm" id="remove-profile-image" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>


                      </div>
                    </div>
                  </div>

                  <div class="row mt-1 mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="user_fullname" data-validation="required|alpha" type="text" class="form-control" id="user_fullname" value="<?= ss('full_name') ?>">
                    </div>
                  </div>



                  <div class="row mb-3">
                    <label for="company" class="col-md-4 col-lg-3 col-form-label">User name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="user_name" type="text" data-validation="required" class="form-control" id="user_name" value="<?= ss('user_name') ?>">
                    </div>
                  </div>


                  <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="user_mobile" type="text" data-validation="required|numeric|exact_length-10" class="form-control" id="user_mobile" value="<?= ss('user_mobile') ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="user_email" type="email" data-validation="required|valid_email" class="form-control" id="user_email" value="<?= ss('user_email') ?>">
                    </div>
                  </div>




                  <div class="text-center">
                    <button type="submit" class="btn btn-primary submit-form">Save Changes</button>
                  </div>

                  <?php echo form_close(); ?>
                  <!-- End Profile Edit Form -->



                </div>

                <div class="tab-pane fade pt-3" id="profile-history">

                  <?php echo form_open(base_url('users/login_history'), 'class="form-horizontal" id="login_history-page" enctype="multipart/form-data"') ?>
                  <?php echo form_close(); ?>

                  <!-- History Form -->
                  <div class="timeline timeline-inverse">
                    <!-- timeline time label -->
                    <div class="time-label">
                      <a href="<?= base_url() ?>list_logs" class="btn btn-sm btn-primary float-right">See full history <i class="ml-10 fa fa-clock-o"></i>
                      </a>

                    </div>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->

                    <ul class="verti-timeline list-unstyled font-sm log_history">
                    </ul>

                    <!-- END timeline item -->


                  </div>
                  <!-- END History Form -->



                </div>

                <div class="tab-pane fade pt-3" id="update-resume">
                  <!-- Change Password Form -->
                  <?php echo form_open(base_url('users/update_resume'), 'class="form-horizontal" id="add-form-without-csrf" enctype="multipart/form-data"') ?>


                  <input name="current_resume" value="<?= ss('user_resume') ?>" type="hidden" class="form-control" id="current_resume">



                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">New Resume</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="resume" type="file" class="form-control document-img-upload" id="resume">
                    </div>
                  </div>


                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Resume preview</label>

                    <?php if (strlen(ss('user_resume')) > 0) : ?>
                      <iframe src="<?= RESUME . ss('user_resume') ?>" height="300" id="previous_document" frameborder="0"></iframe>
                    <?php endif; ?>

                    <iframe src="" height="300" id="document-preview" style="display: none;" frameborder="0"></iframe>
                  </div>



                  <div class="text-center mt-65">
                    <button type="submit" class="btn btn-primary submit-form">Change resume</button>
                  </div>

                  <?php echo form_close(); ?>
                  <!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

</main>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    getloginHistory();
  });





  function getloginHistory() {
    let csrf_hash = $('input[name="_token"]').val();
    var form_url = $('#login_history-page').attr('action');

    var logxhr = $.post(form_url, {
      '_token': csrf_hash
    })

    logxhr.done(function(data) {
      var out = jQuery.parseJSON(data);
      appendlogHistory(out.logs);
    });

    logxhr.fail(function() {
      AlertandToast('error', 'Page has expired, try later !');

    });

  }



  function appendlogHistory(logs) {
    // return;
    var activities = '';
    logs.map(function(element) {

      activities += `<li class="event-list">
              <div class="event-timeline-dot">
                <i class="material-icons md-play_circle_outline font-xxl"></i>
              </div>
              <div class="media">
                <div class="me-3">
                  <h6><span>${element.datetime}</span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>
                </div>
                <div class="media-body">
                  <div>${element.login_os + ' - ' + element.login_browser + ' | ' + element.login_ip}</div>
                </div>
              </div>
            </li>`;
    });

    $('.log_history').html(activities);


  }
</script>


<script>
  //1920 * 902
  $('#upload').on('change', function() {
    $('#profile_image').hide();
    $('#upload-demo').croppie('destroy');

    $uploadCrop = $('#upload-demo').croppie({
      enableExif: true,
      boundary: {
        width: 130,
        height: 130
      },
      viewport: {
        width: 128,
        height: 128,
        type: 'circle'
      }
    });

    var reader = new FileReader();
    reader.onload = function(e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      }).then(function() {
        $('.upload-result').show();
        // console.log('jQuery bind complete');

      });

    }
    reader.readAsDataURL(this.files[0]);

  });



  $('#remove-profile-image').click(function(event) {
    $('#upload-demo').croppie('destroy');
    $('#profile_image').show();
    $('#profile-page')[0].reset();
    $('#upload_status_msg').html('Profile Photo removed');
    $('#upload_status_msg').css('color', '#dc3545');


  });

  $('#upload-profile-image').click(function(event) {
    var this_btn_elem = $($(('#upload-profile-image')));
    loading_btn(this_btn_elem);


    if (typeof $uploadCrop == 'undefined') {
      $('#upload-profile-image').show();
      $('#upload_status_msg').html('Please select an image');
      $('#upload_status_msg').css('color', '#dc3545');
      loading_btn();
      return;
    }
    $uploadCrop.croppie('result', {
      type: 'canvas',
      size: 'viewport'

    }).then(function(response) {
      var formData = new FormData($("#profile-page")[0]);
      formData.append('photo', response);

      var profilepic_xhr = $.ajax({
        url: 'profile_image_store',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        xhr: function() {
          var xhr = new window.XMLHttpRequest();
          xhr.upload.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
              var percentComplete = parseInt((evt.loaded / evt.total) * 100);
              $(".progress-bar").width(percentComplete + '%');
              $(".progress-bar").html(percentComplete + '%');
            }
          }, false);
          return xhr;
        },
        beforeSend: function() {
          $(".progress-bar").width('0%');
        }
      })

      profilepic_xhr.done(function(data) {
        loading_btn();

        var out = jQuery.parseJSON(data);
        toastSuccess(out.status, out.msg);
        $('#profile-page')[0].reset();
        $('#upload-demo').croppie('destroy');
        $('#upload-profile-image').show();
        $('#profile_image').show();
        $('#profile_image').attr('src', response);
      });

      profilepic_xhr.fail(function() {
        toastSuccess('error', 'Page has expired, try later !');
        loading_btn();

      });
    });
  });
</script>