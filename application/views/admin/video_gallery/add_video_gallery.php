<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/video_gallery/save_video_gallery'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/video_gallery/update_video_gallery'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="gallery_id" value="<?= $gallery_id ?>">
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
                    <h3 class="card-title">Video Gallery Details</h3>


                </div>


                <div class="card-body">

                    <div class="form-group">
                        <label for="inputName">Video title</label>
                        <input  data-validation="required" <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($video_galleryDetails)) ? $video_galleryDetails->video_title : ''; ?>" id="video_title" name="video_title" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Video link</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($video_galleryDetails)) ? $video_galleryDetails->video_link : ''; ?>" id="video_link" name="video_link" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Sort order</label>
                        <input data-validation="required|numeric" <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($video_galleryDetails)) ? $video_galleryDetails->sort_order : ''; ?>" id="sort_order" name="sort_order" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>





                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <select <?= ($operation == 'view') ? 'readonly' : '' ?> name="status" id="status" class="form-control">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ((!empty($video_galleryDetails)) && $video_galleryDetails->status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
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
