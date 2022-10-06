<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">

            <?php if ($jobApplied) : ?>
                <?php echo form_open(base_url('users/jobs/withdraw_job'), 'data-reload="true" class=" text-start mt-20" id="add-form" autocomplete="off" '); ?>

                <input type="hidden" name="job_id" id="job_id" value="<?= $job_id ?>">

                <div class="text-center">
                    <div class="alert alert-warning" role="alert">
                        Already Applied !!
                    </div>

                    <div class="alert alert-info" role="alert">
                        You have applied for this job in <?= date('d M ,Y', strtotime($jobDetails->created_at)) . ' at ' . date('h:i a', strtotime($jobDetails->created_at)) ?>
                    </div>
                </div>

                <div class="text-center">
                    <h2 class="mt-10 mb-5 text-brand-1 text-capitalize">Your Application preview</h2>
                    <p class="font-sm text-muted mb-30">Click to revoke this job application. </p>
                    <button class="btn btn-sm btn-danger">Withdraw Application</button>
                </div>


                <hr>

                <h6 class="mt-10 mb-5">Applied On : <?= date('d M ,Y', strtotime($jobDetails->created_at)) . ' at ' . date('h:i a', strtotime($jobDetails->created_at)) ?></h6>
                <h6 class="mt-10 mb-5">Job Title : <?= $jobInfo->job_title ?></h6>
                <a class="btn btn-tags-sm mt-10 mb-10 mr-5">
                    INR <?= $jobInfo->min_salary . ' - ' . $jobInfo->max_salary ?> / Month
                </a>

                <hr>

                <h6 class="mt-10 mb-5">Full Name : <?= ss('full_name') ?></h6>
                <h6 class="mt-10 mb-5">Email : <?= ss('user_email') ?></h6>
                <h6 class="mt-10 mb-5">Contact : <?= ss('user_mobile') ?></h6>

                <hr>

                <iframe src="<?= RESUME . $jobDetails->candidate_resume ?>" height="300" frameborder="0"></iframe>

                </form>

            <?php else : ?>

                <div class="text-center">
                    <h2 class="mt-10 mb-5 text-brand-1 text-capitalize">Start your career today</h2>
                    <p class="font-sm text-muted mb-30">Please fill in your information and send it to the employer. </p>

                    <h6 class="mt-10 mb-5">Job Title : <?= $jobInfo->job_title ?></h6>
                    <a class="btn btn-tags-sm mt-10 mb-10 mr-5">
                        INR <?= $jobInfo->min_salary . ' - ' . $jobInfo->max_salary ?> / Month
                    </a>

                </div>


                <?php echo form_open(base_url('users/jobs/apply_job'), 'class=" text-start mt-20" id="add-form" autocomplete="off" '); ?>

                <input type="hidden" name="job_id" id="job_id" value="<?= $job_id ?>">
                <input name="current_resume" value="<?= ss('user_resume') ?>" type="hidden" class="form-control" id="current_resume">

                <div class="form-group">
                    <label class="form-label" for="input-1">Full Name *</label>
                    <input data-validation="required|alpha" <?= ($jobApplied) ? 'disabled' : '' ?> class="form-control" value="<?= $candidateDetails->full_name ?>" id="full_name" type="text" name="full_name">
                </div>
                <div class="form-group">
                    <label class="form-label" for="input-2">Email *</label>
                    <input data-validation="required|valid_email" <?= ($jobApplied) ? 'disabled' : '' ?> class="form-control" value="<?= $candidateDetails->user_email ?>" id="user_email" type="email" name="user_email">
                </div>
                <div class="form-group">
                    <label class="form-label" for="number">Contact Number *</label>
                    <input data-validation="required|numeric|exact_length-10" <?= ($jobApplied) ? 'disabled' : '' ?> class="form-control" value="<?= $candidateDetails->user_mobile ?>" id="user_mobile" type="text" name="user_mobile">
                </div>

                <?php if (strlen(ss('user_mobile')) == 0) : ?>
                    <div class="login_footer form-group d-flex justify-content-between">
                        <label class="cb-container">
                            <input name="default_mobile" id="default_mobile" type="checkbox"><span class="text-small">Make this my default contact number</span><span class="checkmark"></span>
                        </label>
                    </div>

                <?php endif; ?>

                <div class="form-group">
                    <label class="form-label" for="des">Notes</label>
                    <input <?= ($jobApplied) ? 'disabled' : '' ?> class="form-control" value="" id="notes" type="text" name="notes">
                </div>


                <?php if (strlen(ss('user_resume')) > 0) : ?>

                    <div class="form-group">
                        <label class="form-label" for="file">Current Resume</label>
                        <iframe src="<?= RESUME . ss('user_resume') ?>" height="300" id="previous_document" frameborder="0"></iframe>

                    </div>
                <?php endif; ?>


                <div class="form-group">
                    <iframe src="" height="300" id="document-preview" style="display: none;" frameborder="0"></iframe>
                </div>
                <div class="form-group">
                    <label class="form-label" for="file">Upload Resume</label>
                    <input <?= ($jobApplied) ? 'disabled' : '' ?> class="form-control  document-img-upload" id="resume" name="resume" type="file">
                </div>


                <div class="login_footer form-group d-flex justify-content-between">
                    <label class="cb-container">
                        <input name="default_resume" id="default_resume" type="checkbox"><span class="text-small">Make this my default resume</span><span class="checkmark"></span>
                    </label>
                </div>


                <div class="form-group">
                    <button class="btn btn-default hover-up w-100" type="submit" name="login">Apply Job</button>
                </div>

                </form>

            <?php endif; ?>



        </div>
    </div>
</div>