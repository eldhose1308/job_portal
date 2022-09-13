"use strict";

let orders_json_url = base_url + 'admin/orders/orders_json';
let departments_json_url = base_url + 'admin/departments/departments_json';
let designations_json_url = base_url + 'admin/designations/designations_json';
let teachers_json_url = base_url + 'admin/teachers/teachers_json';
let reports_json_url = base_url + 'admin/reports/reports_json';
let generated_reports_json_url = base_url + 'admin/reports/generated_reports_json';



$(document).on('change', '.reports-status', function (e) {
    load_reports_json();
    e.preventDefault();
});

$(document).on('change', '.reports-gen-status', function (e) {
    load_generated_reports_json();
    e.preventDefault();
});

$(document).on('change', '.orders-status', function (e) {
    load_page();
    e.preventDefault();
});


$(document).on('change', '.departments-status', function (e) {
    load_page();
    e.preventDefault();
});

$(document).on('change', '.teachers-status', function (e) {
    load_page();
    e.preventDefault();
});




function load_reports_json() {
    var status = $("#status").val();

    $("#na_datatable").dataTable().fnDestroy();

    var table = $('#na_datatable').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
            "type": "GET",
            "data": {
                status: status
            },
            "url": reports_json_url
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
    });
}



function load_generated_reports_json() {
    var status = $("#status").val();

    $("#na_datatable").dataTable().fnDestroy();

    var table = $('#na_datatable').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
            "type": "GET",
            "data": {
                status: status
            },
            "url": generated_reports_json_url
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
    });
}


//Adding


$(document).on('submit', '#modal-form', function (e) {
    e.preventDefault();
    var this_btn_elem = $($(('.submit-modal')));
    loading_btn(this_btn_elem);

    var formData = new FormData($("#modal-form")[0]);
    var form_url = $('#modal-form').attr('action');
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
        toastModal(out.status, out.msg);
        $('.submit-modal').show();
        if (out.status == 'success') {
            $('#show-Modal').modal('hide');
            $('#modal-alert-message-div').html('');
            load_page();
        }
    });

    result_xhr.fail(function () {
        toastModal('error', 'Page has expired, try later !');
        loading_btn();

    });
});



