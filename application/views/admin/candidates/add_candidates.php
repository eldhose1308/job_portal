<section class="content-main">

    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/candidates/save_candidates'), 'class="login-form" id="add-form" autocomplete="off" '); ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/candidates/update_candidates'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="user_id" value="<?= $user_id ?>">
    <?php endif; ?>


    <div class="row mb-5">

        <?php if ($operation != 'view') :  ?>

            <div class="col-12 mb-10">
                <div class="content-header">
                    <div>
                        <button type="submit" id="submit-form" class="btn btn-custom font-sm hover-up submit-form float-right"><?= ($operation == 'add') ? 'Add' : 'Update'; ?> Candidates &nbsp; <i class="fas fa-sign-in-alt"></i></button>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <div class="col-md-12">
            <div class="card">


                <div class="card-body">


                    <div class="form-group">
                        <label for="inputName">Full name</label>
                        <input data-validation="required|alpha" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($candidatesDetails)) ? $candidatesDetails->full_name : ''; ?>" type="text" class="form-control" name="full_name" id="full_name" placeholder="Full name">
                    </div>

                    <div class="form-group">
                        <label for="inputName">User name</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($candidatesDetails)) ? $candidatesDetails->user_name : ''; ?>" type="text" class="form-control" name="user_name" id="user_name" placeholder="User name">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Email</label>
                        <input data-validation="required|valid_email" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($candidatesDetails)) ? $candidatesDetails->user_email : ''; ?>" type="email" class="form-control" name="user_email" id="user_email" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Mobile Number</label>
                        <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($candidatesDetails)) ? $candidatesDetails->user_mobile : ''; ?>" type="text" class="form-control" name="user_mobile" id="user_mobile" onkeypress="javascript:return isNumber(event)" placeholder="Mobile">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="status" id="status" class="form-control">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ((!empty($candidatesDetails)) && $candidatesDetails->status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="inputName">Email verified or not?</label>
                        <select <?= ($operation == 'view') ? 'readonly' : '' ?> name="email_verified" id="email_verified" class="form-control">
                            <option <?= ((!empty($candidatesDetails)) && $candidatesDetails->email_verified == 0) ? 'selected' : ''; ?> value="0">No</option>
                            <option <?= ((!empty($candidatesDetails)) && $candidatesDetails->email_verified == 1) ? 'selected' : ''; ?> value="1">Yes</option>
                        </select>
                    </div>

                    <?php if ($operation != 'add') : ?>

                        <?php if ($candidatesDetails->email_verified_at != NULL) : ?>
                            <div class="form-group">
                                <label for="inputName">Email Verified time</label>
                                <input data-validation="" disabled type="text" value="<?= (!empty($candidatesDetails)) ? date('d M , Y', strtotime($candidatesDetails->email_verified_at)) . ' | ' . date('h:i a', strtotime($candidatesDetails->email_verified_at)) : ''; ?>" id="email_verified_at" name="email_verified_at" class="form-control">
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="inputName">Last updated time</label>
                            <input data-validation="" disabled type="text" value="<?= (!empty($candidatesDetails)) ? date('d M , Y', strtotime($candidatesDetails->updated_at)) . ' | ' . date('h:i a', strtotime($candidatesDetails->updated_at)) : ''; ?>" id="updated_at" name="updated_at" class="form-control">
                        </div>

                    <?php endif; ?>

                </div>

            </div>
        </div>







        <!-- /.form-box -->
    </div><!-- /.card -->

    <?php echo form_close(); ?>




</section>
<!-- /.register-box -->

<script>
    $(document).on('keyup', '#full_name', function(e) {
        e.preventDefault();
        let full_name = $(this).val();
        full_name = full_name.replace(/ /g, "_").toLowerCase();
        $("#user_name").val(full_name)
    });
</script>