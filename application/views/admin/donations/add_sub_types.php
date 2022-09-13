<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/donations/save_sub_types'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/donations/update_sub_types'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="subtype_id" value="<?= $subtype_id  ?>">
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
                    <h3 class="card-title">Donation Subtypes Details</h3>


                </div>


                <div class="card-body">

                    <div class="form-group">
                        <label for="inputName">Sub type name</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($sub_typesDetails)) ? $sub_typesDetails->subtype_name : ''; ?>" id="subtype_name" name="subtype_name" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Sub type amount</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($sub_typesDetails)) ? $sub_typesDetails->subtype_rate : ''; ?>" id="subtype_rate" name="subtype_rate" class="form-control">
                    </div>




                    <div class="form-group">
                        <label for="inputName">Main type</label>
                        <select <?= ($operation == 'view') ? 'readonly' : '' ?> name="type_id" id="type_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                            <?php foreach ($mainTypes as $main_types) :
                                $status_badge = ($main_types->visible == 1) ? 'Visible' : 'Hidden';

                            ?>
                                <option <?= ((!empty($sub_typesDetails)) && $sub_typesDetails->type_id == $main_types->type_id) ? 'selected' : ''; ?> value="<?= en_func($main_types->type_id, 'e') ?>"><?= $main_types->type_name . ' - ' . $status_badge ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="inputName">Visible or not</label>
                        <select <?= ($operation == 'view') ? 'readonly' : '' ?> name="visible" id="visible" class="form-control">
                            <option <?= ((!empty($sub_typesDetails)) && $sub_typesDetails->visible == 0) ? 'selected' : ''; ?> value="0">No</option>
                            <option <?= ((!empty($sub_typesDetails)) && $sub_typesDetails->visible == 1) ? 'selected' : ''; ?> value="1">Yes</option>
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