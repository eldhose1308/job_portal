<section class="content-main">

    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/jobs/save_jobs'), 'class="login-form" id="add-form" autocomplete="off" '); ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/jobs/update_jobs'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="job_id" value="<?= $job_id ?>">
    <?php endif; ?>


    <div class="row mb-5">

        <?php if ($operation != 'view') :  ?>

            <div class="col-12 mb-10">
                <div class="content-header">
                    <div>
                        <button type="submit" id="submit-form" class="btn btn-sm btn-custom font-sm hover-up submit-form float-right"><?= ($operation == 'add') ? 'Add' : 'Update'; ?> Job &nbsp; <i class="fas fa-sign-in-alt"></i></button>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <div class="col-md-12">
            <div class="card">


                <div class="card-body">


                    <div class="form-group">
                        <label for="inputName">Job title</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($jobsDetails)) ? $jobsDetails->job_title : ''; ?>" type="text" class="form-control" name="job_title" id="job_title">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Job description ( Brief )</label>
                        <textarea data-validation="required|alpha" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" class="form-control" name="brief_description" id="brief_description">
                        <?= (!empty($jobsDetails)) ? $jobsDetails->brief_description : ''; ?>
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label for="inputName">Job description ( Full )</label>
                        <textarea data-validation="required|alpha" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" class="form-control" name="job_description" id="job_description">
                        <?= (!empty($jobsDetails)) ? $jobsDetails->job_description : ''; ?>
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label for="inputName">Job openings</label>
                        <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($jobsDetails)) ? $jobsDetails->job_openings : ''; ?>" type="text" class="form-control" name="job_openings" id="job_openings">
                    </div>

                    
                    <div class="form-group">
                        <label for="inputName">Location</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="job_location" id="job_location" class="form-control">
                            <?php foreach ($countries as $country) : ?>
                                <option <?= ((!empty($jobsDetails)) && $jobsDetails->job_location == $country->country_id ) ? 'selected' : ''; ?> value="<?= en_func($country->country_id, 'e') ?>"><?= $country->country_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="inputName">Minimum experience</label>
                                <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($jobsDetails)) ? $jobsDetails->min_experience : ''; ?>" type="text" class="form-control" name="min_experience" id="min_experience" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="inputName">Maximum experience</label>
                                <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($jobsDetails)) ? $jobsDetails->max_experience : ''; ?>" type="text" class="form-control" name="max_experience" id="max_experience" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="inputName">Minimum salary</label>
                                <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($jobsDetails)) ? $jobsDetails->min_salary : ''; ?>" type="text" class="form-control" name="min_salary" id="min_salary" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="inputName">Maximum salary</label>
                                <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($jobsDetails)) ? $jobsDetails->max_salary : ''; ?>" type="text" class="form-control" name="max_salary" id="max_salary" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="status" id="status" class="form-control">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ((!empty($jobsDetails)) && $jobsDetails->status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
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