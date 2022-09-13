  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


  <section class="content-main">
      <?php if ($operation == 'add') : ?>
          <?php echo form_open(base_url('admin/modules/save_modules'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
      <?php endif;
        if ($operation == 'edit') :  ?>
          <?php echo form_open(base_url('admin/modules/update_modules'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
          <input type="hidden" name="module_id" value="<?= $module_id ?>">
      <?php endif; ?>


      <div class="row">
          <div class="col-12">
              <div class="content-header">
                  <h2 class="content-title">Add New Module</h2>
                  <div>
                      <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
                      <button type="submit" id="submit-form" class="btn btn-md rounded font-sm hover-up submit-form btn-block float-right">Add &nbsp; <i class="fas fa-sign-in-alt"></i></button>
                  </div>
              </div>
          </div>

          <div class="col-md-6">
              <div class="card card-primary">
                  <div class="card-header">
                      <h3 class="card-title">Module Details</h3>


                  </div>


                  <div class="card-body">

                      <?php $this->load->view('messages/_auth.php') ?>



                      <div class="form-group">
                          <label for="inputName">Module name</label>
                          <input data-validation="required|alpha_numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($modulesDetails)) ? $modulesDetails->module_name : ''; ?>" id="module_name" name="module_name" class="form-control">
                      </div>


                      <div class="form-group">
                          <label for="inputName">Module url</label>
                          <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($modulesDetails)) ? $modulesDetails->module_url : ''; ?>" id="module_url" name="module_url" class="form-control">
                      </div>


                      <div class="form-group">
                          <label for="inputName">Module label</label>
                          <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($modulesDetails)) ? $modulesDetails->module_label : ''; ?>" id="module_label" name="module_label" class="form-control">
                      </div>


                      <div class="form-group">
                          <label for="inputName">Status</label>
                          <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="status" id="status" class="form-control">
                              <?php foreach ($status as $statuses) : ?>
                                  <option <?= ((!empty($modulesDetails)) && $modulesDetails->status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                              <?php endforeach; ?>
                          </select>
                      </div>


                  </div>
                  <!-- /.card-body -->
              </div>
              <!-- /.card -->
          </div>









      </div>
      <?php echo form_close(); ?>

  </section>

