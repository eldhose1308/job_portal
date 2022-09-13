  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">





  <section class="content-main">
    <div class="content-header">
      <div>
        <h2 class="content-title card-title">Users List</h2>
        <p>List of users having access to this portal.</p>
      </div>
    </div>

    <div class="card mb-4">
      
    <form action="<?= base_url() ?>permission_json" class="datatable-list row">
    </form>


      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="na_datatable">
            <thead>
              <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Usertype</th>
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



  <script>

      var table = $('#na_datatable').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
          "type": "GET",
          "url": "<?= base_url('permission_json') ?>"
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
      });
    
  </script>