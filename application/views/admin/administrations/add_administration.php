<link rel="stylesheet" href="<?= base_url() ?>assets/admin/croppie/croppie.css" />
<script src="<?= base_url() ?>assets/admin/croppie/croppie.js"></script>



<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/administration/save_administration'), 'class="form-horizontal" id="add-form-with-imagecrop" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/administration/update_administration'), 'class="form-horizontal" id="add-form-with-imagecrop" enctype="multipart/form-data"') ?>
        <input type="hidden" name="administration_id" value="<?= $administration_id  ?>">
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
                    <h3 class="card-title">Administration Details</h3>


                </div>


                <div class="card-body">
                    <div class="form-group">
                        <label for="inputName"> Name</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($administrationDetails)) ? $administrationDetails->administration_name : ''; ?>" id="administration_name" name="administration_name" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Designation</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="designation" id="designation" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                            <?php foreach ($designations as $designation) : ?>
                                <option <?= ((!empty($administrationDetails)) && $administrationDetails->designation == $designation->designation_id) ? 'selected' : ''; ?> value="<?= en_func($designation->designation_id, 'e') ?>"><?= $designation->designation_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="inputName">Year</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="year" id="year" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                            <?php foreach ($years as $year) : ?>
                                <option <?= ((!empty($administrationDetails)) && $administrationDetails->year == $year->year_id) ? 'selected' : ''; ?> value="<?= en_func($year->year_id, 'e') ?>"><?= $year->year_title ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="inputName">Sort order</label>
                        <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($administrationDetails)) ? $administrationDetails->sort_order : ''; ?>" id="sort_order" name="sort_order" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="status" id="status" class="form-control">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ((!empty($administrationDetails)) && $administrationDetails->status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
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
                        <input type="hidden" name="image_path" id="image_path" value="<?= $administrationDetails->image_path ?>">
                        <img src="<?= base_url() ?>uploads/administration/<?= $administrationDetails->image_path ?>" class="previous_image" alt="administration Image">
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="inputSpentBudget">Select Image</label>
                        <input data-width="600" data-height="400" <?= ($operation == 'view') ? 'disabled' : '' ?> type="file" name="upload" class="form-control" id="upload" accept="image/*">
                    </div>




                </div>
            </div>
        </div>




    </div>
    <?php echo form_close(); ?>


</section>

