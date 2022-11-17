  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/users/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/users/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/users/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <section class="section-box mt-30">
      <div class="container">
          <div class="content-page">

              <div class="card">


                  <div class="card-header row">
                      <div class="d-inline-block col-md-6">
                          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp;
                              Contact messages</h3>
                      </div>


                      <div class="d-block col-md-3">
                          <select class="form-select" name="status" id="status">
                              <?php foreach ($status as $statuses) : ?>
                                  <option <?= ($statuses->status_id == 1) ? 'selected' : '' ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                              <?php endforeach; ?>

                          </select>
                      </div>

                  </div>
              </div>
              <div class="card">
                  <div class="result card-body table-responsive">
                      <table id="na_datatable" class="table table-hover">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Full name</th>
                                  <th>Submitted time</th>
                                  <th>Details</th>
                                  <th>Status</th>
                                  <th></th>
                                  <th>Change</th>

                              </tr>
                          </thead>

                      </table>
                  </div>
              </div>
          </div>
      </div>
  </section>

  <!-- DataTables  & Plugins -->
  <script src="<?= base_url() ?>assets/users/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/users/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/users/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>assets/users/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/users/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url() ?>assets/users/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

  <script>
      $(document).ready(function() {
          load_json();
      });

      $(document).on('change', '#status', function(e) {
          load_json();
          e.preventDefault();
      });


      $(document).on('change', '.change_status', function(e) {
          e.preventDefault();
          var status = $($(this)).val();
          var message_id = $($(this)).attr('data-id');

          var status_xhr = $.post('<?= base_url('admin/contact_messages/change_status'); ?>', {
              '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
              message_id: message_id,
              status: status
          });



          status_xhr.done(function(data) {
              var out = jQuery.parseJSON(data);
              AlertandToast('info', out.msg);
              load_json();

          });

          status_xhr.fail(function() {
              AlertandToast('error', 'Page has expired, try later !');
              load_json();
          });
      });


      function load_json() {
          $("#na_datatable").dataTable().fnDestroy();

          var status = $("#status").val();

          var table = $('#na_datatable').DataTable({
              "processing": true,
              "serverSide": false,
              "ajax": {
                  "type": "GET",
                  "data": {
                      status: status
                  },
                  "url": "<?= base_url('admin/contact_messages/contact_messages_json') ?>"
              },
              "responsive": true,
              "lengthChange": true,
              "autoWidth": false,
          });
      }
  </script>