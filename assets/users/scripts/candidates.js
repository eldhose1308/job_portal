"use strict";
const jobs_loader = `<center><i class="jobsdatacard-loader fa fa-circle-o-notch fa-spin"></i></center>`;

document.addEventListener("DOMContentLoaded", () => {
    load_candidates();

});


function load_candidates() {
    if ($('.candidates_datacard-list').length > 0)
        $(".candidates_datacard-list").submit();
}



$(document).on('click', '.show-filters', function (e) {
    e.preventDefault();
    showOffCanvas("#bs-canvas-bottom-filter", false);

});

$(document).on('click', '.candidates_datacard-list .filter .dropdown-item', function (e) {
    e.preventDefault();

    let ids = $(this).parent().parent()[0].id;
    let value = $(this).attr("data-value");

    add_getParameters(ids, value);

    load_candidates();
});


/***
 * 
 * Side Filters
 * 
 * * */

$(document).on('change', '.checkbox-filters', function (e) {
    $(this).parent().parent().parent().find('.checkbox-filters').not(this).prop('checked', false);

    let ids = $(this).parent().parent().parent()[0].id;
    let value = $(this).attr("data-value");

    add_getParameters(ids, value);

    load_candidates();
});

$(document).on('change', '.dropdown-filters', function (e) {

    let ids = $(this)[0].id;
    let value = $(this).val();
    add_getParameters(ids, value);

    load_candidates();
});


/***
 * 
 * Side Filters
 * 
 * * */





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

}

$(document).on('submit', '.candidates_datacard-list', function (e) {
    e.preventDefault();
    $("#candidates-na_datacard").html(jobs_loader);

    getParameters_toDOM();

    var parameters = {};
    let current_parameters = getParameters();

    for (const [key, value] of current_parameters.entries()) {
        parameters[key] = value;
    }


    load_candidates_datacard(parameters, $(this).attr('action'));


});



function load_candidates_datacard(parameters, form_url) {

    circular_loader_get('show');

    $.get(form_url, parameters, function (data, status) {
        var out = jQuery.parseJSON(data);
        tableData = out.data;

        buildCandidatesCard(tableData);

        circular_loader_get('hide');

    });

}




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





function buildCandidatesCard(myList) {
    let datacard_element = ``;
    let candidatesData = myList.candidates;
    if (myList.content_null) {
        datacard_element += `
            <div class="col-xl-12 col-12 mt-15">
            <h4><a href="#">No Candidates found</a></h4>
            </div>
        `;
    }
    $.each(candidatesData, function (index, item) {
        if (myList.user_type == "admin") {
            datacard_element += `
        
        <div class="col-xl-6 col-12 mt-15">
        <div class="card-grid-2 hover-up">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card-grid-2-image-left">
                        <div class="right-info">
                            <h4><a href="#">${item.full_name}</a></h4>
                            <span class="text-black">${item.user_name}</span> <br>
                            <span class="${myList.show_application_status ? '' : 'd-none '} badge bg-${item.job_status_badge}">${item.job_status ? item.job_status : ''}</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-block-info">
                <div class="mt-5">
                    <span class="text-black"><i class="fa ${item.email_verified ? 'fa-check fa-success' : 'fa-times fa-danger'}"></i></span>
                    <span class="card-time text-black"><span>${item.email_verified_at}</span></span>
                </div>
                <a class="btn btn-tags-sm mt-10 mb-10 mr-5">
                     ${item.user_email}
                </a>
                <a class="btn btn-tags-sm mt-10 mb-10 mr-5">
                     ${item.user_mobile} 
                </a> 
                <a target="_blank" href="https://api.whatsapp.com/send?phone=+91${item.user_mobile}&text=This is a message from Amore Holidays" class="btn btn-tags-sm mt-10 mb-10 mr-5">
                Whatsapp <i class="fa fa-whatsapp text-success"></i>
                </a>
                <div class="card-2-bottom mt-20">
                    <div class="row">
                       
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

    $("#candidates-na_datacard").html(datacard_element)


    let page_limit = (myList.page_limit == undefined) ? 1 : myList.page_limit;
    let current_page = (myList.current_page == undefined) ? 1 : myList.current_page;
    let nums_limit = (myList.nums_limit == undefined) ? 1 : myList.nums_limit;

    let start_index = (myList.start_index == undefined) ? 0 : myList.start_index;
    let per_page = (myList.per_page == undefined) ? 0 : myList.per_page;
    let total_rows = (myList.total_rows == undefined) ? 0 : myList.total_rows;
    let ending_index = (myList.total_rows == undefined) ? 0 : myList.ending_index;


    if (myList.show_pagination) {
        let pagination_details = `Showing <strong>${start_index}-${ending_index} </strong>of <strong>${total_rows} </strong>candidates`
        $(".pagination-details").html(pagination_details);
        $(".total_candidates").html(total_rows);
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

            // load_candidates();
            return true;
        }

    });

    result_xhr.fail(function () {
        BottomToast('Something wrong, Try again');
        return false;

    });


}



$(document).on('click', '.candidates-paginations .pages', function (e) {
    e.preventDefault();

    $('body,html').animate({
        scrollTop: 0
    }, 100);


    let page = $(this).attr('data-id');
    add_getParameters("page", page);

    load_candidates();
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