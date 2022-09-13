  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">



  <section class="content-main">
      <div class="content-header">
          <div>
              <h2 class="content-title card-title">Modules List</h2>
              <p>List of modules in this portal.</p>
          </div>


          <div class="col-6 col-md-4">
              <a href="<?= base_url() ?>admin/modules/add_modules" class="btn btn-primary load-btn btn-sm float-end">Create new module<i class="m-1 fa fa-plus-circle"></i></a>
          </div>

      </div>

      <div class="card mb-4">
          <header class="card-header">
              <div class="row gx-3">

                  <form action="<?= base_url() ?>admin/modules/modules_json" class="datatable-list row">

                      <div class="col-md-2 me-auto filter">
                          <select class="form-control" name="status" id="status">
                              <?php foreach ($status as $statuses) : ?>
                                  <option <?= ($statuses->status_id == 1) ? 'selected' : '' ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                              <?php endforeach; ?>
                          </select>
                      </div>

                      <div class="col-6 col-md-5">
                          <a href="<?= base_url() ?>admin/modules/module_grouping" class="btn btn-dark load-btn btn-sm float-end">Module groups<i class="m-1 fa fa-list"></i></a>
                      </div>

                  </form>


              </div>
          </header>


          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-hover" id="na_datatable">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Module</th>
                              <th>Parent module</th>
                              <th>Last updated</th>
                              <th></th>

                          </tr>
                      </thead>

                  </table>
              </div>

          </div>

      </div>


  </section>





  <!-- DataTables  & Plugins -->
  <script src="<?= base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>