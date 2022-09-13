  <section class="content-main">
      <?php if ($operation == 'add') : ?>
          <?php echo form_open(base_url('admin/users/save_usertypes'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
      <?php endif;
        if ($operation == 'edit') :  ?>
          <?php echo form_open(base_url('admin/users/update_usertypes'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
          <input type="hidden" name="ut_id" value="<?= $ut_id ?>">
      <?php endif; ?>


      <div class="row">


          <div class="col-12">
              <div class="content-header">
                  <h2 class="content-title">Add New Usertype</h2>
                  <div>
                      <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
                      <button type="submit" id="submit-form" class="btn btn-md rounded font-sm hover-up submit-form btn-block float-right">Add &nbsp; <i class="fas fa-sign-in-alt"></i></button>
                  </div>
              </div>
          </div>

          <div class="col-md-6">
              <div class="card card-primary">
                  <div class="card-header">
                      <h3 class="card-title">Usertype Details</h3>


                  </div>


                  <div class="card-body">

                      <div class="form-group">
                          <label for="inputName">Usertype</label>
                          <input data-validation="required|alpha_numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($usertypesDetails)) ? $usertypesDetails->user_type : ''; ?>" id="user_type" name="user_type" class="form-control">
                      </div>








                  </div>
                  <!-- /.card-body -->
              </div>
              <!-- /.card -->
          </div>









      </div>
      <?php echo form_close(); ?>


  </section>

