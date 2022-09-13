<link rel="stylesheet" href="<?= base_url() ?>assets/admin/croppie/croppie.css" />
<script src="<?= base_url() ?>assets/admin/croppie/croppie.js"></script>



<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/about_us/save_second_image'), 'class="form-horizontal" id="add-form-with-imagecrop" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/about_us/update_second_image'), 'class="form-horizontal" id="add-form-with-imagecrop" enctype="multipart/form-data"') ?>
        <input type="hidden" name="about_id" value="<?= en_func($about_usDetails->about_id, 'e') ?>">
    <?php endif; ?>


    <div class="row">


        <?php if ($operation != 'view') :  ?>


            <div class="col-12">
                <div class="content-header">
                    <div>
                        <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
                        <button type="submit" id="submit-form-with-imagecrop" class="btn btn-md submit-form-with-imagecrop rounded font-sm hover-up btn-block float-right">Add &nbsp; <i class="fas fa-sign-in-alt"></i></button>
                    </div>
                </div>
            </div>

        <?php endif; ?>


        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Second Image Details</h3>


                </div>

                <div class="card-body" style="overflow-y:scroll;">



                    <div id="upload-demo" style="display: none;"></div>

                    <?php if ($operation != 'add') : ?>
                        <input type="hidden" name="image_path" id="image_path" value="<?= $about_usDetails->about_image_2 ?>">
                        <img src="<?= base_url() ?>uploads/about_us/<?= $about_usDetails->about_image_2 ?>" class="previous_image" alt="about_us Image">
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="inputSpentBudget">Select Image</label>
                        <input data-width="600" data-height="500" <?= ($operation == 'view') ? 'disabled' : '' ?> type="file" name="upload" class="form-control" id="upload" accept="image/*">
                    </div>




                </div>

                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>




    </div>
    <?php echo form_close(); ?>


</section>