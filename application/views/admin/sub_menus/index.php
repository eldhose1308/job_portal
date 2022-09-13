  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">



  <section class="content-main">
      <div class="content-header">
          <div>
              <h2 class="content-title card-title">SubMenus List</h2>
              <p>List of sub menus in this portal.</p>
          </div>


          <div class="col-6 col-md-3">
              <a href="<?= base_url() ?>admin/menus/add_submenus" class="btn btn-primary float-end">Add sub menu</a>
          </div>
      </div>

      <div class="card mb-4">
          <header class="card-header">
              <div class="row gx-3">

                  <form action="<?= base_url() ?>admin/menus/submenus_json" class="datatable-list row">

                      <div class="col-12 col-md-3 mb-15">
                          <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
                      </div>


                      <div class="col-12 col-md-3 mb-15">
                          <a href="<?= base_url() ?>admin/menus/top_menus" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Add top menu</a>
                      </div>


                      <div class="col-6 col-md-3 filter">
                      <select name="tm_id" id="tm_id" class="form-control float-end select2 select2-hidden-accessible" style="width: 100%;">
                      <option value="-1">Show all parent menus</option>
                            <?php foreach ($topMenu as $topmenu) : ?>
                                <option value="<?= en_func($topmenu->tm_id, 'e') ?>"><?= $topmenu->top_menu_name ?></option>
                            <?php endforeach; ?>
                        </select>
                      </div>



                      <div class="col-6 col-md-3 filter">
                          <select class="form-control float-end" name="status" id="status">
                              <?php foreach ($status as $statuses) : ?>
                                  <option <?= ($statuses->status_id == 1) ? 'selected' : '' ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                              <?php endforeach; ?>
                          </select>
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
                              <th>Menu name</th>
                              <th>Parent menu</th>
                              <th>Sort order</th>
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
