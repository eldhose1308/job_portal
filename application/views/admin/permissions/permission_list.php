  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


  <section class="content-main">
    <div class="col-12">
      <div class="content-header">
        <h2 class="content-title">Change permissions for users</h2>
        <div>
          <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
        </div>
      </div>
    </div>


    <div class="card">
      <div class="card-header">
        <div class="d-inline-block col-md-6">
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp;
            Module Allocation</h3>
        </div>



      </div>
    </div>
    <div class="card">
      <div class="result card-body table-responsive">

        <table class="table table-hover" id="na_datatable">
          <thead class="thead-light">
            <tr>
              <th>Module</th>
              <th>Access</th>

            </tr>
          </thead>
          <tbody>

            <?php foreach ($menusList as $menuLists) :  ?>
              <tr>

                <td><?= $menuLists->module_name ?></td>

                <?php
                $module_id = en_func($menuLists->module_id, 'e');
                $menusAccess = $this->M_permissions->list_modules_access($module_id, $user_id);

                $toggle_status = '';
                if (!empty($menusAccess))
                  $toggle_status = ($menusAccess->status == 1) ? 'checked' : '';
                ?>
                <td>

                  <div class="form-check form-switch">
                    <input class="form-check-input" data-action="add" data-module="<?= $menuLists->module_name ?>" data-id="<?= en_func($menuLists->module_id, 'e') ?>" type="checkbox" id="flexSwitchCheckChecked" <?= $toggle_status ?>>
                    <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                  </div>
                </td>



              </tr>

            <?php endforeach; ?>
          </tbody>
        </table>

        <input type="hidden" value="<?= $user_id ?>" id="user_id">
      </div>
    </div>
  </section>

  <script>
    $('.form-check-input').on('change', function() {
      var this_option = $($(this));
      var module_id = $(this).attr('data-id');
      var module_name = $(this).attr('data-module');
      var user_id = $('#user_id').val();
      var status = (this.checked) ? '1' : '0';
      var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

      var access_xhr = $.post('<?= base_url('change_module_permission'); ?>', {
        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
        module_id: module_id,
        module_name: module_name,
        user_id: user_id,
        status: status
      })

      access_xhr.done(function(data) {
        var out = jQuery.parseJSON(data);
        AlertandToast('info', out.msg, false);

      });

      access_xhr.fail(function() {
        AlertandToast("error","there seems to be some problem");
      });

    });

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

  <!-- DataTables  & Plugins -->
  <script src="<?= base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

