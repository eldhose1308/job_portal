"use strict";
const jobs_loader = `<center><i class="jobsdatacard-loader fa fa-circle-o-notch fa-spin"></i></center>`;

document.addEventListener("DOMContentLoaded", () => {
    load_jobs();

});


function load_jobs() {
    if ($('.jobs_datacard-list').length > 0)
        $(".jobs_datacard-list").submit();
}



$(document).on('click', '.show-filters', function (e) {
    e.preventDefault();
    showOffCanvas("#bs-canvas-bottom-filter", false);

});

$(document).on('click', '.jobs_datacard-list .filter .dropdown-item', function (e) {
    e.preventDefault();

    let ids = $(this).parent().parent()[0].id;
    let value = $(this).attr("data-value");

    add_getParameters(ids, value);

    load_jobs();

    AlertandToast('success', 'Filters Applied', false, true);

});


/***
 * 
 * Side Filters
 * 
 * * */

$(document).on('click', '.reset-filters', function (e) {
    remove_getParameters();
    closeOffCanvas();

    load_jobs();
    AlertandToast('success', 'Filters Cleared', false, true);
});


$(document).on('change', '.checkbox-filters', function (e) {
    $(this).parent().parent().parent().find('.checkbox-filters').not(this).prop('checked', false);

    let ids = $(this).parent().parent().parent()[0].id;
    let value = $(this).attr("data-value");

    add_getParameters(ids, value);

    load_jobs();
    AlertandToast('success', 'Filters Applied', false, true);

});

$(document).on('change', '.dropdown-filters', function (e) {
    let ids = $(this)[0].id;
    let value = $(this).val();
    add_getParameters(ids, value);

    load_jobs();
    AlertandToast('success', 'Filters Applied', false, true);

});


$(document).on('click', '.range-filters', function (e) {
    document.querySelectorAll('.range-items').forEach(function (element) {
        let ids = element.id;
        let value = element.value;
        add_getParameters(ids, value);

    });
    closeOffCanvas();

    load_jobs();
    AlertandToast('success', 'Filters Applied', false, true);
});


/***
 * 
 * Side Filters
 * 
 * * */




$(document).on('submit', '.jobs-search-form', function (e) {
    e.preventDefault();

    let ids = "query";
    let value = $(".jobs-search-form .query").val();

    add_getParameters(ids, value);

    load_jobs();
});


$(document).on('click', '.filter-tablinks', function (e) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("filter-tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("filter-tablinks");
    for (i = 0; i < tablinks.length; i++) {
        $('.filter-tablinks').removeClass('active');
    }
    let sel_elem = "#" + ($(this).attr('data-target'));

    $(sel_elem).show();
    $(this).addClass('active');
});


function getParameters_toDOM() {
    let parameters = getParameters();
    let filters = '';
    let key_splitted;
    parameters.forEach((value, key) => {
        key = key.replaceAll('_', ' ');
        key_splitted = key.split(" ");

        for (var i = 0; i < key_splitted.length; i++)
            key_splitted[i] = key_splitted[i].charAt(0).toUpperCase() + key_splitted[i].slice(1);


        key = key_splitted.join(" ");

        if (key != 'Page')
            filters += `
                        <span class="badge filter-preview bg-custom">${key} <i class="fa fa-times-circle ml-5 remove-filter-preview"></i></span>
                    `;
    });

    $('#filters-preview-dom').html(filters);

}



$(document).on('click', '.remove-filter-preview', function (e) {
    e.preventDefault();
    let key_splitted;
    let key = $(this).parent().text().trim();
    key = key.replaceAll(' ', '_');

    key_splitted = key.split("_");

    for (var i = 0; i < key_splitted.length; i++)
        key_splitted[i] = key_splitted[i].charAt(0).toLowerCase() + key_splitted[i].slice(1);


    key = key_splitted.join("_");

    remove_this_getParameters(key);
    load_jobs();
});

$(document).on('submit', '.jobs_datacard-list', function (e) {
    e.preventDefault();
    $("#jobs-na_datacard").html(jobs_loader);

    getParameters_toDOM();

    var parameters = {};
    let current_parameters = getParameters();

    for (const [key, value] of current_parameters.entries()) {
        parameters[key] = value;
    }


    load_jobs_datacard(parameters, $(this).attr('action'));


});



function load_jobs_datacard(parameters, form_url) {

    circular_loader_get('show');

    $.get(form_url, parameters, function (data, status) {
        var out = jQuery.parseJSON(data);
        tableData = out.data;

        buildJobsCard(tableData);

        circular_loader_get('hide');

    }).fail(function () {
        AlertandToast('error', 'Could not load jobs', false, true);
        circular_loader_get('hide');

    });

}



/***
 * 
 *  sharing options
 * 
 */
$(document).on('click', '.copy-to-clipboard', function (e) {
    e.preventDefault();
    let copy_link = $(this).attr('data-url');
    navigator.clipboard.writeText(copy_link);
    AlertandToast('success', 'Copied to Clipboard', false, true);
});


$(document).on('click', '.web-share', function (e) {
    e.preventDefault();
    let copy_link = $(this).attr('data-url');
    let text_link = $(this).attr('data-text');
    if (navigator.share) {
        navigator.share({
            title: 'Amore - Job Portal',
            text: text_link,
            url: copy_link
        }).then(() => {
            console.log('Thanks for sharing!');
        }).catch(err => {
            AlertandToast('error', 'Something went wrong, try again !', false, true);
            console.log(err);
        });
    } else {
        AlertandToast('error', 'This feature is not supported !', false, true);
    }
});



$(document).on('click', '.open-bottom-offcanvas', function (e) {
    $('.offcanvas-heading').html('');
    $('.offcanvas-content').html('');
    showOffCanvas("#bs-canvas-right");
    let form_url = $(this).attr("data-url");

    $.get(form_url, function (data, status) {
        var out = jQuery.parseJSON(data);
        out = out.data;

        $('.offcanvas-heading').html(out.heading);
        $('.offcanvas-subheading').html(out.sub_heading);
        $('.offcanvas-content').html(out.content);

    }).fail(function () {
        AlertandToast('error', 'Could not load jobs', false, true);
        $('.offcanvas-content').html('');

    });


});



$(document).on('click', '.open-right-offcanvas', function (e) {
    $('.offcanvas-heading').html('');
    $('.offcanvas-content').html('');
    showOffCanvas("#bs-canvas-right");
    let form_url = $(this).attr("data-url");

    $.get(form_url, function (data, status) {
        var out = jQuery.parseJSON(data);
        out = out.data;

        $('.offcanvas-heading').html(out.heading);
        $('.offcanvas-subheading').html(out.sub_heading);
        $('.offcanvas-content').html(out.content);

    }).fail(function () {
        AlertandToast('error', 'Could not load jobs', false, true);
        $('.offcanvas-content').html('');

    });


});





function circular_loader_get(action = 'hide') {
    $("#loader-overlay").show();
    var width = 0;
    if (action == 'hide') {
        $("#circular-progress-value").html('0%');
        $("#loader-overlay").hide();
    }


    var prg = setInterval(function () {
        if (width >= 100) {
            $("#circular-progress-value").html('0%');
            clearInterval(prg);
            $("#loader-overlay").hide();

        } else {
            $("#circular-progress-value").html(width + '%');
            $("#circular-progressbar").removeClass();
            width++;
            $("#circular-progressbar").addClass('progress-circle');
            if (width >= 50)
                $("#circular-progressbar").addClass('over50');

            $("#circular-progressbar").addClass('p' + width);

        }
    }, 1);


}





function buildJobsCard(myList) {

    let datacard_element = ``;
    let jobsData = myList.jobs;
    if (myList.content_null) {
        datacard_element += `
            <div class="col-xl-12 col-12 mt-15">
            <h4><a href="#">No Jobs found</a></h4>
            </div>
        `;
    }
    var job_url = '';
    $.each(jobsData, function (index, item) {
        if (myList.user_type != "admin") {
            job_url = item.job_title.replace(/ /g, "-").toLowerCase() + '-' + item._id;

            datacard_element += `
        
                    <div class="col-xl-12 col-12 mt-15">
                    <div class="card-grid-2 hover-up">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="card-grid-2-image-left">
                                    <div class="right-info">
                                        <h4><a href="${base_url}job_details/${job_url}">${item.job_title}</a></h4>
                                        <span class="location-small text-black">${item.job_location}</span> <br>
                                        <span class="badge bg-${item.job_status_badge}">${item.job_status ? item.job_status : ''}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-block-info">
                            <div class="mt-5">
                                <span class="card-briefcase text-black">${item.job_openings} Openings</span>
                                <span class="card-time text-black"><span>${item.posted_before}</span></span>
                            </div>
                            <a class="btn btn-tags-sm mt-10 mb-10 mr-5">
                                Experience ${item.min_experience} - ${item.max_experience} years
                            </a>
                            <a class="btn btn-tags-sm mt-10 mb-10 mr-5">
                                INR ${item.min_salary} - ${item.max_salary} / Month
                            </a>
                            <div class="card-2-bottom mt-20">
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <p class="font-sm color-text-paragraph mt-10">${item.brief_description}</p>
                                    </div>
                                    <div class="col-lg-7 col-7 mt-15">
                                        <a class="d-inline-block d-middle web-share" data-text="Job Description for ${item.job_title} in ${item.job_location} for ${item.min_experience} - ${item.max_experience} years of experience .Apply Now !" 
                                        data-url="${base_url}job_details/${job_url}"><i class="fa fa-share-alt ml-0 btn text-primary"></i></a>

                                        <a class="d-inline-block d-middle copy-to-clipboard" data-url="${base_url}job_details/${job_url}"><i class="fa fa-clone ml-0 btn text-primary"></i></a>
                                        <a class="d-inline-block d-middle" href="whatsapp://send?text=Job Description for ${item.job_title} in ${item.job_location} for ${item.min_experience} - ${item.max_experience} years of experience .Apply Now ! ${base_url}job_details/${job_url}" data-action="share/whatsapp/share">
                                            <img alt="nexcode" src="${base_url}assets/users/imgs/template/icons/share-whatsapp.svg">
                                        </a>
                                    </div>
                                    <div class="col-lg-5 col-5 text-end mt-15">
                                        <form id="" action="${base_url}home/add_to_wishlist">
                                        <button title="Wishlist" class="${item.show_wishlist ? '' : 'd-none'} btn btn-counter add-to-wishlist ${item.wishlist ? 'active' : ''}"><span>&#x2764;</span><span class="wishlisted-text"> ${item.wishlist ? 'Remove From Wishlist' : 'Add To Wishlist'}</span> </button>
                                        <input type="hidden" name="job_id" class="job_id" value="${item._id}">
                                        <input type="hidden" name="wishlist_status" class="wishlist_status" value="${item.wishlist ? 1 : 0}">
                                        <a data-no="${index}" class="${item.show_applied ? '' : 'd-none'} btn ${item.applied ? 'btn-counter' : 'btn-apply-now '}  open-right-offcanvas" data-url="${base_url + 'home/apply_job_page/' + item._id}">${item.applied ? 'Applied <span>&#x2713;</span>' : 'Apply now'}</a>
                                        <a class="btn btn-counter" href="${base_url}job_details/${job_url}">Details<span class="ml-5">&#x2192;</span></a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
        `;
        } else {
            datacard_element += `
        
        <div class="col-xl-12 col-12 mt-15">
        <div class="card-grid-2 hover-up">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card-grid-2-image-left">
                        <div class="right-info">
                            <h4><a href="#">${item.job_title}</a></h4>
                            <span class="location-small text-black">${item.job_location}</span> <br>
                            <span class="${myList.show_application_status ? '' : 'd-none '} badge bg-${item.job_status_badge}">${item.job_status ? item.job_status : ''}</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-block-info">
                <div class="mt-5">
                    <span class="card-briefcase text-black">${item.job_openings} Openings</span>
                    <span class="card-time text-black"><span>${item.posted_before}</span></span>
                </div>
                <a class="btn btn-tags-sm mt-10 mb-10 mr-5">
                    Experience ${item.min_experience} - ${item.max_experience} years
                </a>
                <a class="btn btn-tags-sm mt-10 mb-10 mr-5">
                    INR ${item.min_salary} - ${item.max_salary} / Month
                </a>
                <div class="card-2-bottom mt-20">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <p class="font-sm color-text-paragraph mt-10">${item.brief_description}</p>
                        </div>
                        <div class="col-lg-7 col-7">
                        </div>
                        <div class="col-lg-5 col-5 text-end">
                            ${item.action_btns}                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
`;
        }
    });

    $("#jobs-na_datacard").html(datacard_element)


    let page_limit = (myList.page_limit == undefined) ? 1 : myList.page_limit;
    let current_page = (myList.current_page == undefined) ? 1 : myList.current_page;
    let nums_limit = (myList.nums_limit == undefined) ? 1 : myList.nums_limit;

    let start_index = (myList.start_index == undefined) ? 0 : myList.start_index;
    let per_page = (myList.per_page == undefined) ? 0 : myList.per_page;
    let total_rows = (myList.total_rows == undefined) ? 0 : myList.total_rows;
    let ending_index = (myList.total_rows == undefined) ? 0 : myList.ending_index;


    if (myList.show_pagination) {
        let pagination_details = `Showing <strong>${start_index}-${ending_index} </strong>of <strong>${total_rows} </strong>jobs`
        $(".pagination-details").html(pagination_details);
        $(".total_jobs").html(total_rows);
        buildJobsPagination(page_limit, current_page, nums_limit);
    }
}




$(document).on('click', '.add-to-wishlist', function (e) {
    e.preventDefault();
    var $this = $(this);

    $this.toggleClass('active');

    let active = $this.hasClass('active');


    $this.parent().children('.wishlist_status').val(active ? 1 : 0);
    $this.children('.wishlisted-text').text((active) ? ' Remove from Wishlist' : ' Add to Wishlist');

    if (add_to_wishlist($this))
        return;


});



function add_to_wishlist($this) {
    let wishlist_status = $this.parent().children('.wishlist_status').val();

    var formData = new FormData($("#dummy-forms")[0]);
    formData.append('_token', $('input[name="_token"]').val());
    formData.append('wishlist_status', wishlist_status);

    var form_url = $('#job_wishlist-forms').attr('action') + $this.parent().children('.job_id').val();
    var result_xhr = $.ajax({
        url: form_url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    var percentComplete = parseInt((evt.loaded / evt.total) * 100);
                    circular_loader_post('show', percentComplete);
                }
            }, false);
            return xhr;
        },
        beforeSend: function () {
            circular_loader_post('hide', 0);

        }
    })

    result_xhr.done(function (data) {
        // circular_loader_post('hide',0);


        var out = jQuery.parseJSON(data);
        if (out.status == 'success') {
            BottomToast(out.msg);

            // load_jobs();
            return true;
        }

    });

    result_xhr.fail(function () {
        BottomToast('Something wrong, Try again');
        return false;

    });


}



$(document).on('click', '.jobs-paginations .pages', function (e) {
    e.preventDefault();

    $('body,html').animate({
        scrollTop: 0
    }, 100);


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

    if (count > page_limit) {
        pagination_btns += `<li><a>...</a></li>`;
    }

    if (current_page <= page_limit - 1)
        pagination_btns += `<li><a data-id="${current_page + 1}" class="pages pager-next"></a></li>`;



    add_getParameters("page", current_page);

    $("#job-pagination_btns").html(pagination_btns);
}