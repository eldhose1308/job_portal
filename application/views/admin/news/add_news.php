<link rel="stylesheet" href="<?= base_url() ?>assets/admin/croppie/croppie.css" />
<script src="<?= base_url() ?>assets/admin/croppie/croppie.js"></script>



<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/news/save_news'), 'class="form-horizontal" id="add-form-with-imagecrop" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/news/update_news'), 'class="form-horizontal" id="add-form-with-imagecrop" enctype="multipart/form-data"') ?>
        <input type="hidden" name="news_id" value="<?= $news_id ?>">
    <?php endif; ?>


    <div class="row">


        <?php if ($operation != 'view') :  ?>


            <div class="col-12">
                <div class="content-header">
                    <div>
                        <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
                        <button type="submit" id="submit-form-with-imagecrop" class="btn btn-md submit-form-with-imagecrop rounded font-sm hover-up btn-block float-right">Add &nbsp; <i class="fas fa-sign-in-alt"></i></button>
                    </div>
                </div>
            </div>

        <?php endif; ?>


        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">News Details</h3>


                </div>


                <div class="card-body">


                    <div class="form-group">
                        <label for="inputName">News title</label>
                        <input  data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($newsDetails)) ? $newsDetails->news_title : ''; ?>" id="news_title" name="news_title" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">News category</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="category" id="category" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                            <?php foreach ($categories as $category) : ?>
                                <option <?= ((!empty($newsDetails)) && $newsDetails->category == $category->category_id) ? 'selected' : ''; ?> value="<?= en_func($category->category_id, 'e') ?>"><?= $category->category_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="inputName">News date</label>
                        <input  data-validation="required|valid_date" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($newsDetails)) ? $newsDetails->news_date : ''; ?>" id="news_date" name="news_date" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Sort order</label>
                        <input  data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($newsDetails)) ? $newsDetails->sort_order : ''; ?>" id="sort_order" name="sort_order" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="status" id="status" class="form-control">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ((!empty($newsDetails)) && $newsDetails->status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>





        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Content Details</h3>

                </div>


                <div class="card-body">
                    <div class="form-group">
                        <label for="inputName"> News Content </label>
                        <textarea rows="10" <?= ($operation == 'view') ? 'disabled' : '' ?> id="news_content" name="news_content" class="form-control">
                          <?= (!empty($newsDetails)) ? $newsDetails->news_content : ''; ?>
                        </textarea>
                    </div>
                </div>
            </div>
        </div>




        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Image Details</h3>

                    <div class="form-group">
                        <div class="progress progress-sm" style="display: none;">
                            <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                            </div>
                        </div>
                    </div>


                </div>


                <div class="card-body" style="overflow-y:scroll;">



                    <div id="upload-demo" style="display: none;"></div>

                    <?php if ($operation != 'add') : ?>
                        <input type="hidden" name="image_path" id="image_path" value="<?= $newsDetails->image_path ?>">
                        <img src="<?= base_url() ?>uploads/news/<?= $newsDetails->image_path ?>" class="previous_image" alt="news Image">
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="inputSpentBudget">Select Image</label>
                        <input data-width="600" data-height="400" <?= ($operation == 'view') ? 'disabled' : '' ?> type="file" name="upload" class="form-control" id="upload" accept="image/*">
                    </div>




                </div>
            </div>
        </div>





        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Document Details</h3>

                </div>


                <div class="card-body" style="overflow-x:scroll;">


                    <iframe id="document-preview" class="document-preview" title="news Document" style="display: none; width:100%;">
                    </iframe>

                    <?php if ($operation != 'add' && strlen($newsDetails->news_document) > 1) : ?>
                        <input type="hidden" name="news_document" id="news_document" value="<?= $newsDetails->news_document ?>">
                        <iframe src="<?= base_url() ?>uploads/news/<?= $newsDetails->news_document ?>" id="previous_document" class="previous_document" title="news Document" style="width: 100%;">
                        </iframe>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="inputSpentBudget">Select Document</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="file" name="document-upload" class="form-control" id="document-upload" accept="application/pdf">
                    </div>


                </div>
            </div>
        </div>





    </div>
    <?php echo form_close(); ?>


</section>


<script src="<?= base_url() ?>assets/admin/ckeditor/ckeditor.js" type="text/javascript"></script>
<script>
    CKEDITOR.replace('news_content', {});
</script>