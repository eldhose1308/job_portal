  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <section class="content-main">

    <div class="content-header">
      <div>
        <h2 class="content-title card-title">Activities List</h2>
        <p>List of activites you have done in this portal.</p>
      </div>


    </div>


    <div class="card mb-4">

      <header class="card-header">
        <div class="row gx-3">

          <form action="<?= base_url() ?>admin/activity/activity_json" class="datatable-list row">

            <div class="col-12 col-md-3 mb-15">
              <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
            </div>


            <div class="col-6 col-md-3 filter">
              <select name="user_id" id="user_id" class="form-control">
                <?php if ($user_type == 1) :  ?>
                  <option value="0">--Select user--</option>
                <?php endif; ?>


                <?php foreach ($usersList as $users) :
                  if ($user_type == 1) :  ?>
                    <option value="<?= en_func($users->user_id, 'e') ?>"> <?= $users->full_name ?> </option>
                    <?php else : if ($users->user_id == $user_id) : ?>
                      <option value="<?= en_func($users->user_id, 'e') ?>"> <?= $users->full_name ?> </option>
                <?php endif;
                  endif;
                endforeach; ?>
              </select>
            </div>




          </form>



        </div>
      </header>


      <div class="card-body table-responsive">
        <table id="na_datatable" class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>User</th>
              <th>Activity</th>
              <th>Date Updated</th>

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
