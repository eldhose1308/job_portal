  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <section class="content-main">
      <div class="content-header">
          <div>
              <h2 class="content-title card-title">Failed Login history List</h2>
              <p>List of failed login history in the portal.</p>
          </div>




      </div>

      <div class="card mb-4">


          <header class="card-header">

              <div class="row gx-3">

                  <form action="<?= base_url() ?>list_failed_logs_json" class="datatable-list row">

                      <div class="d-inline-block col-md-3 filter">
                          <input type="date" name="date" id="date_login" class="form-control">
                      </div>
                  </form>

              </div>
      </div>
      <div class="card">
          <div class="result card-body table-responsive">
              <table id="na_datatable" class="table table-hover">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Username</th>
                          <th>Password</th>
                          <th>Login Time</th>
                          <th>OS</th>
                          <th>Browser</th>
                          <th>Login Ip</th>

                      </tr>
                  </thead>

              </table>
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