<?php echo form_open(base_url('admin/applications/change_application_status'), 'class="" id="change-status-forms" autocomplete="off" '); ?>
</form>

<div class="col-lg-8 col-md-12 mb-15">
    <h3><?= $jobsDetails->job_title ?></h3>
    <div class="mt-0 mb-15 text-black">
        <span class="card-briefcase"><?= $jobsDetails->job_openings ?></span>
        <span class="card-time"><?=  date('d M ,Y', strtotime($jobsDetails->created_at)) . ' | ' . date('h:i a', strtotime($jobsDetails->created_at)) ?></span>
    </div>

    <a class="btn btn-tags-sm mt-10 mb-10 mr-5">
        Experience <?= $jobsDetails->min_experience .' - '. $jobsDetails->max_experience ?> years
    </a>  
    <a class="btn btn-tags-sm mt-10 mb-10 mr-5">
        INR <?= $jobsDetails->min_salary .' - '. $jobsDetails->max_salary ?> / Month
    </a>
</div>

<hr>

<?php foreach ($jobApplications as $applications) :
    $status_bg = ($applications->job_status == 1) ? 'custom' : ($applications->job_status == 2 ? 'success' : 'danger');

?>
    <div class="col-xl-12 col-12 mt-15">
        <div class="card-grid-2 hover-up">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card-grid-2-image-left">
                        <div class="right-info">
                            <h4><a href="#"><?= $applications->full_name ?></a></h4>
                            <span class="text-black"><?= $applications->user_name ?></span> <br>
                            <span class="application-status badge bg-<?= $status_bg ?>"><?= $applications->status_name ?></span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-block-info">
                <div class="mt-5">
                    <?php if ($applications->email_verified == 1) : ?>
                        <span class="text-black"><i class="fa fa-check fa-success"></i></span>
                        <span class="card-time text-black"><span><?= date('d M, Y', strtotime($applications->email_verified_at)) . ' | ' . date('h:i a', strtotime($applications->email_verified_at)) ?></span></span>
                    <?php endif; ?>

                </div>
                <a class="btn btn-tags-sm mt-10 mb-10 mr-5">
                    <?= $applications->user_email ?>
                </a>
                <a class="btn btn-tags-sm mt-10 mb-10 mr-5">
                    <?= $applications->user_mobile ?>
                </a>
                <br>
                <a class="btn btn-tags-sm mb-10 text-white bg-primary">
                    <i class="fa fa-envelope text-white mr-10"></i> Send Email notification
                </a>

                <div class="card-2-bottom mt-20">
                    <div class="row">

                        <div class="col-lg-7 col-7">
                        </div>
                        <div class="col-lg-5 col-5 text-end">

                            <div class="dropdown d-inline-block">
                                <select data-id="<?= en_func($applications->apply_id, 'e') ?>" name="change_status" id="change_status" class="form-select change_status">
                                    <?php foreach ($job_statuses as $job_status) : ?>
                                        <option <?= ($job_status->status_id == $applications->job_status) ? 'selected' : ''; ?> value="<?= en_func($job_status->status_id, 'e') ?>"><?= $job_status->status_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <a class="btn btn-tags-sm mb-10 text-white bg-info open-right-offcanvas-with-url" data-name="<?= $applications->full_name ?>" data-email="<?= $applications->user_email ?>" data-url="<?= base_url() ?>uploads/resumes/<?= $applications->user_resume ?>">Resume</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php endforeach; ?>