"use strict";

let module_json_url = base_url + 'admin/modules/modules_json';
let module_group_json_url = base_url + 'admin/modules/module_group_json';

$(document).on('change', '#status', function (e) {
    $("#na_datatable").dataTable().fnDestroy();
    load_modules_json();
    e.preventDefault();
});


function load_modules_json() {
    var status = $("#status").val();

    var table = $('#na_datatable').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
            "type": "GET",
            "data": {
                status: status
            },
            "url": module_json_url
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
    });
}



function load_module_groups_json() {

    var table = $('#na_datatable').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
            "url": module_group_json_url
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
    });
}


//Adding



$(document).on('submit', '#modules-form', function (e) {
    e.preventDefault();
    var this_btn_elem = $($(('.add-modules-image')));
    loading_btn(this_btn_elem);

    var formData = new FormData($("#modules-form")[0]);
    var form_url = $('#modules-form').attr('action');
    var usertype_xhr = $.ajax({
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
            $(".progress-bar").width('0%');$(".progress").show();
        }
    })

    usertype_xhr.done(function (data) {
        loading_btn();

        var out = jQuery.parseJSON(data);
        toastSuccess(out.status, out.msg);
        //$('#modules-form')[0].reset();
        $('.add-modules-image').show();
        reload_page();
    });

    usertype_xhr.fail(function () {
        toastSuccess('error', 'Page has expired, try later !');
        loading_btn();

    });
});




$(document).on('submit', '#module-group-form', function (e) {
    e.preventDefault();
    loading_btn($($(this)));

    var formData = new FormData($("#module-group-form")[0]);
    var submit_url = $('#module-group-form').attr('action');
    $.ajax({
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
        type: 'POST',
        url: submit_url,
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $(".progress-bar").width('0%');$(".progress").show();
        },
        error: function () {
            loading_btn();
            toastSuccess('error', 'Page has expired, try later !');
        },
        success: function (resp) {
            loading_btn();
            var out = jQuery.parseJSON(resp);
            toastSuccess(out.status, out.msg);
            reload_page();
        }
    });
});