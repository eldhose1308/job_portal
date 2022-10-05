  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <section class="content-main">
    <div class="content-header">
      <div>
        <h2 class="content-title card-title">Login history List</h2>
        <p>List of login history of your profile.</p>
      </div>




    </div>


    <div class="card mb-4">
    <header class="card-header">

      <div class="row gx-3">

        <form action="<?= base_url() ?>list_logs_json" class="datatable-list row">

          <div class="col-12 col-md-3 mb-15">
            <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
          </div>


          <div class="col-6 col-md-3 filter">
            <input type="date" name="date" id="date_login" class="form-control">
          </div>

        </form>
      </div>

    </header>
    

    <div class="card-body table-responsive">
    <table id="na_datatable" class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Login Time</th>
              <th>OS</th>
              <th>Browser</th>
              <th>Login Ip</th>
              <th>Device</th>

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
