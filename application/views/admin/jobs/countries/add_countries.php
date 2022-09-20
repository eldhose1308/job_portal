<section class="content-main">

    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/jobs/save_countries'), 'class="login-form" id="add-form" autocomplete="off" '); ?>
    <?php endif; 
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/jobs/update_countries'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="country_id" value="<?= $country_id ?>">
    <?php endif; ?>


    <div class="row mb-5">

        <?php if ($operation != 'view') :  ?>

            <div class="col-12 mb-10">
                <div class="content-header">
                    <div>
                        <button type="submit" id="submit-form" class="btn btn-sm btn-custom font-sm hover-up submit-form float-right"><?= ($operation == 'add') ? 'Add' : 'Update'; ?> Country &nbsp; <i class="fas fa-sign-in-alt"></i></button>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <div class="col-md-12">
            <div class="card">


                <div class="card-body">


                    <div class="form-group">
                        <label for="inputName">Country name</label>
                        <input data-validation="required|alpha" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($countriesDetails)) ? $countriesDetails->country_name : ''; ?>" type="text" class="form-control" name="country_name" id="country_name">
                    </div>

                
                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="status" id="status" class="form-control">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ((!empty($countriesDetails)) && $countriesDetails->status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>

            </div>
        </div>







        <!-- /.form-box -->
    </div><!-- /.card -->

    <?php echo form_close(); ?>




</section>
<!-- /.register-box -->

