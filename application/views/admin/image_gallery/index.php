<script src="<?= base_url() ?>assets/admin/js/datacards.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/admin/css/datacards.css">

<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Image Gallery List</h2>
            <p>List of gallery images in this portal.</p>
        </div>



        <div class="col-6 col-md-3">
            <a href="<?= base_url() ?>admin/image_gallery/add_image_gallery" class="btn btn-md btn-primary float-end">Add image <i class="icon material-icons md-add ms-3"></i></a>
        </div>

    </div>

    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">

                <form action="<?= base_url() ?>admin/image_gallery/image_gallery_json" class="datacard-list row">

                    <div class="col-12 col-md-2 mb-15 me-auto">
                        <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
                    </div>


                    <div class="col-6 col-md-3 filter">
                        <select class="form-control float-end" name="status" id="status">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ($statuses->status_id == 1) ? 'selected' : '' ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="col-6 col-md-3 filter">
                        <select class="form-control float-end  select2 select2-hidden-accessible" style="width: 100%;" name="gallery_category" id="gallery_category">
                            <option value="-1">Show all categories</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= en_func($category->category_id, 'e') ?>"><?= $category->category_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                </form>



            </div>
        </header>


        <div class="card-body">


            <div id="na_datacard" data-class="row gx-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-3 row-cols-xxl-3">
                <center><i class="datacard-loader fa fa-circle-o-notch fa-spin"></i></center>
            </div>



            <div class="container ">
                <div id="pagination-wrapper"></div>
            </div>



        </div>


</section>
