"use strict";
const jobs_loader = `<center><i class="jobsdatacard-loader fa fa-circle-o-notch fa-spin"></i></center>`;

document.addEventListener("DOMContentLoaded", () => {
    load_jobs();
});


function load_jobs() {
    if ($('.jobs_datacard-list').length > 0)
        $(".jobs_datacard-list").submit();
}



$(document).on('submit', '.jobs_datacard-list', function (e) {
    e.preventDefault();
    $("#jobs-na_datacard").html(jobs_loader);


    var parameters = {};
    let current_parameters = getParameters();

    for (const [key, value] of current_parameters.entries()) {
        parameters[key] = value;
    }

    load_jobs_datacard(parameters, $(this).attr('action'));

    $('body,html').animate({
        scrollTop: 0
    }, 500);
});



function load_jobs_datacard(parameters, form_url) {

    $.get(form_url, parameters, function (data, status) {
        var out = jQuery.parseJSON(data);
        tableData = out.data;

        buildJobsCard(tableData);


    });
}





function buildJobsCard(myList) {

    let datacard_element = ``;
    let jobsData = myList.jobs;


    $.each(jobsData, function (index, item) {

        datacard_element += `
        <div class="col-xl-12 col-12 mt-15">
                <div class="card-grid-2 hover-up">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card-grid-2-image-left">
                                    <div class="right-info">
                                    <h4><a href="#">${item.job_title}</a></h4>
                                    <span class="location-small">${item.job_location}</span></div>
                                    </div>
                                </div>
                               
                            </div>
                                <div class="card-block-info">
                                    <div class="mt-5">
                                    <span class="card-briefcase">${item.job_openings} Openings</span>
                                    <span class="card-time"><span>4</span><span> mins ago</span></span></div>
                                        <p class="font-sm color-text-paragraph mt-10">${item.brief_description}</p>
                                        <div class="card-2-bottom mt-20">
                                            <div class="row">
                                                <div class="col-lg-7 col-7">
                                                <p class="font-sm text-custom">${item.min_experience} - ${item.max_experience} years experience </p>
                                                    <span class="card-text-price">₹ ${item.min_salary} - ₹ ${item.max_salary}</span><span class="text-muted">/Month</span>
                                                </div>
                                                    <div class="col-lg-5 col-5 text-end">
                                                    <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        `;

    });

    $("#jobs-na_datacard").html(datacard_element)


    let page_limit = (myList.page_limit == undefined) ? 1 : myList.page_limit;
    let current_page = (myList.current_page == undefined) ? 1 : myList.current_page;
    let nums_limit = (myList.nums_limit == undefined) ? 1 : myList.nums_limit;

    let start_index = (myList.start_index == undefined) ? 0 : myList.start_index;
    let per_page = (myList.per_page == undefined) ? 0 : myList.per_page;
    let total_rows = (myList.total_rows == undefined) ? 0 : myList.total_rows;
    let ending_index = (myList.total_rows == undefined) ? 0 : myList.ending_index;


    let pagination_details = `Showing <strong>${start_index}-${ending_index} </strong>of <strong>${total_rows} </strong>jobs`
    $(".pagination-details").html(pagination_details);

    buildJobsPagination(page_limit, current_page, nums_limit);

}


$(document).on('click', '.jobs-paginations .pages', function (e) {
    let page = $(this).attr('data-id');
    add_getParameters("page", page);

    load_jobs();
});


function buildJobsPagination(page_limit, current_page, nums_limit) {
    let pagination_btns = ``;

    if (current_page > 1)
        pagination_btns += `<li><a data-id="${current_page - 1}" class="pages pager-prev"></a></li>`;


    var count = 0;
    for (var i = current_page - 1; i <= page_limit; i++) {
        if (count < nums_limit && i > 0)
            pagination_btns += `<li><a data-id="${i}" class="pages pager-number ${(i == current_page) ? 'active' : ''}">${i}</a></li>`;

        count++;
    }

    if(count > page_limit){
        pagination_btns += `<li><a>...</a></li>`;
    }

    if (current_page <= page_limit - 1)
        pagination_btns += `<li><a data-id="${current_page + 1}" class="pages pager-next"></a></li>`;



    add_getParameters("page", current_page);

    $("#job-pagination_btns").html(pagination_btns);
}