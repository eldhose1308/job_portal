<section class="content-main">

    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/users/save_user'), 'class="login-form" id="add-form" autocomplete="off" '); ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/users/update_user'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="user_id" value="<?= $user_id ?>">
    <?php endif; ?>


    <div class="row mb-5">

        <div class="col-12">
            <div class="content-header">
                <h2 class="content-title">Add New User</h2>
                <div>
                    <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
                    <button type="submit" id="submit-form" class="btn btn-md rounded font-sm hover-up submit-form btn-block float-right">Add &nbsp; <i class="fas fa-sign-in-alt"></i></button>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">New User Details</h3>
                </div>

                <div class="card-body">


                    <div class="form-group">
                        <label for="inputName">Full name</label>
                        <input data-validation="required|alpha_numeric" <?= $disabled ?> value="<?= (!empty($userDetails)) ? $userDetails->full_name : ''; ?>" type="text" class="form-control" name="full_name" id="full_name" placeholder="Full name">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Email</label>
                        <input data-validation="required|valid_email" <?= $disabled ?> value="<?= (!empty($userDetails)) ? $userDetails->user_email : ''; ?>" type="email" class="form-control" name="user_email" id="user_email" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Mobile Number</label>
                        <input data-validation="required|numeric" <?= $disabled ?> value="<?= (!empty($userDetails)) ? $userDetails->user_mobile : ''; ?>" type="text" class="form-control" name="user_mobile" id="user_mobile" onkeypress="javascript:return isNumber(event)" placeholder="Mobile">
                    </div>

                </div>

            </div>
        </div>




        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">New User Credentials</h3>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label for="inputName">Username</label>
                        <input data-validation="required|alpha_numeric" <?= $disabled ?> value="<?= (!empty($userDetails)) ? $userDetails->user_name : ''; ?>" type="text" class="form-control" name="user_name" id="user_name" placeholder="Username">
                    </div>

                    <?php if ($operation == 'add') : ?>

                        <div class="form-group">
                            <label for="inputName">Password</label>
                            <input data-validation="required" <?= $disabled ?> type="password" class="form-control" name="user_password" id="user_password" placeholder="Password" autocomplete="FALSE">
                        </div>

                        <div class="form-group">
                            <label for="inputName">Retyped Password</label>
                            <input data-validation="required" <?= $disabled ?> type="password" class="form-control" name="user_retyped_password" id="user_retyped_password" placeholder="Retype password">
                        </div>

                    <?php endif; ?>

                    <div class="form-group">
                        <label for="inputName">User type</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="user_type" id="user_type" class="form-control">
                            <?php foreach ($user_type as $user_types) : ?>
                                <option <?= ((!empty($userDetails)) && $userDetails->type == $user_types->ut_id) ? 'selected' : ''; ?> value="<?= en_func($user_types->ut_id, 'e') ?>"><?= $user_types->user_type ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="status" id="status" class="form-control">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ((!empty($userDetails)) && $userDetails->user_status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
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

