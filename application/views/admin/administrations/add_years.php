<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/administration/save_years'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/administration/update_years'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="year_id" value="<?= $year_id ?>">
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
                    <h3 class="card-title">Administration year Details</h3>


                </div>


                <div class="card-body">

                    <div class="form-group">
                        <label for="inputName">Year title</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($yearsDetails)) ? $yearsDetails->year_title : ''; ?>" id="year_title" name="year_title" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">From Year</label>
                        <input data-validation="required|numeric|exact_length-4" <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($yearsDetails)) ? $yearsDetails->from_year : ''; ?>" id="from_year" name="from_year" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>


                    <div class="form-group">
                        <label for="inputName">To Year</label>
                        <input data-validation="required|numeric|exact_length-4" <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($yearsDetails)) ? $yearsDetails->to_year : ''; ?>" id="to_year" name="to_year" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>




                    <div class="form-group">
                        <label for="inputName">Active or not</label>
                        <select <?= ($operation == 'view') ? 'readonly' : '' ?> name="active" id="active" class="form-control">
                            <option <?= ((!empty($yearsDetails)) && $yearsDetails->active == 0) ? 'selected' : ''; ?> value="0">No</option>
                            <option <?= ((!empty($yearsDetails)) && $yearsDetails->active == 1) ? 'selected' : ''; ?> value="1">Yes</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <select <?= ($operation == 'view') ? 'readonly' : '' ?> name="status" id="status" class="form-control">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ((!empty($yearsDetails)) && $yearsDetails->status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                            <?php endforeach; ?>
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