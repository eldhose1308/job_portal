"use strict";

let json_url = base_url + 'admin/users/users_json';
let captcha_url = base_url + 'change_captcha2';


$(document).on('change', '#status', function (e) {
    $("#fa_datatable").dataTable().fnDestroy();
    load_json();
    e.preventDefault();
});


function load_json() {
    var status = $("#status").val();
    var table = $('#fa_datatable').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
            "type": "GET",
            "data": {
                status: status
            },
            "url": json_url
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
    });
}



//Adding user





$(document).on('submit', '#register-form', function (e) {
    e.preventDefault();
    var this_btn_elem = $($(('.add-new-user')));
    loading_btn(this_btn_elem);

    var formData = new FormData($("#register-form")[0]);
    var form_url = $('#register-form').attr('action');
    var user_xhr = $.ajax({
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

    user_xhr.done(function (data) {
        loading_btn();
        var out = jQuery.parseJSON(data);
        toastSuccess(out.status, out.msg);
        $('.add-new-user').show();
        reload_page();
    });

    user_xhr.fail(function () {
        toastSuccess('error', 'Page has expired, try later !');
        loading_btn();

    });

});





$(document).on("click", ".change-captcha", function (e) {
    refresh_captcha();
    e.preventDefault();
});


function refresh_captcha() {
    $('.change-captcha').html('');
    $('#loader').show();

    var fetching = $.get(captcha_url);
    fetching.done(function (data) {
        $('#loader').hide();
        $('.change-captcha').html(data);

    });

    fetching.fail(function () {
        alert("error");
    })
}



