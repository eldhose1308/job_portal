<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/social_media/save_social_media'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/social_media/update_social_media'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="link_id" value="<?= $link_id ?>">
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
                    <h3 class="card-title">Social media Details</h3>


                </div>


                <div class="card-body">




                    <div class="form-group">
                        <label for="inputName">Link title</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($social_mediaDetails)) ? $social_mediaDetails->link_title : ''; ?>" id="link_title" name="link_title" class="form-control">
                    </div>




                    <div class="form-group">
                        <label for="inputName">Link icon *(Should be a font-awesome icon)</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($social_mediaDetails)) ? $social_mediaDetails->link_icon : ''; ?>" id="link_icon" name="link_icon" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Link url *(Should start with https://)</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($social_mediaDetails)) ? $social_mediaDetails->link_url : ''; ?>" id="link_url" name="link_url" class="form-control">
                    </div>






                    <div class="form-group">
                        <label for="inputName">Sort order</label>
                        <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($social_mediaDetails)) ? $social_mediaDetails->sort_order : ''; ?>" id="sort_order" name="sort_order" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="status" id="status" class="form-control">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ((!empty($social_mediaDetails)) && $social_mediaDetails->status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
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