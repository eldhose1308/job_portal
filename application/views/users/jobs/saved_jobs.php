<main class="main">
    <section class="section-box-2">
        <div class="container">
            <div class="banner-hero banner-single banner-single-bg">
                <div class="block-banner text-center">
                    <h3 class="wow animate__animated animate__fadeInUp"><span class="color-brand-2"><span class="total_jobs">00</span> Jobs</span> Saved to Wishlist</h3>
                    <div class="font-sm color-text-paragraph-2 mt-10 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero repellendus magni, <br class="d-none d-xl-block">atque delectus molestias quis?</div>
                    <div class="form-find text-start mt-40 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <form class="jobs-search-form">

                            <input class="form-input input-keysearch mr-10 query" type="text" placeholder="Your keyword... ">
                            <button class="btn btn-default btn-find font-sm">Search</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php echo form_open(base_url('home/add_to_wishlist/'), 'class=" text-start mt-20" id="job_wishlist-forms" autocomplete="off" '); ?>
    <?php echo form_close(); ?>


    <section class="section-box mt-30">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9 col-md-12 col-sm-12 col-12 float-right">
                    <div class="content-page">
                        <div class="box-filters-job">
                            <div class="row">

                                <div class="col-xl-6 col-lg-6 col-6">
                                    <span class="text-small text-showing pagination-details">Showing <strong>0-0 </strong>of <strong>0 </strong>jobs</span>
                                    <a class="btn btn-sm btn-outline-custom show-filters" role="button"><i class="fa fa-filter"></i>Show Filter </a>

                                </div>


                                <div class="col-xl-6 col-lg-6 col-6 text-lg-end mt-sm-15">
                                    <div class="display-flex2">


                                        <form action="<?= base_url() ?>users/jobs/saved_jobs_json" class="jobs_datacard-list float-right">


                                            <div class="box-border mr-10"><span class="text-sortby">Show:</span>
                                                <div class="dropdown dropdown-sort">
                                                    <button class="btn dropdown-toggle" id="dropdownSort" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"><span>10</span><i class="fi-rr-angle-small-down"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-light filter" id="per_page" aria-labelledby="dropdownSort">
                                                        <li><a data-value="10" class="dropdown-item active" href="#">10</a></li>
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
                                                            <li><a data-value="<?= $sortBy['sort_id'] ?>" class="dropdown-item" href="#"><?= $sortBy['sorting_by'] ?></a></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            </div>


                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="jobs-na_datacard" data-class="row">
                            <center><i class="datacard-loader fa fa-circle-o-notch fa-spin"></i></center>
                        </div>


                    </div>


                    <div class="jobs-paginations float-end paginations">
                        <ul class="pager" id="job-pagination_btns">

                        </ul>
                    </div>

                </div>


                <div class="col-lg-3 col-md-12 col-sm-12 col-12 jobs-filters-desktop">
                    <div class="sidebar-shadow none-shadow mb-30">
                        <div class="sidebar-filters">
                            <div class="filter-block head-border mb-30">
                                <h5>Advance Filter <a class="link-reset reset-filters" role="button">Reset</a></h5>
                            </div>
                            <div class="filter-block mb-30">
                                <div class="form-group select-style select-style-icon">
                                    <select id="job_location" class="form-control form-icons dropdown-filters">
                                        <option data-identifier="default-value" value="-1">All Countries</option>
                                        <?php foreach ($countries as $country) : ?>
                                            <option value="<?= en_func($country->country_id, 'e') ?>"><?= $country->country_name ?></option>
                                        <?php endforeach; ?>
                                    </select><i class="fi-rr-marker"></i>
                                </div>
                            </div>

                            <div class="filter-block mb-30">
                                <h5 class="medium-heading mb-10">Job Posted</h5>
                                <div class="form-group">
                                    <ul class="list-checkbox" id="posted_date">
                                        <li>
                                            <label class="cb-container">
                                                <input data-identifier="default-value" class="checkbox-filters" data-value="-1" type="checkbox" checked="checked"><span class="text-small">All</span><span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input class="checkbox-filters" data-value="1" type="checkbox"><span class="text-small">1 day</span><span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input class="checkbox-filters" data-value="7" type="checkbox"><span class="text-small">7 days</span><span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input class="checkbox-filters" data-value="30" type="checkbox"><span class="text-small">30 days</span><span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                            <div class="filter-block mb-20">
                                <h5 class="medium-heading mb-15">Industry</h5>
                                <div class="form-group">
                                    <ul class="list-checkbox">
                                        <li>
                                            <label class="cb-container">
                                                <input data-identifier="default-value" class="checkbox-filters" data-value="0" type="checkbox" checked="checked"><span class="text-small">All</span><span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input class="checkbox-filters" data-value="1" type="checkbox"><span class="text-small">Software</span><span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input class="checkbox-filters" type="checkbox"><span class="text-small">Finance</span><span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input class="checkbox-filters" type="checkbox"><span class="text-small">Recruting</span><span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input class="checkbox-filters" type="checkbox"><span class="text-small">Management</span><span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input class="checkbox-filters" type="checkbox"><span class="text-small">Advertising</span><span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filter-block mb-20">
                                <h5 class="medium-heading mb-25">Salary Range </h5>
                                <div class="list-checkbox pb-20">
                                    <div class="row position-relative mt-10 mb-20">
                                        <div class="col-sm-12 box-slider-range">
                                            <div id="slider-range-1"></div>
                                        </div>
                                        <div class="box-input-money">
                                            <input class="input-disabled form-control range-items min-value-money" type="text" id="salary" name="salary" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>
                                    </div>
                                    <div class="box-number-money">
                                        <div class="row mt-30">
                                            <div class="col-sm-4 col-4"><span class="font-sm color-brand-1">₹0</span></div>
                                            <div class="col-sm-4 col-4"><a class="btn btn-link btn-sm float-right range-filters">Apply</a></div>
                                            <div class="col-sm-4 col-4 text-end"><span class="font-sm color-brand-1">₹1000</span></div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="filter-block mb-30">
                                <h5 class="medium-heading mb-10">Experience Level</h5>
                                <div class="list-checkbox pb-20">
                                    <div class="row position-relative mt-10 mb-20">
                                        <div class="col-sm-12 box-slider-range">
                                            <div id="slider-range-2"></div>
                                        </div>
                                        <div class="box-input-money">
                                            <input class="input-disabled form-control range-items min-value-experience" type="text" id="experience" name="experience" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>
                                    </div>
                                    <div class="box-number-money">
                                        <div class="row mt-30">
                                            <div class="col-sm-4 col-4"><span class="font-sm color-brand-1">0 yrs</span></div>
                                            <div class="col-sm-4 col-4"><a class="btn btn-link btn-sm float-right range-filters">Apply</a></div>
                                            <div class="col-sm-4 col-4 text-end"><span class="font-sm color-brand-1">20 yrs</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>



                <!--- Bottom canvas -->
                <div id="bs-canvas-bottom-filter" style="display: none;" class="bs-canvas bs-canvas-anim bs-canvas-bottom position-fixed bg-light w-100">
                    <header class="bs-canvas-header p-3 bg-primary overflow-auto">
                        <button type="button" class="bs-canvas-close float-left close" aria-label="Close" style="background: transparent; border: none;">
                            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                        </button>
                        <h5 class="d-inline-block text-light mb-0 float-righ offcanvas-heading">Filters</h5>
                    </header>


                    <div class="bs-canvas-content px-3 mt-10">



                        <div class="sidebar-shadow none-shadow mb-30">

                            <div class="filter-block head-border mb-30">
                                <h5>Advance Filter <a class="link-reset reset-filters" role="button">Reset</a></h5>
                            </div>

                            <div class="filter-block mb-30">
                                <div class="form-group select-style select-style-icon">
                                    <select id="job_location" class="form-control form-icons dropdown-filters">
                                        <option data-identifier="default-value" value="-1">All Countries</option>
                                        <?php foreach ($countries as $country) : ?>
                                            <option value="<?= en_func($country->country_id, 'e') ?>"><?= $country->country_name ?></option>
                                        <?php endforeach; ?>
                                    </select><i class="fi-rr-marker"></i>
                                </div>
                            </div>

                            <!---->

                            <div class="filter-tab">
                                <button class="filter-tablinks active" data-target="Posted_Time">Posted time</button>
                                <button class="filter-tablinks" data-target="Job_Type">Job type</button>
                                <button class="filter-tablinks" data-target="Salary">Salary</button>
                                <button class="filter-tablinks" data-target="Experience">Experience</button>
                            </div>

                            <!---->

                            <div id="Posted_Time" class="filter-tabcontent">
                                <div class="filter-block mb-30">
                                    <div class="form-group">
                                        <ul class="list-checkbox" id="posted_date">
                                            <li>
                                                <label class="cb-container">
                                                    <input data-identifier="default-value" class="checkbox-filters" data-value="-1" type="checkbox" checked="checked"><span class="text-small">All</span><span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="cb-container">
                                                    <input class="checkbox-filters" data-value="1" type="checkbox"><span class="text-small">1 day</span><span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="cb-container">
                                                    <input class="checkbox-filters" data-value="7" type="checkbox"><span class="text-small">7 days</span><span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="cb-container">
                                                    <input class="checkbox-filters" data-value="30" type="checkbox"><span class="text-small">30 days</span><span class="checkmark"></span>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!---->

                            <!---->
                            <div id="Job_Type" class="filter-tabcontent" style="display: none;">
                                <div class="filter-block mb-20">
                                    <div class="form-group">
                                        <ul class="list-checkbox">
                                            <li>
                                                <label class="cb-container">
                                                    <input type="checkbox" checked="checked"><span class="text-small">All</span><span class="checkmark"></span>
                                                </label><span class="number-item">180</span>
                                            </li>
                                            <li>
                                                <label class="cb-container">
                                                    <input type="checkbox"><span class="text-small">Software</span><span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="cb-container">
                                                    <input type="checkbox"><span class="text-small">Finance</span><span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="cb-container">
                                                    <input type="checkbox"><span class="text-small">Recruting</span><span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="cb-container">
                                                    <input type="checkbox"><span class="text-small">Management</span><span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="cb-container">
                                                    <input type="checkbox"><span class="text-small">Advertising</span><span class="checkmark"></span>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!---->

                            <div id="Salary" class="filter-tabcontent" style="display: none;">
                                <div class="filter-block mb-20">
                                    <div class="list-checkbox pb-20">
                                        <div class="row position-relative mt-10 mb-20">
                                            <div class="col-sm-12 box-slider-range">
                                                <div id="slider-range-3"></div>
                                            </div>
                                            <div class="box-input-money">
                                                <input class="input-disabled form-control range-items min-value-money" type="text" id="salary" name="salary" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            </div>
                                        </div>
                                        <div class="box-number-money">
                                            <div class="row mt-30">
                                                <div class="col-sm-4 col-4"><span class="font-sm color-brand-1">₹0</span></div>
                                                <div class="col-sm-4 col-4"><a class="btn btn-link btn-sm float-right range-filters">Apply</a></div>
                                                <div class="col-sm-4 col-4 text-end"><span class="font-sm color-brand-1">₹1000</span></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!---->

                            <!---->
                            <div id="Experience" class="filter-tabcontent" style="display: none;">
                                <div class="filter-block mb-30">
                                    <div class="list-checkbox pb-20">
                                        <div class="row position-relative mt-10 mb-20">
                                            <div class="col-sm-12 box-slider-range">
                                                <div id="slider-range-4"></div>
                                            </div>
                                            <div class="box-input-money">
                                                <input class="input-disabled form-control range-items min-value-experience" type="text" id="experience" name="experience" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            </div>
                                        </div>
                                        <div class="box-number-money">
                                            <div class="row mt-30">
                                                <div class="col-sm-4 col-4"><span class="font-sm color-brand-1">0 yrs</span></div>
                                                <div class="col-sm-4 col-4"><a class="btn btn-link btn-sm float-right range-filters">Apply</a></div>
                                                <div class="col-sm-4 col-4 text-end"><span class="font-sm color-brand-1">20 yrs</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!---->



                            <!---->


                        </div>




                    </div>
                </div>
                <!--- Bottom canvas -->


            </div>
        </div>
    </section>


    <!--- Right canvas -->
    <div id="bs-canvas-right" class="bs-canvas bs-canvas-anim bs-canvas-right position-fixed bg-light h-100">
        <header class="bs-canvas-header p-3 bg-primary overflow-auto">
            <button type="button" class="bs-canvas-close float-left close" aria-label="Close" style="background: transparent; border: none;">
                <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
            </button>
            <h5 class="d-inline-block text-light mb-0 float-righ offcanvas-heading">Canvas Header</h5>
            <p class="mt-10 ml-50 offcanvas-subheading text-white">Subheading</p>
        </header>

        <div id="alert-message-div" class="mt-15 alert-message-div" style="display: none; padding: 0% 3%;">
        </div>


        <div class="bs-canvas-content px-3 offcanvas-content mt-10">
            ...
        </div>
    </div>
    <!--- Right canvas -->




</main>





<script src="<?= base_url() ?>assets/users/scripts/jobs.js"></script>


<script src="<?= base_url() ?>assets/users/js/noUISlider.js"></script>
<script src="<?= base_url() ?>assets/users/js/slider.js"></script>