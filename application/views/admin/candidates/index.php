<section class="section-box mt-30">
    <div class="container">
        <div class="content-page">


            <div class="box-filters-job">
                <div class="row">
                    <div class="col-xl-3 col-lg-3"><span class="text-small text-showing datacard-search-results-count">
                            Showing <strong>0-60 </strong>of <strong>130 </strong>entries
                        </span></div>
                    <div class="col-xl-6 col-lg-6 text-lg-end mt-sm-15">
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

                    <div class="col-xl-3 col-lg-3 text-end">
                        <button class="btn btn-custom open-offcanvas" data-url="<?= base_url() ?>admin/candidates/add_candidates">Add</button>
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







<script>
    $(document).on('click', '.open-offcanvas', function(e) {
        $('.offcanvas-heading').html('');
        $('.offcanvas-content').html('');
        showOffCanvas("#bs-canvas-right");
        let form_url = $(this).attr("data-url");

        $.get(form_url, function(data, status) {
            var out = jQuery.parseJSON(data);
            out = out.data;

            $('.offcanvas-heading').html(out.heading);
            $('.offcanvas-subheading').html(out.sub_heading);
            $('.offcanvas-content').html(out.content);

        });


    });
</script>