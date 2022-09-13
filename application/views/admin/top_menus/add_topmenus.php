<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/menus/save_topmenus'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/menus/update_topmenus'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="tm_id" value="<?= $tm_id ?>">
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
                    <h3 class="card-title">Top Menu Details</h3>


                </div>


                <div class="card-body">

                    <div class="form-group">
                        <label for="inputName">Menu name</label>
                        <input data-validation="required|alpha_numeric" <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($topmenusDetails)) ? $topmenusDetails->top_menu_name : ''; ?>" id="top_menu_name" name="top_menu_name" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Content page or not? ( No , if it is a new page with your own content else enter the link to your page)</label>
                        <select <?= ($operation == 'view') ? 'readonly' : '' ?> name="content_page" id="content_page" class="form-control">
                            <option <?= ((!empty($topmenusDetails)) && $topmenusDetails->content_page == 0) ? 'selected' : ''; ?> value="0">No</option>
                            <option <?= ((!empty($topmenusDetails)) && $topmenusDetails->content_page == 1) ? 'selected' : ''; ?> value="1">Yes</option>
                        </select>
                    </div>



                    <div class="form-group link-div">
                        <label for="inputName">Link</label>
                        <input data-validation="" <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($topmenusDetails)) ? $topmenusDetails->link : ''; ?>" id="link" name="link" class="form-control">
                    </div>


                    <div class="form-group content-div">
                        <label for="inputName">Content </label>
                        <textarea <?= ($operation == 'view') ? 'readonly' : '' ?> id="content" name="content" class="form-control">
                        <?= (!empty($topmenusDetails)) ? $topmenusDetails->content : ''; ?>
                        </textarea>
                    </div>



                    <div class="form-group">
                        <label for="inputName">Sort order</label>
                        <input data-validation="required|numeric" <?= ($operation == 'view') ? 'readonly' : '' ?> type="text" value="<?= (!empty($topmenusDetails)) ? $topmenusDetails->sort_order : ''; ?>" id="sort_order" name="sort_order" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Description (Optional)</label>
                        <textarea <?= ($operation == 'view') ? 'readonly' : '' ?> id="description" name="description" class="form-control">
                        <?= (!empty($topmenusDetails)) ? $topmenusDetails->description : ''; ?>
                        </textarea>
                    </div>



                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <select <?= ($operation == 'view') ? 'readonly' : '' ?> name="status" id="status" class="form-control">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ((!empty($topmenusDetails)) && $topmenusDetails->status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
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



<script src="<?= base_url() ?>assets/admin/ckeditor/ckeditor.js" type="text/javascript"></script>
<script>
    CKEDITOR.replace('content', {
        filebrowserBrowseUrl: base_url + 'admin/ckeditor/upload_image/',
        filebrowserUploadMethod: 'form',

        filebrowserUploadUrl: base_url + 'admin/ckeditor/upload_image?CKEditorFuncNum=1'
    });
</script>

<script>
    content_page_or_not();
    $(document).on('change', '#content_page', function(e) {
        e.preventDefault();
        content_page_or_not();
    });

    function content_page_or_not() {
        if ($('#content_page').val() == 1) {
            $('.link-div').fadeIn();
            $('.content-div').hide();
        } else {
            $('.content-div').fadeIn();
            $('.link-div').hide();
        }
    }
</script>