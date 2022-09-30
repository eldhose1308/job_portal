const base_url = document.getElementsByTagName("constants")[0].dataset.base;

let dashboard_menus = base_url + 'admin/home/dashboard_menus';
let shortcut_url = base_url + 'keyboard_shortcuts';
var alert_message = '';




let intId = document.getElementById("internetStatus");
let sucText = "Yaay!  You are now online.";
let failText = "Oops! No internet connection.";
let sucCol = "#00b894";
let failCol = "#ea4c62";




document.addEventListener("DOMContentLoaded", () => {
    // load_dashboard_menus(); // loads user menu
    setSiteSettings(); // checks for dark mode or light mode
    load_datatable_list() // loads datatable data 
    load_datacard_list() // loads datacard data 



    //alert(222);
    hide_preloader() // hides preloader 


    $('.select2').select2({
        closeOnSelect: true
    });
});


function showOffCanvas(canvas, show_loader = true) {
    let offCanvas_loader = `<center><i style="font-size:35px;color: #05264e;" class="fa fa-spinner fa-spin"></i></center>`;
    $(canvas).css('width', '65%');
    $('.bs-canvas-overlay').addClass('show');
    $(canvas).show();

    // $('.offcanvas-heading').html('Header');
    if (show_loader)
        $('.offcanvas-content').html(offCanvas_loader);
    return false;
}


function closeOffCanvas() {
    $('.bs-canvas-close').trigger('click');
}


$(document).on('click', '.bs-canvas-close, .bs-canvas-overlay', function () {
    $('.bs-canvas').css('width', '0%');
    $('.bs-canvas').hide();
    $('.bs-canvas-overlay').removeClass('show');

    $('.offcanvas-heading').html('');
    $('.offcanvas-subheading').html('');
    $('.offcanvas-content').html('');

    return false;
});


function hide_preloader() {
    $('.preloader').hide();
}



/******** Sidebar search ********/

$(document).on('keyup', '.form-control-sidebar', function (e) {
    e.preventDefault();


    let clear_btn = '<i class="fa fa-fw fa-times clear-in-searchbar"></i>';
    let search_btn = '<i class="fa fa-fw fa-search search-in-searchbar"></i>';

    let search_keyword = $('.form-control-sidebar').val().toLowerCase();


    if (search_keyword.length > 1) {

        $('.btn-sidebar').html(clear_btn);
        search_forkeyword(search_keyword);
    } else {
        $('.btn-sidebar').html(search_btn);
        $('.list-group').html('');

    }

    navigate_throughResults(e.keyCode);



});

function navigate_throughResults(keyCode) {
    if (keyCode == 38) {
        $('.list-group').children().last().focus();
        return;
    }
    if (keyCode == 40) {
        $('.list-group').children().first().focus();
        return;
    }
}


function search_forkeyword(search_keyword) {

    if (search_keyword.length > 1) {
        $('.sidebar-search-results').show();
    } else {
        $('.sidebar-search-results').hide();
        return;
    }


    let counter = 0;
    var nav_items = document.getElementById('dashboard_menus').getElementsByClassName('menu-navlinks');

    var item_in_lower = '';
    var search_result_html = ``;


    for (var i = 0; i < nav_items.length; i++) {
        item_in_lower = nav_items[i].innerText.toLowerCase();

        ;

        if (item_in_lower.includes(search_keyword)) {
            counter++;

            search_result_html += `
              <a href="${nav_items[i].href}" class="list-group-item">
                  <div class="search-title"><strong>${nav_items[i].innerText}</strong></div>
                  <div class="search-path">${(nav_items[i].dataset.parent) ? nav_items[i].dataset.parent : ''}</div>
              </a>
        `;

        }
    }


    if (counter == 0) {
        search_result_html = `
              <a class="list-group-item">
                  <div class="search-title">No results found !</div>
                  <div class="search-path"></div>
              </a>
      `;
    }


    $('.list-group').html(search_result_html);

}

function toggle_searchAndclear() {
    let clear_btn = '<i class="fa fa-fw fa-times clear-in-searchbar"></i>';
    let search_btn = '<i class="fa fa-fw fa-search search-in-searchbar"></i>';


    if ($('.search-in-searchbar').is(":visible")) {
        $('.btn-sidebar').html(clear_btn);
        $('.sidebar-search-results').show();
        let search_keyword = $('.form-control-sidebar').val().toLowerCase();

        search_forkeyword(search_keyword);

    } else {
        $('.btn-sidebar').html(search_btn);
        $('.sidebar-search-results').hide();
    }


}

$(document).on('click', '.btn-sidebar', function (e) {
    e.preventDefault();
    toggle_searchAndclear();
});

/******** Sidebar search ********/



/******** Loads Datatable Json data ********/

function load_datatable_list() {
    if ($('.datatable-list').length > 0)
        $(".datatable-list").submit();
}

$(document).on('change', '.datatable-list .filter .form-control', function (e) {
    e.preventDefault();
    if ($('.datatable-list').length > 0)
        $(".datatable-list").submit();
});


$(document).on('submit', '.datatable-list', function (e) {
    e.preventDefault();

    var parameters = [];

    $(this).children()
        .each(function (index, element) {
            if (element.classList.contains('filter')) {
                var ids = element.children[0].id;
                parameters[ids] = element.children[0].value;
            }
        });

    load_datatable(parameters, $(this).attr('action'));
});

function load_datatable(parameters, form_url) {
    $("#na_datatable").dataTable().fnDestroy();

    $('#na_datatable').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
            "data": parameters,
            "url": form_url
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
    });
}


/******** Loads Datatable Json data ********/



/******** Loads Datacard Json data ********/

/*
function load_datacard_list() {
    if ($('.datacard-list').length > 0)
        $(".datacard-list").submit();
}

$(document).on('change', '.datacard-list .filter .form-control', function (e) {
    e.preventDefault();
    if ($('.datacard-list').length > 0)
        $(".datacard-list").submit();
});


$(document).on('submit', '.datacard-list', function (e) {
    e.preventDefault();
    var datacard_loader = `<center><i class="datacard-loader fa fa-circle-o-notch fa-spin"></i></center>`;
    $("#na_datacard").html(datacard_loader);

    var parameters = {};

    $(this).children()
        .each(function (index, element) {
            if (element.classList.contains('filter')) {
                var ids = String(element.children[0].id);
                parameters[ids] = element.children[0].value;
            }
        });


    load_datacard(parameters, $(this).attr('action'));
});

function load_datacard(parameters, form_url) {

    $.get(form_url, parameters, function (data, status) {
        var out = jQuery.parseJSON(data);
        tableData = out.data;

        getData(tableData);

    });
}

*/


function load_datacard_list() {
    if ($('.datacard-list').length > 0)
        $(".datacard-list").submit();
}



$(document).on('click', '.datacard-list .filter .dropdown-item', function (e) {
    e.preventDefault();

    let ids = $(this).parent().parent()[0].id;
    let value = $(this).attr("data-value");

    add_getParameters(ids, value);



    if ($('.datacard-list').length > 0)
        $(".datacard-list").submit();
});



$(document).on('submit', '.datacard-list', function (e) {
    e.preventDefault();
    var datacard_loader = `<center><i class="datacard-loader fa fa-circle-o-notch fa-spin"></i></center>`;
    $("#na_datacard").html(datacard_loader);

    var parameters = {};
    let current_parameters = getParameters();

    for (const [key, value] of current_parameters.entries()) {
        parameters[key] = value;
    }

    load_datacard(parameters, $(this).attr('action'));
});


function load_datacard(parameters, form_url) {

    $.get(form_url, parameters, function (data, status) {
        var out = jQuery.parseJSON(data);
        tableData = out.data;

        getData(tableData);

    });
}


/******** Loads Datacard Json data ********/



/******** Loads GET Parameters data ********/


function add_getParameters(ids, value) {
    let current_parameters = getParameters();

    if (current_parameters.has(ids))
        current_parameters.set(ids, value);
    else
        current_parameters.append(ids, value);

    window.history.replaceState(null, null, "?" + current_parameters);

}


function getParameters() {
    address = window.location.search;
    parameterList = new URLSearchParams(address);
    return parameterList;
}


/******** Loads GET Parameters data ********/




/******** Submits form without csrf and shows alert ********/

$(document).on('submit', '#add-form-without-csrf', function (e) {
    e.preventDefault();


    // let validations = validation_fields('category_name', 'required', 'Category name');
    // validations = validation_fields('sort_order', 'required|numeric', 'Sort order');


    if (validate_form(true, false, true))
        return false;



    var formData = new FormData($("#add-form-without-csrf")[0]);
    formData.append('_token', $('input[name="_token"]').val())

    var form_url = $('#add-form-without-csrf').attr('action');
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
                    $(".progress-bar").width(percentComplete + '%');
                    $(".progress-bar").html(percentComplete + '%');
                    circular_loader_post('show',percentComplete);
                }
            }, false);
            return xhr;
        },
        beforeSend: function () {
            $(".progress-bar").width('0%');
            $(".progress").show();
            circular_loader_post('hide',0);

        }
    })

    result_xhr.done(function (data) {
        $(".progress-bar").width('0%');
        $(".progress").hide();
        // circular_loader_post('hide',0);


        var out = jQuery.parseJSON(data);
        if (out.status == 'success') {
            // AlertandToast(out.status, out.msg, false, true);
            // go_to_backpage();
            // closeOffCanvas();
            // load_datacard_list();
        }
        else
            // AlertandToast(out.status, 'Recheck these errors and resubmit', false, true);


        // AlertandToast(out.status, out.msg, true, false);
        $('.submit-form').show();

    });

    result_xhr.fail(function () {
        AlertandToast('error', 'Page has expired, try later !');
    });
});



function BottomToast(message = 'Welcome !') {
    $("#snackbar").remove();
    let snackbar_html = `<div id="snackbar" class="show">${message}</div>`;
    $('body').append(snackbar_html);
    setTimeout(function(){ $("#snackbar").removeClass("show");    $("#snackbar").remove();
}, 3000);
  }


/******** Submits form without csrf and shows alert ********/


/******** Submits form and shows alert ********/

$(document).on('submit', '#add-form', function (e) {
    e.preventDefault();


    // let validations = validation_fields('category_name', 'required', 'Category name');
    // validations = validation_fields('sort_order', 'required|numeric', 'Sort order');


    if (validate_form(true, false, true))
        return false;



    var formData = new FormData($("#add-form")[0]);
    var form_url = $('#add-form').attr('action');
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
                    $(".progress-bar").width(percentComplete + '%');
                    $(".progress-bar").html(percentComplete + '%');
                }
            }, false);
            return xhr;
        },
        beforeSend: function () {
            $(".progress-bar").width('0%');
            $(".progress").show();
        }
    })

    result_xhr.done(function (data) {
        $(".progress-bar").width('0%');
        $(".progress").hide();


        var out = jQuery.parseJSON(data);
        if (out.status == 'success') {
            AlertandToast(out.status, out.msg, false, true);
            // go_to_backpage();
            // closeOffCanvas();
            load_datacard_list();
        }
        else
            AlertandToast(out.status, 'Recheck these errors and resubmit', false, true);


        AlertandToast(out.status, out.msg, true, false);

    });

    result_xhr.fail(function () {
        AlertandToast('error', 'Page has expired, try later !');
    });
});




/******** Submits form and shows alert ********/



/******** Submits image crop form and shows alert ********/

$(document).on('change', '#document-upload', function (e) {
    var allowedTypes = ['application/pdf'];
    var file = this.files[0];
    var fileName = file.name;
    var fileType = file.type;
    var fileSize = (file.size / 1024) / 1024;
    fileSize = Math.ceil(fileSize);


    if (fileSize > 5) {
        AlertandToast('warning', fileName + ' is of ' + fileSize + 'MB and the limit for uploading size is 5 MB');
        return false;
    }

    fileSize = fileSize + ' MB';

    $('#previous_document').hide();
    $('#document-preview').fadeIn();
    document.getElementById('document-preview').src = window.URL.createObjectURL(this.files[0]);
    return true;

});





$(document).on('change', '#upload', function () {
    var file = this.files[0];
    var fileName = file.name;
    var fileSize = (file.size / 1024) / 1024;
    fileSize = Math.ceil(fileSize);

    if (fileSize > 5) {
        AlertandToast('warning', fileName + ' is of ' + fileSize + 'MB and the limit for uploading size is 5 MB');
        return;
    }

    fileSize = fileSize + ' MB';

    let viewport_height = Number($(this).attr('data-height'));
    let viewport_width = Number($(this).attr('data-width'));
    $('#upload-demo').fadeIn();
    $('#upload-demo').croppie('destroy');
    $uploadCrop = $('#upload-demo').croppie({
        enableExif: true,
        boundary: {
            width: viewport_width + 20,
            height: viewport_height + 10
        },
        viewport: {
            width: viewport_width,
            height: viewport_height,
            type: 'square'
        }
    });

    var reader = new FileReader();
    reader.onload = function (e) {
        $uploadCrop.croppie('bind', {
            url: e.target.result
        }).then(function () {
            $('.previous_image').fadeOut();
            // $('.submit-form-with-imagecrop').show();
            //  $('.add-image_gallery-image-form').val(e.target.result);
            AlertandToast('info', 'Click on Add to save !', false, true);
            $('#image_path').val('');

        });

    }
    reader.readAsDataURL(this.files[0]);

});



$(document).on('submit', '#add-form-with-imagecrop', function (e) {
    e.preventDefault();


    if (validate_form(true, true, false))
        return false;


    if ($('.previous_image').is(":visible")) {

        $('#upload-demo').croppie('destroy');
        $uploadCrop = $('#upload-demo').croppie({
            enableExif: true,
            boundary: {
                width: 100,
                height: 100
            },
            viewport: {
                width: 100,
                height: 100,
                type: 'square'
            }
        });

    }



    if (typeof $uploadCrop == 'undefined') {
        AlertandToast('warning', 'No image selected !');
        return;
    }

    var this_btn_elem = $($(('.submit-form-with-imagecrop')));
    loading_btn(this_btn_elem);

    $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'

    }).then(function (response) {
        var formData = new FormData($("#add-form-with-imagecrop")[0]);
        formData.append('photo', response);
        var form_url = $('#add-form-with-imagecrop').attr('action');
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
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            beforeSend: function () {
                $(".progress-bar").width('0%');
                $(".progress").show();
            }
        })

        result_xhr.done(function (data) {
            $(".progress-bar").width('0%');
            $(".progress").hide();

            loading_btn();

            var out = jQuery.parseJSON(data);
            if (out.status == 'success') {
                AlertandToast(out.status, out.msg, false, true);
                go_to_backpage();
            } else
                AlertandToast(out.status, 'Recheck these errors and resubmit', false, true);


            AlertandToast(out.status, out.msg, true, false);
            $('.submit-form-with-imagecrop').show();

        });

        result_xhr.fail(function () {
            AlertandToast('error', 'Page has expired, try later !');
            loading_btn();
        });
    });
});

/******** Submits image crop form and shows alert ********/




function load_user_dp() {
    $('.user_image').hide();
    let username = $('#user_image').attr('alt');

    var matches = username.match(/\b(\w)/g);
    var acronym = matches.join('');

    $('.user-avatar-text').show();
    $('.user-avatar-text').html(acronym);
}




function setSiteSettings() {
    let layout_color = localStorage.getItem("layout-color");
    $('body').removeClass();
    $('body').addClass(layout_color);
}


function saveSiteSettings() {
    let body_elem = document.body;
    let layout_color = body_elem.getAttribute('class');
    localStorage.setItem("layout-color", layout_color);
    AlertandToast('info', 'Site settings saved !', false, true);
}





$(document).on('click', '.change-color-mode', function (e) {
    e.preventDefault();
    saveSiteSettings();
});





$(document).on('input', '#search-dashboard', function (e) {
    $('.search_results').html('');
    $('.search_results').hide();

    var link_href = '';
    var keyword = $($(this)).val();
    if (keyword.length < 3) return;


    $(".dashboard-menu").each(function () {

        if ($(this)[0].children[1].innerText.toLowerCase().includes(keyword.toLowerCase())) {
            link_href = $(this)[0].href;



            //Cloning the results divs according to count
            var elem = $('.search_list-hidden').clone()[0];
            elem.classList.remove('d-none');
            elem.children[0].children[0].innerText = $(this)[0].children[1].innerHTML;
            elem.children[0].href = link_href;


            $('.search_results').append(elem);
            elem.classList.remove('search_list-hidden');


            $('.search_results').show();
        }


    });
});



function AlertandToast(status, message, alert = true, toast = true) {
    //alert(333);
    if (toast) {
        BottomToast(message);
        // var Toast = Swal.mixin({
        //     toast: true,
        //     position: 'top-end',
        //     showConfirmButton: false,
        //     timer: 3000
        // });

        // Toast.fire({
        //     icon: status,
        //     title: message
        // });
    }

    if (alert)
        alertMessage(status, message);
}


function alertMessage(status, message) {
    $('.alert-message-div').html('');

    $('body,html').animate({
        scrollTop: 0
    }, 500);

    let alert_status = (status == 'error') ? 'alert-danger' : 'alert-' + status;
    let bg_status = (status == 'error') ? 'bg-danger' : 'bg-' + status;

    alert_message = `
    <div class="alert ${alert_status} alert-dismissible fade show" role="alert">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`;

    $('.alert-message-div').html(alert_message);
    $('.alert-message-div').show(1200);





}



function toastModal(status, message, alert_modal = true, toast = true, alert = false) {
    if (toast) {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        Toast.fire({
            icon: status,
            title: message
        });
    }

    if (alert_modal)
        alertModal(status, message);
    if (alert)
        alertMessage(status, message);
}


function alertModal(status, message) {

    $('body,html').animate({
        scrollTop: 0
    }, 500);

    let alert_status = (status == 'error') ? 'alert-danger' : 'alert-' + status;
    let bg_status = (status == 'error') ? 'bg-danger' : 'bg-' + status;

    alert_message = `
    <div class="alert ${alert_status} alert-dismissible fade show" role="alert">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`;

    $('#modal-alert-message-div').html(alert_message);
    $('#modal-alert-message-div').show(1200);





}
function alertMessage(status, message) {

    $('body,html').animate({
        scrollTop: 0
    }, 500);

    let alert_status = (status == 'error') ? 'alert-danger' : 'alert-' + status;
    let bg_status = (status == 'error') ? 'bg-danger' : 'bg-' + status;

    alert_message = `
    <div class="alert ${alert_status} alert-dismissible fade show" role="alert">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`;

    $('#alert-message-div').html(alert_message);
    $('#alert-message-div').show(1200);





}


function alertMessage_old(status, message) {
    return;
    $('body,html').animate({
        scrollTop: 0
    }, 500);

    let alert_status = (status == 'error') ? 'alert-danger' : 'alert-' + status;
    let bg_status = (status == 'error') ? 'bg-danger' : 'bg-' + status;

    $('.alert-msg').addClass(alert_status);
    $('.alert-msg').addClass(bg_status);
    $('.message_content').html(message);
    $('.alert-msg').show(1200);

    setTimeout(function () {
        $('.alert-msg').fadeOut();
        $('.alert-msg').removeClass(alert_status);
        $('.alert-msg').removeClass(bg_status);
    }, 10000);


}

function loadCroppie() {
    $uploadCrop = $('#upload-demo').croppie({
        enableExif: true,
        boundary: {
            width: 1280,
            height: 430
        },
        viewport: {
            width: 1271,
            height: 419,
            type: 'square'
        }
    });
}



$(document).on('click', '.load-btn', function () {
    this.innerHTML = (this.localName == 'input') ? 'Loading ...' : 'Loading...' + '<i class="fas fa-fan fa-spin"></i>';
    this.style.opacity = "0.7";
    return true;
});




var elem;
function loading_btn(this_elem = '') {
    // return;
    var xhr_loader = document.querySelectorAll('.loader-xhr');
    if (xhr_loader.length > 0) {
        xhr_loader[0].remove();
        elem.css('opacity', '1.0');
        elem.removeAttr('disabled');
    } else {
        this_elem.attr('disabled', true);
        this_elem.css('opacity', '0.7');
        this_elem.append('<i class="fa fa-spinner fa-spin loader-xhr"></i>');
        elem = this_elem;
    }
    return;
}


function refresh_page(to_page = '') {


    setTimeout(function () {
        $(".progress-bar").width('0%'); $(".progress").show();
        $(".progress-bar").html('0%');
        location.reload(true);
    }, 1000);
}



$(document).on('click', '#checkinternetStatus', function (e) {
    e.preventDefault();
    check_internet();
});


function check_internet() {
    if (window.navigator.onLine) {
        intId.innerHTML = sucText;
        intId.style.display = "block";
        intId.style.backgroundColor = sucCol;
    } else {
        intId.innerHTML = failText;
        intId.style.display = "block";
        intId.style.backgroundColor = failCol;
    }

    setTimeout(function () {
        var fade2Out = setInterval(function () {
            if (!intId.style.opacity) {
                intId.style.opacity = 1;
            }
            if (intId.style.opacity > 0) {
                intId.style.opacity -= 0.1;
            } else {
                clearInterval(fade2Out);
                intId.style.display = "none";
            }
        }, 5);
    }, 4000);
}


if (intId) {
    if (window.navigator.onLine) {
        intId.innerHTML = sucText;
        intId.style.display = "none";
        intId.style.backgroundColor = sucCol;
    } else {
        intId.innerHTML = failText;
        intId.style.display = "block";
        intId.style.backgroundColor = failCol;
    }

    window.addEventListener("online", function () {
        intId.innerHTML = sucText;
        intId.style.display = "block";
        intId.style.backgroundColor = sucCol;
        setTimeout(function () {
            var fade2Out = setInterval(function () {
                if (!intId.style.opacity) {
                    intId.style.opacity = 1;
                }
                if (intId.style.opacity > 0) {
                    intId.style.opacity -= 0.1;
                } else {
                    clearInterval(fade2Out);
                    intId.style.display = "none";
                }
            }, 5);
        }, 7000);
    });

    window.addEventListener("offline", function () {
        intId.innerHTML = failText;
        intId.style.display = "block";
        intId.style.backgroundColor = failCol;
    });
}



