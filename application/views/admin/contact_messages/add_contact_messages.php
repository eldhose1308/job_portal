  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/croppie/croppie.css" />
  <script src="<?= base_url() ?>assets/admin/croppie/croppie.js"></script>

  <section class="content-main">
      <?php if ($operation == 'add') : ?>
          <?php echo form_open(base_url('admin/modules/save_modules'), 'class="form-horizontal" id="modules-form" enctype="multipart/form-data"') ?>
      <?php endif;
        if ($operation == 'edit') :  ?>
          <?php echo form_open(base_url('admin/modules/update_modules'), 'class="form-horizontal" id="modules-form" enctype="multipart/form-data"') ?>
          <input type="hidden" name="module_id" value="<?= $module_id ?>">
      <?php endif; ?>


      <div class="row">

          <div class="col-md-6">
              <div class="card card-primary">
                  <div class="card-header">
                      <h3 class="card-title">User Security Details</h3>


                  </div>


                  <div class="card-body">



                      <div class="form-group">
                          <label for="inputName">IP address</label>
                          <input <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($msgDetails)) ? $msgDetails->visitor_ip : ''; ?>" id="visitor_ip" name="visitor_ip" class="form-control">
                      </div>


                      <div class="form-group">
                          <label for="inputName">Platform used</label>
                          <input <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($msgDetails)) ? $msgDetails->visited_platform : ''; ?>" id="visited_platform" name="visited_platform" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="inputName">Agent used</label>
                          <input <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($msgDetails)) ? $msgDetails->visited_agent : ''; ?>" id="visited_agent" name="visited_agent" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="inputName">Submitted time</label>
                          <input <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($msgDetails)) ?  date('d-m-Y', strtotime($msgDetails->created_at)) . ' | ' . date('h:i a', strtotime($msgDetails->created_at)) : ''; ?>" id="created_at" name="created_at" class="form-control">
                      </div>

                  </div>
              </div>
          </div>


          <div class="col-md-6">
              <div class="card card-primary">
                  <div class="card-header">
                      <h3 class="card-title">User Details</h3>


                  </div>


                  <div class="card-body">



                      <div class="form-group">
                          <label for="inputName">Full name</label>
                          <input <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($msgDetails)) ? $msgDetails->full_name : ''; ?>" id="full_name" name="full_name" class="form-control">
                      </div>


                      <div class="form-group">
                          <label for="inputName">Email</label>
                          <input <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($msgDetails)) ? $msgDetails->email_address : ''; ?>" id="email_address" name="email_address" class="form-control">
                      </div>


                      <div class="form-group">
                          <label for="inputName">Phone</label>
                          <input <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($msgDetails)) ? $msgDetails->phone_number : ''; ?>" id="phone_number" name="phone_number" class="form-control">
                      </div>


                      <div class="form-group">
                          <label for="inputName">Subject</label>
                          <input <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($msgDetails)) ? $msgDetails->subject : ''; ?>" id="subject" name="subject" class="form-control">
                      </div>



                  </div>
                  <!-- /.card-body -->
              </div>
              <!-- /.card -->
          </div>


          <div class="col-md-12">
              <div class="card card-primary">
                  <div class="card-header">
                      <h3 class="card-title">Message Details</h3>


                  </div>


                  <div class="card-body">



                      <div class="form-group">
                          <label for="inputName">Message</label>
                          <textarea <?= ($operation == 'view') ? 'readonly' : '' ?> id="feedback" name="feedback" class="form-control">
                          <?= (!empty($msgDetails)) ? $msgDetails->feedback : ''; ?>
                          </textarea>
                      </div>
                  </div>
              </div>
          </div>







      </div>
      <?php echo form_close(); ?>

      <div class="row">
          <div class="col-12">
              <a onclick="window.history.go(-1); return false;" class="btn btn-secondary">Cancel</a>
              <?php if ($operation != 'view') : ?>
                  <a class="btn btn-success float-right add-modules-image">Add modules</a>
              <?php endif; ?>
          </div>
      </div>
  </section>