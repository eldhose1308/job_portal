  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <section class="content-main">
      <?php if ($operation == 'add') : ?>
          <?php echo form_open(base_url('admin/modules/save_module_group'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
      <?php else : ?>
          <?php echo form_open(base_url('admin/modules/add_modules_to_group'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
      <?php endif; ?>


      <div class="row">
          <div class="col-12">
              <div class="content-header">
                  <h2 class="content-title">Add New Module group</h2>
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

                      <div class="form-group">
                          <label for="inputName">Main Module name</label>
                          <input data-validation="required|alpha_numeric" type="text" value="<?= (!empty($moduleDetails)) ? $moduleDetails->main_module_name : ''; ?>" id="main_module_name" name="main_module_name" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="inputName">Main Module label</label>
                          <input data-validation="required" type="text" value="<?= (!empty($moduleDetails)) ? $moduleDetails->module_group_label : ''; ?>" id="module_group_label" name="module_group_label" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="inputName">Sort order</label>
                          <input data-validation="required|numeric" type="text" value="<?= (!empty($moduleDetails)) ? $moduleDetails->sort_order : ''; ?>" id="sort_order" name="sort_order" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                      </div>







                  </div>
                  <!-- /.card-body -->
              </div>
              <!-- /.card -->
          </div>


          <?php if ($operation == 'edit') : ?>

              <input type="hidden" name="mg_id" value="<?= $mg_id ?>">
              <div class="col-md-6">
                  <div class="card card-secondary">
                      <div class="card-header">
                          <h3 class="card-title">Sub Modules</h3>

                      </div>
                      <div class="card-body">
                          In order to add submodules,Please make sure that the desired submodule is unallocated at the moment !

                          <div class="form-group">
                              <label for="inputName">Submodules</label>
                              <select name="modules_list[]" class="select2" multiple="multiple" data-placeholder="Select Modules" data-dropdown-css-class="select2-primary" style="width: 100%;">
                                  <?php foreach ($modules_unallocated as $modules) : ?>
                                      <option value="<?= en_func($modules->module_id, 'e') ?>"><?= $modules->module_name ?></option>
                                  <?php endforeach; ?>
                              </select>
                          </div>

                          <div class="form-group">
                              <label for="inputSpentBudget">Allocated Modules</label>
                              <ul>
                                  <?php foreach ($allocated_modules as $modules) : ?>
                                      <li>
                                          <span class="badge bg-primary">
                                              <?= $modules->module_name ?></span>
                                          <a href="<?= base_url() ?>admin/modules/remove_submodule_allocated/<?= en_func($modules->module_id, 'e')  ?>/<?= $mg_id ?>" data-id="<?= en_func($modules->module_id, 'e') ?>" class="badge bg-danger remove_submodule_allocated"><i class="fa fa-times"></i></a>

                                      </li>
                                  <?php endforeach; ?>
                              </ul>
                          </div>


                          <div class="form-group">
                              <label for="inputSpentBudget">Progress</label>
                              <div class="progress progress-sm">
                                  <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                  </div>
                              </div>
                          </div>

                      </div>
                      <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
              </div>
          <?php endif; ?>

      </div>
      <?php echo form_close(); ?>

      
  </section>

  <script src="<?= base_url() ?>assets/admin/plugins/select2/js/select2.full.min.js"></script>
  <script>
      $('.select2').select2();
  </script>

