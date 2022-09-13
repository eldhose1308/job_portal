<?php
foreach ($css_files as $file) : ?>
  <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>

<section class="content-main">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Modules List</h3>
            <div class="d-inline-block float-right">
              <a href="<?= base_url('admin/modules/module_grouping'); ?>" title="Download Full Database Zip" class="btn btn-secondary float-right"><i class="fa fa-random"></i> &nbsp; Group Modules</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?php echo $output; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php foreach ($js_files as $file) : ?>
  <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>