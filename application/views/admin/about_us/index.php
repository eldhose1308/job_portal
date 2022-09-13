<link rel="stylesheet" href="<?= base_url() ?>assets/admin/croppie/croppie.css" />
<script src="<?= base_url() ?>assets/admin/croppie/croppie.js"></script>



<section class="content-main">


    <div class="row">
        <?php if ($operation == 'add') : ?>
            <?php echo form_open(base_url('admin/about_us/save_about_us'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <?php endif;
        if ($operation == 'edit') :  ?>
            <?php echo form_open(base_url('admin/about_us/update_about_us'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
            <input type="hidden" name="about_id" value="<?= en_func($about_usDetails->about_id, 'e') ?>">
        <?php endif; ?>


        <?php if ($operation != 'view') :  ?>


            <div class="col-12">
                <div class="content-header">
                    <div>
                        <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
                        <button type="submit" id="submit-form" class="btn btn-md submit-form rounded font-sm hover-up btn-block float-right">Add &nbsp; <i class="fas fa-sign-in-alt"></i></button>
                    </div>
                </div>
            </div>

        <?php endif; ?>


        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About content</h3>


                </div>


                <div class="card-body">



                    <div class="form-group">
                        <label for="inputName">About title</label>
                        <input  data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($about_usDetails)) ? $about_usDetails->about_title : ''; ?>" id="about_title" name="about_title" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Front description</label>
                        <textarea  data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> id="front_description" name="front_description" class="form-control">
                          <?= (!empty($about_usDetails)) ? $about_usDetails->front_description : ''; ?>
                        </textarea>
                    </div>



                    <div class="form-group">
                        <label for="inputName">Page description</label>
                        <textarea  data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> id="page_description" name="page_description" class="form-control">
                          <?= (!empty($about_usDetails)) ? $about_usDetails->page_description : ''; ?>
                        </textarea>
                    </div>




                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>


        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Mission and Vision</h3>


                </div>


                <div class="card-body">



                    <div class="form-group">
                        <label for="inputName">Mission</label>
                        <textarea  data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> id="mission" name="mission" class="form-control">
                          <?= (!empty($about_usDetails)) ? $about_usDetails->mission : ''; ?>
                        </textarea>
                    </div>





                    <div class="form-group">
                        <label for="inputName">Vision</label>
                        <textarea data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> id="vision" name="vision" class="form-control">
                          <?= (!empty($about_usDetails)) ? $about_usDetails->vision : ''; ?>
                        </textarea>
                    </div>



                </div>
            </div>
        </div>

        <?php echo form_close(); ?>






        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">First Image Details</h3>
                    <a class="btn btn-primary" href="<?= base_url() ?>admin/about_us/add_first_image">Add Image</a>

                    <div class="form-group">
                        <div class="progress progress-sm" style="display: none;">
                            <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                            </div>
                        </div>
                    </div>


                </div>


                <div class="card-body" style="overflow-y:scroll;">

                    <?php if ($operation != 'add') : ?>
                        <input type="hidden" name="image_path" id="image_path" value="<?= $about_usDetails->about_image_1 ?>">
                        <img src="<?= base_url() ?>uploads/about_us/<?= $about_usDetails->about_image_1 ?>" class="previous_image" alt="about Image">
                    <?php endif; ?>




                </div>
            </div>
        </div>



        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Second Image Details</h3>
                    <a class="btn btn-primary" href="<?= base_url() ?>admin/about_us/add_second_image">Add Image</a>

                    <div class="form-group">
                        <div class="progress progress-sm" style="display: none;">
                            <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                            </div>
                        </div>
                    </div>


                </div>


                <div class="card-body" style="overflow-y:scroll;">



                    <div id="upload-demo" style="display: none;"></div>

                    <?php if ($operation != 'add') : ?>
                        <input type="hidden" name="image_path" id="image_path" value="<?= $about_usDetails->about_image_2 ?>">
                        <img src="<?= base_url() ?>uploads/about_us/<?= $about_usDetails->about_image_2 ?>" class="previous_image" alt="about Image">
                    <?php endif; ?>



                </div>
            </div>
        </div>




        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Third Image Details</h3>
                    <a class="btn btn-primary" href="<?= base_url() ?>admin/about_us/add_third_image">Add Image</a>

                    <div class="form-group">
                        <div class="progress progress-sm" style="display: none;">
                            <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                            </div>
                        </div>
                    </div>


                </div>


                <div class="card-body" style="overflow-y:scroll;">



                    <div id="upload-demo" style="display: none;"></div>

                    <?php if ($operation != 'add') : ?>
                        <input type="hidden" name="image_path" id="image_path" value="<?= $about_usDetails->about_image_3 ?>">
                        <img src="<?= base_url() ?>uploads/about_us/<?= $about_usDetails->about_image_3 ?>" class="previous_image" alt="about Image">
                    <?php endif; ?>



                </div>
            </div>
        </div>



        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Fourth Image Details</h3>

                    <a class="btn btn-primary" href="<?= base_url() ?>admin/about_us/add_fourth_image">Add Image</a>

                    <div class="form-group">
                        <div class="progress progress-sm" style="display: none;">
                            <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                            </div>
                        </div>
                    </div>


                </div>


                <div class="card-body" style="overflow-y:scroll;">



                    <div id="upload-demo" style="display: none;"></div>

                    <?php if ($operation != 'add') : ?>
                        <input type="hidden" name="image_path" id="image_path" value="<?= $about_usDetails->about_image_4 ?>">
                        <img src="<?= base_url() ?>uploads/about_us/<?= $about_usDetails->about_image_4?>" class="previous_image" alt="about Image">
                    <?php endif; ?>



                </div>
            </div>
        </div>








    </div>






</section>