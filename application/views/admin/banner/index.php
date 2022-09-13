<script src="<?= base_url() ?>assets/admin/js/datacards.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/admin/css/datacards.css">


<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Banner List</h2>
            <p>List of banners in this portal.</p>
        </div>


        <div class="col-6 col-md-3">
            <a href="<?= base_url() ?>admin/banner/add_banner" class="btn btn-primary float-end">Add banner</a>
        </div>


    </div>

    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">

                <form action="<?= base_url() ?>admin/banner/banner_json" class="datacard-list row">

                    <div class="col-12 col-md-3 mb-15">
                        <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
                    </div>


                    <div class="col-6 col-md-3 filter">
                        <select class="form-control float-end" name="status" id="status">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ($statuses->status_id == 1) ? 'selected' : '' ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                </form>



            </div>
        </header>


        <div class="card-body">

            <div id="na_datacard" data-class="row gx-3 row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-1 row-cols-xxl-1">
                <center><i class="datacard-loader fa fa-circle-o-notch fa-spin"></i></center>
            </div>



            <div class="container ">
                <div id="pagination-wrapper"></div>
            </div>



        </div>

    </div>


</section>