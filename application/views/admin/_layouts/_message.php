<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!--print error messages-->
<?php if ($this->session->flashdata('errors')) : ?>
    <div class="m-b-15" style="margin: 10px 7px;padding: 0 34px;">

        <div class="alert alert-danger">
            <?= $this->session->flashdata('errors') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>

<!--print error messages-->
<?php if ($this->session->flashdata('error_msg')) : ?>
    <div class="m-b-15" style="margin: 10px 7px;padding: 0 34px;">

        <div class="alert alert-danger alert-dismissable">
            <?= $this->session->flashdata('error_msg') ?>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
    </div>


<?php endif; ?>


<!--print custom success message-->
<?php if ($this->session->flashdata('success')) : ?>
    <div class="m-b-15" style="margin: 10px 7px;padding: 0 34px;">
        <div class="alert alert-dismissible alert-success show alert-msg" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>


    </div>
<?php endif; ?>