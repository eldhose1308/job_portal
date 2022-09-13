<link rel="stylesheet" href="<?= base_url() ?>assets/admin/croppie/croppie.css" />
<script src="<?= base_url() ?>assets/admin/croppie/croppie.js"></script>



<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/banner/save_banner'), 'class="form-horizontal" id="add-form-with-imagecrop" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/banner/update_banner'), 'class="form-horizontal" id="add-form-with-imagecrop" enctype="multipart/form-data"') ?>
        <input type="hidden" name="banner_id" value="<?= $banner_id ?>">
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
                    <h3 class="card-title">Banner Details</h3>


                </div>


                <div class="card-body">

                    <div class="form-group">
                        <label for="inputName">Banner title</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($bannerDetails)) ? $bannerDetails->banner_name : ''; ?>" id="banner_name" name="banner_name" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Sort order</label>
                        <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($bannerDetails)) ? $bannerDetails->sort_order : ''; ?>" id="sort_order" name="sort_order" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>


                    
                    <div class="form-group">
                        <label for="inputName">Banner caption</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($bannerDetails)) ? $bannerDetails->banner_caption : ''; ?>" id="banner_caption" name="banner_caption" class="form-control">
                    </div>




                    <div class="form-group">
                          <label for="inputName">Banner Description</label>
                          <textarea data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> id="banner_description" name="banner_description" class="form-control">
                          <?= (!empty($bannerDetails)) ? $bannerDetails->banner_description : ''; ?>
                        </textarea>
                      </div>
                  

                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="status" id="status" class="form-control">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ((!empty($bannerDetails)) && $bannerDetails->status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>




                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>




        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Image Details</h3>

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
                        <input type="hidden" name="image_path" id="image_path" value="<?= $bannerDetails->banner_photo ?>">
                        <img src="<?= base_url() ?>uploads/banner/<?= $bannerDetails->banner_photo ?>" class="previous_image" alt="banner Image">
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="inputSpentBudget">Select Image</label>
                        <input data-width="1200" data-height="600" <?= ($operation == 'view') ? 'disabled' : '' ?> type="file" name="upload" class="form-control" id="upload" accept="image/*">
                    </div>




                </div>
            </div>
        </div>




    </div>
    <?php echo form_close(); ?>


</section>

