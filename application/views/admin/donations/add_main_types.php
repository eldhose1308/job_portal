<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/donations/save_main_types'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/donations/update_main_types'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="type_id" value="<?= $type_id  ?>">
    <?php endif; ?>


    <div class="row">


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
                    <h3 class="card-title">Donation Maintypes Details</h3>


                </div>


                <div class="card-body">

                    <div class="form-group">
                        <label for="inputName">Main type name </label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($main_typesDetails)) ? $main_typesDetails->type_name : ''; ?>" id="type_name" name="type_name" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Visible or not</label>
                        <select <?= ($operation == 'view') ? 'readonly' : '' ?> name="visible" id="visible" class="form-control">
                            <option <?= ((!empty($main_typesDetails)) && $main_typesDetails->visible == 0) ? 'selected' : ''; ?> value="0">No</option>
                            <option <?= ((!empty($main_typesDetails)) && $main_typesDetails->visible == 1) ? 'selected' : ''; ?> value="1">Yes</option>
                        </select>
                    </div>






                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>


    </div>
    <?php echo form_close(); ?>


</section>