<section class="section-box mt-30">
    <div class="container">
        <div class="content-page">


            <div class="box-filters-job">
                <div class="row">
                    <div class="col-xl-6 col-lg-5"><span class="text-small text-showing datacard-search-results-count">
                            Showing <strong>0-60 </strong>of <strong>130 </strong>entries
                        </span></div>
                    <div class="col-xl-6 col-lg-7 text-lg-end mt-sm-15">
                        <div class="display-flex2">

                            <form action="<?= base_url() ?>admin/candidates/candidates_json" class="datacard-list">


                                <div class="box-border mr-10"><span class="text-sortby">Gender:</span>
                                    <div class="dropdown dropdown-sort">
                                        <button class="btn dropdown-toggle" id="dropdownSort" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"><span>All</span><i class="fi-rr-angle-small-down"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-light filter" id="gender" aria-labelledby="dropdownSort">
                                            <li><a data-value="-1" class="dropdown-item" href="#">All</a></li>
                                            <?php foreach ($genders as $gender) : ?>
                                                <li><a data-value="<?= en_func($gender->gender_id, 'e') ?>" class="dropdown-item" href="#"><?= $gender->gender_title ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>

                                <div class="box-border mr-10"><span class="text-sortby">Status:</span>
                                    <div class="dropdown dropdown-sort">
                                        <button class="btn dropdown-toggle" id="dropdownSort" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"><span>All</span><i class="fi-rr-angle-small-down"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-light filter" id="status" aria-labelledby="dropdownSort">
                                            <li><a data-value="-1" class="dropdown-item" href="#">All</a></li>
                                            <?php foreach ($status as $statuses) : ?>
                                                <li><a data-value="<?= en_func($statuses->status_id, 'e') ?>" class="dropdown-item" href="#"><?= $statuses->status ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>

                                <div class="box-border"><span class="text-sortby">Sort by:</span>
                                    <div class="dropdown dropdown-sort">
                                        <button class="btn dropdown-toggle" id="dropdownSort2" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"><span>Latest</span><i class="fi-rr-angle-small-down"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-light filter" id="sortby" aria-labelledby="dropdownSort2">
                                            <?php foreach ($sortBys as $sortBy) : ?>
                                                <li><a data-value="<?= en_func($sortBy['sort_id'], 'e') ?>" class="dropdown-item" href="#"><?= $sortBy['sorting_by'] ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>



            <div id="na_datacard" data-class="row">
                <center><i class="datacard-loader fa fa-circle-o-notch fa-spin"></i></center>
            </div>


        </div>

        <div class="container ">
            <div id="pagination-wrapper"></div>
        </div>

    </div>
</section>






<!-- Off-canvas sidebar markup, left/right or both. -->
<div id="bs-canvas-left" class="bs-canvas bs-canvas-anim bs-canvas-left position-fixed bg-light h-100">
    <header class="bs-canvas-header p-3 bg-success">
        <h4 class="d-inline-block text-light mb-0">Canvas Header</h4>
        <button type="button" class="bs-canvas-close close" aria-label="Close"><span aria-hidden="true" class="text-light">&times;</span></button>
    </header>
    <div class="bs-canvas-content px-3 py-5">
        ...
    </div>
</div>

<div id="bs-canvas-right" class="bs-canvas bs-canvas-anim bs-canvas-right position-fixed bg-light h-100">
    <header class="bs-canvas-header p-3 bg-primary overflow-auto">
        <button type="button" class="bs-canvas-close float-left close" aria-label="Close"><span aria-hidden="true" class="text-light">&times;</span></button>
        <h4 class="d-inline-block text-light mb-0 float-right">Canvas Header</h4>
    </header>
    <div class="bs-canvas-content px-3 py-5">
        ...
    </div>
</div>




<script>





    $(document).on('click', '.open-offcanvas', function(e) {
        showOffCanvas("#bs-canvas-right");


    });
</script>