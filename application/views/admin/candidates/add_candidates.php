<section class="content-main">

    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/candidates/save_candidates'), 'class="login-form" id="add-form" autocomplete="off" '); ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/candidates/update_candidates'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="user_id" value="<?= $user_id ?>">
    <?php endif; ?>


    <div class="row mb-5">

        <div class="col-12 mb-10">
            <div class="content-header">
                <div>
                    <button type="submit" id="submit-form" class="btn btn-sm btn-custom font-sm hover-up submit-form float-right">Add &nbsp; <i class="fas fa-sign-in-alt"></i></button>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">New Candidates Details</h5>
                </div>

                <div class="card-body">


                    <div class="form-group">
                        <label for="inputName">Full name</label>
                        <input data-validation="required|alpha_numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($candidatesDetails)) ? $candidatesDetails->full_name : ''; ?>" type="text" class="form-control" name="full_name" id="full_name" placeholder="Full name">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Email</label>
                        <input data-validation="required|valid_email" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($candidatesDetails)) ? $candidatesDetails->user_email : ''; ?>" type="email" class="form-control" name="user_email" id="user_email" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Mobile Number</label>
                        <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($candidatesDetails)) ? $candidatesDetails->user_mobile : ''; ?>" type="text" class="form-control" name="user_mobile" id="user_mobile" onkeypress="javascript:return isNumber(event)" placeholder="Mobile">
                    </div>

                </div>

            </div>
        </div>







        <!-- /.form-box -->
    </div><!-- /.card -->

    <?php echo form_close(); ?>




</section>
<!-- /.register-box -->

