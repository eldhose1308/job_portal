<section class="section-box mt-30">
    <div class="container">
        <div class="content-page">


            <div class="box-filters-job">
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <span class="text-small text-showing pagination-details">Showing <strong>0-0 </strong>of <strong>0 </strong>candidates</span>
                    </div>
                    <div class="col-xl-6 col-lg-6 text-lg-end mt-sm-15">
                        <div class="display-flex2">

                            <form action="<?= base_url() ?>admin/candidates/candidates_json" class="candidates_datacard-list">


                                <div class="box-border mr-10"><span class="text-sortby">Registered:</span>
                                    <div class="dropdown dropdown-sort">
                                        <button class="btn dropdown-toggle" id="dropdownSort" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"><span>All</span><i class="fi-rr-angle-small-down"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-light filter" id="added_before" aria-labelledby="dropdownSort">
                                            <li><a data-identifier="default-value" data-value="-1" class="dropdown-item active" href="#">All</a></li>
                                            <li><a data-value="1" class="dropdown-item" href="#">1</a></li>
                                            <li><a data-value="7" class="dropdown-item" href="#">7</a></li>
                                            <li><a data-value="30" class="dropdown-item" href="#">30</a></li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="box-border mr-10"><span class="text-sortby">Show:</span>
                                    <div class="dropdown dropdown-sort">
                                        <button class="btn dropdown-toggle" id="dropdownSort" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"><span>10</span><i class="fi-rr-angle-small-down"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-light filter" id="per_page" aria-labelledby="dropdownSort">
                                            <li><a data-identifier="default-value" data-value="10" class="dropdown-item active" href="#">10</a></li>
                                            <li><a data-value="20" class="dropdown-item" href="#">20</a></li>
                                            <li><a data-value="30" class="dropdown-item" href="#">30</a></li>
                                        </ul>
                                    </div>
                                </div>



                                <div class="box-border"><span class="text-sortby">Sort by:</span>
                                    <div class="dropdown dropdown-sort">
                                        <button class="btn dropdown-toggle" id="dropdownSort2" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"><span>Newest Post</span><i class="fi-rr-angle-small-down"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-light filter" id="sortby" aria-labelledby="dropdownSort2">
                                            <?php foreach ($sortBys as $sortBy) : ?>
                                                <li><a data-identifier="default-value" data-value="<?= $sortBy['sort_id'] ?>" class="dropdown-item" href="#"><?= $sortBy['sorting_by'] ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>

                            </form>



                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 text-end">
                        <button class="btn btn-custom open-right-offcanvas" data-url="<?= base_url() ?>admin/candidates/add_candidates">Add</button>
                    </div>

                </div>
            </div>




            <div id="candidates-na_datacard" class="row" data-class="row">
                <center><i class="datacard-loader fa fa-circle-o-notch fa-spin"></i></center>
            </div>


        </div>


        <div class="candidates-paginations float-end paginations">
            <ul class="pager" id="job-pagination_btns">

            </ul>
        </div>

    </div>
</section>

<script src="<?= base_url() ?>assets/users/scripts/candidates.js"></script>