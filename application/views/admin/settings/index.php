  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/croppie/croppie.css" />
  <script src="<?= base_url() ?>assets/admin/croppie/croppie.js"></script>

  <section class="content-main">
      <?php if ($operation == 'add') : ?>
          <?php echo form_open(base_url('admin/site_settings/save_site_settings'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
      <?php endif;
        if ($operation == 'edit') :  ?>
          <?php echo form_open(base_url('admin/site_settings/update_site_settings'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
          <input type="hidden" name="site_id" value="<?= en_func($siteDetails->site_id, 'e') ?>">
      <?php endif; ?>


      <div class="row">



          <?php if ($operation != 'view') :  ?>


              <div class="col-12">
                  <div class="content-header">
                      <div>
                          <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
                          <button type="submit" id="submit-form" class="btn btn-md submit-form rounded font-sm hover-up btn-block float-right">Add &nbsp; <i class="fas fa-sign-in-alt"></i></button>
                      </div>
                  </div>
              </div>

          <?php endif; ?>



          <div class="col-md-6">
              <div class="card card-primary">
                  <div class="card-header">
                      <h3 class="card-title">Site Details</h3>


                  </div>


                  <div class="card-body">




                      <div class="form-group">
                          <label for="inputName">Site name</label>
                          <input  data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($siteDetails)) ? $siteDetails->site_name : ''; ?>" id="site_name" name="site_name" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="inputName">Contact numbers (If there are more than one,then write it comma seperated)</label>
                          <input  data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($siteDetails)) ? $siteDetails->contact_numbers : ''; ?>" id="contact_numbers" name="contact_numbers" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="inputName">Email address</label>
                          <input data-validation="required|valid_email" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($siteDetails)) ? $siteDetails->email_address : ''; ?>" id="email_address" name="email_address" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="inputName">Map location</label>
                          <input  data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($siteDetails)) ? $siteDetails->map_location : ''; ?>" id="map_location" name="map_location" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="inputName">Address</label>
                          <textarea  data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> id="address" name="address" class="form-control">
                          <?= (!empty($siteDetails)) ? $siteDetails->address : ''; ?>
                        </textarea>
                      </div>












                  </div>
                  <!-- /.card-body -->
              </div>
              <!-- /.card -->
          </div>









      </div>
      <?php echo form_close(); ?>


  </section>