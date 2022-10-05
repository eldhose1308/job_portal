<?php if ($jobApplied) : ?>


    <div class="text-center">
        <div class="alert alert-warning" role="alert">
            Already Applied !!
        </div>

        <div class="alert alert-info" role="alert">
            You have already applied for this job 
            <!-- You have applied for this job in <?= date('d M ,Y', strtotime($jobDetails->updated_at)) . ' at ' . date('h:i a', strtotime($jobDetails->updated_at)) ?> -->
        </div>
    </div>

<?php else : ?>

    <div class="text-center">
        <h2 class="mt-10 mb-5 text-brand-1 text-capitalize">Start your career today</h2>
        <p class="font-sm text-muted mb-30">Please fill in your information and send it to the employer. </p>
    </div>


<?php echo form_open(base_url('home/apply_job'), 'class=" text-start mt-20" id="add-form" autocomplete="off" '); ?>

<input type="hidden" name="job_id" id="job_id" value="<?= $job_id ?>">

<div class="form-group">
    <label class="form-label" for="input-1">Full Name *</label>
    <input <?= ($jobApplied) ? 'disabled':'' ?> class="form-control" value="<?= $candidateDetails->full_name ?>" id="full_name" type="text" name="full_name">
</div>
<div class="form-group">
    <label class="form-label" for="input-2">Email *</label>
    <input <?= ($jobApplied) ? 'disabled':'' ?> class="form-control" value="<?= $candidateDetails->user_email ?>" id="user_email" type="email" name="user_email">
</div>
<div class="form-group">
    <label class="form-label" for="number">Contact Number *</label>
    <input <?= ($jobApplied) ? 'disabled':'' ?> class="form-control" value="<?= $candidateDetails->user_mobile ?>" id="user_mobile" type="text" name="user_mobile">
</div>

<div class="form-group">
    <label class="form-label" for="des">Notes</label>
    <input <?= ($jobApplied) ? 'disabled':'' ?> class="form-control" value="" id="notes" type="text" name="notes">
</div>

<div class="form-group">
    <label class="form-label" for="file">Upload Resume</label>
    <input <?= ($jobApplied) ? 'disabled':'' ?> class="form-control" id="file" name="resume" type="file">
</div>
<div class="login_footer form-group d-flex justify-content-between">
    <label class="cb-container">
        <input type="checkbox"><span class="text-small">Agree our terms and policy</span><span class="checkmark"></span>
    </label><a class="text-muted" href="page-contact.html">Lean more</a>
</div>


    <div class="form-group">
        <button class="btn btn-default hover-up w-100" type="submit" name="login">Apply Job</button>
    </div>

</form>

<?php endif; ?>
