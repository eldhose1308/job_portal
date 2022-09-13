"use strict";

let prescription_json_url = base_url + 'admin/prescriptions/prescriptions_json';



$(document).on('change', '#patient_id', function (e) {
    load_prescription_json();
    e.preventDefault();
});



$(document).on('change', '#status', function (e) {
    load_prescription_json();
    e.preventDefault();
});


function load_prescription_json() {
    var status = $("#status").val();
    var patient_id = $("#patient_id").val();
    
    $("#na_datatable").dataTable().fnDestroy();
    var table = $('#na_datatable').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
            "type": "GET",
            "data": {
                status: status,
                patient_id: patient_id
            },
            "url": prescription_json_url
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
    });
}


//Adding




$(document).on('submit', '#prescriptions-modal-form', function (e) {
    e.preventDefault();
    var this_btn_elem = $($(('.add-prescriptions-image')));
    loading_btn(this_btn_elem);

    var formData = new FormData($("#prescriptions-modal-form")[0]);
    var form_url = $('#prescriptions-modal-form').attr('action');
    var prescription_xhr = $.ajax({
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

    prescription_xhr.done(function (data) {
        loading_btn();

        var out = jQuery.parseJSON(data);
        toastModal(out.status, out.msg);
        $('.add-prescriptions-image').show();
        if (out.status == 'success') {
            $('#show-prescriptionModal').modal('hide');
            $('#modal-alert-message-div').html('');
            load_prescription_json();

        }
    });

    prescription_xhr.fail(function () {
        toastModal('error', 'Page has expired, try later !');
        loading_btn();

    });
});





$(document).on('submit', '#prescriptions-form', function (e) {
    e.preventDefault();
    var this_btn_elem = $($(('.add-prescriptions-image')));
    loading_btn(this_btn_elem);

    var formData = new FormData($("#prescriptions-form")[0]);
    var form_url = $('#prescriptions-form').attr('action');
    var prescription_xhr = $.ajax({
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

    prescription_xhr.done(function (data) {
        loading_btn();

        var out = jQuery.parseJSON(data);
        toastSuccess(out.status, out.msg);
        $('.add-prescriptions-image').show();
        reload_page();
    });

    prescription_xhr.fail(function () {
        toastSuccess('error', 'Page has expired, try later !');
        loading_btn();

    });
});
