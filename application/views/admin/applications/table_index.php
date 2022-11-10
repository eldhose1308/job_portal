  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/users/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/users/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/users/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">




  <main class="main">

      <section class="section-box mt-30">
          <div class="container">
              <div class="row">



                  <div data-id="1" class="resizable-cards col-md-4">

                      <div class="row">
                          <div class="col-md-6"><a class="expand-left btn btn-custom btn-sm"><i class="fa fa-search-minus"></i></a></div>
                          <div class="col-md-6"><a class="expand-right btn btn-custom btn-sm float-end"><i class="fa fa-search-plus"></i></a></div>
                      </div>
                      <hr>
                      <div class="card mb-4">
                          <div class="card-header fw-bold">
                              Latest applied jobs
                          </div>
                          <div class="card-body">

                              <form action="<?= base_url() ?>admin/applications/jobs_json_table" class="datatable-list row">


                                  <div class="table-responsive">
                                      <table class="table table-hover" id="na_datatable">
                                          <thead>
                                              <tr>
                                                  <th>#</th>
                                                  <th>Job title</th>
                                                  <th></th>
                                              </tr>
                                          </thead>

                                      </table>
                                  </div>
                              </form>
                          </div>
                      </div>

                  </div>





                  <div data-id="2" class="resizable-cards col-md-8">


                      <div class="row">
                          <div class="col-md-6"><a class="expand-left btn btn-custom btn-sm"><i class="fa fa-search-minus"></i></a></div>
                          <div class="col-md-6"><a class="expand-right btn btn-custom btn-sm float-end"><i class="fa fa-search-plus"></i></a></div>
                      </div>
                      <hr>
                      <div class="card mb-4">
                          <div class="card-header fw-bold">
                              Latest Applications
                          </div>
                          <div class="card-body">

                              <div class="table-responsive">
                                  <table class="table table-hover" id="candidates_datatable">
                                      <thead>
                                          <tr>
                                              <th>#</th>
                                              <th>Applicant name</th>
                                              <th>Status</th>
                                              <th>Applied at</th>
                                              <th>Actions</th>
                                              <th>Docs</th>

                                          </tr>
                                      </thead>

                                  </table>
                              </div>
                          </div>
                      </div>

                  </div>



              </div>
          </div>
      </section>
  </main>




  <script>
      $(document).on('click', '.expand-right', function(e) {
          e.preventDefault();
          let default_class = 'resizable-cards'
          let col_class = 'col-md-';
          let resizable_cards = $('.resizable-cards');
          let current_card = $(this).parent().parent().parent();
          let current_class = current_card[0].className;
          let current_class_length = Number(current_class[current_class.length - 1]) + 1;


          let selected_index = current_card[0].dataset.id;

          let changing_index = selected_index == 1 ? 1 : 0;
          let changing_card = resizable_cards[changing_index];
          let changing_class = changing_card.className;
          let new_changing_class = changing_class.split(" ")[changing_class.split(" ").length - 1]

          let new_colum_length = 12 - current_class_length;

          current_card.removeClass();
          current_card.addClass(default_class);
          current_card.addClass(col_class + current_class_length);

          changing_card.classList.remove(new_changing_class);
          changing_card.classList.add(col_class + new_colum_length);
      });

      $(document).on('click', '.expand-left', function(e) {
          e.preventDefault();
          let default_class = 'resizable-cards'
          let col_class = 'col-md-';
          let resizable_cards = $('.resizable-cards');
          let current_card = $(this).parent().parent().parent();
          let current_class = current_card[0].className;
          let current_class_length = Number(current_class[current_class.length - 1]) - 1;


          let selected_index = current_card[0].dataset.id;

          let changing_index = selected_index == 1 ? 1 : 0;
          let changing_card = resizable_cards[changing_index];
          let changing_class = changing_card.className;
          let new_changing_class = changing_class.split(" ")[changing_class.split(" ").length - 1]

          let new_colum_length = 12 - current_class_length;

          current_card.removeClass();
          current_card.addClass(default_class);
          current_card.addClass(col_class + current_class_length);

          changing_card.classList.remove(new_changing_class);
          changing_card.classList.add(col_class + new_colum_length);
      });
  </script>

  <!-- DataTables  & Plugins -->
  <script src="<?= base_url() ?>assets/users/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/users/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/users/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>assets/users/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/users/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url() ?>assets/users/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script src="<?= base_url() ?>assets/users/scripts/applications.js"></script>
