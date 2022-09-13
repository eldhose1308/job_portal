"use strict";

let results_json_url = base_url + 'admin/results/results_json';



$(document).on('change', '#status', function (e) {
    load_results_json();
    e.preventDefault();
});


$(document).on('change', '#patient_id', function (e) {
    load_results_json();
    e.preventDefault();
});


$(document).on('change', '#test_category', function (e) {
    load_results_json();
    e.preventDefault();
});


function load_results_json() {
    var status = $("#status").val();
    var patient_id = $("#patient_id").val();
    var test_category = $("#test_category").val();
    $("#na_datatable").dataTable().fnDestroy();

    var table = $('#na_datatable').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
            "type": "GET",
            "data": {
                status: status,
                patient_id: patient_id,
                test_category: test_category
            },
            "url": results_json_url
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
    });
}


//Adding


$(document).on('submit', '#results-modal-form', function (e) {
    e.preventDefault();
    var this_btn_elem = $($(('.add-results-image')));
    loading_btn(this_btn_elem);

    var formData = new FormData($("#results-modal-form")[0]);
    var form_url = $('#results-modal-form').attr('action');
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
        loading_btn();

        var out = jQuery.parseJSON(data);
        toastModal(out.status, out.msg);
        $('.add-results-image').show();
        if (out.status == 'success') {
            $('#show-resultModal').modal('hide');
            $('#modal-alert-message-div').html('');
            load_results_json();
        }
    });

    result_xhr.fail(function () {
        toastModal('error', 'Page has expired, try later !');
        loading_btn();

    });
});



$(document).on('submit', '#results-form', function (e) {
    e.preventDefault();
    var this_btn_elem = $($(('.add-results-image')));
    loading_btn(this_btn_elem);

    var formData = new FormData($("#results-form")[0]);
    var form_url = $('#results-form').attr('action');
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
        loading_btn();

        var out = jQuery.parseJSON(data);
        toastSuccess(out.status, out.msg);
        $('.add-results-image').show();
        reload_page();
    });

    result_xhr.fail(function () {
        toastSuccess('error', 'Page has expired, try later !');
        loading_btn();

    });
});
